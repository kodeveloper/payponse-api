<?php
include "connect.php";
$phoneNumber=$_POST['phone_data'];
$user=new user();
$user->checkPhoneNumber($phoneNumber);