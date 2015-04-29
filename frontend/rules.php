<html lang="en">
	<?php include('./header.php'); ?>
	<body>
		<?php include('./topnav.php'); ?>

		<div class="container-fluid">
			<div class="row">
				<?php include('./ordersnav.php'); ?>
				<div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
					<h1 class="page-header">Message Rules</h1>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										Automation Rules
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<!-- Automatic replies on first and subsequent texts from a number, time periods, etc. -->
									<table id="automationTable" style="width:100%;"></table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('./footer.php'); ?>
		<script>
			openFBR("rules/information/ifNewUser/rules").on("value", displayAutoRules);
			document.getElementById("automationTable").addEventListener("click", autoTableFunctionality, false);
		</script>
</body></html>