<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Send a mass message</h1>
          <div class="well">
            Please select a contact group and enter a message
			
			<br><br>
			
			<div class="dropdown">
				<label for="dropdownMenu1">Contact:</label><br>
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					Contact group
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Customers</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Employees</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Undefined</a></li>
				</ul>
			</div>
			
            <br>
			
			<div class="form-group">
				<label for="messageText">Message content:</label>
				<textarea class="form-control" rows="5" id="messageText"></textarea>
			</div>
			
			<button id="send" type="button" class="btn btn-default" data-toggle="modal" data-target=".modal">
				<span class="glyphicon glyphicon-send" aria-hidden="true"></span> Send
			</button>
			<a href="./mass.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Back without sending</button></a>
			

			<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
			    <div class="modal-content">
			      <div class="modal-content">

			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			          <h4 class="modal-title" id="mySmallModalLabel">Your message is being sent...</h4>
			        </div>
			        <div class="modal-body">
			          Status: Sending...
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
          </div>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    <script>
	    function transmit(){
	    	document.getElementById("messageText").disabled = true;
	    	var myFirebaseRef = new Firebase("https://group15.firebaseio.com/outgoing");
	    	myFirebaseRef.push({
	    		groupid : "someId - use some other number for now!",
			    message: document.getElementById("messageText").value,
			    delivered : 0
			});
	    	document.getElementById("messageText").disabled = false;
	    	document.getElementById("messageText").value = "";
		}

		document.getElementById("send").addEventListener("click", transmit, false);
    </script>
</body></html>
