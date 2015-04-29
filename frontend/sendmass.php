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
							<label id="" for="dropdownMenu1">Send to: <div id="recip"></div></label><br>
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
							Contact group
							<span class="caret"></span>
							</button>
							<ul id="grouplist" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
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
						<a href="./masscontacts.php">Back without sending</a> <!-- needs to be changed! -->
						
						<!-- modal feedback -->
						<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="feedbackhead" aria-hidden="true">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											<h4 class="modal-title" id="feedbackhead">Working...</h4>
										</div>
										<div id="feedbackbody" class="modal-body">
											Your message is being sent...
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end modal feedback -->
					</div>
				</div>
			</div>
		</div>
		<?php include('./footer.php'); ?>
		<script>
			openFBR("group").once("value",getGroupList);
			document.getElementById("send").addEventListener("click", transmitMassMessage, false);
			document.getElementById("grouplist").addEventListener("click", function(evt){
				document.getElementById("recip").innerHTML=evt.target.innerHTML;
				document.getElementById("recip").parentElement.id=evt.target.id;
			}, false);
		</script>
	</body></html>