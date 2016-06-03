<?php
	// passe une date du format mm/dd/yyyy au format dd/mm/yyyy
	function transformeDate($date){
		$infDate = explode("/",$date);
		return $infDate[1]."/".$infDate[0]."/".$infDate[2];
	}
	// retourne un texte tronqué au bout de $n caractère
	// si $n caractère tombe sur un mots, on retourne le dernier mots.
	function coupe($text, $n){
		
		if(!empty($text[$n])){
			if($text[$n] == ' '){
				return substr("$text", 0, $n);
			}
			else{
				$i = $n;
				while(($text[$i] != ' ')&&(!empty($text[$i]))) {
					$i++;
				}
				return substr($text, 0, $i)."...";
			}
		}
		else{
			return $text;
		}
	}
?>