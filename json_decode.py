import json
import time
from firebase import firebase

def checkjson(a):
    b = json.loads(a)
    if len(b['number']) == 11:
	    if(checkBlacklist(b["number"])):
	        if (len(b["message"]) !=0):
    		    print 'success'
    		    return 0
    	    else:
    	        print 'Invalid Message'
    	        return 1
    	else:
    	    return 3
    else:
        print 'Invalid Number Received'
        print 'Something Weird Happened'
        return 2

def checkBlacklist(a):
    fireBase = firebase.FirebaseApplication('https://group15.firebaseio.com', None)
    result = fireBase.get('/blacklist', None)
    for x in result:
        y = fireBase.get('/blacklist', x)
        if a == y["number"]:
            print "blacklisted"
            return False
    print "clear"
    return True


jsonTest = {'message' : 'Hello, World!', 'number' : '07947393586'}
checkjson(json.dumps(jsonTest))
jsonTest = {'message' : 'Hello, World!', 'number' : '079473'}
checkjson(json.dumps(jsonTest))
jsonTest = {'message' : '', 'number' : '079473'}
checkjson(json.dumps(jsonTest))
checkBlacklist(json.dumps('07941395218'))
checkBlacklist(json.dumps('07947393586'))
time.sleep(5)