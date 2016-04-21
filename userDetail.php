<?php
require_once 'connect.php';
$uid=$_POST['uid'];
$name=$_POST['name'];
$surName=$_POST['surname'];
$email=$_POST['email'];
$model=$_POST['model'];
$carrier=$_POST['carrier'];
$osType=$_POST['os_type'];
$osVersion=$_POST['os_version'];
$deviceToken=$_POST['device_token'];
$now=strtotime('now');
$userDetail=new user();
$userDetail->createUserDetail($uid,$name,$surName,$email,$model,$carrier,$osType,$osVersion,$deviceToken,$now);
?>