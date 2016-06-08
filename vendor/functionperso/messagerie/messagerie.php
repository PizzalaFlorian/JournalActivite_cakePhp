<?php
	function message_Lu($message){
		if($message->recepteurLu){
			$resultat = "";
		}else{
			$resultat = "nonLu";
		}
		return $resultat;
	}
	// afficheContenue
	// input : le contenu d'un message
	// output : le contenu d'un message avec le symbole > aprés chaque \n
	// mets au format "reponse" le contenu d'un message
	function afficheContenu($contenu){
		return $contenuFormaté = str_replace("\n", "\n>", $contenu);
	}
	function whoIsID($ID){
		switch ($ID) {
            case '1':				$user = "Chercheur";					break;
            case '2':				$user = "Administrateur";				break;
            case '4':				$user = "Utilisateur Supprimé";			break;
            default:				$user = "Candidat ".$ID;				break;
        }
        return $user;
	}
	function message($contenue, $expediteur){
		$candidat = whoIsID($expediteur);
		$email = "Bonjour,\nVous avez reçu un nouveau message de $candidat.\n\n";
		$email = $email.$contenue;
		return $email;
	}
?>