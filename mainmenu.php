<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid text-center">
      <div class="row">
        <h1 class="page-header">Welcome, (name).</h1>
        <h3> What would you like to do today? </h3>
        <br/>
        <div class="row" style="width:100%;">
          <div class="col-md-3 col-md-offset-3">
            <h4><span class="glyphicon glyphicon-bullhorn"></span><br/>Send and Manage<br/> Mass Messages</h4>
          </div>
          <div class="col-md-3">
            <h4><span class="glyphicon glyphicon-envelope"></span><br/>Monitor and Manage<br/> Incoming Orders</h4>
          </div>
        </div>
      </div>
      <br/><br/>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <?php include('./latest.php'); ?>
        </div>
      </div>
    </div>

    <?php include('./footer.php'); ?>
    
  </body>
</html>