from flask import Flask, request, redirect, jsonify
import twilio.twiml
from twilio.rest import TwilioRestClient
from firebase import firebase
import json
from flask.ext.cors import CORS, cross_origin

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

account_sid = "AC6db8f3d3a7c1d160f663c5e615bbaade"
auth_token = "8a6ec3b89f099e9d437089d1bd50cac6"
client = TwilioRestClient(account_sid, auth_token)

@app.route("/", methods=['GET', 'POST'])
def sendResponse():
    print "message received"
    response = twilio.twiml.Response()
    response.message("Auto-response")
    return str(response)

@app.route('/twilioapi', methods=['GET', 'POST'])
def incoming_message():

    #get details of incoming message
    sender = request.values.get('From', None)
    messageBody = request.values.get('Body', None)
    dealtWith = False

    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)

    replyData = "OK" #change
    response = twilio.twiml.Response()

    if 'order' in str(messageBody).lower():
        orderBody = request.values.get("Body", None)
        fromNumber = request.values.get("From", None)
        orderID = database.post('/messages', None).get('name') #get id from firebase first so that ID 
                                                               #so that ID can be in the object. Needed 
                                                               #for order completion ect.
        orderData = {'dealtwith': False, 'message': orderBody, 'number': fromNumber, 'orderID': orderID}
        database.patch('/messages/'+orderID, orderData)
        response.say("Thank you for your order. Your order is currently being processed and will be accepted shortly. Your order id is "+orderID)

    ## Otherwise Tree Responses


    return str(response)

@app.route("/webapi/masssms", methods=['POST'])
@cross_origin()
def sendSms():
    # if not request.json: # or not "title" in request.json:
    # abort(400) #currently will accept any post request
    # return request.json.get("group")
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    result = database.get("group/", request.json.get("group")+"/contacts")
    if result == None:
        return "Error"
    for x in result:
        # try:
        if x != "":
            number = database.get("contact/", result[x]["contactid"])["number"]
            message = client.messages.create(to=number, from_="+441255411083",
                                         body=request.json.get("message"))

        # except twilio.TwilioRestException: eror handeling would be a very good idea
       #    print e
    return "200 OK"

@app.route("/webapi/ordercomplete", methods=['POST'])
@cross_origin()
def completeOrder():

    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    orderID = request.json.get("orderID")

    number = database.get("messages/"+orderID+"/number", None)
    message = "Your order is now ready." 
    client.messages.create(to=number, from_="+441255411083",
                                         body=message)



    database.patch('/messages/'+orderID, {'dealtwith': True})
    return  "200 OK"


@app.route("/webapi/orderaccepted", methods=['POST'])
@cross_origin()
def acceptOrder():
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    orderID = request.json.get("orderID")

    number = database.get("messages/"+orderID+"/number", None)
    message = "Your order has been accepted" 
    client.messages.create(to=number, from_="+441255411083",
                                         body=message)
    return "200 OK"

@app.route("/webapi/orderdeclined", methods=['POST'])
@cross_origin()
def declineOrder():
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    orderID = request.json.get("orderID")
    
    number = database.get("messages/"+orderID+"/number", None)
    message = "Sorry you're order has been declined. Please contact us directly" 
    client.messages.create(to=number, from_="+441255411083",
                                         body=message)

    database.delete('/messages/'+orderID, None)
    return "200 OK"

if __name__ == "__main__":
    app.run(debug=True)