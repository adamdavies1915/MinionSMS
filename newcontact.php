<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./masssnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Edit/Add new contact</h1>
          <div class="well">
            Please fill in the following details
			<p></p>
			
			<form>
				First name:<br>
					<input type="text" name="firstname">
				<br>
				Last name:<br>
					<input type="text" name="lastname">
				<br>
				Phone number:<br>
					<input type="text" name="phonenumber">
				<br>
				Contact group:<br>
					<input type="text" name="lastname"> or <select><option value="Undefined">Undefined</option><option value="Employees">Employees</option><option value="Customers">Customers</option></select>
			</form>
			
			
            <ul>
              <li><a href="./mass.php">Go back</a></li>
              <li><a href="">Save</a></li>
            </ul>
          </div>
          <?php include('./latest.php'); ?>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>
