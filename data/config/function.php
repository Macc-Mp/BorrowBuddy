<?php

    require_once 'db.php';

    function display_data(){
        global $con;
        $query = "SELECT * FROM borrowerinfo"; 
        $result = mysqli_query($con,$query);
        return $result;

    }
?>