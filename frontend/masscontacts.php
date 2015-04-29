<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Contact groups</h1>
			<div class="well">
				Review, edit and add new contacts here!
				<br/>
				<br/>
				<a href="./newcontact.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new contact</button></a>
				<a href="./newcontactgroup.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new group</button></a>
            	<a href="./sendmass.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Send a mass message</button></a><br>
			</div>
			  
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">
					<!-- <div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
							Contact group
							<span class="caret"></span>
						</button>
						<ul id="dropdownGroupFilter" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Customers</a></li>
						</ul>
					</div> -->
				</div>
				<div id="contactsTable">
				</div>
					
			</div>
        </div>
		</div>
      </div>
    <?php include('./footer.php'); ?>
    <script>
    	var contacts = (openFBR("contact")).orderByChild("name");
    	contacts.on("value", displayContacts);
    	var groups = (openFBR("group"));
    	groups.on("value", function(snapshot){
    		contacts.once("value", displayContacts);
    	});
    	document.getElementById("contactsTable").addEventListener("click", contactsTableFunctionality, false);
    </script>
</body></html>
