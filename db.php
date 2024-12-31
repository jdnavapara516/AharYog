<?php

$host = "localhost";
$dbname = "aharyog";
$username = "root";
$password = "050106";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn){
    echo "Connected";
}else{
    echo "Not Connected";
}



?>