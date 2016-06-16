<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('administrateur');
?>
<div class="actualites index large-12 medium-11 columns content">
	<h4>Configuration de la messagerie</h4>
	<div class="text">
		Attention! un redémarrage serveur est nécessaire pour que les modifications soient prises en compte.<br/>
		<strong>Les données entrées ici doivent être modifiées en externe avant toute modification sur ce site.
		<br/>Les champs ci-dessous permettent de configurer le site pour se connecter a la messagerie externe, et non l'inverse.</strong>
	</div>
	<br/>
	<form action="/administrateur/messagerie" accept-charset="utf-8" method="post">
		<div class="input email required">
			<label for="email">E-mail de l'application</label>
			<input id="name_email" type="text" value="<?php echo $name_email; ?>" maxlength="255" required="required" name="name_email" placeholder="Exemple : noreply@monAppli.com">
		</div>
		<div class="input email required">
			<label for="email">Serveur de messagerie</label>
			<input id="host" type="text" class="" value="<?php echo $host; ?>" maxlength="255" required="required" name="host" placeholder="Exemple : smtp.gmail.com">
		</div>
		<div class="input email required">
			<label for="email">Nom d'utilisateur'</label>
			<input id="username" type="text" value="<?php echo $username; ?>" maxlength="255" required="required" name="username" placeholder="Login">
		</div>
		<div class="input email required">
			<label for="email">Mot de passe</label>
			<input id="password" type="text" value="<?php echo $password; ?>" maxlength="255" required="required" name="password" placeholder="Mots de passe">
		</div>
		<div class="input email required">
			<label for="email">Port</label>
			<input id="port" type="text" value="<?php echo $port; ?>" maxlength="255" required="required" name="port" placeholder="Exemple : 587">
		</div>
		<div class="input email required">
			<label for="secure">Sécurité</label>
			<div class="buttonradio">
				<input type="radio" name="secure" value="tls" <?php if($secure == 'tls'){echo 'checked';}?> >TLS<br>
		  		<input type="radio" name="secure" value="ssl" <?php if($secure == 'ssl'){echo 'checked';}?> >SSL<br>
		  		<input type="radio" name="secure" value="none" <?php if($secure == 'none'){echo 'checked';}?> >Aucune<br>
		  	</div>
		</div>
		<button class="submit" type="submit">Modifier</button>
	</form>
</div>