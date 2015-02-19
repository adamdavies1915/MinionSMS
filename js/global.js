function transmitMassMessage()
{
	document.getElementById("messageText").disabled = true;

	var url = "http://group15.pythonanywhere.com/webapi/masssms";
	var method = "POST";
	var postData = "number : 07731784340, message : Hello World!";
	var async = true;
	var request = new XMLHttpRequest();
	// request.onload = function () {
	//    var status = request.status; // HTTP response status, e.g., 200 for "200 OK"
	//    var data = request.responseText; // Returned data, e.g., an HTML document.
	// }
	//NEEDED FOR FEEDBACK

	request.open(method, url, async);
	request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	request.send(postData);


	document.getElementById("messageText").disabled = false;
	document.getElementById("messageText").value = "";
}

function displayOutstanding(snapshot)
{
	var tableContent ="";
	snapshot.forEach(function(ss) {
		tableContent = tableContent+"<tr><td>"+ss.val().number+"</td><td>"+ss.val().message+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu1\"><li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Mark Done</a></li><li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-remove\"></span> Decline </a></li></ul></div></div></td></tr>";
	});
	document.getElementById("outstandingTable").innerHTML = "<thead><tr><th>Orders</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
}

function createContact(){
	    	//document.getElementById("contactForm").disabled = true;
	    	var myFirebaseRef = new Firebase("https://group15.firebaseio.com/contact");
	    	myFirebaseRef.push({
	    		name : document.getElementById("firstNText").value+" "+document.getElementById("surNText").value,
			    number: document.getElementById("numberText").value,
			    groupid: document.getElementById("groupText").value
			});
			//ADD GROUPCONTACT STUFF

		}

function createContactGroup(){
	    	//document.getElementById("contactForm").disabled = true;
	    	var myFirebaseRef = new Firebase("https://group15.firebaseio.com/group");
	    	myFirebaseRef.push({
	    		name : document.getElementById("firstNText").value+" "+document.getElementById("surNText").value,
			    number: document.getElementById("numberText").value,
			    groupid: document.getElementById("groupText").value
			});

		}

function displayLatest(snapshot){
	var tableContent ="";
    snapshot.forEach(function(ss) {
      tableContent = tableContent+"<tr><td>"+ss.val().number+"</td><td>"+ss.val().message+"</td></tr>";
    });

    var table = "<table class=\"table\"><thead><tr><th>Latest Orders</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
    document.getElementById("latestTable").innerHTML = table;
}