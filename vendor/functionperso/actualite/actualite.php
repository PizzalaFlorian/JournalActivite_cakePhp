<?php
	// passe une date du format mm/dd/yyyy au format dd/mm/yyyy
	function transformeDate($date){
		$infDate = explode("/",$date);
		return $infDate[1]."/".$infDate[0]."/".$infDate[2];
	}
?>