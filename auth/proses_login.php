<?php

session_start();
include "../config/database.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");

$data = mysqli_fetch_assoc($query);

if($data){
    $_SESSION['login']=true;
    $_SESSION['id']=$data['id'];
    $_SESSION['username']=$data['username'];
    $_SESSION['role']=$data['role'];
    $_SESSION['kecamatan']=$data['kecamatan_id'];

    header("Location: ../dashboard/dashboard.php");
}else{
    echo "Login gagal";
}

?>