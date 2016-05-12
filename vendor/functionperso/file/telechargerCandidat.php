<?php

require '../includes/connection_MYSQL.inc.php';
/*générer un fichier csv avec les données de la table candidat*/
//créer un fichier
// 1 : on ouvre le fichier

$fichierCSV = fopen('../file/candidat.csv', 'a');
ftruncate($fichierCSV,0);
$delimiter = ";";


$entete = array( "Code Candidat" , "Age" , "Genre Candidat", "Lieu d'étude" , "Niveau d'étude" , "Diplome préparé" , "Etat civil" , "Nombre d'enfant"); 
fputcsv($fichierCSV,$entete,$delimiter);
$requete = $bdd->query("SELECT * FROM candidat");
while ($data = $requete->fetch()){
	$res = array($data['CodeCandidat'] , $data['Age'] , $data['GenreCandidat'], $data['LieuxEtude'], $data['NiveauEtude'], $data['DiplomePrep'], $data['EtatCivil'], $data['NombreEnfant']);
	fputcsv($fichierCSV,$res,$delimiter);
}
$requete->closeCursor();

// 3 : quand on a fini de l'utiliser, on ferme le fichier
fclose($fichierCSV);
header('Location: candidat.csv');
exit();
?>