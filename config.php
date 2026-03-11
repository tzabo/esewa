<?php

/* URL */
$base_url = "http://10.255.244.50/esewa/";
// $base_url = "http://localhost/esewa/";

/* Database */
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "esewa";

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

if(!$conn){
    die("Database error");
}