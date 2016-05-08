<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isRecaptchaValid(test_input($_POST['g-recaptcha-response']))){
	/*Active la détection d'erreur pour la bdd*/
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (! empty($_POST)){
	//	var_dump($_POST);
		if (isset($_POST['inscription'])){
			$mail = test_input($_POST['mail']);
			$mdp = test_input($_POST['mdp']);
			$log = test_input($_POST['login']);
			$new_mdp = test_input($_POST['new_mdp']);
			$genre = test_input($_POST['gender']);
			$niv = test_input($_POST['niv']);
			$statut = test_input($_POST['civ']);
			$age = test_input($_POST['age']);
			$dip = test_input($_POST['dip']);
			$nb = test_input($_POST['nb']);
			$lieu = test_input($_POST['lieu']);
			if (empty($mail) || empty($mdp) || empty($log)  || empty($new_mdp) || empty($genre)  || empty($niv)  || empty($statut)  || empty($age)  || empty($dip)  || empty($lieu)){
				$msg = "Entrez toutes les informations!";
				
			}
			else if(empty($nb) && $nb != 0){
				$msg = "Entrez toutes les informations!";
			}
			/* vérifier si les mots de passes sont identiques*/
			else if (strcmp($mdp,$new_mdp) != 0) {
				$msg = "Les mots de passes ne sont pas identiques";
			}
			/* vérifier le format de l'adresse mail*/
			else if ( ! filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				$msg = "Le format de l'adresse e-mail n'est pas valide";
			}
			/* vérifier si un compte existe déjà avec se login*/
			else{
				$requete = $bdd->query("SELECT COUNT(*) AS num FROM utilisateur WHERE Login LIKE '$log' ");
				$data = $requete->fetch();
				if ($data['num'] > 0)
					$msg = "Un compte existe déjà avec ce login";
				else{
			/* vérifier si un compte existe déjà avec cet email*/		
					$requete = $bdd->query("SELECT COUNT(*) AS num FROM utilisateur WHERE MailCandidat LIKE '$mail' ");
					$data = $requete->fetch();
						if ($data['num'] > 0)
						$msg = "Un compte existe déjà avec cet e-mail, aller sur j'ai perdu mes identifants";
					else{
			/* tuti fruti on insère le candidat dans utilisateur*/			
						$req = $bdd->prepare("INSERT INTO utilisateur (Login,TypeUser,MotDePasse,MailCandidat) VALUES (:Login,:TypeUser,:MotDePasse,:MailCandidat)");
						$req->execute(array(
							'Login' => $log ,
							'TypeUser' => "candidat" ,
							'MotDePasse' => $mdp ,
							'MailCandidat' => $mail
						));
			/*On récupère l'id du candidat*/			
						$requete = $bdd->query("SELECT * FROM utilisateur WHERE Login LIKE '$log' ");
						$data = $requete->fetch();
						$id = $data['ID'];
			/*On insère le candidat dans candidat*/			
						$req = $bdd->prepare("INSERT INTO candidat (Age,GenreCandidat,LieuxEtude,NiveauEtude,DiplomePrep,EtatCivil,NombreEnfant,ID) VALUES (:Age,:GenreCandidat,:LieuxEtude,:NiveauEtude,:DiplomePrep,:EtatCivil,:NombreEnfant,:ID)");
						$req->execute(array(
							'Age' => $age ,
							'GenreCandidat' => $genre ,
							'LieuxEtude' => $lieu ,
							'NiveauEtude' => $niv,
							'DiplomePrep' => $dip,
							'EtatCivil' => $statut,
							'NombreEnfant' =>$nb,
							'ID' => $id
						));
			/*On redirige la page sur la page d'acceuil de l'étudiant*/
						$user = connection_user($bdd,$login,$mdp);

						if(!empty($user)){
							session_start();
							$_SESSION['id']=$user->ID;
							$_SESSION['pseudo']=$user->Login;
							header('Location: candidatAccueil.ctrl.php');
							exit();
						}
					}
				}
			}
		}
	}
}
		
?>