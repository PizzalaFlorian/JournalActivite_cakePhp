<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('main_custom');
	echo $this->Html->css('administrateur');
	echo $this->Html->script('administrateur.js');
?>
<div id="content">
<h3 class="center">Aide</h3>
	<h4>Gestion des actualités</h4>
	<h4>Gestion du site web</h4>
	<h4>Gestion des utilisateurs</h4>
	<h4>Gestion des candidats web</h4>
	<h4>Gestion des chercheurs</h4>
	<h4>gestion des administrateurs</h4>	
	<div>
		<h4>Suppression des données</h4>	
		<div class="aide">
			La page 'Suppression des données' permet à l'administrateur de supprimer partielement ou totalement les données enregistrés des candidats.
			<div class='titre5'>Suppression des données 'Candidats' de la base de données</div>
				La suppression des données candidats permet de vider toutes les occupations entrés par les candidats tout en gardant leurs comptes inscrit dans la base de données.<br/>
				Données supprimées :<br/>
				<ul>
					<li>données liées aux activités des candidats</li>
				</ul>
				Données conservées :
				<ul>
					<li>Données des Comptes Candidats/Chercheurs/Administrateurs</li>
					<li>Catégorie Activités/Lieux</li>
					<li>Activités/Lieux/Dispositifs/Compagnie</li>
					<li>Tous les messages envoyées</li>
					<li>Carnet de bord</li>
					<li>Actualités</li>
				</ul>
			<div class='titre5'>Suppression des Comptes Candidats</div>
				La suppression des Comptes Candidats permet de supprimer toutes les occupations, ainsi que toutes les informations liés au compte des candidats.<br/>
				Données supprimées :<br/>
				<ul>
					<li>données liées aux activités des candidats</li>
					<li>Tous les messages envoyées</li>
					<li>Données des Comptes Candidats</li>
				</ul>
				Données conservées :
				<ul>
					<li>Données des Comptes Chercheurs/Administrateurs</li>
					<li>Catégorie Activités/Lieux</li>
					<li>Activités/Lieux/Dispositifs/Compagnie</li>
					<li>Carnet de bord</li>
					<li>Actualités</li>
				</ul>
		</div>
	</div>	
	<h4>Configuration Messagerie</h4>	
		<div class="aide">
			<img> - image de gestion de messagerie - </img><br/>
			La page 'Configuration de la Messagerie' permet de connecter l'application a un compte d'une messagerie afin que celle-ci puisse envoyer des emails aux utilisateurs de l'application.<br/>
			Cas d'envoie d'emails : <br/>
			<ul>
				<li>Création d'un compte</li>
				<li>Envoie d'un Email aux chercheurs lors de la reception d'un message de la part d'un candidat</li>
				<li>Envoie d'un Email aux administrateurs lors d'une demande de 'contacts'.
			</ul>	
			Pour cela, l'application a besoin de connaitre les information concernant la messagerie, par exemple :<br/>
			<ul>
				<li>Le nom de l'Email de l'application (par exemple : noreply.monappli@.com)</li>
				<li>un identifiant, afin de pouvoir se connecter au serveur mail (les emails seront envoyés à partir de cette identifiant, sous le nom d'email noreply@monappli.com)</li>
				<li>Le mots de passe de l'identifiant saisie ci-dessus</li>
				<li>Le nom du serveur de messagerie (par exemple : smtp.gmail.com pour une adresse gmail)</li>
				<li>Le chiffrement utilisé par le serveur mail (SSL ou TLS)</li>
			</ul>
			Attention! Pour prendre en compte les modifications, vous devrez redémarer le serveur. "A CONFIRMER"
		</div>	
	<h4>Mon Compte</h4>	
</div>