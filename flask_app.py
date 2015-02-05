from flask import Flask, request, redirect, jsonify
import twilio.twiml

app = Flask(__name__)

@app.route("/", methods=['GET', 'POST'])
def sendResponse():
    print "message received"
    response = twilio.twiml.Response()
    response.message("Auto-response")
    return str(response)

@app.route('/hello', methods=['GET'])
def get_tasks():
    return "hello"

@app.route("/webapi/masssms", methods=['POST'])
def sendSms():
	# if not request.json: # or not "title" in request.json:
	# 	abort(400) #currently will accept any post request
	print "ok"
	print request.json
	return jsonify({'number': 2}), 201

if __name__ == "__main__":
    app.run(debug=True)