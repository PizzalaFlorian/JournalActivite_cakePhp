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
			if (isset($_POST['add_categorie'])){
				if (empty($_POST['nom_categorie'])){
					$msg = "<div class=\"msg_alert\">Le nom de la catégorie doit etre rempli!</div>";
				}
				else{
					$nom_categorie = test_input($_POST['nom_categorie']);
					/*--- On insère la catégorie dans la bdd*/
					$req = $bdd->prepare("INSERT INTO categorieactivite (NomCategorie) VALUES (:NomCategorie)");
					$req->execute(array(
						'NomCategorie' => $nom_categorie
					));
					$msg = "<div class=\"msg_confirm\">La catégorie '$nom_categorie' a bien été rajouté!</div>";
					
				}
			}
			elseif(isset($_POST['sup_categorie'])){
				if (empty($_POST['code_categorie'])){
					$msg = "<div class=\"msg_alert\">Il faut sélectionner une catégorie!</div>";
				}
				else{	
					$num_categorie = test_input($_POST['code_categorie']);
					/*--- On véréfie si il y a des activités affecté à cette catégorie---*/
					$requete = $bdd->query("SELECT COUNT(*) AS num FROM activite WHERE CodeCategorie = $num_categorie");
					$data = $requete->fetch();
					if($data['num']!= 0){
						$requete = $bdd->query("SELECT * FROM activite WHERE CodeCategorie = $num_categorie");
						if($data['num']== 1)
							$msg ="<div class=\"msg_alert\">Impossible de supprimer la catégorie l'activités suivante est affectée à la catégorie: ";
						else
							$msg ="<div class=\"msg_alert\">Impossible de supprimer la catégorie les activités suivantes sont affectées à la catégorie: ";
						while ($data = $requete->fetch()){
							$msg.="<br/>".$data['CodeActivite']."  ".$data['NomActivite'];
						}
						$msg.="<br/>Veuillez affecter les activités à une autre catégorie.</div>";
					}
					else {
						$req = $bdd->prepare("DELETE FROM categorieactivite WHERE CodeCategorieActivite = :CodeCategorieActivite");
						$req->execute(array(
							'CodeCategorieActivite' => $num_categorie,
						));
						$msg = "<div class=\"msg_confirm\">La catégorie a bien été supprimé</div>";
					}
				}
			}
			elseif(isset($_POST['mod_categorie'])){
				if (empty($_POST['nom_categorie'])){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom à la catégorie!</div>";
				}
				elseif($_POST['id'] == -1){
					$msg = "<div class=\"msg_alert\">Il faut sélectionner une catégorie!</div>";
				}
				else{
					$nom_categorie = test_input($_POST['nom_categorie']);
					$id = test_input($_POST['id']);
					$req = $bdd->prepare('UPDATE categorieactivite SET NomCategorie = :NomCategorie WHERE CodeCategorieActivite = :CodeCategorieActivite');
					$req->execute(array(
						'NomCategorie' => $nom_categorie,
						'CodeCategorieActivite' => $id
					));
					$msg = "<div class=\"msg_confirm\">La catégorie a bien été modifiée!</div>";
				}
			}
			elseif(isset($_POST['add_dispositif'])){
				if (empty($_POST['nom_dispositif']) || (empty($_POST['id']) && $_POST['id'] != 0)){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id au dispositf!</div>";
				}
				else{
					$nom_dispositif = test_input($_POST['nom_dispositif']);
					$id = test_input($_POST['id']);
					/*On vérifie si l'id n'est pas déjà présent*/
					$requete = $bdd->query("SELECT COUNT(*) AS num FROM dispositif WHERE CodeDispositif = $id");
					$data = $requete->fetch();
					if($data['num']!= 0){
						$requete = $bdd->query("SELECT * FROM dispositif WHERE CodeDispositif = $id");
						$msg ="<div class=\"msg_alert\">Impossible de rajouter le dispositif l'id $id est déà affecté au dispositif ";
						$data = $requete->fetch();
						$msg.=$data['NomDispositif']." .</div>";
					}
					else{
					/*On insère le dispositif dans la bdd*/
						$req = $bdd->prepare("INSERT INTO dispositif (CodeDispositif,NomDispositif) VALUES (:CodeDispositif,:NomDispositif)");
						$req->execute(array(
							'CodeDispositif' => $id,
							'NomDispositif' => $nom_dispositif
						));
						$msg = "<div class=\"msg_confirm\">Le dispositif '$nom_dispositif' a bien été rajouté!</div>";
					}
					
				}
			}
			elseif(isset($_POST['add_compagnie'])){
				if (empty($_POST['nom_compagnie']) || (empty($_POST['id_compagnie']) && $_POST['id'] != 0) ){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id à la compagnie!</div>";
				}
				else{
					$nom_dispositif = test_input($_POST['nom_compagnie']);
					$id = test_input($_POST['id_compagnie']);
					/*On vérifie si l'id n'est pas déjà présent*/
					$requete = $bdd->query("SELECT COUNT(*) AS num FROM compagnie WHERE CodeCompagnie = $id");
					$data = $requete->fetch();
					if($data['num']!= 0){
						$requete = $bdd->query("SELECT * FROM compagnie WHERE CodeCompagnie = $id");
						$msg ="<div class=\"msg_alert\">Impossible de rajouter la compagnie l'id $id est déà affecté à la compagnie ";
						$data = $requete->fetch();
						$msg.=$data['NomCompagnie']." .</div>";
					}
					else{
					/*On insère la compagnie dans la bdd*/
						$req = $bdd->prepare("INSERT INTO compagnie (CodeCompagnie,NomCompagnie) VALUES (:CodeDispositif,:NomDispositif)");
						$req->execute(array(
							'CodeDispositif' => $id,
							'NomDispositif' => $nom_dispositif
						));
						$msg = "<div class=\"msg_confirm\">La compagnie '$nom_dispositif' a bien été rajouté!</div>";
					}
					
				}
			}
			elseif(isset($_POST['sup_dispositif'])){
				if (empty($_POST['id']) && $_POST['id'] != 0){
					$msg = "<div class=\"msg_alert\">Il faut sélectionner un dispositf!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					if ($id != -1){
						if (isset($_POST['reafecterDispositif'])){
							$id_new = $_POST['reafecterDispositif'];
							$req = $bdd->prepare('UPDATE occupation SET CodeDispositif = :CodeDispositif WHERE CodeDispositif = :CodeDispositifOld');
							$req->execute(array(
								'CodeDispositif' => $id_new,
								'CodeDispositifOld' => $id
							));					
						}
						$req = $bdd->prepare("DELETE FROM dispositif WHERE CodeDispositif = :CodeDispositif");
						$req->execute(array(
							'CodeDispositif' => $id
						));
						$msg = "<div class=\"msg_confirm\">Le dispositif a bien été supprimé</div>";
					}
					else{
						$msg = "<div class=\"msg_alert\">Il faut sélectionner un dispositf!</div>";
					}
				}
			}
			elseif(isset($_POST['sup_compagnie'])){
				if (empty($_POST['id']) && $_POST['id'] != 0){
					$msg = "<div class=\"msg_alert\">Il faut sélectionner une compagnie!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					if ($id != -1){
						if (isset($_POST['reafecterCompagnie'])){
							$id_new = $_POST['reafecterCompagnie'];
							$req = $bdd->prepare('UPDATE occupation SET CodeCompagnie = :CodeCompagnie WHERE CodeCompagnie = :CodeCompagnieOld');
							$req->execute(array(
								'CodeCompagnie' => $id_new,
								'CodeCompagnieOld' => $id
							));					
						}
						$req = $bdd->prepare("DELETE FROM compagnie WHERE CodeCompagnie = :CodeDispositif");
						$req->execute(array(
							'CodeDispositif' => $id
						));
						$msg = "<div class=\"msg_confirm\">La compagnie a bien été supprimé</div>";
					}
					else{
						$msg = "<div class=\"msg_alert\">Il faut sélectionner une compagnie!</div>";
					}
				}
			}
			elseif(isset($_POST['mod_dispositif'])){
				if ((empty($_POST['id']) || empty($_POST['nom_dispositif']) || $id == -1)&& $id!=0 ){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id au dispositif!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					$id_old = test_input($_POST['id_old']);
					$nom_dispositif = test_input($_POST['nom_dispositif']);
					if ($id == $id_old){
						/*L'id ne change pas*/
						$req = $bdd->prepare('UPDATE dispositif SET NomDispositif = :NomDispositif WHERE CodeDispositif = :CodeDispositif');
						$req->execute(array(
							'NomDispositif' => $nom_dispositif,
							'CodeDispositif' => $id
						));
						$msg = "<div class=\"msg_confirm\">Le dispositif a bien été modifiée!</div>";
					}
					else{
						/*L'id change, on vérifie si on n'écrase pas un autre dispositif*/
						$requete = $bdd->query("SELECT COUNT(*) AS num FROM dispositif WHERE CodeDispositif = $id");
						$data = $requete->fetch();
						if($data['num']!= 0){
							$requete = $bdd->query("SELECT * FROM dispositif WHERE CodeDispositif = $id");
							$msg ="<div class=\"msg_alert\">Impossible de rajouter le dispositif l'id $id est déà affecté au dispositif ";
							$data = $requete->fetch();
							$msg.=$data['NomDispositif']." .</div>";
						}
						else{
							$req = $bdd->prepare("INSERT INTO dispositif (NomDispositif,CodeDispositif) VALUES (:NomDispositif,:CodeDispositif)");
							$req->execute(array(
								'NomDispositif' => $nom_dispositif,
								'CodeDispositif' => $id
							));
						/*On modifie la table des occupations*/	
							$req = $bdd->prepare('UPDATE occupation SET CodeDispositif = :CodeDispositif WHERE CodeDispositif = :CodeDispositifOld');
							$req->execute(array(
								'CodeDispositifOld' => $id_old,
								'CodeDispositif' => $id
							));
							
							$req = $bdd->prepare("DELETE FROM dispositif WHERE CodeDispositif = :CodeDispositif");
							$req->execute(array(
								'CodeDispositif' => $id_old
							));
							
							$msg = "<div class=\"msg_confirm\">Le dispositif a bien été modifiée!</div>";
						}
						
					}
				}
			}
			elseif(isset($_POST['mod_compagnie'])){
				if ((empty($_POST['id']) || empty($_POST['nom_compagnie']) || $id == -1 ) && $_POST['id'] != 0){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id à la compagnie!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					$id_old = test_input($_POST['id_old']);
					$nom_dispositif = test_input($_POST['nom_compagnie']);
					if ($id == $id_old){
						/*L'id ne change pas*/
						$req = $bdd->prepare('UPDATE compagnie SET NomCompagnie = :NomDispositif WHERE CodeCompagnie = :CodeDispositif');
						$req->execute(array(
							'NomDispositif' => $nom_dispositif,
							'CodeDispositif' => $id
						));
						$msg = "<div class=\"msg_confirm\">La compagnie a bien été modifiée!</div>";
					}
					else{
						/*L'id change, on vérifie si on n'écrase pas un autre dispositif*/
						$requete = $bdd->query("SELECT COUNT(*) AS num FROM compagnie WHERE CodeCompagnie = $id");
						$data = $requete->fetch();
						if($data['num']!= 0){
							$requete = $bdd->query("SELECT * FROM compagnie WHERE CodeCompagnie = $id");
							$msg ="<div class=\"msg_alert\">Impossible de mettre à jour la compagnie l'id $id est déà affecté à la compagnie ";
							$data = $requete->fetch();
							$msg.=$data['NomCompagnie']." .</div>";
						}
						else{
							
							$req = $bdd->prepare("INSERT INTO compagnie (NomCompagnie,CodeCompagnie) VALUES (:NomDispositif,:CodeDispositif)");
							$req->execute(array(
								'NomDispositif' => $nom_dispositif,
								'CodeDispositif' => $id
							));
						/*On modifie la table des occupations*/	
							$req = $bdd->prepare('UPDATE occupation SET CodeCompagnie = :CodeDispositif WHERE CodeCompagnie = :CodeDispositifOld');
							$req->execute(array(
								'CodeDispositifOld' => $id_old,
								'CodeDispositif' => $id
							));
							
							$req = $bdd->prepare("DELETE FROM compagnie WHERE CodeCompagnie = :CodeDispositif");
							$req->execute(array(
								'CodeDispositif' => $id_old
							));
							
							
							$msg = "<div class=\"msg_confirm\">La compagnie a bien été modifiée!</div>";
						}
						
					}
				}
			}
			elseif(isset($_POST['add_lieu'])){
				if (empty($_POST['nom_lieu']) || (empty($_POST['id_lieu']) && $_POST['id_lieu'] != 0)){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id au lieu!</div>";
				}
				else{
					$nom_lieu = test_input($_POST['nom_lieu']);
					$id = test_input($_POST['id_lieu']);
					$cat = test_input($_POST['cat']);
					/*On vérifie si l'id n'est pas déjà présent*/
					$requete = $bdd->query("SELECT COUNT(*) AS num FROM lieu WHERE CodeLieux = $id");
					$data = $requete->fetch();
					if($data['num']!= 0){
						$requete = $bdd->query("SELECT * FROM lieu WHERE CodeLieux = $id");
						$msg ="<div class=\"msg_alert\">Impossible de rajouter le lieu l'id $id est déà affecté au lieu ";
						$data = $requete->fetch();
						$msg.=$data['NomLieux']." .</div>";
					}
					else{
					/*On insère le dispositif dans la bdd*/
						$req = $bdd->prepare("INSERT INTO lieu (CodeLieux,NomLieux,CodeCategorieLieux) VALUES (:CodeLieux,:NomLieux,:CodeCategorieLieux)");
						$req->execute(array(
							'CodeLieux' => $id,
							'NomLieux' => $nom_lieu,
							'CodeCategorieLieux' => $cat
						));
						$msg = "<div class=\"msg_confirm\">Le lieux '$nom_lieu' a bien été rajouté!</div>";
					}
					
				}
			}
			elseif(isset($_POST['sup_lieu'])){
				if (empty($_POST['id']) && $_POST['id'] != 0){
					$msg = "<div class=\"msg_alert\">Il faut sélectionner un lieu!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					if ($id != -1){
						if (isset($_POST['reafecterLieu'])){
							$id_new = $_POST['reafecterLieu'];
							$req = $bdd->prepare('UPDATE occupation SET CodeLieux = :CodeLieux WHERE CodeLieux = :CodeLieuxOld');
							$req->execute(array(
								'CodeLieux' => $id_new,
								'CodeLieuxOld' => $id
							));					
						}
						$req = $bdd->prepare("DELETE FROM lieu WHERE CodeLieux = :CodeLieux");
						$req->execute(array(
							'CodeLieux' => $id
						));
						$msg = "<div class=\"msg_confirm\">Le lieu a bien été supprimé</div>";
					}
					else{
						$msg = "<div class=\"msg_alert\">Il faut sélectionner un lieu!</div>";
					}
				}
			}
			elseif(isset($_POST['mod_lieu'])){
				if ((empty($_POST['id']) && $_POST['id'] != 0) || empty($_POST['nom_lieu']) || $id == -1){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id au lieu!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					$id_old = test_input($_POST['id_old']);
					$nom_lieu = test_input($_POST['nom_lieu']);
					if ($id == $id_old){
						/*L'id ne change pas*/
						$req = $bdd->prepare('UPDATE lieu SET NomLieux = :NomLieux WHERE CodeLieux = :CodeLieux');
						$req->execute(array(
							'NomLieux' => $nom_lieu,
							'CodeLieux' => $id
						));
						$msg = "<div class=\"msg_confirm\">Le lieu a bien été modifiée!</div>";
					}
					else{
						/*L'id change, on vérifie si on n'écrase pas un autre lieu*/
						$requete = $bdd->query("SELECT COUNT(*) AS num FROM lieu WHERE CodeLieux = $id");
						$data = $requete->fetch();
						if($data['num']!= 0){
							$requete = $bdd->query("SELECT * FROM lieu WHERE CodeLieux = $id");
							$msg ="<div class=\"msg_alert\">Impossible de modifier le lieu l'id $id est déà affecté au dispositif ";
							$data = $requete->fetch();
							$msg.=$data['NomLieux']." .</div>";
						}
						else{	
							$requete = $bdd->query("SELECT * FROM lieu WHERE CodeLieux = $id_old");
							$data = $requete->fetch();
						
							$req = $bdd->prepare("INSERT INTO lieu (NomLieux,CodeLieux,CodeCategorieLieux) VALUES (:NomDispositif,:CodeDispositif,:CodeCategorieLieux)");
							$req->execute(array(
								'NomDispositif' => $nom_lieu,
								'CodeDispositif' => $id,
								'CodeCategorieLieux' => $data['CodeCategorieLieux']
							));
						/*On modifie la table des occupations*/	
							$req = $bdd->prepare('UPDATE occupation SET CodeLieux = :CodeDispositif WHERE CodeLieux = :CodeDispositifOld');
							$req->execute(array(
								'CodeDispositifOld' => $id_old,
								'CodeDispositif' => $id
							));
							
							$req = $bdd->prepare("DELETE FROM lieu WHERE CodeLieux = :CodeDispositif");
							$req->execute(array(
								'CodeDispositif' => $id_old
							));
							
							$msg = "<div class=\"msg_confirm\">Le lieu a bien été modifiée!</div>";
						}			
					}
				}
			}
			elseif(isset($_POST['add_activite'])){
				if (empty($_POST['nom_activite']) || (empty($_POST['id']) && $_POST['id'])){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id à l'activité!</div>";
				}
				else{
					$nom_activite = test_input($_POST['nom_activite']);
					$id = test_input($_POST['id']);
					$cat = test_input($_POST['cat_activite']);
					$desc = nl2br(test_input($_POST['desc'])); 
					/*On vérifie si l'id n'est pas déjà présent*/
					$requete = $bdd->query("SELECT COUNT(*) AS num FROM activite WHERE CodeActivite = $id");
					$data = $requete->fetch();
					if($data['num']!= 0){
						$requete = $bdd->query("SELECT * FROM activite WHERE CodeActivite = $id");
						$msg ="<div class=\"msg_alert\">Impossible de rajouter l'activite l'id $id est déà affecté à l'activité ";
						$data = $requete->fetch();
						$msg.=$data['NomActivite']." .</div>";
					}
					else{
					/*On insère le dispositif dans la bdd*/
						$req = $bdd->prepare("INSERT INTO activite (CodeActivite,NomActivite,CodeCategorie,DescriptifActivite) VALUES (:CodeActivite,:NomActivite,:CodeCategorie,:DescriptifActivite)");
						$req->execute(array(
							'CodeActivite' => $id ,
							'NomActivite' => $nom_activite ,
							'CodeCategorie' => $cat ,
							'DescriptifActivite' => $desc
						));
						$msg = "<div class=\"msg_confirm\">L'activite '$nom_activite' a bien été rajouté!</div>";
					}
					
				}
			}
			elseif(isset($_POST['sup_activite'])){
				if (empty($_POST['id']) && $_POST['id'] != 0){
					$msg = "<div class=\"msg_alert\">Il faut sélectionner une activite!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					if ($id != -1){
						if (isset($_POST['reafecterActivite'])){
							$id_new = $_POST['reafecterActivite'];
							$req = $bdd->prepare('UPDATE occupation SET CodeActivite = :CodeActivite WHERE CodeActivite = :CodeActiviteOld');
							$req->execute(array(
								'CodeActivite' => $id_new,
								'CodeActiviteOld' => $id
							));					
						}
						$req = $bdd->prepare("DELETE FROM activite WHERE CodeActivite = :CodeActivite");
						$req->execute(array(
							'CodeActivite' => $id
						));
						$msg = "<div class=\"msg_confirm\">L'activite a bien été supprimé</div>";
					}
					else{
						$msg = "<div class=\"msg_alert\">Il faut sélectionner une activité!</div>";
					}
				}
			}
			elseif(isset($_POST['mod_activite'])){ 
				if ((empty($_POST['id']) && $_POST['id'] != 0) || empty($_POST['nom_act'])){
					$msg = "<div class=\"msg_alert\">Il faut donner un nom et un id à l'activité!</div>";
				}
				else{
					$id = test_input($_POST['id']);
					$id_old = test_input($_POST['id_old']);
					$nom_act = test_input($_POST['nom_act']);
					$descr = nl2br(test_input($_POST['descr_act']));
					$cat = test_input($_POST['cat_activite']);
					if ($id == $id_old){
						/*L'id ne change pas*/
						$req = $bdd->prepare('UPDATE activite SET NomActivite = :NomActivite, DescriptifActivite = :DescriptifActivite, CodeCategorie = :CodeCategorie WHERE CodeActivite = :CodeActivite');
						$req->execute(array(
							'NomActivite' => $nom_act,
							'DescriptifActivite' => $descr,
							'CodeCategorie' => $cat,
							'CodeActivite' => $id
						));
						$msg = "<div class=\"msg_confirm\">L'activité a bien été modifiée!</div>";
					}
					else{
						/*L'id change, on vérifie si on n'écrase pas un autre dispositif*/
						$requete = $bdd->query("SELECT COUNT(*) AS num FROM activite WHERE CodeActivite = $id");
						$data = $requete->fetch();
						if($data['num']!= 0){
							$requete = $bdd->query("SELECT * FROM activite WHERE CodeActivite = $id");
							$msg ="<div class=\"msg_alert\">Impossible de modifier l'activité l'id $id est déjà affecté à l'activité ";
							$data = $requete->fetch();
							$msg.=$data['NomActivite']." .</div>";
						}
						else{
							
							$req = $bdd->prepare("INSERT INTO activite (NomActivite,CodeActivite,DescriptifActivite,CodeCategorie) VALUES (:NomActivite,:CodeActivite,:DescriptifActivite,:CodeCategorie)");
							$req->execute(array(
								'NomActivite' => $nom_act,
								'CodeActivite' => $id,
								'DescriptifActivite' => $descr,
								'CodeCategorie' => $cat
							));
						/*On modifie la table des occupations*/	
							$req = $bdd->prepare('UPDATE occupation SET CodeActivite = :CodeDispositif WHERE CodeActivite = :CodeDispositifOld');
							$req->execute(array(
								'CodeDispositifOld' => $id_old,
								'CodeDispositif' => $id
							));
							
							$req = $bdd->prepare("DELETE FROM activite WHERE CodeActivite = :CodeDispositif");
							$req->execute(array(
								'CodeDispositif' => $id_old
							));
							
							
							$msg = "<div class=\"msg_confirm\">L'activité a bien été modifiée!</div>";
						}	
					}
				}
			}
		}
		echo $msg;
	}
	?>