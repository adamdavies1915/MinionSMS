<html lang="en">
  <?php include('./header.php'); ?>
  <body>
    <?php include('./topnav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./massnav.php'); ?>
        <div class="main col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <h1 class="page-header">Contact groups</h1>
          <div class="well">
            Contact groups <select><option value="Undefined">Undefined</option><option value="Employees">Employees</option><option value="Customers">Customers</option></select>
            
			<table style="width:30%">
				<tr>
					<td>Jane</td>
					<td>Doe</td> 
					<td>077123456789</td>
					<td><a href="">Edit</a></td>
				</tr>
				<tr>
					<td>Bob</td>
					<td>Thebuilder</td> 
					<td>077123456781</td>
					<td><a href="">Edit</a></td>
				</tr>
			
			<ul>
              <li><a href="./newcontact.php">Add new contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php include('./footer.php'); ?>
    
</body></html>
