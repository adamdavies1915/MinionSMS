from flask import Flask, request, redirect, jsonify
import twilio.twiml
from firebase import firebase
import json

app = Flask(__name__)

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
	# 	abort(400) #currently will accept any post request
	# return request.json.get("group")
    database = firebase.FirebaseApplication('https://group15.firebaseio.com/', None)
    result = database.get("group/", request.json.get("group"))
    # return request.json.get("group")
    input = json.dumps(result["contacts"])
    return str(input)
    # return "ok"

	# return jsonify({'number': 2}), 201

if __name__ == "__main__":
    app.run(debug=True)