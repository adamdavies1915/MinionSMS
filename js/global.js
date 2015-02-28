function openFBR(attr)
{
	return new Firebase("https://group15.firebaseio.com/"+attr);
}

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

function createContact()
{
	//document.getElementById("contactForm").disabled = true;
	var contact = (openFBR("contact"));
	contact.push({
		name : document.getElementById("firstNText").value+" "+document.getElementById("surNText").value,
	    number: document.getElementById("numberText").value,
	    groupid: document.getElementById("groupText").value
	});
	//ADD GROUPCONTACT STUFF

}

function createContactGroup()
{
	//document.getElementById("contactForm").disabled = true;
	var group = (openFBR("group"));
	group.push({
	    name: document.getElementById("groupText").value
	});

}

function addContactToGroup(groupID,contactID)
{
	var groupcontacts = (openFBR("group/"+groupID+"/contacts"));
	groupcontacts.push({
	    contactid: contactID
	});
}

function deleteContactFromGroup(groupID, contactID)
{
	var groupcontacts = (openFBR("group/"+groupID+"/contacts"));
	groupcontacts.once("value",function(ss){
	    ss.forEach(function(contact){
	    	if(contact.val().contactid==contactID) 
	    	{
	    		console.dir("equality!");
	    		openFBR("group/"+groupID+"/contacts/"+contact.key()).remove();
	    	}
	    });
	});
}

function displayLatest(snapshot)
{
	var tableContent ="";
    snapshot.forEach(function(ss){
      tableContent = tableContent+"<tr><td>"+ss.val().number+"</td><td>"+ss.val().message+"</td></tr>";
    });

    var table = "<table class=\"table\"><thead><tr><th>Latest Orders</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
    document.getElementById("latestTable").innerHTML = table;
}

function displayContacts(snapshot)
{
	var contactGroups = openFBR("group");
	
	contactGroups.once("value", function(groupsnapshot){
		var x=0;
		var tableContent ="";
		var surname="";
	    snapshot.forEach(function(contactsnap){
	    	
	    	var groupsList="";
	    	groupsnapshot.forEach(function(groupsnap){
				var del=false;
				groupsnap.child("contacts").forEach(function(groupcontactsnap){
					if(groupcontactsnap.val().contactid==contactsnap.key()) del = true;
				})
				if(!del)
				{
					groupsList += "<li><a id=\""+groupsnap.key()+"\" class=\"add\" tabindex=\"-1\" href=\"#\">Add to "+groupsnap.val().name+"</a></li>";
				}
				else
				{
					groupsList += "<li><a id=\""+groupsnap.key()+"\" class=\"rem\" tabindex=\"-1\" href=\"#\">Remove from "+groupsnap.val().name+"</a></li>";
				}
			});

			x++;
			if((surname=contactsnap.val().name.split(" ")[1])==undefined) surname = "-";
			tableContent = tableContent+"<tr id=\""+contactsnap.key()+"\"><td>"+x+"</td><td>"+contactsnap.val().name.split(" ")[0]+"</td><td>"+surname+"</td> <td>"+contactsnap.val().number+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu\"><li><a tabindex=\"-1\" href=\"#\">Edit</a></li><li><a class=\"delete\" tabindex=\"-1\" href=\"#\">Delete</a></li><li class=\"divider\"></li>"+groupsList+"</ul>";
	    });

	    var table = "<table class=\"table\"><thead><tr><th>#</th><th>First</th><th>Last</th><th>Number</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
	    document.getElementById("contactsTable").innerHTML = table;
	});
}

function contactsTableFunctionality(evt)
{
	if((!evt.target.id=="")||
	   (!evt.target.id=="dropdownMenu"))
	{
		if(evt.target.className=="add")
		{
			var groupid = evt.target.id;
			var contactid =	evt.target.parentElement
				.parentElement
				.parentElement
				.parentElement
				.parentElement
				.parentElement.id;
			addContactToGroup(groupid,contactid);
		}
		if(evt.target.className=="rem")
		{
		console.dir("entered");
		var groupid = evt.target.id;
		var contactid =	evt.target.parentElement
			.parentElement
			.parentElement
			.parentElement
			.parentElement
			.parentElement.id;
		deleteContactFromGroup(groupid,contactid);
		}
	}

	if(evt.target.className=="delete")
	{
		console.dir(evt.target.parentElement
			.parentElement
			.parentElement
			.parentElement
			.parentElement
			.parentElement
			);
		//TODO: IJMPLEMENT!
	}
	if(evt.target.className=="edit")
	{
		console.dir(evt.target.parentElement
			.parentElement
			.parentElement
			.parentElement
			.parentElement
			.parentElement
			);
		//TODO: IMPLEMENT!
	}


}