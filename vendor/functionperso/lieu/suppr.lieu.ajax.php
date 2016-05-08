<?php
/* Ajax pour vérifier réafecter le lieu*/
require '../includes/connection_MYSQL.inc.php';
require './lieux.modele.php';

function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = test_input($_POST['code']);
if ((! empty($id) || $id == 0 ) && $id != -1){
	$requete = $bdd->query("SELECT COUNT(*) AS num FROM occupation WHERE CodeLieux = $id");
	$data = $requete->fetch();
	$num = $data['num'];
	if ($num != 0){
		echo "<div class=\"msg_alert\">Il y a  $num entrées d'occupations associé à ce lieu !<br/>Sélectionnez un lieu pour réafecter les entrées, les occupations concenrnés vont être mis-à-jour.</div>";
		echo "<label>Sélectionnez un lieu pour réafecter les occupations concernés:</label>";
		echo selectLieuSauf($bdd,$id,"lieu_sel","reafecterLieu");
		echo "Les occupations concernés ne vont pas être supprimé, leurs code lieu sera réafecté à la sélection ci-dessus.";
	}
	$requete->closeCursor();
}
?>