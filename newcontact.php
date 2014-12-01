<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Edit/Add new contact</h1>
          <div class="well">
            Please fill in the following details
			<p></p>
			
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Forename">
			</div>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Surname">
			</div>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Phone number">
			</div>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Contact Group">
			</div>
			<br>
			
			<a href=""><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button></a>
			<br>
			<a href="./mass.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Back without saving</button></a>
			
          </div>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>
