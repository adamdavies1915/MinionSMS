<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./ordersnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Order Queue</h1>
          <div class="well">
            This list will show all orders not yet marked as <span class="glyphicon glyphicon-ok"></span> done.
          </div>
          <?php include('./outstanding.php'); ?>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>