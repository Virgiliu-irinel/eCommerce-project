<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$HOSTNAME = "http://localhost/webanunturi";
	include_once "functions.php";

	if(isset($_POST["actiune"]) || isset($_GET["actiune"])) {
		$actiune = isset($_POST["actiune"]) ? $_POST["actiune"] : $_GET["actiune"]; 
		switch ($actiune) {
		case 'login': // login
			$username = login($_POST["email"],$_POST["password"]);
			if($username){
				$_SESSION["username"] = $username;
			}
			
			include_once "index.php";
			break;
		
		case 'register': //inregistrare
			register($_POST["username"], $_POST["nume"], $_POST["password"], $_POST["email"], $_POST["telefon"]);
			include_once "index.php";
			break;
		case 'publicare': //Publicare anunt nou
		
			$imagename = fileupload($_FILES["fileToUpload"]);
			publicare($_POST["titlu"], $_POST["descriere"], $imagename, $_POST["pret"], $_POST["dataexpirare"],$_SESSION["username"]->id);
			include_once "index.php";
			break;
		case 'sters': //sterge anunt
			elimina($_GET["id"]);	
			include_once "profil.php";
			break;

		case 'vandut': //seteaza ca vandut/ inactiv
			setVandut($_GET["id"]);	
			include_once "profil.php";
			break;

		case 'logout': //			
			logout();	
			include_once "index.php";
			break;

		case 'actualizareUser': //actualizare profil
			$id = $_POST["id"];
			$username = $_POST["username"];
			$nume = $_POST["nume"];
			$email = $_POST["email"];
			$telefon = $_POST["telefon"];
			
			$usernameActualizt = actualizareUser($id, $username, $nume, $email, $telefon);	
			$_SESSION["username"] = $usernameActualizt;

			die(json_encode($usernameActualizt));
			break;

		case 'favorit': //
			$idAnunt = $_GET["idAnunt"];
			$isFavorit = $_GET["isFavorit"];
			if($isFavorit == 1){
				deleteFavorit($idAnunt, $_SESSION["username"]->id);
				die("deleteFavorit: ".$idAnunt." - ".$isFavorit." --- ".$_SESSION["username"]->id); 
			} else {
				addFavorit($idAnunt, $_SESSION["username"]->id);
				die("addFavorit".$idAnunt." - ".$isFavorit." --- ".$_SESSION["username"]->id); 
			}
			break;

		default:
			include_once "index.php";
			//redirect($HOSTNAME."/index.php");
			break;
		}
	}

	function logout() {
		$_SESSION["username"] = null;
		session_destroy();
	}

	function redirect($url){
		header("Location: ".$url);
	}

	function cerrarSesion(){
		session_destroy();
	}

	function fileupload($file) {
		$target_dir = "./uploads/";
		$fecha = date_create();

		$target_file = $target_dir . basename($file["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($file["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = -1;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = -2;
		}
		// Check file size
		if ($file["size"] > 5000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = -3;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk < 0) {
		    return $uploadOk;
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($file["tmp_name"], $target_file)) {
		        return basename( $file["name"]);
		    } else {
		        return '$file[name] --> ' . $file["name"] . '  |  $target_file --> ' . $target_file ;
		    }
		}
	}

?>