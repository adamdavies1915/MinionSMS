from flask import Flask, request, redirect
import twilio.twiml

app = Flask(__name__)

@app.route("/", methods=['GET', 'POST'])
def sendResponse():
    print "message received"
    response = twilio.twiml.Response()
    response.message("Auto-response")
    return str(response)

@app.route("/webapi/masssms", methods=['POST'])
def sendSms():
	if not request.json: # or not "title" in request.json:
		abort(400)
	print request.json

if __name__ == "__main__":
    app.run(debug=True)