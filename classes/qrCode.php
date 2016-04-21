<?php
ini_set("display_errors", FALSE);
if($_REQUEST["url"]) {
    require "barkod.class.php";
    $QRkod = new BarcodeQR();
    $QRkod->text("".$_REQUEST["url"]."");
    $QRkod->draw();
    $QRkod->draw(250, "".$_REQUEST["url"].".png");
    return $_REQUEST["url"].'.png';
}
?>