import json

def checkjson(a):
	b = json.loads(a)
	if len(b["number"]) == 11:
		if len(b["message"]) !=0:
			return true
	return false
