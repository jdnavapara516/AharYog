<?php

$host = "localhost";
$dbname = "aharyog";
$username = "root";
$password = "050106";

if (!extension_loaded('mysqli')) {
    die('The mysqli extension is not loaded.');
}

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "Connected";
}

?>