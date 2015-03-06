from flask import Flask, request, redirect, jsonify
import twilio.twiml
from twilio.rest import TwilioRestClient
from firebase import firebase
import json

app = Flask(__name__)

account_sid = "AC6db8f3d3a7c1d160f663c5e615bbaade"
auth_token = "8a6ec3b89f099e9d437089d1bd50cac6"
client = TwilioRestClient(account_sid, auth_token)

@app.route("/", methods=['GET', 'POST'])
def sendResponse():
    print "message received"
    response = twilio.twiml.Response()
    response.message("Auto-response")
    return str(response)

@app.route('/hello', methods=['GET'])
def get_tasks():
    database = firebase.FirebaseApplication("https://group15.firebaseio.com", None)

    result = database.post("/hello", "hello world")
    return "ok"

@app.route("/webapi/masssms", methods=['POST'])
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
	   #  	print e
    return "ok"

if __name__ == "__main__":
    app.run(debug=True)