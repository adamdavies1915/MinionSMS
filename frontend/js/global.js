function openFBR(attr)
{
	return new Firebase("https://group15.firebaseio.com/"+attr);
}

function transmitMassMessage()
{

	var url = "http://group15.pythonanywhere.com/webapi/masssms";
	var method = "POST";
	var postData = JSON.stringify({"group":document.getElementById("recip").parentElement.id, "message": document.getElementById("messageText").value})
	var async = true;
	var request = new XMLHttpRequest();

	request.onload = function () {
	   status = request.status; // HTTP response status, e.g., 200 for "200 OK"
	   if(status==200) 
	   {
	   		document.getElementById("feedbackhead").innerHTML="Completed!";
	   		document.getElementById("messageText").value= "";
	   		document.getElementById("feedbackbody").innerHTML="Message sent.";
	   }
	   else 
	   {
	   		document.getElementById("feedbackhead").innerHTML="Oops!";
	   		document.getElementById("feedbackbody").innerHTML="Something went wrong. Your message was not sent; please try again later.";
	   }
	}

	request.open(method, url, async);
	request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	request.send(postData);

	
}

function createContact()
{
	var contact = (openFBR("contact"));
	contact.push({
		name : document.getElementById("firstNText").value+" "+document.getElementById("surNText").value,
	    number: document.getElementById("numberText").value
	}, function(error){
		if(error)
		{
			document.getElementById("feedbackheader").innerHTML="Oops!";
	   		document.getElementById("feedbackbody").innerHTML="Something went wrong. Contact was not saved; please try again later.";
		}
		else
		{
			window.location.href="./masscontacts.php";
		}
	});

}

function editContact(contactid)
{
	var exists = false;
	var contacts = (openFBR("contact"));
	contacts.once("value",function(contactsnap){
		contactsnap.forEach(function(contact){
			if(contact.key()==contactid) exists = true;
		});
		if(exists) contacts.child(contactid).set({
			name : document.getElementById("firstNText").value+" "+document.getElementById("surNText").value,
	    	number: document.getElementById("numberText").value
		}, function(error){
			if(error)
			{
				document.getElementById("feedbackheader").innerHTML="Oops!";
		   		document.getElementById("feedbackbody").innerHTML="Something went wrong. Contact was not saved; please try again later.";
			}
			else
			{
				window.location.href="./masscontacts.php";
			}
		});
	});
}

function createContactGroup()
{
	var group = (openFBR("group"));
	group.push({
	    name: document.getElementById("groupText").value
	}, function(error){
		if(error)
		{
			document.getElementById("feedbackheader").innerHTML="Oops!";
	   		document.getElementById("feedbackbody").innerHTML="Something went wrong. Group was not saved; please try again later.";
		}
		else
		{
			window.location.href="./masscontacts.php";
		}
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
			tableContent = tableContent+"<tr id=\""+contactsnap.key()+"\"><td>"+x+"</td><td>"+contactsnap.val().name.split(" ")[0]+"</td><td>"+surname+"</td> <td>"+contactsnap.val().number+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu\"><li><a tabindex=\"-1\" href=\"./newcontact.php?id="+contactsnap.key()+"\">Edit</a></li><li><a class=\"delete\" tabindex=\"-1\" href=\"#\">Delete</a></li><li class=\"divider\"></li>"+groupsList+"</ul>";
	    });

	    var table = "<table class=\"table\"><thead><tr><th>#</th><th>First</th><th>Last</th><th>Number</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
	    document.getElementById("contactsTable").innerHTML = table;
	});
}

function deleteContact(contactid)
{
	openFBR("contact/"+contactid).remove();
	openFBR("group").once("value", function(groupsnapshot){
		groupsnapshot.forEach(function(group){
			deleteContactFromGroup(group.key(),contactid);
		});
	});
}

function deleteAutoRule(autoid)
{
	openFBR("rules/information/ifNewUser/rules/"+autoid).remove();
}

function par6(evttarget)
{
	return evttarget.parentElement
				.parentElement
				.parentElement
				.parentElement
				.parentElement
				.parentElement;
}

function contactsTableFunctionality(evt)
{
	if((!evt.target.id=="")||
	   (!evt.target.id=="dropdownMenu"))
	{
		if(evt.target.className=="add")
		{
			var groupid = evt.target.id;
			var contactid =	par6(evt.target).id;
			console.dir(par6(evt.target)
			);
			addContactToGroup(groupid,contactid);
		}
		if(evt.target.className=="rem")
		{
			var groupid = evt.target.id;
			var contactid =	par6(evt.target).id;
			console.dir(par6(evt.target)
			);
			deleteContactFromGroup(groupid,contactid);
		}
	}

	if(evt.target.className=="delete")
	{
		var contactid = par6(evt.target).id;
		deleteContact(contactid);
	}
}

function displayOutstanding(snapshot)
{
	var tableContent ="";
	snapshot.forEach(function(messagesnap) {
		if(messagesnap.val().status !== "completed")
			tableContent = tableContent+"<tr id=\""+messagesnap.key()+"\"><td>"+messagesnap.val().number+"</td><td>"+messagesnap.val().message+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu1\"><li role=\"presentation\"><a class=\"accept\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Accept</a></li><li role=\"presentation\"><a class=\"ready\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Ready</a></li><li role=\"presentation\"><a class=\"contact\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Add to Contacts</a></li><li role=\"presentation\"><a class=\"marketing\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Add to Marketing</a></li><li role=\"presentation\"><a class=\"markdone\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Mark Done</a></li><li role=\"presentation\"><a class=\"decline\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-remove\"></span> Decline </a></li></ul></div></div></td></tr>";
	});
	document.getElementById("outstandingTable").innerHTML = "<thead><tr><th>Orders</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
}

function displayCompleted(snapshot)
{
	var tableContent ="";
	snapshot.forEach(function(messagesnap) {
		if(messagesnap.val().status === "completed")
			tableContent = tableContent+"<tr id=\""+messagesnap.key()+"\"><td>"+messagesnap.val().number+"</td><td>"+messagesnap.val().message+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu1\"><li role=\"presentation\"><a class=\"contact\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Add to Contacts</a></li><li role=\"presentation\"><a class=\"marketing\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Add to Marketing</a></li></ul></div></div></td></tr>";
	});
	document.getElementById("completedTable").innerHTML = "<thead><tr><th>Orders</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
}

function traverseAutoSubrules(subrulessnap,parent,parentin)
{
	var tableContent="";
	var optionsList ="";
	subrulessnap.forEach(function(subrule){
		tableContent=tableContent+"<tr id=\""+parentin+"/subrules/"+subrule.key()+"\"><td>"+parent+"</td><td>"+subrule.key()+"</td><td>"+subrule.val().reply+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu1\"><li role=\"presentation\"><a class=\"delete\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-remove\"></span>Delete</a></li></ul></div></div></td></tr>";
		optionsList=optionsList+"<option value=\""+parentin+"/subrules/"+subrule.key()+"/subrules/"+"\">"+subrule.val().reply+"</option>";
		if(subrule.hasChild("subrules")) 
		{
			var traversal = traverseAutoSubrules(subrule.child("subrules"),parent+" > "+subrule.val().reply,parentin+"/subrules/"+subrule.key());
			tableContent=tableContent+traversal[0];
			optionsList=optionsList+traversal[1];
		}
	});
	return [tableContent,optionsList];
}

function displayAutoRules(snapshot)
{
	var tableContent ="";
	var optionsList ="";
	snapshot.forEach(function(toplevelrule) {
		tableContent = tableContent+"<tr id=\""+toplevelrule.key()+"\"><td>-</td><td>"+toplevelrule.key()+"</td><td>"+toplevelrule.val().reply+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu1\"><li role=\"presentation\"><a class=\"delete\" role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-remove\"></span>Delete</a></li></ul></div></div></td></tr>"
		optionsList=optionsList+"<option value=\""+toplevelrule.key()+"/subrules/"+"\">"+toplevelrule.val().reply+"</option>";
			if(toplevelrule.hasChild("subrules")) 
			{
				var traversal = traverseAutoSubrules(toplevelrule.child("subrules"),toplevelrule.val().reply,toplevelrule.key());
				tableContent=tableContent+traversal[0];
				optionsList=optionsList+traversal[1];
			}
	});
	document.getElementById("automationTable").innerHTML = "<thead><tr><th>Parent</th><th>Input</th><th>Response</th></tr></thead><tbody>"+tableContent+"<tr><td><select id=\"parentSelect\"><option value=\"\">-</option>"+optionsList+"</select></td><td><div class=\"input-group\"><input id=\"inputText\" type=\"text\" class=\"form-control\" placeholder=\"Input\" aria-describedby=\"basic-addon2\"></input></div></td><td><div class=\"input-group\"><input id=\"responseText\" type=\"text\" class=\"form-control\" placeholder=\"Response\" aria-describedby=\"basic-addon2\"></input></div></td><td><button type=\"button\" id=\"addNewAuto\" class=\"btn btn-default navbar-btn pull-right\">Add new</button></td></tr></tbody></table>";
	document.getElementById("addNewAuto").addEventListener("click", addNewAutoRule, false);
}

function autoTableFunctionality(evt)
{
	if(evt.target.className=="delete")
	{
		var autoid = par6(evt.target).id;
		console.dir(autoid);
		deleteAutoRule(autoid);
		
	}
}

function messageTableFunctionality(evt)
{
	if(evt.target.className=="decline")
	{
		var url = "http://group15.pythonanywhere.com/webapi/orderdeclined";
	}
	if(evt.target.className=="accept"){
		var url = "http://group15.pythonanywhere.com/webapi/orderaccepted";
	}
		if(evt.target.className=="ready"){
		var url = "http://group15.pythonanywhere.com/webapi/orderready";
	}
	if(evt.target.className=="markdone")
	{
		var messageid = par6(evt.target).id;
		openFBR("messages/"+messageid+"/status").set("completed");
	}
	if(evt.target.className=="contact"){
		var contactName = prompt("Please enter the contact name");
		var messageid = par6(evt.target).id;		
		openFBR("messages/"+messageid).on("value", function(snapshot) {
			contactRef = openFBR("contact");
			contactRef.push({name : contactName,
	    number: snapshot.val().number})
		});		
	}
	if(evt.target.className=="marketing"){
		var contactName = prompt("Please check the customer is happy for their details to be used for marketing and enter their name");
		var messageid = par6(evt.target).id;
		openFBR("messages/"+messageid).on("value", function(snapshot) {
			contactRef = openFBR("contact");
			console.log(contactRef);
			var contactid = contactRef.push({name : contactName,
	    	number: snapshot.val().number});
	    	console.log(contactid.key());
			openFBR("group/-JmsvH2CIUIvMSrRePew/contacts").push({"contactid": contactid.key()});
		});
	}
	var method = "POST";
	var messageid = par6(evt.target).id;
	postData = JSON.stringify({"orderID":messageid})
	var async = true;
	var request = new XMLHttpRequest();
	request.open(method, url, async);
	request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	request.send(postData);
}


function addNewAutoRule()
{
	openFBR("rules/information/ifNewUser/rules/"+document.getElementById("parentSelect").value+document.getElementById("inputText").value).set({reply:document.getElementById("responseText").value});
}

function getGroupList(groups)
{
	var listcontent="";
	groups.forEach(function(group){

		listcontent = listcontent + "<li role=\"presentation\"><a id="+group.key()+" role=\"menuitem\" tabindex=\"-1\" href=\"#\">"+group.val().name+"</a></li>"
	});
	document.getElementById("grouplist").innerHTML = listcontent;
}