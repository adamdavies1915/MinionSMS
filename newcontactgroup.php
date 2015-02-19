<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Edit/Add new contact group</h1>
          <div class="well" id="contactForm">
            Please fill in the following details
			<p></p>
			
			<div class="input-group">
				<input id = "groupText" type="text" class="form-control" placeholder="Group Name">
			</div>
			<br>
			
			<button id="create" type="button" class="btn btn-default"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button></a>
			<br>
			<a href="./mass.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Back without saving</button>
			
          </div>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    <script>
		document.getElementById("create").addEventListener("click", createContactGroup, false);
    </script>
</body></html>
