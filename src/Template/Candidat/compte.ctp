<!-- Content -->
<div id="content">
	<div class="inner">
		<?php include('../modele/candidatMonCompte.modele.php');?>	
		<center>
			<a><h1>Mon compte</h1></a>
		</center>
		<strong>Adresse e-mail : </strong><?php echo mailChercheur($bdd);?> <br/><a href="#" class="all_m_l"> Modifier mon e-mail</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez votre nouveau e-mail:</label>
			<input type="email" name="mail" required/>
			<input type="submit" name="mod_mail" value="Modifier"/>
		</form>
		</div>
		<br/><strong>Mot de passe : </strong><br/>
		<a href="#" class="all_m_l">Modifier mon mot de passe</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8" class="cmxform" id ="passForm" >
			<label>Entrez votre ancien mot de passe:</label>
			<input type="password" name="old_mdp" required/>
			<label>Entrez votre nouveau mot de passe:</label>
			<input type="password" name="mdp" id="mdp" required/>
			<label>Confirmez votre nouveau mot de passe:</label>
			<input type="password" name="new_mdp" id="new_mdp" required/>
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
		<br/><strong>Login :</strong>
		<?php echo loginChercheur($bdd);?> <br/><a href="#" class="all_m_l">Modifier mon login</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez votre nouveau login: </label>
			<input type="text" name="login" required value="<?php echo loginChercheur($bdd);?>"/>
			<label>Confirmez votre mot de passe:</label>
			<input type="password" name="mdp" required/>
			<input type="submit" name="mod_login" value="Modifier"/>
		</form>
		</div>
		<br/><strong>Age :</strong>
		<?php echo ageCandidat($bdd);?> <br/><a href="#" class="all_m_l">Modifier mon age</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez votre age:</label>
			<input type="number" name="age" required value="<?php echo ageCandidat($bdd);?>"/>
			<input type="submit" name="mod_age" value="Modifier"/>
		</form>
		</div>
		<br/><strong>Niveau d'étude: </strong><?php echo diplomeCandidat($bdd);?> <br/><a href="#" class="all_m_l">Modifier le niveau d'étude</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Sélectionnez le niveau d'étude:</label>
			<select name="dip">
				<option value="Bac +1">Bac +1</option>
				<option value="Bac +2">Bac +2</option>
				<option value="Bac +3">Bac +3</option>
				<option value="Bac +4">Bac +4</option>
				<option value="Bac +5">Bac +5</option>
				<option value="Bac +6">Bac +6</option>
				<option value="Bac +7">Bac +7</option>
				<option value="Bac +8">Bac +8</option>
			</select>
			<input type="submit" name="mod_dip" value="Modifier"/>
		</form>
		</div>
		<br/><strong>Diplôme préparé: </strong><?php echo nivCandidat($bdd);?> <br/><a href="#" class="all_m_l">Modifier le diplôme préparé</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Sélectionnez le diplôme:</label>
			<select name="dip">
				<option value="Licence">Licence</option>
				<option value="Master">Master</option>
				<option value="Doctorat">Doctorat</option>
				<option value="BTS">BTS</option>
				<option value="DUT">DUT</option>
				<option value="Diplôme d'ingénieur">Diplôme d'ingénieur</option>
				<option value="Diplôme médical et paramédical">Diplôme médical et paramédical</option>
				<option value="Autre diplôme">Autre diplôme </option>
			</select>
			<input type="submit" name="mod_niv" value="Modifier"/>
		</form>
		</div>
		<br/><strong>État civil :</strong><?php echo etatCandidat($bdd);?> <br/><a href="#" class="all_m_l">Modifier l'état civil</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Sélectionnez votre état civil:</label>
			<select name="civ">
				<option value="Marié(e)">Marié(e)</option>
				<option value="Pacsé(e)">Pacsé(e)</option>
				<option value="Non marié(e) avec partenaire stable">Non marié(e) avec partenaire stable</option>
				<option value="Non marié(e) sans partenaire stable">Non marié(e) sans partenaire stable</option>
				<option value="Veuve, veuf">Veuve, veuf</option>
				<option value="Divorcé">Divorcé</option>
			</select>
			<input type="submit" name="mod_civ" value="Modifier"/>
		</form>
		</div>
		<br/><strong>Nombre d'enfants: </strong><?php echo enfantCandidat($bdd);?> <br/><a href="#" class="all_m_l">Modifier le nombre d'enfants</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez le nombre d'enfants:</label>
			<input type="number" name="nb" required value="<?php echo enfantCandidat($bdd);?>"/>
			<input type="submit" name="mod_enf" value="Modifier"/>
		</form>
		</div>
		<br/><strong>Lieux d'étude: </strong><?php echo lieuCandidat($bdd);?> <br/><a href="#" class="all_m_l">Modifier le lieu d'étude</a>
		<div class="all_m">
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
			<label>Entrez votre lieu d'étude:</label>
			<input type="text" name="lieu" required value="<?php echo lieuCandidat($bdd);?>"/>
			<input type="submit" name="mod_lieu" value="Modifier"/>
		</form>
		</div>
		<br/><strong>Suppression du compte :</strong><br/>
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
