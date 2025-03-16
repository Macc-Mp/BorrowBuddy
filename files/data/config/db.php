<?php
	//host, root, no password, borrowerinfo which is the db name
    $con = mysqli_connect("localhost", "root", "", "user_details");

    if(!$con){
        die("Connection Error");
    }
?>