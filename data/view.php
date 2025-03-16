<?php 
/* require_once('config/db.php');
 $query = "select * from registration";
 $result = mysqli_query($con, $query);
*/

require_once 'config/db.php';
require_once 'config/function.php';
$result = display_data();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	<title>Fetch DATA FROM DATABASE in PHP</title>
</head>

<body class="bg-dark">
	<div class="container">
		<div class="row mt-5">
			<div class="col">
				<div class="card mt-5">
					<div class="card-header">
						<h2 class="display-6 text-center">Fetch Data from Database</h2>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<th>Username</th>
								<th>ID</th>
								<th>Email</th>
								<th>Item</th>
								<th>Date Borrowed</th>
							</tr>
							<?php
								// view only
								while($row = mysqli_fetch_assoc($result)) {
							?>
								<tr>
									<td><?php echo $row['username']; ?></td>
									<td><?php echo str_repeat('*', strlen ($row['id'])); ?></td>
									<td><?php echo str_repeat('*', strlen($row['email'])); ?></td>
									<td><?php echo $row['chosenItem']; ?></td>
									<td><?php echo $row['date_added']; ?></td>
								</tr>
							<?php
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>