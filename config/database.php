<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "esewa";

$conn = mysqli_connect("localhost", "root", "", "esewa");

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}