<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Send a mass message</h1>
          <div class="well">
            Please select a contact group and enter a message
			<br><br>
			<select><option value="Undefined">Undefined</option><option value="Employees">Employees</option><option value="Customers">Customers</option></select>
            
			<form method="post" action="">
				<textarea name="comments" cols="25" rows="5">
				Enter message here...
				</textarea><br>
				<input type="submit" value="Send" />
			</form>
			
			
			<ul>
              <li><a href="./mass.php">Go back</a></li>
            </ul>
          </div>
          <?php include('./latest.php'); ?>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>
