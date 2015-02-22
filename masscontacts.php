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
				<br>
				<br>
				<a href="./newcontact.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new contact</button></a>
			</div>
			  
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">
					<div class="dropdown">
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
				</div>
				<div class="table-responsive" id="contactsTable">
					<!-- Table -->
					<!-- <table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>First</th> 
								<th>Last</th>
								<th>Number</th>
							</tr>
						</thead>
						<tbody> -->
							<!-- <tr>
								<td>2</td>
								<td>Bob</td>
								<td>Thebuilder</td> 
								<td>077123456781</td>
								<td><div class="dropdown pull-right">
									<div class="pull-right">
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
											Action
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
											<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span aria-hidden="true" class="pull-left glyph glyph-ok"></span> Edit</a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span aria-hidden="true" class="pull-left glyph glyph-ok"></span> Edit</a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span aria-hidden="true" class="pull-left glyph glyph-remove"></span> Delete</a></li>
										</ul>
									</div>
								</div></td>
							</tr> -->
						<!-- </tbody>
					</table> -->
				</div>
					
			</div>
        </div>
		</div>
      </div>
    <?php include('./footer.php'); ?>
    <script>
    	var contacts = (openFBR("contact")).orderByChild("name");
    	contacts.on("value", displayContacts);
    </script>
</body></html>
