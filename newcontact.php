<?php $edit = false;
if($_GET!=[]) $edit = true;?>
<html lang="en">
	<?php include('./header.php'); ?>
	<body>
		<?php include('./topnav.php'); ?>
		<div class="container-fluid">
			<div class="row">
				<?php include('./massnav.php'); ?>
				<div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
					<h1 class="page-header">
						<?php if($edit) echo("Edit customer:");
									else echo("Add customer"); ?>
					</h1>
					<div class="well" id="contactForm">
						Please fill in the follwing details:
						<p></p>
						<div class="input-group">
							<input id = "firstNText" type="text" class="form-control" placeholder="Forename">
						</div>
						<div class="input-group">
							<input id = "surNText" type="text" class="form-control" placeholder="Surname">
						</div>
						<div class="input-group">
							<input id = "numberText" type="text" class="form-control" placeholder="Phone number">
						</div>
						<!-- <div class="input-group">
							<input id = "groupText" type="text" class="form-control" placeholder="Contact Group">
						</div> -->
						<br>
						<button id="create" type="button" class="btn btn-default" data-toggle="modal" data-target=".modal"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button></a>
						<a href="./masscontacts.php">Back without saving</a>
					</div>
				</div>
			</div>
			<!-- modal feedback -->
			<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<div id="feedbackheader">Working...</div>
							</div>
							<div id="feedbackbody" class="modal-body">
								<?php if($edit) echo("Your changes are being saved...");
									else echo("Adding customer..."); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal feedback -->
		</div>
		<?php include('./footer.php'); ?>
		<script>
		//stop editContact from firing!
		<?php if($edit) echo("document.getElementById(\"create\").addEventListener(\"click\", function(){editContact(\"".$_GET["id"]."\");}, false);");
							 else echo("document.getElementById(\"create\").addEventListener(\"click\", createContact, false);"); ?>
		
		</script>
	</body></html>