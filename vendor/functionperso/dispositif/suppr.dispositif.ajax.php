<?php
/* Ajax pour vérifier réafecter le lieu*/
require '../includes/connection_MYSQL.inc.php';
require './dispositif.modele.php';

function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = test_input($_POST['code']);
if ((! empty($id) || $id == 0 ) && $id != -1){
	$requete = $bdd->query("SELECT COUNT(*) AS num FROM occupation WHERE CodeDispositif = $id");
	$data = $requete->fetch();
	$num = $data['num'];
	if ($num != 0){
		echo "<div class=\"msg_alert\">Il y a  $num entrées d'occupations associé à ce dispositif !<br/>Sélectionnez un dispositif pour réafecter les entrées, les occupations concenrnés vont être mis-à-jour.</div>";
		echo "<label>Sélectionnez un dispositif pour réafecter les occupations concernés:</label>";
		echo selectDispositifSauf($bdd,$id,"dispositif_sel","reafecterDispositif");
		echo "Les occupations concernés ne vont pas être supprimé, leurs code du dispositif sera réafecté à la sélection ci-dessus.";
	}
	$requete->closeCursor();
}
?>