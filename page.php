<?php
session_start();
include_once 'functions.php';
include_once 'helpers.php';
$_SESSION["currentPage"] = 'page.php';
?>
<?php include_once 'header.php';?>
<?php include_once 'content.php';?>
<?php include_once 'footer.php';?>

      
