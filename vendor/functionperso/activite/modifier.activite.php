<?php
/* Ajax pour l'affichage du changement d'activité*/
require '../includes/connection_MYSQL.inc.php';
require '../modele/categorieActivite.modele.php';

function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = test_input($_POST['code']);
$nom = test_input($_POST['nom']);
$requete = $bdd->query("SELECT * FROM activite WHERE CodeActivite = $id");
$data = $requete->fetch();
echo "<div id=\"idActiviteModifAjax\"></div>";
echo "<input type=\"hidden\" id=\"old_id_activite\" value=\"$id\">";
echo "<label>ID de l'activité</label><input type=\"number\" name=\"id\" value=\"$id\" id=\"new_id_activite\"><br/>\n";
echo "<label>Nom de l'activité:</label><input type=\"text\" name=\"nom_act\" value=\"$nom\">\n";
echo "<label>Description de l'activité: </label><textarea name=\"descr_act\">".$data['DescriptifActivite']."</textarea>\n<label>Catégorie de l'activité:</label>";
echo selectCategorieSelected($bdd,"choix_cat_act","cat_activite",$data['CodeCategorie']);
?>