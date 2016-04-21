<?php
require_once 'connect.php';
$user=new user();
$payponseId=$_POST['payponseId'];
$name=$_POST['name'];
$surname=$_POST['surname'];
$card_number=$_POST['cart_number'];
$expired_date=$_POST['expired_date'];
$now=strtotime('now');
$user->addCrediCart($payponseId,$name,$surname,$card_number,$expired_date,1,$now,$now,1);
?>