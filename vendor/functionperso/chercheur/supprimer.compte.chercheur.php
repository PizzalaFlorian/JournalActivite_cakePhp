<?php
function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$msg ="";
	/*Active la détection d'erreur pour la bdd*/
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (! empty($_POST)){
	//	var_dump($_POST);
		if (isset($_POST['sup_compte'])){
			if (empty($_POST['mdp'])){
				$msg ="<div class=\"msg_alert\">Mot de passe incorrect!</div>";
			}
			else{
				$mdp = test_input($_POST['mdp']);
				$id = test_input($_SESSION['id']);
				$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
				$data = $requete->fetch();
				$requete->closeCursor();
				if ( strcmp($mdp,$data['MotDePasse']) !== 0){
					$msg = "<div class=\"msg_alert\">Mot de passe incorrect!</div>";
				}
				else{
				// on procède à la suprssion du compte
					$req = $bdd->prepare("DELETE FROM chercheur WHERE ID = :ID");
					$req->execute(array(
						'ID' => $id,
					));
					$req = $bdd->prepare("DELETE FROM utilisateur WHERE ID = :ID");
					$req->execute(array(
						'ID' => $id,
					));
					header('Location: ../controleur/connection.ctrl.php');
				}
			}
		}
	}
}
		
?>