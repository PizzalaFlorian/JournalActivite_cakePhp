<?php
/*Renvoie le nombre de candidats inscrits à l'étude*/
use Cake\ORM\TableRegistry;

/*affiche le tableau des occupations*/
function tableDonnees(){
	$table = null;
	$table = TableRegistry::get('occupation')
	    ->find()
	    ->select(array(
            	'dure'=>'TIMEDIFF(HeureFin,HeureDebut)',
            	'CodeCandidat',
            	'CodeLieux',
            	'CodeCompagnie',
            	'CodeActivite',
            	'CodeDispositif',
            	'CodeOccupation',
            	'HeureDebut',
            	'HeureFin'
            	)
            )
	    ->limit(20)
	    ->toArray();

	$res = "<table cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"table\"  width=\"100%\">";
	$res.= "<thead><tr><th>Heure début</th><th>Heure Fin</th><th>Durée</th><th>Code Activité</th><th>Code Lieu</th><th>Code Compagnie</th><th>Code Dispositif</th><th>Code Candidat</th></tr></thead><tbody>";
		
	foreach ($table as $data) {
		$res.= "<tr><td>".$data['HeureDebut']->i18nFormat('yyyy-MM-dd HH:mm:ss')."</td><td>".$data['HeureFin']->i18nFormat('yyyy-MM-dd HH:mm:ss')."</td><td>".$data['dure']."</td><td>".$data['CodeActivite']."</td><td>".$data['CodeLieux']."</td><td>".$data['CodeCompagnie']."</td><td>".$data['CodeDispositif']."</td><td>".$data['CodeCandidat']."</td></tr>\n";
	}
	
	$res.="</tbody></table>";
	return $res;
}

/*affiche le tableau des candidats*/
function tableCandidat(){
	$res = "<table cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"table2\"  width=\"100%\">";
	$res.= "<thead><tr><th>Code Candidat</th><th>Age</th><th>Genre Candidat</th><th>Lieu d'étude</th><th>Niveau d'étude</th><th>Diplome préparé</th><th>Etat civil</th><th>Nombre d'enfant</th></tr></thead><tbody>";
	$table = TableRegistry::get('candidat')
	    ->find()
	    ->toArray();
	foreach ($table as $data) {
		$res.= "<tr><td>".$data['CodeCandidat']."</td><td>".$data['Age']."</td><td>".$data['GenreCandidat']."</td><td>".$data['LieuxEtude']."</td><td>".$data['NiveauEtude']."</td><td>".$data['DiplomePrep']."</td><td>".$data['EtatCivil']."</td><td>".$data['NombreEnfant']."</td></tr>\n";
	}
	$res.="</tbody></table>";
	return $res;
}

//function tableauActivite(){}
?>