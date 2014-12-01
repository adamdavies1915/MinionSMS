<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Mass Messaging</h1>
          <div class="well">
            Welcome to the mass messaging service<br/>
            What would you like to do?
			<br><br>
			
			<a href="./masscontacts.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> View contacts</button></a><br>
			<a href="./newcontact.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new contact</button></a><br>
			<a href="./sendmass.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Send a mass message</button></a><br>
          </div>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>
