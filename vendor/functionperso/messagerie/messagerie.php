<?php
	function message_Lu($message){
		if($message->Lu){
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
?>