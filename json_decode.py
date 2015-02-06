import json
import time

def checkjson(a):
	b = json.loads(a)
	if len(b["number"]) == 11:
		if len(b["message"]) !=0:
			print 'true'
			return True
	print 'false'
	return False


jsonTest = {'message' : 'Hello, World!', 'number' : '07947393586'}
checkjson(json.dumps(jsonTest))
jsonTest = {'message' : 'Hello, World!', 'number' : '079473'}
checkjson(json.dumps(jsonTest))
jsonTest = { 'number' : '079473'}
checkjson(json.dumps(jsonTest))

time.sleep(5)