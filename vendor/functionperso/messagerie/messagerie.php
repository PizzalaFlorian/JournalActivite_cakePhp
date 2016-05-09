<?php
	function message_Lu($message){
		if($message->Lu){
			$resultat = "";
		}else{
			$resultat = "nonLu";
		}
		return $resultat;
	}
?>