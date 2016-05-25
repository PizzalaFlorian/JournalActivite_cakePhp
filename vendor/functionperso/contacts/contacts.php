<?php
	function contact_Lu($contacts){
		if($contacts->lu){
			$resultat = "";
		}else{
			$resultat = "nonLu";
		}
		return $resultat;
	}
?>