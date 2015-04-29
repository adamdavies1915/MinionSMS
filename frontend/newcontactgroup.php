<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Add new contact group</h1>
          <div class="well" id="contactForm">
            Please fill in the following details
            <p></p>
            
            <div class="input-group">
              <input id = "groupText" type="text" class="form-control" placeholder="Group Name">
            </div>
            <br>
            
            <button id="create" type="button" class="btn btn-default" data-toggle="modal" data-target=".modal"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button></a>
            <a href="./masscontacts.php">Back without saving</a>
            
          </div>
        </div>
      </div>
      <!-- modal feedback -->
      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="feedbackhead" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="feedbackhead">Working...</h4>
              </div>
              <div id="feedbackbody" class="modal-body">
                Creating new group...
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end modal feedback -->
    </div>
    <?php include('./footer.php'); ?>
    <script>
    document.getElementById("create").addEventListener("click", createContactGroup, false);
    </script>
  </body></html>