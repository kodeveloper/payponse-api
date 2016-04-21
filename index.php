<?php
//require_once 'connect.php';
//$user=new user();
//$payponseId=$_POST['PI'];
//$phoneNumber=$_POST['PN'];
//$masterPassword=$_POST['MP'];
//$password=$_POST['P'];
////$createdTime=$_POST['CT'];
////$updateTime=$_POST['UT'];
////$lastLoginTime=$_POST['LLT'];
////$status=$_POST['S'];
//$now=strtotime('now');
//$user->createNewUser($payponseId,$phoneNumber,$masterPassword,$password,$now,$now,$now,1);
//?>
<?php
require_once 'connect.php';
$user=new user();
$payponseId=$_POST['payponseId'];
$phoneNumber=$_POST['phone_number'];
$masterPassword=$_POST['master_password'];
$password=$_POST['password'];
$createdTime=$_POST['CT'];
$updateTime=$_POST['UT'];
$lastLoginTime=$_POST['LLT'];
$status=$_POST['S'];
$now=strtotime('now');
$user->createNewUser($payponseId,$phoneNumber,$masterPassword,$password,$now,$now,$now,1);
?>
