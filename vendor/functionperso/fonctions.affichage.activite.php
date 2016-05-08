<?php

// namespace affichageActivite;

// class affichageActivite
// {
	use Cake\ORM\TableRegistry;
	
	 function renvoyerCodeCandidatfromCodetilisateur($id,$bdd){
		// $sql = 'SELECT CodeCandidat FROM candidat WHERE ID="'.$id.'"';
		// $res = $bdd->query($sql);
		// $data = $res->fetch();
		// return $data['CodeCandidat'];
		var_dump('id =',$id);	
		$query = TableRegistry::get('candidat')
		    ->find()
		    ->select(['CodeCandidat'])
		    ->where(['id' == $id])
		    ->first();
		var_dump($article->CodeCandidat);
		debug($article->CodeCandidat);
	}
	
	 function renvoyerToutesOccupationDunCandidatALaDate($codeCandidat,$date,$bdd){
		$sql = 'SELECT * FROM occupation WHERE CodeCandidat="'.$codeCandidat.'" AND HeureDebut LIKE "'.$date.'%"';
		$res = $bdd->query($sql);
		$table = null;
		while($data = $res->fetch())
			$table[] = $data;
		return $table;
	}
	
	 function print_table($weekquery,$id,$bdd){
		$codeCandidat = renvoyerCodeCandidatfromCodetilisateur($id,$bdd);
		foreach($weekquery as $key => $value){
			echo '<td valign="top" class="other_day calendar_td" id="'.$value.'">';
			echo afficheColone($codeCandidat,$value,$key,$bdd);
			echo'</td>';
		}
	}
	
	 function afficheColone($codeCandidat,$date,$day,$bdd){
		$table = renvoyerToutesOccupationDunCandidatALaDate($codeCandidat,$date,$bdd);
		if(isset($table)){
			return retournerOccupations($table,$bdd);
		}
		else
		return '';
	}
	
	
	 function retournerDureeSeconde($occupation){
		$hours = convertDateTimeToHours($occupation['HeureDebut']);
		$data = explode(':',$hours);
		
		$depSec = $data[0]*60*60 + $data[1]*60;
		
		$hoursf = convertDateTimeToHours($occupation['HeureFin']);
		$dataf = explode(':',$hoursf);
		
		$finSec = $dataf[0]*60*60 + $dataf[1]*60;
		$dureeSec = $finSec - $depSec;
		
		return $dureeSec;
	}
	
	 function generateStyle($occupation){
		
		$hours = convertDateTimeToHours($occupation['HeureDebut']);
		$data = explode(':',$hours);
		
		$depSec = $data[0]*60*60 + $data[1]*60;
		
		$hoursf = convertDateTimeToHours($occupation['HeureFin']);
		$dataf = explode(':',$hoursf);
		
		$finSec = $dataf[0]*60*60 + $dataf[1]*60;
		$dureeSec = $finSec - $depSec;
		
		//var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
		//var duree_en_sec=(((height_css_value/10)/4)*60)*60;
		
		$margin_top = ((($depSec/60)/60)*4)*10;
		$height = ((($dureeSec/60)/60)*4)*10;  
		
		return 'height:'.$height.'px; margin-top:'.$margin_top.'px;';      
	}
	
	 function convertHoursToSecond($hours){
		$data = explode(':',$hours);
		//var_dump($data);
		return ($data[0]*60*60) + ($data[1]*60);
	}
	
	 function retournerHeureDebut($occupation){
		$hours = convertDateTimeToHours($occupation['HeureDebut']);
		$data = explode(':',$hours);
		return $data[0];
	}
	
	 function retournerMinuteDebut($occupation){
		$hours = convertDateTimeToHours($occupation['HeureDebut']);
		$data = explode(':',$hours);
		return $data[1];
	}
	
	 function retournerHeureFin($occupation){
		$hours = convertDateTimeToHours($occupation['HeureFin']);
		$data = explode(':',$hours);
		return $data[0];
	}
	
	 function retournerMinuteFin($occupation){
		$hours = convertDateTimeToHours($occupation['HeureFin']);
		$data = explode(':',$hours);
		return $data[1];
	}
	
	 function convertCodeToNomActivite($codeActivite,$bdd){
		$sql = 'SELECT NomActivite FROM activite WHERE CodeActivite="'.$codeActivite.'"';
		$res = $bdd->query($sql);
		$data = $res->fetch();
		return $data['NomActivite'];
	}
			
	 function convertCodeToNomLieu($CodeLieux,$bdd){
		$sql = 'SELECT NomLieux FROM lieu WHERE CodeLieux="'.$CodeLieux.'"';
		$res = $bdd->query($sql);
		$data = $res->fetch();
		return $data['NomLieux'];
	}
	
	 function convertCodeToNomCompagnie($CodeCompagnie,$bdd){
		$sql = 'SELECT NomCompagnie FROM compagnie WHERE CodeCompagnie="'.$CodeCompagnie.'"';
		$res = $bdd->query($sql);
		$data = $res->fetch();
		return $data['NomCompagnie'];
	} 
	
	 function convertCodeToNomDispositif($CodeDispositif,$bdd){
		$sql = 'SELECT NomDispositif FROM dispositif WHERE CodeDispositif="'.$CodeDispositif.'"';
		$res = $bdd->query($sql);
		$data = $res->fetch();
		return $data['NomDispositif'];
	}
	
	 function retournerOccupations($table,$bdd){
		$string = '';
		foreach($table as $occupation){
			$Ds = retournerDureeSeconde($occupation);
			$Dm = $Ds / 60;
			$string = $string. '<div class="calendar_event" id="'.$occupation['CodeOccupation'].'"style="'.generateStyle($occupation).'">
				<div class="calendar_event_date" id="'.$occupation['CodeOccupation'].'_date" >
					<span id="'.$occupation['CodeOccupation'].'_date_debut_heure">'.retournerHeureDebut($occupation).'</span>:
					<span id="'.$occupation['CodeOccupation'].'_date_debut_minute">'.retournerMinuteDebut($occupation).'</span> -
					<span id="'.$occupation['CodeOccupation'].'_date_fin_heure">'.retournerHeureFin($occupation).'</span>:
					<span id="'.$occupation['CodeOccupation'].'_date_fin_minute">'.retournerMinuteFin($occupation).'</span>
				</div>';
			
			if($Dm <= 60){
				$string = $string.'</div>';
			}
			else if($Dm > 60 && $Dm <= 100){
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite'],$bdd).'</div>
				</div>';
			}
			else if($Dm > 100 && $Dm <= 140){
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite'],$bdd).'</div>
				<div class="calendar_event_lieu" id="'.$occupation['CodeOccupation'].'_lieu">'.convertCodeToNomLieu($occupation['CodeLieux'],$bdd).'</div>
				</div>';
			}
			else if($Dm > 140 && $Dm <= 180){
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite'],$bdd).'</div>
				<div class="calendar_event_lieu" id="'.$occupation['CodeOccupation'].'_lieu">'.convertCodeToNomLieu($occupation['CodeLieux'],$bdd).'</div>
				<div class="calendar_event_compagnie" id="'.$occupation['CodeOccupation'].'_compagnie">'.convertCodeToNomCompagnie($occupation['CodeCompagnie'],$bdd).'</div>
				</div>';
			}
			else{
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite'],$bdd).'</div>
				<div class="calendar_event_lieu" id="'.$occupation['CodeOccupation'].'_lieu">'.convertCodeToNomLieu($occupation['CodeLieux'],$bdd).'</div>
				<div class="calendar_event_compagnie" id="'.$occupation['CodeOccupation'].'_compagnie">'.convertCodeToNomCompagnie($occupation['CodeCompagnie'],$bdd).'</div>
				<div class="calendar_event_dispositif" id="'.$occupation['CodeOccupation'].'_dispositif">'.convertCodeToNomDispositif($occupation['CodeDispositif'],$bdd).'</div>
				</div>';
				
			}	
		}
		return $string;
	}
// }
?>
