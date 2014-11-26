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
            <ul>
              <li><a href="./masscontacts.php">View Contacts and contact groups</a></li>
              <li><a href="./newcontact.php">Add a new contact</a></li>
			        <li><a href="./sendmass.php">Send a mass message</a></li>
              <li><a href="">Do something else</a></li>
              <li><a href="">Do another thing</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>
