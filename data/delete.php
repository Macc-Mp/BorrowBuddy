<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Create connection
    $connection = new mysqli('localhost', 'root', '', 'user_details');

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $connection->prepare("DELETE FROM borrowerinfo WHERE id=?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>