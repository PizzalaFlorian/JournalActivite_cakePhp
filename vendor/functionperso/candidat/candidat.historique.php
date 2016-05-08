<?php
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

/*Renvoie les statistiques des activités*/
function stat_all_activite($bdd){
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS dure FROM occupation WHERE CodeCandidat = $id");
		$data = $requete->fetch();
		$dure_total = afficher_temps($data['dure']);
		$requete->closeCursor();
		echo  "Sur une durée $dure_total j'ai passé le plus de temps à :<br/>";
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomActivite, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN activite a ON o.codeActivite = a.CodeActivite WHERE CodeCandidat = $id GROUP BY o.CodeActivite,NomActivite ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomActivite'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}

/*Renvoie les statistiques des activités pour un jour*/
function stat_jour_activite($bdd,$jour){
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS dure FROM occupation WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' ");
		$data = $requete->fetch();
		$dure_total = $data['dure'];
		$requete->closeCursor();
		echo  "J'ai passé mon temps à :<br/>";
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomActivite, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN activite a ON o.codeActivite = a.CodeActivite WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeActivite,NomActivite ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomActivite'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}


/*Function pour l'activite des jours*/
function camembert_jour_activite($bdd,$id_conatainer,$jour){
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
        },<?php
			// sélection de la durée total
		$id = test_input($_SESSION['id']);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure FROM occupation WHERE CodeCandidat = $id");
		$data = $requete->fetch();
		$dure_total = $data['dure']; // pour l'instant dure total non utilisisé
		$requete->closeCursor();
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomActivite, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN activite a ON o.codeActivite = a.CodeActivite WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeActivite,NomActivite ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}	



/*Génération scripte activité camemebert*/
function camembert_all_activite($bdd,$id_conatainer){
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
        },<?php
			// sélection de la durée total
		$id = test_input($_SESSION['id']);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure FROM occupation WHERE CodeCandidat = $id");
		$data = $requete->fetch();
		$dure_total = $data['dure']; // pour l'instant dure total non utilisisé
		$requete->closeCursor();
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomActivite, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN activite a ON o.codeActivite = a.CodeActivite WHERE CodeCandidat = $id GROUP BY o.CodeActivite,NomActivite ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Renvoie les statistiques des compagnies*/
function stat_all_compagnie($bdd){
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS dure FROM occupation WHERE CodeCandidat = $id");
		$data = $requete->fetch();
		$dure_total = afficher_temps($data['dure']);
		$requete->closeCursor();
		echo  "Sur une durée de $dure_total j'ai passé mon temps avec :<br/>";
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomCompagnie, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN compagnie c ON o.codeCompagnie = c.CodeCompagnie WHERE CodeCandidat = $id GROUP BY o.CodeCompagnie,NomCompagnie ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomCompagnie'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}

/*Renvoie les statistiques journé des compagnies*/
function stat_jour_compagnie($bdd,$jour){
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$id = test_input($_SESSION['id']);
		echo  "J'ai passé mon temps avec :<br/>";
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomCompagnie, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN compagnie c ON o.codeCompagnie = c.CodeCompagnie WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeCompagnie,NomCompagnie ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomCompagnie'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}

/*Génération scripte compagnie camemebert*/
function camembert_all_compagnie($bdd,$id_conatainer){
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
			// sélection de la durée total
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomCompagnie, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN compagnie c ON o.codeCompagnie = c.CodeCompagnie WHERE CodeCandidat = $id GROUP BY o.CodeCompagnie,NomCompagnie ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}


/*Génération scripte compagnie camemebert*/
function camembert_jour_compagnie($bdd,$id_conatainer,$jour){
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
			// sélection de la durée total
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomCompagnie, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN compagnie c ON o.codeCompagnie = c.CodeCompagnie WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeCompagnie,NomCompagnie ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}


/*Renvoie les statistiques des dispositifs*/
function stat_all_dispositif($bdd){
		$id = test_input($_SESSION['id']);
		echo  "Ai-je été un geek ou ai-je passé mon temps à feuilleter les revues scientifiques?<br/>";
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomDispositif, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN dispositif d ON o.codeDispositif = d.CodeDispositif WHERE CodeCandidat = $id GROUP BY o.CodeDispositif,NomDispositif ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomDispositif'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}

/*Renvoie les statistiques des dispositifs*/
function stat_jour_dispositif($bdd,$jour){
		$id = test_input($_SESSION['id']);
		echo  "Ai-je été un geek ou ai-je passé mon temps à feuilleter les revues scientifiques?<br/>";
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomDispositif, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN dispositif d ON o.codeDispositif = d.CodeDispositif WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeDispositif,NomDispositif ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomDispositif'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}

/*Génération scripte dispositif camemebert*/
function camembert_all_dispositif($bdd,$id_conatainer){
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
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomDispositif, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN dispositif d ON o.codeDispositif = d.CodeDispositif WHERE CodeCandidat = $id GROUP BY o.CodeDispositif,NomDispositif ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Génération scripte dispositif camemebert*/
function camembert_jour_dispositif($bdd,$id_conatainer,$jour){
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
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomDispositif, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN dispositif d ON o.codeDispositif = d.CodeDispositif WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeDispositif,NomDispositif ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Renvoie les statistiques des lieux*/
function stat_all_lieu($bdd){
		$id = test_input($_SESSION['id']);
		echo  "Combien de temps ai-je perdu dans les transports?<br/>";
		$requete = $bdd->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS dure FROM occupation o INNER JOIN lieu l ON o.CodeLieux = l.codeLieux WHERE CodeCandidat = $id AND CodeCategorieLieux = 2");
		$data = $requete->fetch();
		if (!empty($data['dure'])){
			$dure_total = afficher_temps($data['dure']);
			echo "J'ai passé $dure_total dans les transports.<br/>";
			
		}
		$requete->closeCursor();
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomLieux, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN lieu l ON o.codeLieux = l.CodeLieux WHERE CodeCandidat = $id GROUP BY o.CodeLieux,NomLieux ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomLieux'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}

/*Renvoie les statistiques des lieux*/
function stat_jour_lieu($bdd,$jour){
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS dure FROM occupation o INNER JOIN lieu l ON o.CodeLieux = l.codeLieux WHERE CodeCandidat = $id AND CodeCategorieLieux = 2 AND DATE(HeureDebut) = '$jour' ");
		$data = $requete->fetch();
		if (!empty($data['dure'])){
			echo  "Combien de temps ai-je perdu dans les transports?<br/>";
			$dure_total = afficher_temps($data['dure']);
			echo "J'ai passé $dure_total dans les transports.<br/>";
			
		}
		$requete->closeCursor();
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomLieux, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN lieu l ON o.codeLieux = l.CodeLieux WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeLieux,NomLieux ORDER BY dure DESC");
		while ($data = $requete->fetch()){
				$dure = $data['temps'];
				$nom =  $data['NomLieux'];
				echo "$dure : $nom <br/>";
			}
		$requete->closeCursor();
}

/*Génération scripte dispositif camemebert*/
function camembert_all_lieu($bdd,$id_conatainer){
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
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomLieux, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN lieu l ON o.codeLieux = l.CodeLieux WHERE CodeCandidat = $id GROUP BY o.CodeLieux,NomLieux ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}

/*Génération scripte dispositif camemebert*/
function camembert_jour_lieu($bdd,$id_conatainer,$jour){
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
		$id = test_input($_SESSION['id']);
		$requete = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut))) AS dure, NomLieux, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))) AS temps FROM occupation o INNER JOIN lieu l ON o.codeLieux = l.CodeLieux WHERE CodeCandidat = $id AND DATE(HeureDebut) = '$jour' GROUP BY o.CodeLieux,NomLieux ORDER BY dure DESC");	
		?>
        series: [{
            name: 'Temps',
            data: [
		<?php	
			$i = 0; 
			while ($data = $requete->fetch()){
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
		$requete->closeCursor();
		?>	
            ]
        }]
    });
}); 
</script>
<?php
}


function premiere_date_moins_un($bdd){
	$id = test_input($_SESSION['id']); 
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	$requete = $bdd->query("SELECT DATE_FORMAT(DATE_ADD(HeureDebut, INTERVAL -2 DAY),'%d/%m/%Y') AS jour FROM occupation WHERE CodeCandidat = $id ORDER BY HeureDebut");
	$data = $requete->fetch();
	$res = $data['jour'];
	$requete->closeCursor();
	return $res;
}

function date_des_jours($bdd){
	$id = test_input($_SESSION['id']); 
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	$requete = $bdd->query("SELECT DATE_FORMAT(HeureDebut,'%d/%m/%Y') AS jour, DATE_FORMAT(HeureDebut,'%d/%m') AS titre FROM occupation WHERE CodeCandidat = $id GROUP BY DAY(HeureDebut) ORDER BY HeureDebut");
	while ($data = $requete->fetch()){
		$jour = $data['jour'];
		$titre = $data['titre'];
		echo "<li><a href=\"#0\" data-date=\"$jour\">$titre</a></li>\n"; 
	}
	$requete->closeCursor();
}

function contenu_date($bdd){
	$id = test_input($_SESSION['id']); 
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	$requete = $bdd->query("SELECT DATE_FORMAT(HeureDebut,'%d/%m/%Y') AS jour, DATE_FORMAT(HeureDebut,'%d/%m') AS titre, DATE(HeureDebut) as jourm FROM occupation WHERE CodeCandidat = $id GROUP BY DAY(HeureDebut) ORDER BY HeureDebut");
	while ($data = $requete->fetch()){
		$jour = $data['jour'];
		$titre = $data['titre'];
		$jourm = $data['jourm'];
		echo "<li data-date=\"$jour\">";
		echo "<center>$jour $jourm</center>";
		echo "<div id=\"activite_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_activite($bdd,"activite_$jourm"."_camembert",$jourm);
			stat_jour_activite($bdd,$jourm);
		echo "<div id=\"compagnie_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_compagnie($bdd,"compagnie_$jourm"."_camembert",$jourm);
			stat_jour_compagnie($bdd,$jourm);
		echo "<div id=\"dispositif_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_dispositif($bdd,"dispositif_$jourm"."_camembert",$jourm);
			stat_jour_dispositif($bdd,$jourm);
		echo "<div id=\"lieu_$jourm"."_camembert\" style=\"width:100%; height:400px;\"></div>";
			camembert_jour_lieu($bdd,"lieu_$jourm"."_camembert",$jourm);
			stat_jour_lieu($bdd,$jourm);		
		echo "</li>";
	}
	$requete->closeCursor();
}
?>


