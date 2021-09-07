<?php 

/*** HTML Helpers **/

function getFormattedDate($datetime){
	return explode(' ', $datetime)[0];
}


function echoSelectedClassIfRequestMatches($requestUri)
{
    
    if ($_SESSION["currentPage"] == $requestUri)
        echo ' active"';
}

function addFavoritIcon($idAnunt, $favorit) {
	foreach ($favorit as $key => $an) {
		if($idAnunt == $an["idanunt"]){
			return true;
		}
	}
	return false;
}

function getImageUrl($imageName) {
	return 'uploads/' . $imageName;
}

?>