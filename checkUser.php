<?php
include "connect.php";
$phoneNumber=$_POST["phone_data"];
$password=$_POST['password'];
$user=new user();
$user->checkUser($phoneNumber,$password);