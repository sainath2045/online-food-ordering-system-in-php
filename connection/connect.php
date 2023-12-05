<?php

//main connection file for both admin & front end
$servername = "jyosql.mysql.database.azure.com"; //server
$username = "jyo"; //username
$password = "qwerty@12345"; //password
$dbname = "online_rest";  //database

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}

?>
