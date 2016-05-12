<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	/*Active la détection d'erreur pour la bdd*/
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (! empty($_POST)){
	//	var_dump($_POST);
		if (isset($_POST['mod_mail'])){
			if (empty($_POST['mail'])){
				$msg = "<div class=\"msg_alert\">Donnez une adresse e-mail!</div>";
			}
			else{
				$mail = test_input($_POST['mail']);
				$id = test_input($_SESSION['id']);
				$req = $bdd->prepare('UPDATE utilisateur SET MailCandidat = :MailCandidat WHERE ID = :ID');
				$req->execute(array(
					'MailCandidat' => $mail,
					'ID' => $id
				));
				$msg = "<div class=\"msg_confirm\">Votre e-mail a bien été modifiée!</div>";
			}
		}
		if (isset($_POST['mod_nom'])){
			if (empty($_POST['prenom']) || empty($_POST['nom'])){
				$msg = "<div class=\"msg_alert\">Donnez un nom et un prénom</div>";
			}
			else{
				$nom = test_input($_POST['nom']);
				$prenom = test_input($_POST['prenom']);
				$id = test_input($_SESSION['id']);
				$req = $bdd->prepare('UPDATE chercheur SET NomChercheur = :NomChercheur, PrenomChercheur = :PrenomChercheur WHERE ID = :ID');
				$req->execute(array(
					'NomChercheur' => $nom,
					'PrenomChercheur' => $prenom,
					'ID' => $id
				));
				$msg = "<div class=\"msg_confirm\">Votre nom a bien été modifié modifié!</div>";
			}
		}
		if (isset($_POST['mod_login'])){
			if (empty($_POST['login']) || empty($_POST['mdp'])){
				$msg = "<div class=\"msg_alert\">Donnez un login et un mot de passe</div>";
			}
			else{
				$login = test_input($_POST['login']);
				$mdp = test_input($_POST['mdp']);
				$id = test_input($_SESSION['id']);
				$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
				$data = $requete->fetch();
				$requete->closeCursor();
				if ( strcmp($mdp,$data['MotDePasse']) !== 0){
					$msg = "<div class=\"msg_alert\">Mot de passe incorrect!</div>";
				}
				else{
					$req = $bdd->prepare('UPDATE utilisateur SET Login = :Login WHERE ID = :ID');
					$req->execute(array(
						'Login' => $login,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Votre login a bien été modifié modifié!</div>";
				}
			}
		}
		if (isset($_POST['mod_mdp'])){
			if (empty($_POST['mdp']) || empty($_POST['old_mdp']) || empty($_POST['new_mdp'])){
				$msg = "<div class=\"msg_alert\">Donnez tous les mots de passe</div>";
			}
			else{
				$old_mdp = test_input($_POST['old_mdp']);
				$mdp = test_input($_POST['mdp']);
				$new_mdp = test_input($_POST['new_mdp']);
				$id = test_input($_SESSION['id']);
				$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
				$data = $requete->fetch();
				$requete->closeCursor();
				if ( strcmp($old_mdp,$data['MotDePasse']) !== 0){
					$msg = "<div class=\"msg_alert\">Ancien mot de passe incorrect!</div>";
				}
				else if (strcmp($mdp,$new_mdp) !== 0){
					$msg = "<div class=\"msg_alert\">Les nouveaux mots de passe ne sont pas identiques!</div>";
				}
				else{
					$req = $bdd->prepare('UPDATE utilisateur SET MotDePasse = :MotDePasse WHERE ID = :ID');
					$req->execute(array(
						'MotDePasse' => $mdp,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Votre mot de passe a bien été modifié modifié!</div>";
				}
			}
		}	
	}
	echo $msg;
}





/*Renvoie le nom du chercheur*/
function nomChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM chercheur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['PrenomChercheur']." ".$data['NomChercheur'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le mail du chercheur*/
function mailChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['MailCandidat'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le login du chercheur*/
function loginChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['Login'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le prénom du chercheur*/
function prenomChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM chercheur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['PrenomChercheur'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le prénom du chercheur*/
function nomFamilleChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM chercheur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['NomChercheur'];
	$requete->closeCursor();
	return $resultat;
}

?>