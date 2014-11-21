<html lang="en">
	<?php include('./header.php'); ?>
	<body>
		<?php include('./topnav.php'); ?>

		<div class="container-fluid">
			<div class="row">
				<?php include('./ordersnav.php'); ?>
				<div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
					<h1 class="page-header">Message Rules</h1>
					<div class="well">
						Here you can edit the rules for:
						<ul>
							<li><a href="#collapseOne" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">Automated Replies</a></li>
							<li><a href="#collapseTwo" class="collapsed" data-toggle="collapse" data-parent="#accordion"  aria-expanded="false" aria-controls="collapseTwo">Formatting Requirements</a></li>
							<li><a href="#collapseThree" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseThree">Notifications</a></li>
						</ul>
					</div>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										Automation Rules
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									Automatic replies on first and subsequent texts from a number, time periods, etc.
									<?php include('./exampleaccordioncontent.php'); ?>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingTwo">
								<h4 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Message Formatting Rules
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								<div class="panel-body">
									Ignore texts if certain phrases aren't included
									<?php include('./exampleaccordioncontent.php'); ?>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingThree">
								<h4 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Notification Rules
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								<div class="panel-body">
									Notify for certain phrases sent in texts
									<?php include('./exampleaccordioncontent.php'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('./footer.php'); ?>
		
</body></html>