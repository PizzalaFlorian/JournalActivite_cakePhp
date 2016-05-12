<?php

require '../includes/connection_MYSQL.inc.php';
require '../modele/activite.modele.php';
require '../modele/lieux.modele.php';
require '../modele/compagnie.modele.php';
require '../modele/dispositif.modele.php';
/*générer un fichier txt avec le les codes correspondant aux codes*/
//créer un fichier
// 1 : on ouvre le fichier

$fichierLegende = fopen('../file/legende.txt', 'a');
ftruncate($fichierLegende,0);
fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
$date = date("Y-m-d H:i");
fputs($fichierLegende,"\nLes codes correspondant aux noms dans la base de données au $date\n");
fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
fputs($fichierLegende,"Les codes des activités :\n");
fputs($fichierLegende,listeActivite($bdd));
fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
fputs($fichierLegende,"Les codes des lieux :\n");
fputs($fichierLegende,listeLieu($bdd));
fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
fputs($fichierLegende,"Les codes des compagnies :\n");
fputs($fichierLegende,listeCompagnie($bdd));
fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
fputs($fichierLegende,"Les codes des dispositifs :\n");
fputs($fichierLegende,listeDispositif($bdd));
fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
fputs($fichierLegende,"Les codes candidats : ce sont les codes des candidats, leur noms n'est pas communiqué aux chercheurs à cause de la confidentialité, si vous vous rendez compte qu'un candidat rentre des mauvaises données signalez le à l'administrateur qui se chargera de supprimer le candidat.\n");

// 3 : quand on a fini de l'utiliser, on ferme le fichier
fclose($fichierLegende);
header('Location: legende.txt');
exit();
?>