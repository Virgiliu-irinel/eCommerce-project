<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
//var_dump($_SESSION);
include_once 'functions.php';
include_once 'helpers.php';

$_SESSION["currentPage"] = 'index.php';
?>
<?php include_once 'header.php';?>
<?php include_once 'content.php';?>
<?php include_once 'footer.php';?>

      
