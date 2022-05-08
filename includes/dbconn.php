<?php 
    $server = 'localhost';
    $username = "euriamej_admin";
    $password = "z7q!yItDh0Ot";
    $dbname = "euriamej_euria";

    //make connection
    $conn = new mysqli($server, $username, $password, $dbname);

//check connection

if($conn->connect_error){

die("Connectioin error: ". $conn->connect_error);
}
// echo "Connection successful";
