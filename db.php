<?php
function getConnection() {
	$bbdd = 'mysql:host=localhost;dbname=anuntbew2020';
	$userdb = 'root'; 
	$pass = '';
	try {
    	$connection = new PDO($bbdd, $userdb, $pass);
    	return $connection;
	} catch (PDOException $e) {
	    echo 'Eroare conexiune DB: ';// . $e->getMessage();
	}
}
?>
