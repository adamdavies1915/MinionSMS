from flask import Flask, request, redirect, jsonify
import twilio.twiml
from twilio.rest import TwilioRestClient
from firebase import firebase
import json
from flask.ext.cors import CORS, cross_origin
import ConfigParser
import time

# From pythonanywhere support- only use in python anywhere NOT localy
import os
from urlparse import urlparse

from twilio.rest.resources import Connection
from twilio.rest.resources.connection import PROXY_TYPE_HTTP

proxy_url = os.environ.get("http_proxy")
host, port = urlparse(proxy_url).netloc.split(":")
Connection.set_proxy_info(host, int(port), proxy_type=PROXY_TYPE_HTTP)

# end

app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

account_sid = "AC301918810de783fef63162d58afd5052"
auth_token = "c96ec8bfd7c5d5abcb48f253ce3cb25b"
client = TwilioRestClient(account_sid, auth_token)

Config = ConfigParser.RawConfigParser()
Config.read('mysite/config.cfg')
twilioNumber = Config.get('data', 'number')
print twilioNumber
twilioNumber = +441173252277
print twilioNumber
newOrderMessage = Config.get('data', 'new')
declinedMessage = Config.get('data', 'declined')
acceptedMessage = Config.get('data', 'accepted')
readyMessage = Config.get('data', 'ready')


@app.route("/", methods=['GET', 'POST'])
def sendResponse():
    print "message received"
    response = twilio.twiml.Response()
    response.message("Auto-response")
    return str(response)

@app.route('/twilioapi', methods=['GET', 'POST'])
def incoming_message():
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)

    #get details of incoming message
    sender = request.values.get('From', None)
    messageBody = request.values.get('Body', None)
    contactsList = database.get('/contact', None)
    dealtWith = False


    replyData = "500" #server error if something breaks
    response = twilio.twiml.Response()

    if 'order' in str(messageBody).lower():
        orderBody = request.values.get("Body", None)
        fromNumber = request.values.get("From", None)
        orderID = database.post('/messages', None).get('name') #get id from firebase first so that ID
                                                               #so that ID can be in the object. Needed
                                                               #for order completion ect.
        orderData = {'dealtwith': False, 'message': orderBody, 'number': fromNumber, 'orderID': orderID}
        database.patch('/messages/'+orderID, orderData)
        response.message(newOrderMessage + " "+orderID)

     #if not an order use auto rules
    else:
        rules = database.get('/rules/information/ifNewUser/rules', None)

        if messageBody in rules:
            pathway = '/rules/information/ifNewUser/rules/' + messageBody
            autoResponse = database.get('/rules/information/ifNewUser/rules/' + messageBody + '/reply', None)
            client.messages.create(to= sender, from_=twilioNumber, body= autoResponse)
            if 'subrules' in database.get(pathway, None):
                database.post('/autoStates', {'number' : sender, 'lastmessage' : messageBody, 'pathway' : pathway})
        else:
            autoUsers = database.get('/autoStates', None)

            for user in autoUsers:
                if sender == database.get('/autoStates/' + user + '/number', None):
                    subRules(database.get('/autoStates/' + user + '/pathway', None), sender, messageBody, database, user)


    return str(response)

def subRules(pathway, number, lastMsg, db, autoID):

    if 'subrules' in db.get(pathway, None):
        validResponses = db.get(pathway +'/subrules' , None)

        if lastMsg in validResponses:
            response = db.get(pathway + '/subrules/' + lastMsg + '/reply', None)
            client.messages.create(to= number, from_=twilioNumber, body= response)
            newPath = pathway + '/subrules/' + lastMsg
            if 'subrules' in db.get(newPath, None):
                db.patch('/autoStates/' + autoID, {'lastmessage' : lastMsg, 'number' : number, 'pathway' : newPath})
            else:
                db.delete('/autoStates/', autoID)

@app.route("/webapi/masssms", methods=['POST'])
@cross_origin()
def sendSms():
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    result = database.get("group/", request.json.get("group")+"/contacts")
    if result == None:
        return "Error"
    for x in result:
        if x != "":
            number = database.get("contact/", result[x]["contactid"])["number"]
            message = client.messages.create(to=number, from_=twilioNumber,
                                         body=request.json.get("message"))

    return "200 OK"

@app.route("/webapi/orderready", methods=['POST'])
@cross_origin()
def completeOrder():

    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    orderID = request.json.get("orderID")

    number = database.get("messages/"+orderID+"/number", None)
    message = readyMessage
    client.messages.create(to=number, from_=twilioNumber,
                                        body=message)

    database.patch('/messages/'+orderID, {'status': 'ready'})
    return  "200 OK"


@app.route("/webapi/orderaccepted", methods=['POST'])
@cross_origin()
def acceptOrder():
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    orderID = request.json.get("orderID")

    number = database.get("messages/"+orderID+"/number", None)
    message = acceptedMessage
    client.messages.create(to=number, from_=twilioNumber,
                                         body=message)
    database.patch('/messages/'+orderID, {'status': 'accepted'})
    return "200 OK"

@app.route("/webapi/orderdeclined", methods=['POST'])
@cross_origin()
def declineOrder():
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    orderID = request.json.get("orderID")

    number = database.get("messages/"+orderID+"/number", None)
    message = declinedMessage
    client.messages.create(to=number, from_=twilioNumber,
                                         body=message)

    database.delete('/messages/'+orderID, None)

    return "200 OK"

if __name__ == "__main__":
    app.run(debug=True)