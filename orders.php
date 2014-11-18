<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./ordersnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Ordering Hub</h1>
          <div class="well">
            Welcome to the ordering hub!<br/>
            What would you like to do?
            <ul>
              <li><a href="./queue.php">View list of orders to be dealt with</a></li>
              <li><a href="./rules.php">Change formatting and reply automation rules</a></li>
              <li><a href="">Do something else</a></li>
              <li><a href="">Do another thing</a></li>
            </ul>
          </div>
          <?php include('./latest.php'); ?>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>