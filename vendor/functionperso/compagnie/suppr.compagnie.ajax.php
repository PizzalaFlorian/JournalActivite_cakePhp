<?php
/* Ajax pour vérifier réafecter la compagnie*/
require '../includes/connection_MYSQL.inc.php';
require './compagnie.modele.php';

function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = test_input($_POST['code']);
if ((! empty($id) || $id == 0 ) && $id != -1){
	$requete = $bdd->query("SELECT COUNT(*) AS num FROM occupation WHERE CodeCompagnie = $id");
	$data = $requete->fetch();
	$num = $data['num'];
	if ($num != 0){
		echo "<div class=\"msg_alert\">Il y a  $num entrées d'occupations associé à cette compagnie !<br/>Sélectionnez une compagnie pour réafecter les entrées, les occupations concenrnés vont être mis-à-jour.</div>";
		echo "<label>Sélectionnez une compagnie pour réafecter les occupations concernés:</label>";
		echo selectCompagnieSauf($bdd,$id,"comp","reafecterCompagnie");
		echo "Les occupations concernés ne vont pas être supprimé, leurs code compagnie sera réafecté à la sélection ci-dessus.";
	}
	$requete->closeCursor();
}
?>