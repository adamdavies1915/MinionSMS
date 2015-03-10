from flask import Flask, request, redirect, jsonify
import twilio.twiml, twilio.rest
#import json
from firebase import firebase
from flask.ext.cors import CORS, cross_origin


app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'


@app.route("/", methods=['GET', 'POST'])


@app.route('/twilioapi', methods=['GET'])
def incoming_message():
    account_sid = "AC6db8f3d3a7c1d160f663c5e615bbaade"
    auth_token  = "8a6ec3b89f099e9d437089d1bd50cac6"

    client = twilio.rest.TwilioRestClient(account_sid, auth_token)

    #get details of incoming message
    sender = request.values.get('From', None)
    messageBody = request.values.get('Body', None)

    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)

    #then log the message
    messageData = {'message' : messageBody, 'number' : sender}
    database.post('/messages', messageData)

    if 'order' in str(messageBody).lower():
        #process_order()
        newMessageBody = "Thank you for your order. Your order number is h9843ru4hfu"
        try:
            client.messages.create(body=newMessageBody,
                                             to = sender,
                                             from_="+441255411083")

            replyData = {'groupID' : 'group', 'message' : newMessageBody}
            database.post('/outgoing', replyData)

        except twilio.TwilioRestException as e:
            print e

    return 'ok'

#def process_order(sender, order, db, twilioClient):


@app.route("/webapi/masssms", methods=['POST'])
@cross_origin()
def sendSms():
	# if not request.json: # or not "title" in request.json:
	# 	abort(400) #currently will accept any post request
    # print request.json
	return "ok"
# 	return jsonify({'number': 2}), 201

if __name__ == "__main__":
    app.run(debug=True)