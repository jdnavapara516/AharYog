<?php

$host = "localhost";
$dbname = "aharyog";
$username = "root";
$password = "050106";


$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{
  
}

?>