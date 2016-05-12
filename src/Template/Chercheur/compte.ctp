<!-- Content -->
<div id="content">
	<div class="inner">
		<?php include('../modele/chercheurMonCompte.modele.php');?>
		
		<center>
			<a><h1>Le compte de <?php echo nomChercheur($bdd);?></h1></a>
		</center>
		
		<h2>Adresse e-mail : </h2><?php echo mailChercheur($bdd);?> <br/><a href="#" class="all_m_l"> Modifier mon e-mail</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez votre nouveau e-mail:</label>
			<input type="email" name="mail" required/>
			<input type="submit" name="mod_mail" value="Modifier"/>
		</form>
		</div>
		<h2>Mot de passe : </h2>
		<a href="#" class="all_m_l">Modifier mon mot de passe</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8" id="passForm">
			<label>Entrez votre ancien mot de passe:</label>
			<input type="password" name="old_mdp" required/>
			<label>Entrez votre nouveau mot de passe:</label>
			<input type="password" name="mdp" required id="mdp"/>
			<label>Confirmez votre nouveau mot de passe:</label>
			<input type="password" name="new_mdp" required id="new_mdp"/>
			<input type="submit" name="mod_mdp" value="Modifier"/>
		</form>
		</div>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
		<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
		<script>
		$("#passForm").validate({
		  rules: {
			mdp: "required",
			new_mdp: {
			  equalTo: "#mdp"
			}
		  }
		});

		</script>
	
	
	
		<h2> Nom :</h2>
		Nom: <?php echo nomChercheur($bdd);?> <br/><a href="#" class="all_m_l">Modifier mon nom</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez votre Nom: </label>
			<input type="text" name="nom" required value="<?php echo nomFamilleChercheur($bdd);?>"/>
			<label>Entrez votre Prénom:</label>
			<input type="text" name="prenom" required value="<?php echo prenomChercheur($bdd);?>"/>
			<input type="submit" name="mod_nom" value="Modifier"/>
		</form>
		</div>
		<h2>Login :</h2>
		Login: <?php echo loginChercheur($bdd);?> <br/><a href="#" class="all_m_l">Modifier mon login</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez votre nouveau login: </label>
			<input type="text" name="login" required value="<?php echo loginChercheur($bdd);?>"/>
			<label>Confirmez votre mot de passe:</label>
			<input type="password" name="mdp" required/>
			<input type="submit" name="mod_login" value="Modifier"/>
		</form>
		</div>
		<h2>Suppression du compte :</h2>
		<a href="#" class="all_m_l">Supprimer mon compte</a>
		<div class="all_m">
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<div class="msg_alert">Attention cette action est irréversible!</div>
				<label>Confirmez votre mot de passe:</label>
				<input type="password" name="mdp" required/>
				<input type="submit" name="sup_compte" value="Supprimer mon compte"/>
			</form>
		</div>
	</div>
</div>