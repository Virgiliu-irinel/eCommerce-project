<?php
require_once('db.php');
function getAnunturi($userId=""){
	if($userId != ""){
		$statement = "
			SELECT anunturi.id,nume, telefon, email ,titlu, 
			descriere, img, pret,timestamp, vandut
			FROM anunturi,users
			WHERE 
			users.id = anunturi.user_id
			AND vandut = 0
			AND anunturi.user_id <> :idusers;";
	} else {
		$statement = "
			SELECT anunturi.id, nume, telefon, email ,titlu, 
			descriere, img, pret,timestamp, vandut
			FROM anunturi,users
			WHERE 
			users.id = anunturi.user_id
			AND vandut = 0;";
	}

	$consulta = getConnection()->prepare($statement);
	$consulta->execute();

	/* Fetch all of the remaining rows in the result set */
	return $consulta->fetchAll();
}

function getAnunturiByUser($userId){

	$consulta = getConnection()->prepare("
		SELECT 
			anunturi.id, nume, telefon, 
			email ,titlu, descriere, img, 
			pret,timestamp, vandut 
		FROM anunturi,users
		WHERE 
			users.id = anunturi.user_id AND
			users.id = :userId");
	$consulta->execute(array(
		"userId" => $userId));

	/* Fetch all of the remaining rows in the result set */
	return $consulta->fetchAll();
}

function getIDAnuntFavorit($userId){

	
	$statement = "
		SELECT DISTINCT idanunt
		FROM favorite
		WHERE user_id = :userId;";
	
	$consulta = getConnection()->prepare($statement);
	$consulta->execute(array("userId" => $userId));

	/* Fetch all of the remaining rows in the result set */
	return $consulta->fetchAll();
}

function getAnunturiFavorite($userId){

	
	$statement = "
		SELECT 
			anunturi.id, nume, telefon, 
			email ,titlu, descriere, img, 
			pret,timestamp, vandut 
		FROM anunturi,users
		WHERE 
			users.id = anunturi.user_id
			
			AND anunturi.id IN (
				SELECT DISTINCT idanunt
				FROM favorite
				WHERE user_id = :userId
			)";
	
	$consulta = getConnection()->prepare($statement);
	$consulta->execute(array("userId" => $userId));

	/* Fetch all of the remaining rows in the result set */
	return $consulta->fetchAll();
}

function publicare($titlu, $descriere, $img, $pret, $dataexpirare, $user_id){
	

	$consulta = getConnection()->prepare("
		INSERT
		INTO
		  anunturi(
		    titlu,
		    descriere,
		    img,
		    pret,
		    dataexpirare,
		    user_id
		  )
		VALUES(
		  :titlu,
		  :descriere,
		  :img,
		  :pret,
		  :dataexpirare,
		  :user_id
		);
	");
	$consulta->execute(array(
    "titlu" => $titlu,
    "descriere" => $descriere,
    "img" => $img,
    "pret" => $pret,
    "dataexpirare" => $dataexpirare,
    "user_id" => $user_id));
    $consulta = null;
}

function elimina($idanunturi){

	$consulta = getConnection()->prepare("
		DELETE 
		FROM
		  anunturi
		WHERE
		  id = :idanunturi
	");
	$consulta->execute(array(
    "idanunturi" => $idanunturi));
    $consulta = null;
}

function setVandut($idanunturi){

	$consulta = getConnection()->prepare("
		UPDATE anunturi
		SET vandut=1
		WHERE id = :idanunturi
	");
	$consulta->execute(array(
    "idanunturi" => $idanunturi));
    $consulta = null;
}


function addFavorit($anunt, $user){

	$consulta = getConnection()->prepare("
		INSERT INTO favorite (idanunt, user_id)
		VALUES(:idanunt,:user_id);
	");
	$consulta->execute(array(
    "idanunt" => $anunt,
    "user_id" => $user));
    $consulta = null;
}

function deleteFavorit($anunt, $user){

	$consulta = getConnection()->prepare("
		DELETE FROM favorite 
		WHERE idanunt = :idanunt 
		AND user_id = :user_id;
	");
	$consulta->execute(array(
    "idanunt" => $anunt,
    "user_id" => $user));
    $consulta = null;
}

function login($email, $password) {
	$consulta = getConnection()->prepare("
		SELECT id, username, email, password, nume, telefon 
		FROM users 
		WHERE email = :email AND password = :password
	");
	$consulta->execute(array(
    	"email" => $email,
    	"password" => $password));

	if ($consulta->rowCount() > 0) {
		return $consulta->fetchObject();
	} else {
	    return false;
	}

}

function register($username, $nume, $password, $email, $telefon){

	$consulta = getConnection()->prepare("
		INSERT
		INTO
		  users(
		    email,
		    nume,
		    password,
		    telefon,
		    username
		  )
		VALUES(
		  :email,
		  :nume,
		  :password,
		  :telefon,
		  :username
		);
	");
	$consulta->execute(array(
    "email" => $email,
    "nume" => $nume,
    "password" => $password,
    "username" => $username,
    "telefon" => $telefon));
	$consulta = null;
}

function actualizareUser($id, $username, $nume, $email, $telefon){

	$consulta = getConnection()->prepare("
		UPDATE users
		SET 
		    email = :email,
		    nume = :nume,
		    telefon = :telefon,
		    username = :username
		WHERE id = :id;
	");
	$consulta->execute(array(
	"id" => $id,
    "email" => $email,
    "nume" => $nume,
    "username" => $username,
    "telefon" => $telefon));
    $consulta = null;
    return getUserByID($id);
}


//execute https://www.php.net/manual/en/pdostatement.execute.php
function getUserByID($id){
	$consulta = getConnection()->prepare("
		SELECT id, username, email, password, nume, telefon 
		FROM users 
		WHERE id = :id
	");
	$consulta->execute(array(
    	"id" => $id));

	if ($consulta->rowCount() > 0) {
		return $consulta->fetchObject();
	} else {
	    return false;
	}
}

//bindParam 2 https://www.php.net/manual/en/pdostatement.bindparam.php
function getUserByID2($id){
	$consulta = getConnection()->prepare("
		SELECT id, username, email, password, nume, telefon 
		FROM users 
		WHERE id = ?
	");
	$consulta->bindParam(1, $id, PDO::PARAM_INT);
	//$consulta->bindValue(1, $id, PDO::PARAM_INT);
	$consulta->execute();

	if ($consulta->rowCount() > 0) {
		return $consulta->fetchObject();
	} else {
	    return false;
	}
}
//bindValue 3 https://www.php.net/manual/en/pdostatement.bindvalue.php
function getUserByID3($id){
	$consulta = getConnection()->prepare("
		SELECT id, username, email, password, nume, telefon 
		FROM users 
		WHERE id = :id
	");
	//$consulta->bindParam(':id', $id, PDO::PARAM_INT);
	$consulta->bindValue(':id', $id, PDO::PARAM_INT);
	$consulta->execute();

	if ($consulta->rowCount() > 0) {
		return $consulta->fetchObject();
	} else {
	    return false;
	}
}


?>