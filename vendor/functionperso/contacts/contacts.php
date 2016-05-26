<?php
	function contact_Lu($contacts){
		if($contacts->lu){
			$resultat = "";
		}else{
			$resultat = "nonLu";
		}
		return $resultat;
	}
	function message($contact){
		$email = "Bonjour,\nVous avez reçut une demande de contact de la part de ".$contact->expediteur.".\n\n";

		$email = $email."Contenue du message :\n\n\n";
		$email = $email."De : ".$contact->expediteur;
		$email = $email."\nLe : ".$contact->dateEnvoie;
		$email = $email."\nSujet : ".$contact->sujet;
		$email = $email."\n";
		$email = $email."\n".$contact->contenu;
		
		return $email;
	}
?>