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
				<label for="comment">Message content:</label>
				<textarea class="form-control" rows="5" id="comment"></textarea>
			</div>
			
			<a href=""><button id="send" type="button" class="btn btn-default"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Send</button></a>
			<a href="./mass.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Back without sending</button></a>
			
          </div>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    <script>
	    function transmit(){

	    	var url = "http://group15.pythonanywhere.com/webapi/send";
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
		}

		document.getElementById("send").addEventListener("click", transmit, false);
    </script>
</body></html>
