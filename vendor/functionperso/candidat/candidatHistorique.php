<?php
use Cake\ORM\TableRegistry;

function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}

function afficher_temps($temps){
	$tmp = explode(":", $temps);
	$res = "";
	if ($tmp[0] == 1){
		$h = ltrim($tmp[0],"0");
		$res = "$h heure ";
	}
	if($tmp[0] > 1){
		$h = ltrim($tmp[0],"0");
		$res = "$h heures ";
	} 
	if ($tmp[0] != 0 && $tmp[1] != 0)
		$res.= "et ";
	if ($tmp[1] == 1)
		$res.= "1 minute ";
	if ($tmp[1] > 1){
		$m = ltrim($tmp[1],"0");
		$res.= "$m minutes ";
	}
	return $res;
}


function afficher_temps_f($temps){
	$tmp = explode(":", $temps);
	$h = $tmp[0];
	$m = $tmp[1];
	return "$h"."h $m"."m";
}

function duree_totale($CodeCandidat){
	$data = TableRegistry::get('occupation')
            ->find()
            ->select(array('dure' => 'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))))'))
            ->where(['CodeCandidat' => $CodeCandidat])
            ->first();
    //debug($data);
    
    return $dure_total = afficher_temps($data['dure']);
}

/*Renvoie les statistiques des activités*/
function stat_all_activite($CodeCandidat,$dure_total){

	echo  "Sur une durée $dure_total j'ai passé le plus de temps à :<br/>";
			
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomActivite'=>'a.NomActivite',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'a' => [
		            'table' => 'activite',
		            'type' => 'INNER',
		            'conditions' => 'a.CodeActivite = occupation.CodeActivite',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('occupation.CodeActivite')
            ->order(['dure'=>'DESC'])
            ->toArray();
    // debug($table);
    foreach ($table as $data) {
    	$dure = $data['temps'];
		$nom =  $data['NomActivite'];
		$temps_formate = afficher_temps_f($dure);
		echo "$temps_formate : $nom <br/>";
    }
    
}

/*Renvoie les statistiques des activités pour un jour*/
function stat_jour_activite($jour,$CodeCandidat,$dure_total){
	echo  "J'ai passé mon temps à :<br/>";
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomActivite'=>'a.NomActivite',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'a' => [
		            'table' => 'activite',
		            'type' => 'INNER',
		            'conditions' => 'a.CodeActivite = occupation.CodeActivite',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            		'DATE(HeureDebut)' => $jour
            	])
            ->group('occupation.CodeActivite')
            ->order(['dure'=>'DESC'])
            ->toArray();
    // debug($table);
    foreach ($table as $data) {
    	$dure = $data['temps'];
		$nom =  $data['NomActivite'];
		$temps_formate = afficher_temps_f($dure);
		echo "$temps_formate : $nom <br/>";
    }
	$table2 = TableRegistry::get('occupation')
	            ->find()
	            ->select(array(
	            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
	            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
	            	)
	            )
				->where(['CodeCandidat' => $CodeCandidat,
	            		 'DATE(HeureDebut)' => $jour
	            ])
				->toArray();
	$total = $table2[0]['dure'];
	if ($table2[0]['dure'] < 86330) {
		temps_inoccupe(86400 - $table2[0]['dure']);
	}
	
}

/*Fonction pour retourner le temps inocupé*/
function temps_inoccupe($dure){
	$heure = (int)($dure / 3600);
	$reste = $dure % 3600;
	$minute = (int)($reste / 60);
	$seconde = $reste % 60;
	if ($minute < 10)
		$minute = "0$minute";
	if ($seconde < 10)
		$seconde = "0$seconde";
	if ($heure < 10)
		$heure = "0$heure";
	echo "$heure"."h $minute"."m : Non renseigné";
}


/*Function pour l'activite des jours*/
function camembert_jour_activite($id_conatainer,$jour,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){

    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Comment ai-je utilisé mon temps?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		<?php
			$table = TableRegistry::get('occupation')
	            ->find()
	            ->select(array(
	            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
	            	'NomActivite'=>'c.NomActivite',
	            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
	            	)
	            )
	             ->join([
			        'c' => [
			            'table' => 'activite',
			            'type' => 'INNER',
			            'conditions' => 'c.CodeActivite = occupation.CodeActivite',
			        ]
			    ])
	            ->where(['CodeCandidat' => $CodeCandidat,
	            		'DATE(HeureDebut)' => $jour
	            	])
	            ->group('occupation.CodeActivite')
	            ->order(['dure'=>'DESC'])
	            ->toArray();
	    //debug($table);
		$table2 = TableRegistry::get('occupation')
	            ->find()
	            ->select(array(
	            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
	            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
	            	)
	            )
				->where(['CodeCandidat' => $CodeCandidat,
	            		 'DATE(HeureDebut)' => $jour
	            ])
				->toArray();
		$nonrenseigne = 86400 - $table2[0]['dure'];
		$i =0;
		$autre = 0;
		foreach ($table as $data) {
	    	$dure = $data['dure'];
			$nom =  $data['NomActivite'];
			if ($i == 0)
				echo "{ name: '".$nom."',y: ".$dure."}\n";
			elseif ($i == 1)
				echo ",{ name: '".$nom."',y: ".$dure.", sliced: true, selected : true}\n";
			elseif ($i < 8)
				echo ",{ name: '".$nom."',y: ".$dure."}\n";
			else 
				$autre+= $dure;
			$i++;
	    }
		if ($autre > 0)
			echo  ",{ name: 'Autre',y: ".$autre."}\n";
		if ($table2[0]['dure'] < 86330) {
			echo ",{ name: 'NON RENSEIGNE',y: ". $nonrenseigne ." }";
		}
		
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}	



/*Génération scripte activité camemebert*/
function camembert_all_activite($id_conatainer,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){
	// Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });


    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Comment ai-je utilisé mon temps?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		<?php
			$table = TableRegistry::get('occupation')
	            ->find()
	            ->select(array(
	            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
	            	'NomActivite'=>'c.NomActivite',
	            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
	            	)
	            )
	             ->join([
			        'c' => [
			            'table' => 'activite',
			            'type' => 'INNER',
			            'conditions' => 'c.CodeActivite = occupation.CodeActivite',
			        ]
			    ])
	            ->where(['CodeCandidat' => $CodeCandidat,
	            		// 'DATE(HeureDebut)' => $jour
	            	])
	            ->group('occupation.CodeActivite')
	            ->order(['dure'=>'DESC'])
	            ->toArray();	
			$i = 0; 
			$autre = 0;
			foreach($table as $data){
				$dure = $data['dure'];
				$nom =  $data['NomActivite'];
				if ($i == 0)
					echo "{ name: '$nom',y: $dure}\n";
				elseif ($i == 1)
					echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
				elseif ($i < 8)
					echo ",{ name: '$nom',y: $dure}\n";
				else 
					$autre += $dure;
				$i++;
			}
			if ($autre > 0)
				echo ",{ name: 'Autre',y: $autre}";
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Renvoie les statistiques des compagnies*/
function stat_all_compagnie($CodeCandidat,$dure_total){
	
	echo  "Sur une durée de ".$dure_total." j'ai passé mon temps avec :<br/>";
			
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomCompagnie'=>'c.NomCompagnie',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'compagnie',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeCompagnie = occupation.CodeCompagnie',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('occupation.CodeCompagnie')
            ->order(['dure'=>'DESC'])
            ->toArray();
    // debug($table);
    foreach ($table as $data) {
    	$dure = $data['temps'];
		$nom =  $data['NomCompagnie'];
		$temps_formate = afficher_temps_f($dure);
		echo "$temps_formate : $nom <br/>";
    }
}

/*Renvoie les statistiques journé des compagnies*/
function stat_jour_compagnie($jour,$CodeCandidat,$dure_total){
	
	echo  "J'ai passé mon temps avec :<br/>";
			
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomCompagnie'=>'c.NomCompagnie',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'compagnie',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeCompagnie = occupation.CodeCompagnie',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            		'DATE(HeureDebut)' => $jour
            	])
            ->group('occupation.CodeCompagnie')
            ->order(['dure'=>'DESC'])
            ->toArray();
    // debug($table);
    foreach ($table as $data) {
    	$dure = $data['temps'];
		$nom =  $data['NomCompagnie'];
		$temps_formate = afficher_temps_f($dure);
		echo "$temps_formate : $nom <br/>";
    }
}

/*Génération scripte compagnie camemebert*/
function camembert_all_compagnie($id_conatainer,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){

    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Avec qui ai-je passé mon temps?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		 <?php	

		 $table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomCompagnie'=>'c.NomCompagnie',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'compagnie',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeCompagnie = occupation.CodeCompagnie',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('occupation.CodeCompagnie')
            ->order(['dure'=>'DESC'])
            ->toArray();
		    // debug($table);
		    
			$i = 0; 
			foreach ($table as $data) {
				$dure = $data['dure'];
				$nom =  $data['NomCompagnie'];
				if ($i == 0)
					echo "{ name: '$nom',y: $dure}\n";
				elseif ($i == 1)
					echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
				else
					echo ",{ name: '$nom',y: $dure}\n";
				$i++;
			}
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}


/*Génération scripte compagnie camemebert*/
function camembert_jour_compagnie($id_conatainer,$jour,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){

    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Avec qui ai-je passé mon temps?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		<?php	
		$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomCompagnie'=>'c.NomCompagnie',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'compagnie',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeCompagnie = occupation.CodeCompagnie',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            		'DATE(HeureDebut)' => $jour
            	])
            ->group('occupation.CodeCompagnie')
            ->order(['dure'=>'DESC'])
            ->toArray();
		    // debug($table);
		    
			$i = 0; 
			foreach ($table as $data) {
				$dure = $data['dure'];
				$nom =  $data['NomCompagnie'];
				if ($i == 0)
					echo "{ name: '$nom',y: $dure}\n";
				elseif ($i == 1)
					echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
				else
					echo ",{ name: '$nom',y: $dure}\n";
				$i++;
			}
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}


/*Renvoie les statistiques des dispositifs*/
function stat_all_dispositif($CodeCandidat,$dure_total){
		
		echo  "Sur une durée de ".$dure_total." j'ai utilisé :<br/>";
			
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomDispositif'=>'c.NomDispositif',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'dispositif',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeDispositif = occupation.CodeDispositif',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('occupation.CodeDispositif')
            ->order(['dure'=>'DESC'])
            ->toArray();
    // debug($table);
    foreach ($table as $data) {
    	$dure = $data['temps'];
		$nom =  $data['NomDispositif'];
		$temps_formate = afficher_temps_f($dure);
		echo "$temps_formate : $nom <br/>";
    }
}

/*Renvoie les statistiques des dispositifs*/
function stat_jour_dispositif($jour,$CodeCandidat,$dure_total){
	
		echo  "Combient de temps ai-je passé mon temps avec :<br/>";
				
		$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomDispositif'=>'c.NomDispositif',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'dispositif',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeDispositif = occupation.CodeDispositif',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            	 'DATE(HeureDebut)' => $jour])
            ->group('occupation.CodeDispositif')
            ->order(['dure'=>'DESC'])
            ->toArray();
		    // debug($table);
		    
			foreach ($table as $data) {
				$dure = $data['temps'];
				$nom =  $data['NomDispositif'];
				$temps_formate = afficher_temps_f($dure);
				echo "$temps_formate : $nom <br/>";
			}
}

/*Génération scripte dispositif camemebert*/
function camembert_all_dispositif($id_conatainer,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){

    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Quels dispositifs ai-je utilisé?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		<?php	

		$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomDispositif'=>'c.NomDispositif',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'dispositif',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeDispositif = occupation.CodeDispositif',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('occupation.CodeDispositif')
            ->order(['dure'=>'DESC'])
            ->toArray();
		    // debug($table);
		    
			$i = 0; 
			foreach ($table as $data) {
				$dure = $data['dure'];
				$nom =  $data['NomDispositif'];
				if ($i == 0)
					echo "{ name: '$nom',y: $dure}\n";
				elseif ($i == 1)
					echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
				else
					echo ",{ name: '$nom',y: $dure}\n";
				$i++;
			}
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Génération scripte dispositif camemebert*/
function camembert_jour_dispositif($id_conatainer,$jour,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){

    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Quels dispositifs ai-je utilisé?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		<?php	
		$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomDispositif'=>'c.NomDispositif',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'dispositif',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeDispositif = occupation.CodeDispositif',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            	'DATE(HeureDebut)' => $jour])
            ->group('occupation.CodeDispositif')
            ->order(['dure'=>'DESC'])
            ->toArray();
		    // debug($table);
		    
			$i = 0; 
			foreach ($table as $data) {
				$dure = $data['dure'];
				$nom =  $data['NomDispositif'];
				if ($i == 0)
					echo "{ name: '$nom',y: $dure}\n";
				elseif ($i == 1)
					echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
				else
					echo ",{ name: '$nom',y: $dure}\n";
				$i++;
			}
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Renvoie les statistiques des lieux*/
function stat_all_lieu($CodeCandidat,$dure_total){
		echo  "Sur une durée de ".$dure_total." j'ai passé mon temps :<br/>";
			
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomLieux'=>'c.NomLieux',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'lieu',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeLieux = occupation.CodeLieux',
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('occupation.CodeLieux')
            ->order(['dure'=>'DESC'])
            ->toArray();
    // debug($table);
    foreach ($table as $data) {
    	$dure = $data['temps'];
		$nom =  $data['NomLieux'];
		$temps_formate = afficher_temps_f($dure);
		echo "$temps_formate : $nom <br/>";
    }
}

/*Renvoie les statistiques des lieux*/
function stat_jour_lieu($jour,$CodeCandidat,$dure_total){
		$dtransport = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomLieux'=>'c.NomLieux',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'lieu',
		            'type' => 'INNER',
		            'conditions' => array('c.CodeLieux = occupation.CodeLieux',
		            						'c.CodeCategorieLieux = 2'),
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            	'DATE(HeureDebut)' => $jour])
            ->group('occupation.CodeLieux')
            ->order(['dure'=>'DESC'])
            ->first();
		    // debug($table);
		    if (!empty($dtransport['dure'])){
				echo  "Combien de temps ai-je perdu dans les transports?<br/>";
				$dure_total = afficher_temps($dtransport['dure']);
				echo "J'ai passé $dure_total dans les transports.<br/>";
			}
		    
		    $table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomLieux'=>'c.NomLieux',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'lieu',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeLieux = occupation.CodeLieux'
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            	'DATE(HeureDebut)' => $jour])
            ->group('occupation.CodeLieux')
            ->order(['dure'=>'DESC'])
            ->toArray();
			 
			foreach ($table as $data) {
				$dure = $data['temps'];
				$nom =  $data['NomLieux'];
				$temps_formate = afficher_temps_f($dure);
				echo "$temps_formate : $nom <br/>";
			}
}

/*Génération scripte dispositif camemebert*/
function camembert_all_lieu($id_conatainer,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){

    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mais où étais-je?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		<?php

			$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomLieux'=>'c.NomLieux',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'lieu',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeLieux = occupation.CodeLieux'
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('occupation.CodeLieux')
            ->order(['dure'=>'DESC'])
            ->toArray();
			 
				
			$i = 0; 
			foreach ($table as $data) {
				$dure = $data['dure'];
				$nom =  $data['NomLieux'];
				if ($i == 0)
					echo "{ name: \"$nom\",y: $dure}\n";
				elseif ($i == 1)
					echo ",{ name: \"$nom\",y: $dure, sliced: true, selected : true}\n";
				else
					echo ",{ name: \"$nom\",y: $dure}\n";
				$i++;
			}
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Génération scripte dispositif camemebert*/
function camembert_jour_lieu($id_conatainer,$jour,$dure_total,$CodeCandidat){
?>
<script>
$(document).ready(function(){

    $('#<?php echo $id_conatainer; ?>').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Mais où étais-je?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Temps',
            data: [
		<?php	
		$table = TableRegistry::get('occupation')
            ->find()
            ->select(array(
            	'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
            	'NomLieux'=>'c.NomLieux',
            	'temps'=>'SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut))))'
            	)
            )
             ->join([
		        'c' => [
		            'table' => 'lieu',
		            'type' => 'INNER',
		            'conditions' => 'c.CodeLieux = occupation.CodeLieux'
		        ]
		    ])
            ->where(['CodeCandidat' => $CodeCandidat,
            	'DATE(HeureDebut)' => $jour])
            ->group('occupation.CodeLieux')
            ->order(['dure'=>'DESC'])
            ->toArray();
			 
				
			$i = 0; 
			foreach ($table as $data) {
				$dure = $data['dure'];
				$nom =  $data['NomLieux'];
				if ($i == 0)
					echo "{ name: \"$nom\",y: $dure}\n";
				elseif ($i == 1)
					echo ",{ name: \"$nom\",y: $dure, sliced: true, selected : true}\n";
				else
					echo ",{ name: \"$nom\",y: $dure}\n";
				$i++;
			}
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}


function premiere_date_moins_un($CodeCandidat){

	//ATTENTION  ça semble renvoyer trop loins
	$query = TableRegistry::get('occupation')
            ->find()
            ->select(array('jour' => 'DATE_FORMAT(DATE_ADD(HeureDebut, INTERVAL -2 DAY),"%d/%m/%Y")'))
            ->where(['CodeCandidat' => $CodeCandidat])
            ->order(['HeureDebut' => 'ASC'])
            ->first();
    //debug($query);
    
    $res = $query['jour'];
     return $res;
}

function date_des_jours($CodeCandidat){
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(
            	array(
            		'jour' => 'DATE_FORMAT(HeureDebut,"%d/%m/%Y")',
            		'titre' => 'DATE_FORMAT(HeureDebut,"%d/%m")'
            		)
            )
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('DAY(HeureDebut)')
            ->order(['HeureDebut' => 'ASC'])
            ->toArray();
   //debug($table);
    foreach($table as $data){
    	$jour = $data['jour'];
		$titre = $data['titre'];
		echo "<li><a href=\"#0\" data-date=\"$jour\">$titre</a></li>\n";
    }
}

function contenu_date($CodeCandidat,$dure_total){
	
	$table = TableRegistry::get('occupation')
            ->find()
            ->select(
            	array(
            		'jour' => 'DATE_FORMAT(HeureDebut,"%d/%m/%Y")',
            		'titre' => 'DATE_FORMAT(HeureDebut,"%d/%m")',
            		'jourm' => 'DATE(HeureDebut)'
            		)
            )
            ->where(['CodeCandidat' => $CodeCandidat])
            ->group('DAY(HeureDebut)')
            ->order(['HeureDebut' => 'ASC'])
            ->toArray();
   //debug($table);
    foreach($table as $data){
    	$jour = $data['jour'];
		$titre = $data['titre'];
		$jourm = $data['jourm'];
		echo "<li data-date=\"$jour\">";
		echo "<center>$jour $jourm</center>";
		echo "<div id=\"activite_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_activite("activite_$jourm"."_camembert",$jourm,$dure_total,$CodeCandidat);
			stat_jour_activite($jourm,$CodeCandidat,$dure_total);
		echo "<div id=\"compagnie_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_compagnie("compagnie_$jourm"."_camembert",$jourm,$dure_total,$CodeCandidat);
			stat_jour_compagnie($jourm,$CodeCandidat,$dure_total);
		echo "<div id=\"dispositif_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_dispositif("dispositif_$jourm"."_camembert",$jourm,$dure_total,$CodeCandidat,$CodeCandidat);
			stat_jour_dispositif($jourm,$CodeCandidat,$dure_total);
		echo "<div id=\"lieu_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_lieu("lieu_$jourm"."_camembert",$jourm,$dure_total,$CodeCandidat);
			stat_jour_lieu($jourm,$CodeCandidat,$dure_total);		
		echo "</li>";
    }
}
?>


