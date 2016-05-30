<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('administrateur');
?>
<div class="actualites index large-12 medium-11 columns content">
	<h4>Configuration de la messagerie</h4>
	<div class="input email required">
		<label for="email">Nom de l'Email de l'application</label>
		<input id="email" type="email" value="" maxlength="255" required="required" name="email" placeholder="Exemple : noreply@monAppli.com">
	</div>
	<div class="input email required">
		<label for="email">Serveur de messagerie</label>
		<input id="email" type="email" class="test" value="" maxlength="255" required="required" name="email" placeholder="Exemple : smtp.gmail.com">
	</div>
	<div class="input email required">
		<label for="email">Mots de passe</label>
		<input id="email" type="email" value="" maxlength="255" required="required" name="email">
	</div>
	<div class="input email required">
		<label for="email">Port</label>
		<input id="email" type="email" value="" maxlength="255" required="required" name="email" placeholder="Exemple : 587">
	</div>
</div>