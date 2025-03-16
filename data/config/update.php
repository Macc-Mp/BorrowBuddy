<?php 
require_once 'config/db.php';
require_once 'config/function.php';

// Check if the ID is set in the query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data from the database for the given ID
    $query = "SELECT * FROM `borrowerinfo` WHERE `id` = '$id'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Failed: " . mysqli_error($con));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
} else {
    die("No ID specified.");
}

// Check if the form is submitted
if (isset($_POST['update_students'])) {
    $username = $_POST['username'];
    $id = $_POST['id'];
    $item = $_POST['item'];
	$email = $_POST['email'];

    // Update query
    $updateQuery = "UPDATE `borrowerinfo` SET `username` = '$username', `id` = '$id', `item` = '$item' WHERE `email` = '$email'";

    // Execute the query
    $result = mysqli_query($con, $updateQuery);

    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    } else {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id . '&update_msg=You have successfully updated the data.');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Update Data in PHP</title>
    <script>
        // Function to enable form fields for editing
        function enableEdit() {
            document.getElementById("f_name").disabled = false;
            document.getElementById("id").disabled = false;
            document.getElementById("email").disabled = false;
            document.getElementById("item").disabled = false;

            // Show the Save button and hide the Edit button
            document.getElementById("editBtn").style.display = 'none';
            document.getElementById("saveBtn").style.display = 'inline-block';
        }
    </script>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Update Borrower Information</h2>
                    </div>
                    <div class="card-body">
                        <!-- Form to display and update data -->
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="f_name">Username</label>
                                <input type="text" id="f_name" name="f_name" class="form-control" value="<?php echo htmlspecialchars($row['username']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" id="id" name="id" class="form-control" value="<?php echo htmlspecialchars($row['id']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="item">Item</label>
                                <input type="text" id="item" name="item" class="form-control" value="<?php echo htmlspecialchars($row['chosenItem']); ?>" disabled>
                            </div>

                            <!-- Initially the Save button is hidden -->
                            <button type="button" id="editBtn" class="btn btn-primary" onclick="enableEdit()">Edit</button>
                            <button type="submit" id="saveBtn" class="btn btn-success" style="display:none;">Save</button>
							<a href="index.php" class="btn btn-secondary">Back</a>
                        </form>

                        <?php
                        // Handle form submission
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Get form data
                            $username = $_POST['f_name'];
                            $email = $_POST['email'];
                            $item = $_POST['item'];

                            // Update query
                            $updateQuery = "UPDATE `borrowerinfo` SET `username` = '$username', `email` = '$email', `chosenItem` = '$item' WHERE `id` = '$id'";

                            // Execute the query
                            $updateResult = mysqli_query($con, $updateQuery);

                            if ($updateResult) {
                                echo "<div class='alert alert-success'>Data updated successfully!</div>";
								echo "<script>clearForm();</script>"; 
                            } else {
                                echo "<div class='alert alert-danger'>Failed to update: " . mysqli_error($connection) . "</div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>