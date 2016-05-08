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
					$msg = "<div class=\"msg_confirm\">Votre login a bien été modifié!</div>";
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
					$msg = "<div class=\"msg_confirm\">Votre mot de passe a bien été modifié!</div>";
				}
			}
		}
		if (isset($_POST['mod_age'])){
			if (empty($_POST['age'])){
				$msg = "<div class=\"msg_alert\">Donnez un age</div>";
			}
			else{
				$age = test_input($_POST['age']);
				$id = test_input($_SESSION['id']);
				if ($age < 1){
					$msg = "<div class=\"msg_alert\">L'age doit etre supérieur à 0</div>";
				}
				else{
					$req = $bdd->prepare('UPDATE candidat SET Age = :Age WHERE ID = :ID');
					$req->execute(array(
						'Age' => $age,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Votre age a bien été modifié!</div>";
				}
			}
		}
		if (isset($_POST['mod_enf'])){
			if (empty($_POST['nb'])){
				$msg = "<div class=\"msg_alert\">Donnez un nombre</div>";
			}
			else{
				$nb = test_input($_POST['nb']);
				$id = test_input($_SESSION['id']);
				if ($nb < 0){
					$msg = "<div class=\"msg_alert\">Le nombre d'enfant doit etre supérieur égal à 0</div>";
				}
				else{
					$req = $bdd->prepare('UPDATE candidat SET NombreEnfant = :NombreEnfant WHERE ID = :ID');
					$req->execute(array(
						'NombreEnfant' => $nb,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Le nombre d'enfant a bien été modifié!</div>";
				}
			}
		}
		if (isset($_POST['mod_dip'])){
			if (empty($_POST['dip'])){
				$msg = "<div class=\"msg_alert\">Sélectionnez un diplome</div>";
			}
			else{
				$dip = test_input($_POST['dip']);
				$id = test_input($_SESSION['id']);
					$req = $bdd->prepare('UPDATE candidat SET NiveauEtude = :NiveauEtude WHERE ID = :ID');
					$req->execute(array(
						'NiveauEtude' => $dip,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Le diplome a bien été modifié!</div>";

			}
		}
		if (isset($_POST['mod_civ'])){
			if (empty($_POST['civ'])){
				$msg = "<div class=\"msg_alert\">Sélectionnez un état civil</div>";
			}
			else{
				$civ = test_input($_POST['civ']);
				$id = test_input($_SESSION['id']);
					$req = $bdd->prepare('UPDATE candidat SET EtatCivil = :EtatCivil WHERE ID = :ID');
					$req->execute(array(
						'EtatCivil' => $civ,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Votre état civil a bien été modifié!</div>";

			}
		}
		if (isset($_POST['mod_lieu'])){
			if (empty($_POST['lieu'])){
				$msg = "<div class=\"msg_alert\">Entrez un lieu</div>";
			}
			else{
				$lieu = test_input($_POST['lieu']);
				$id = test_input($_SESSION['id']);
					$req = $bdd->prepare('UPDATE candidat SET LieuxEtude = :LieuxEtude WHERE ID = :ID');
					$req->execute(array(
						'LieuxEtude' => $lieu,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Votre lieux d'étude a bien été modifié!</div>";

			}
		}
		if (isset($_POST['mod_niv'])){
			if (empty($_POST['dip'])){
				$msg = "<div class=\"msg_alert\">Sélectionnez un diplome</div>";
			}
			else{
				$lieu = test_input($_POST['dip']);
				$id = test_input($_SESSION['id']);
					$req = $bdd->prepare('UPDATE candidat SET DiplomePrep = :DiplomePrep WHERE ID = :ID');
					$req->execute(array(
						'DiplomePrep' => $lieu,
						'ID' => $id
					));
					$msg = "<div class=\"msg_confirm\">Votre diplome a bien été modifié!</div>";

			}
		}
	}
	echo $msg;
}

/*Renvoie le mail du candidat*/
function mailChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['MailCandidat'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le login du candidat*/
function loginChercheur($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM utilisateur WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['Login'];
	$requete->closeCursor();
	return $resultat;
}


/*Renvoie l'age du candidat*/
function ageCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['Age'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le nombre d'enfant du candidat*/
function enfantCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['NombreEnfant'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le niveau du candidat*/
function diplomeCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['NiveauEtude'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie l'état civil du candidat*/
function etatCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['EtatCivil'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le lieu d'étude du candidat*/
function lieuCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['LieuxEtude'];
	$requete->closeCursor();
	return $resultat;
}

/*Renvoie le dipome d'étude du candidat*/
function nivCandidat($bdd){
	$id = test_input($_SESSION['id']); 
	$requete = $bdd->query("SELECT * FROM candidat WHERE ID = $id");
	$data = $requete->fetch();
	$resultat = $data['DiplomePrep'];
	$requete->closeCursor();
	return $resultat;
}
?>