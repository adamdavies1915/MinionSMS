from flask import Flask, request, redirect, jsonify
import twilio.twiml
#import json
from firebase import firebase

app = Flask(__name__)

@app.route("/", methods=['GET', 'POST'])
# def sendResponse():
#     # senderNumber = request.values.get('From', None)
#     # messageBody = request.values.get('Body', None)

#     #print senderNumber
#     #print messageBody
#     # firebasePost = 'hello'

#     #print "message received"
#     # response = twilio.twiml.Response()
#     # response.message(messageBody)

#     database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
#     messageData = [{'message' : 'Testing3', 'number' : '07807709499'}]

#     result = database.post('/messages', messageData)
#     print result

@app.route('/twilioapi', methods=['GET'])
def incoming_message():

    #first log the message
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    messageData = [{'message' : 'Testing4', 'number' : '07807709499'}]
    result = database.post('/messages', messageData)
    return "ok"

@app.route("/webapi/masssms", methods=['POST'])
def sendSms():
	# if not request.json: # or not "title" in request.json:
	# 	abort(400) #currently will accept any post request
	print "ok"
	print request.json
	return jsonify({'number': 2}), 201

if __name__ == "__main__":
    app.run(debug=True)