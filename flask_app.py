from flask import Flask, request, redirect, jsonify
import twilio.twiml
#import json
from firebase import firebase
from flask.ext.cors import CORS, cross_origin


app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'


@app.route("/", methods=['GET', 'POST'])


@app.route('/twilioapi', methods=['GET'])
def incoming_message():

    #get details of incoming message
    senderNumber = request.values.get('From', None)
    messageBody = request.values.get('Body', None)

    #then log the message
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    messageData = {'message' : messageBody, 'number' : senderNumber}
    result = database.post('/messages', messageData)
    return "ok"

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