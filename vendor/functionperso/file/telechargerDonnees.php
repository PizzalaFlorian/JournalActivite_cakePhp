<?php

require '../includes/connection_MYSQL.inc.php';
require '../modele/activite.modele.php';
require '../modele/lieux.modele.php';
require '../modele/compagnie.modele.php';
require '../modele/dispositif.modele.php';
/*générer un fichier csv avec les données de la table occupation*/
//créer un fichier
// 1 : on ouvre le fichier

$fichierCSV = fopen('../file/donnees.csv', 'a');
ftruncate($fichierCSV,0);
$delimiter = ";";
$entete = array( "Début" , "Fin" , "Durée", "Code Activité" , "Code Lieu" , "Code Compagnie" , "Code Dispositif" , "Code Candidat"); 
fputcsv($fichierCSV,$entete,$delimiter);
$requete = $bdd->query("SELECT *, TIMEDIFF(HeureFin,HeureDebut) AS dure FROM occupation");
while ($data = $requete->fetch()){
	$res = array($data['HeureDebut'] , $data['HeureFin'], $data['dure'], $data['CodeActivite'], $data['CodeLieux'] , $data['CodeCompagnie'] , $data['CodeDispositif'] , $data['CodeCandidat']);
	fputcsv($fichierCSV,$res,$delimiter);
}
$requete->closeCursor();

// 3 : quand on a fini de l'utiliser, on ferme le fichier
fclose($fichierCSV);
header('Location: donnees.csv');
exit();
?>