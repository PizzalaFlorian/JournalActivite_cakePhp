<?php

	function SemaineCourante ($SemaineCourante,$Semaine) 
	{
		//fonction de choix entre un affichage par défault et le retour du post.
		if ($Semaine == NULL)
			return $SemaineCourante ;
		else
			return $Semaine ;
	}

			
	function convertNumToDay($j)
	{
		//fonction de conversion perso
		switch ($j) {
			case 0 : $text = "Lundi" ;		break;
			case 1 : $text = "Mardi" ;		break;
			case 2 : $text = "Mercredi" ;	break;
			case 3 : $text = "Jeudi" ;		break;
			case 4 : $text = "Vendredi" ;	break;
			case 5 : $text = "Samedi" ;		break;
			case 6 : $text = "Dimanche" ;	break;
			default: $text = "Lundi" ;		break;
		}
		return $text;
	}	
	
	function print_current_date () {
		//renvoie la date du jours courant.
		$j = date ("w") ;
		switch ($j) {
			case 1 : $text = "Lundi" ;		break;
			case 2 : $text = "Mardi" ;		break;
			case 3 : $text = "Mercredi" ;	break;
			case 4 : $text = "Jeudi" ;		break;
			case 5 : $text = "Vendredi" ;	break;
			case 6 : $text = "Samedi" ;		break;
			case 7 : $text = "Dimanche" ;	break;
			default: $text = "Lundi" ;		break;
		}
		$text = $text.' '.date("d") ;
		$m = date ("m") ;
		switch ($m) {
			case 1 : $text = $text.' Janvier' ;		break;
			case 2 : $text = $text.' Février' ;		break;
			case 3 : $text = $text.' Mars' ;		break;
			case 4 : $text = $text.' Avril' ;		break;
			case 5 : $text = $text.' Mai' ;			break;
			case 6 : $text = $text.' Juin' ;		break;
			case 7 : $text = $text.' Juillet' ;		break;
			case 8 : $text = $text.' Août' ;		break;
			case 9 : $text = $text.' Septembre' ;	break;
			case 10 : $text = $text.' Octobre' ;	break;
			case 11 : $text = $text.' Novembre' ;	break;
			case 12 : $text = $text.' Décembre' ;	break;
			default : $text = 'aaaaaarg';			break;
		}
		echo $text.' '.date ("Y") ;
	}
	
	function get_date_lundi_to_Sunday_from_week ($week,$year,$affichage,$format="d/m/Y") {
		//renvoie un tableau des jours de la semaine et des dates associées en fonction du
		//numero de semaine et de l'année.
		$firstDayInYear = date ("N",mktime(0,0,0,1,1,$year)) ;
		if ($firstDayInYear < 5)
			$shift =- ($firstDayInYear-1) * 86400 ;
		else
			$shift = (8-$firstDayInYear) * 86400 ;
		if ($week>1)
			$weekInSeconds = ($week-1) * 604800 ;
		else 
			$weekInSeconds=0 ;
		$timestamp_lundi = mktime (0,0,0,1,1,$year) + $weekInSeconds + $shift ;
		$timestamp_mardi = mktime (0,0,0,1,2,$year) + $weekInSeconds + $shift ;
		$timestamp_mercredi = mktime (0,0,0,1,3,$year) + $weekInSeconds + $shift ;
		$timestamp_jeudi = mktime (0,0,0,1,4,$year) + $weekInSeconds + $shift ;
		$timestamp_vendredi = mktime (0,0,0,1,5,$year) + $weekInSeconds + $shift ;
		$timestamp_samedi = mktime (0,0,0,1,6,$year) + $weekInSeconds + $shift ;
		$timestamp_dimanche = mktime (0,0,0,1,7,$year) + $weekInSeconds + $shift ;
		
		if($affichage == 0){
			return array ("Lu. " . date($format,$timestamp_lundi),
						"Ma. " . date($format,$timestamp_mardi),
						"Me. " . date($format,$timestamp_mercredi),
						"Je. " . date($format,$timestamp_jeudi),
						"Ve. " . date($format,$timestamp_vendredi),
						"Sa. " . date($format,$timestamp_samedi),
						"Di. ".date($format,$timestamp_dimanche)		
			) ;
		}
		else
			return array ("Lundi " . date($format,$timestamp_lundi),
						"Mardi " . date($format,$timestamp_mardi),
						"Mercredi " . date($format,$timestamp_mercredi),
						"Jeudi " . date($format,$timestamp_jeudi),
						"Vendredi " . date($format,$timestamp_vendredi),
						"Samedi " . date($format,$timestamp_samedi),
						"Dimanche ".date($format,$timestamp_dimanche)		
			) ;
	}
	
	function remplirEnteteCalendar($week){
		$dates = get_date_lundi_to_Sunday_from_week($week,date("Y"),0);
		for($i=0;$i<7;$i++){
			echo '<th><a  href="">'.$dates[$i].'</a></th>';
		}	
	}
	
	function get_date_lundi_to_Sunday_from_week_for_query ($week,$year,$format="Y-m-d") {
		//renvoie un tableau des jours de la semaine et des dates associées en fonction du
		//numero de semaine et de l'année.
		$firstDayInYear = date ("N",mktime(0,0,0,1,1,$year)) ;
		if ($firstDayInYear < 5)
			$shift =- ($firstDayInYear-1) * 86400 ;
		else
			$shift = (8-$firstDayInYear) * 86400 ;
		if ($week>1)
			$weekInSeconds = ($week-1) * 604800 ;
		else 
			$weekInSeconds=0 ;
		$timestamp_lundi = mktime (0,0,0,1,1,$year) + $weekInSeconds + $shift ;
		$timestamp_mardi = mktime (0,0,0,1,2,$year) + $weekInSeconds + $shift ;
		$timestamp_mercredi = mktime (0,0,0,1,3,$year) + $weekInSeconds + $shift ;
		$timestamp_jeudi = mktime (0,0,0,1,4,$year) + $weekInSeconds + $shift ;
		$timestamp_vendredi = mktime (0,0,0,1,5,$year) + $weekInSeconds + $shift ;
		$timestamp_samedi = mktime (0,0,0,1,6,$year) + $weekInSeconds + $shift ;
		$timestamp_dimanche = mktime (0,0,0,1,7,$year) + $weekInSeconds + $shift ;

		return array (date($format,$timestamp_lundi),
					date($format,$timestamp_mardi),
					date($format,$timestamp_mercredi),
					date($format,$timestamp_jeudi),
					date($format,$timestamp_vendredi),
					date($format,$timestamp_samedi),
					date($format,$timestamp_dimanche)		
		) ;
	}
	
	function convertDateTimeToHours($DateTime){
		return substr($DateTime,11,-3);
	}
	
	function ConvertNumSemaineToDateDebEtFin($W,$Y)
	{
		//renvoie la date de début et fin de semaine en fonction du numéro de semaine et de l'année.
		$debut_fin_semaine = get_date_lundi_to_Sunday_from_week($W,$Y,1);
		return "Semaine du ".$debut_fin_semaine[0] . " au " . $debut_fin_semaine [6];
	}

	function genererChoixSemaine($W,$Y)
	{
		//propose toutes les semaines du début de l'année a la semaine courante
		$s ='<form action="./activite" method="POST">
		<fieldset>
		<SELECT name="semaine" onchange="this.form.submit()">';
		for($i=1;$i<=date("W");$i++)
		{
			if($i==$W)
			{
				$s=$s.'<OPTION value="'.$i.'" selected><center>'.ConvertNumSemaineToDateDebEtFin($i,$Y).'</center></OPTION>';
			}
			else
				$s=$s.'<OPTION value="'.$i.'" ><center>'.ConvertNumSemaineToDateDebEtFin($i,$Y).'</center></OPTION>';
		}
		$s=$s.'</SELECT>
		</fieldset>
		</form>';
		return $s;
	}


?>
