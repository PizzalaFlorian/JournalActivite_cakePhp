<?php

	use Cake\ORM\TableRegistry;
	
	 function renvoyerCodeCandidatfromCodetilisateur($id){
		$res = TableRegistry::get('candidat')
		    ->find()
		    ->where(['ID' => $id])
		    ->first();
		return $res['CodeCandidat'];
	}

	function renvoyerListeChercheur(){
		$res = TableRegistry::get('users')
		    ->find()
		    ->where(['typeUser' => 'chercheur']);
		return $res;
	}	
	 function renvoyerToutesOccupationDunCandidatALaDate($codeCandidat,$date){
		$table = null;

		$table = TableRegistry::get('occupation')
		    ->find()
		    ->where(['CodeCandidat' => $codeCandidat,'HeureDebut LIKE' => $date.'%'])
		    ->toArray();
		
		return $table;
	}
	
	 function print_table($weekquery,$id){
		$codeCandidat = renvoyerCodeCandidatfromCodetilisateur($id);
		echo "<div id='tableAgenda'>";
		foreach($weekquery as $key => $value){
			echo '<td valign="top" class="other_day calendar_td" id="'.$value.'">';
			echo afficheColone($codeCandidat,$value,$key);
			echo'</td>';
		}
		echo '</div>';
	}
	
	 function afficheColone($codeCandidat,$date,$day){
		$table = renvoyerToutesOccupationDunCandidatALaDate($codeCandidat,$date);
		if(isset($table)){
			return retournerOccupations($table);
		}
		else
		return '';
	}
	
	
	 function retournerDureeSeconde($occupation){
		$hours = convertDateTimeToHours($occupation['HeureDebut']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		$data = explode(':',$hours);
		
		$depSec = $data[0]*60*60 + $data[1]*60;
		
		$hoursf = convertDateTimeToHours($occupation['HeureFin']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		$dataf = explode(':',$hoursf);
		
		$finSec = $dataf[0]*60*60 + $dataf[1]*60;
		$dureeSec = $finSec - $depSec;
		
		return $dureeSec;
	}
	
	 function generateStyle($occupation){
		
		$hours = convertDateTimeToHours($occupation['HeureDebut']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		$data = explode(':',$hours);
		
		$depSec = $data[0]*60*60 + $data[1]*60;
		
		$hoursf = convertDateTimeToHours($occupation['HeureFin']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
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
		$hours = convertDateTimeToHours($occupation['HeureDebut']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		$data = explode(':',$hours);
		return $data[0];
	}
	
	 function retournerMinuteDebut($occupation){
		$hours = convertDateTimeToHours($occupation['HeureDebut']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		$data = explode(':',$hours);
		return $data[1];
	}
	
	 function retournerHeureFin($occupation){
		$hours = convertDateTimeToHours($occupation['HeureFin']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		$data = explode(':',$hours);
		return $data[0];
	}
	
	 function retournerMinuteFin($occupation){
		$hours = convertDateTimeToHours($occupation['HeureFin']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		$data = explode(':',$hours);
		return $data[1];
	}
	
	 function convertCodeToNomActivite($codeActivite){
		$res = TableRegistry::get('activite')
		    ->find()
		    ->where(['CodeActivite' => $codeActivite])
		    ->first();
		return $res->NomActivite;
	}
			
	 function convertCodeToNomLieu($CodeLieux){
		$res = TableRegistry::get('lieu')
		    ->find()
		    ->where(['CodeLieux' => $CodeLieux])
		    ->first();
		return $res->NomLieux;
	}
	
	 function convertCodeToNomCompagnie($CodeCompagnie){
		$res = TableRegistry::get('compagnie')
		    ->find()
		    ->where(['CodeCompagnie' => $CodeCompagnie])
		    ->first();
		return $res->NomCompagnie;
	} 
	
	 function convertCodeToNomDispositif($CodeDispositif){
		$res = TableRegistry::get('dispositif')
		    ->find()
		    ->where(['CodeDispositif' => $CodeDispositif])
		    ->first();
		return $res->NomDispositif;
	}
	
	 function retournerOccupations($table){
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
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite']).'</div>
				</div>';
			}
			else if($Dm > 100 && $Dm <= 140){
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite']).'</div>
				<div class="calendar_event_lieu" id="'.$occupation['CodeOccupation'].'_lieu">'.convertCodeToNomLieu($occupation['CodeLieux']).'</div>
				</div>';
			}
			else if($Dm > 140 && $Dm <= 180){
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite']).'</div>
				<div class="calendar_event_lieu" id="'.$occupation['CodeOccupation'].'_lieu">'.convertCodeToNomLieu($occupation['CodeLieux']).'</div>
				<div class="calendar_event_compagnie" id="'.$occupation['CodeOccupation'].'_compagnie">'.convertCodeToNomCompagnie($occupation['CodeCompagnie']).'</div>
				</div>';
			}
			else{
				$string = $string.'<div class="calendar_event_activite" id="'.$occupation['CodeOccupation'].'_activite">'.convertCodeToNomActivite($occupation['CodeActivite']).'</div>
				<div class="calendar_event_lieu" id="'.$occupation['CodeOccupation'].'_lieu">'.convertCodeToNomLieu($occupation['CodeLieux']).'</div>
				<div class="calendar_event_compagnie" id="'.$occupation['CodeOccupation'].'_compagnie">'.convertCodeToNomCompagnie($occupation['CodeCompagnie']).'</div>
				<div class="calendar_event_dispositif" id="'.$occupation['CodeOccupation'].'_dispositif">'.convertCodeToNomDispositif($occupation['CodeDispositif']).'</div>
				</div>';
				
			}	
		}
		return $string;
	}
// }
?>
