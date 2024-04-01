<?php 
session_start();
    $servername = "viaduct.proxy.rlwy.net";
    $username = "root";
    $password = "PJpfGEYbrvPeilCTkpNhLVsrkqbLkbEU";
    $dbname = "railway";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die ('connection faild:'.$conn->connect_error);
    }
?>