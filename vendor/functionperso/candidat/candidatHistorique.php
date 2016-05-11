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
		echo "$dure : $nom <br/>";
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
		echo "$dure : $nom <br/>";
    }
}


/*Function pour l'activite des jours*/
function camembert_jour_activite($id_conatainer,$jour,$dure_total){
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

		$i =0;
		foreach ($table as $data) {
	    	$dure = $data['dure'];
			$nom =  $data['NomActivite'];
			if ($i == 0)
				echo "{ name: '".$nom."',y: ".$dure."}\n";
			elseif ($i == 1)
				echo ",{ name: '".$nom.".',y: ".$dure.", sliced: true, selected : true}\n";
			else
				echo ",{ name: '".$nom."',y: ".$dure."}\n";
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



/*Génération scripte activité camemebert*/
function camembert_all_activite($id_conatainer){
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
	            		'DATE(HeureDebut)' => $jour
	            	])
	            ->group('occupation.CodeActivite')
	            ->order(['dure'=>'DESC'])
	            ->toArray();	
			$i = 0; 
			foreach($table as $data){
				$dure = $data['dure'];
				$nom =  $data['NomActivite'];
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
		echo "$dure : $nom <br/>";
    }
}

/*Renvoie les statistiques journé des compagnies*/
function stat_jour_compagnie($jour,$CodeCandidat,$dure_total){
	//TODO
	// $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	// 	echo  "J'ai passé mon temps avec :<br/>";
	// 	$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomCompagnie, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN compagnie c ON o.codeCompagnie = c.CodeCompagnie WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeCompagnie,NomCompagnie ORDER BY dure DESC");
	// 	while ($data = $requete->fetch()){
	// 			$dure = $data['temps'];
	// 			$nom =  $data['NomCompagnie'];
	// 			echo "$dure : $nom <br/>";
	// 		}
	// 	$requete->closeCursor();
}

/*Génération scripte compagnie camemebert*/
function camembert_all_compagnie($id_conatainer){
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
        <?php
        //TODO
			// sélection de la durée total
		
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomCompagnie, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN compagnie c ON o.codeCompagnie = c.CodeCompagnie WHERE CodeCandidat = $id GROUP BY o.CodeCompagnie,NomCompagnie ORDER BY dure DESC");	
		// ?>
        series: [{
            name: 'Temps',
            data: [
		 <?php	
		// 	$i = 0; 
		// 	while ($data = $requete->fetch()){
		// 		$dure = $data['dure'];
		// 		$nom =  $data['NomCompagnie'];
		// 		if ($i == 0)
		// 			echo "{ name: '$nom',y: $dure}\n";
		// 		elseif ($i == 1)
		// 			echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
		// 		else
		// 			echo ",{ name: '$nom',y: $dure}\n";
		// 		$i++;
		// 	}
		// $requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}


/*Génération scripte compagnie camemebert*/
function camembert_jour_compagnie($id_conatainer,$jour){
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
        },<?php
        //TODO
			// sélection de la durée total
		
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomCompagnie, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN compagnie c ON o.codeCompagnie = c.CodeCompagnie WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeCompagnie,NomCompagnie ORDER BY dure DESC");	
		// ?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
		// 	$i = 0; 
		// 	while ($data = $requete->fetch()){
		// 		$dure = $data['dure'];
		// 		$nom =  $data['NomCompagnie'];
		// 		if ($i == 0)
		// 			echo "{ name: '$nom',y: $dure}\n";
		// 		elseif ($i == 1)
		// 			echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
		// 		else
		// 			echo ",{ name: '$nom',y: $dure}\n";
		// 		$i++;
		// 	}
		// $requete->closeCursor();
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
		echo "$dure : $nom <br/>";
    }
}

/*Renvoie les statistiques des dispositifs*/
function stat_jour_dispositif($jour,$CodeCandidat,$dure_total){
	//TODO
		
		// echo  "Ai-je été un geek ou ai-je passé mon temps à feuilleter les revues scientifiques?<br/>";
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomDispositif, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN dispositif d ON o.codeDispositif = d.CodeDispositif WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeDispositif,NomDispositif ORDER BY dure DESC");
		// while ($data = $requete->fetch()){
		// 		$dure = $data['temps'];
		// 		$nom =  $data['NomDispositif'];
		// 		echo "$dure : $nom <br/>";
		// 	}
		// $requete->closeCursor();
}

/*Génération scripte dispositif camemebert*/
function camembert_all_dispositif($id_conatainer){
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
        },<?php
			// sélection de la durée 
		//TODO
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomDispositif, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN dispositif d ON o.codeDispositif = d.CodeDispositif WHERE CodeCandidat = $id GROUP BY o.CodeDispositif,NomDispositif ORDER BY dure DESC");	
		// ?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
		// 	$i = 0; 
		// 	while ($data = $requete->fetch()){
		// 		$dure = $data['dure'];
		// 		$nom =  $data['NomDispositif'];
		// 		if ($i == 0)
		// 			echo "{ name: '$nom',y: $dure}\n";
		// 		elseif ($i == 1)
		// 			echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
		// 		else
		// 			echo ",{ name: '$nom',y: $dure}\n";
		// 		$i++;
		// 	}
		// $requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Génération scripte dispositif camemebert*/
function camembert_jour_dispositif($id_conatainer,$jour){
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
        },<?php
			// sélection de la durée 
		//TODO
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomDispositif, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN dispositif d ON o.codeDispositif = d.CodeDispositif WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeDispositif,NomDispositif ORDER BY dure DESC");	
		// ?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
		// 	$i = 0; 
		// 	while ($data = $requete->fetch()){
		// 		$dure = $data['dure'];
		// 		$nom =  $data['NomDispositif'];
		// 		if ($i == 0)
		// 			echo "{ name: '$nom',y: $dure}\n";
		// 		elseif ($i == 1)
		// 			echo ",{ name: '$nom',y: $dure, sliced: true, selected : true}\n";
		// 		else
		// 			echo ",{ name: '$nom',y: $dure}\n";
		// 		$i++;
		// 	}
		// $requete->closeCursor();
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
		echo "$dure : $nom <br/>";
    }
}

/*Renvoie les statistiques des lieux*/
function stat_jour_lieu($jour,$CodeCandidat,$dure_total){
		//TODO
		// $requete = $bdd->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS dure FROM occupation o INNER JOIN lieu l ON o.CodeLieux = l.codeLieux WHERE CodeCandidat = $id AND CodeCategorieLieux = 2 AND DATE(HeureDebut) = '$jour' ");
		// $data = $requete->fetch();
		// if (!empty($data['dure'])){
		// 	echo  "Combien de temps ai-je perdu dans les transports?<br/>";
		// 	$dure_total = afficher_temps($data['dure']);
		// 	echo "J'ai passé $dure_total dans les transports.<br/>";
			
		// }
		// $requete->closeCursor();
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomLieux, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN lieu l ON o.codeLieux = l.CodeLieux WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeLieux,NomLieux ORDER BY dure DESC");
		// while ($data = $requete->fetch()){
		// 		$dure = $data['temps'];
		// 		$nom =  $data['NomLieux'];
		// 		echo "$dure : $nom <br/>";
		// 	}
		// $requete->closeCursor();
}

/*Génération scripte dispositif camemebert*/
function camembert_all_lieu($id_conatainer){
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
        },<?php
			// sélection de la durée 
		//TODO
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomLieux, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN lieu l ON o.codeLieux = l.CodeLieux WHERE CodeCandidat = $id GROUP BY o.CodeLieux,NomLieux ORDER BY dure DESC");	
		// ?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
		// 	$i = 0; 
		// 	while ($data = $requete->fetch()){
		// 		$dure = $data['dure'];
		// 		$nom =  $data['NomLieux'];
		// 		if ($i == 0)
		// 			echo "{ name: \"$nom\",y: $dure}\n";
		// 		elseif ($i == 1)
		// 			echo ",{ name: \"$nom\",y: $dure, sliced: true, selected : true}\n";
		// 		else
		// 			echo ",{ name: \"$nom\",y: $dure}\n";
		// 		$i++;
		// 	}
		// $requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Génération scripte dispositif camemebert*/
function camembert_jour_lieu($id_conatainer,$jour){
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
        <?php
			// sélection de la durée 
		//TODO
		// $requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomLieux, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN lieu l ON o.codeLieux = l.CodeLieux WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeLieux,NomLieux ORDER BY dure DESC");	
		// ?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
		// 	$i = 0; 
		// 	while ($data = $requete->fetch()){
		// 		$dure = $data['dure'];
		// 		$nom =  $data['NomLieux'];
		// 		if ($i == 0)
		// 			echo "{ name: \"$nom\",y: $dure}\n";
		// 		elseif ($i == 1)
		// 			echo ",{ name: \"$nom\",y: $dure, sliced: true, selected : true}\n";
		// 		else
		// 			echo ",{ name: \"$nom\",y: $dure}\n";
		// 		$i++;
		// 	}
		// $requete->closeCursor();
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
			camembert_jour_activite("activite_$jourm"."_camembert",$jourm,$CodeCandidat);
			stat_jour_activite($jourm,$CodeCandidat,$dure_total);
		echo "<div id=\"compagnie_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_compagnie("compagnie_$jourm"."_camembert",$jourm,$CodeCandidat);
			stat_jour_compagnie($jourm,$CodeCandidat,$dure_total);
		echo "<div id=\"dispositif_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_dispositif("dispositif_$jourm"."_camembert",$jourm,$CodeCandidat);
			stat_jour_dispositif($jourm,$CodeCandidat,$dure_total);
		echo "<div id=\"lieu_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_lieu("lieu_$jourm"."_camembert",$jourm,$CodeCandidat);
			stat_jour_lieu($jourm,$CodeCandidat,$dure_total);		
		echo "</li>";
    }
}
?>


