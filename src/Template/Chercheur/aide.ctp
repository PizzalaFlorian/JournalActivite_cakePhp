<?php
	echo $this->element('sidebarChercheur');
	echo $this->Html->css('main_custom');
	echo $this->Html->script('aide.js');
?>

<div id="content">
	<div class="inner">
		<center>
			<a><h1>Aide</h1></a>
		</center>
		<br/> <a href="#" class="menu_aide">Récupérer les données</a>	
		<p>
			Pour récupérer les données allez dans l'onglet extraction des données.<br/>
			En cliquant sur les liens vous pouvez télécharger les données sous format csv ou xsl (Excel).<br/>
			Dans le fichier csv les champs sont séparés par des point-virgules: ; .
		</p>
		<br/> <a href="#" class="menu_aide">Obtenir les noms correspondants aux codes des données</a>	
		<p>
			Pour récupérer les noms correspondant aux codes allez dans l'onglet extraction des données.<br/>
			Cliquer sur afficher les noms correspondants aux codes. <br/>
			Vous pouvez aussi télécharger cette liste en format texte en cliquant sur "Télécharger les noms correspondant aux codes". <br/>
			pour modifier les codes correspondants aux noms modifiez les tables.
		</p>
		<br/> <a href="#" class="menu_aide">Utiliser le carnet de bord</a>
		<p>
			Le carnet de bord permet de se laisser des messages entre chercheurs. Par exemple "Récupération des données le jeudi 12 mai 2017 pour procéder à l'analyse XY ou rajout d'une activité 
			Baignade avec le code 305 dans la catégorie Activités sportives Exercices physiques" <br/>
			Pour ajouter une nouvelle entré dans le carnet de bord cliquer sur "Nouvelle entrée", renseignez les champs, puis cliquez sur "ajouter" pour sauvegarder la nouvelle entré.<br/>
			Pour voir une entré du tableau de bord cliquer sur l'icone de l'enveloppe ouverte.<br/>
			Vous pouvez modifier et supprimer les entrés en cliquant sur les iconnes correspondant à ces actions.
		</p>
		<br/> <a href="#" class="menu_aide">Utiliser la messagerie</a>
		<p>
			Les étudiants peuvent vous contacter via la messagerie si ils ont des remarques sur certaines activités/catégories d'activités. <br/>
			Vous recevrez aussi un e-mail sur l'adresse e-mail qui est défini dans votre compte.<br/>
			La messagerie fonctionne comme une messagerie classique, si vous ne savez pas comment l'utiliser nous vous invitons à consulter cette page: 
			<a href="https://fr.wikipedia.org/wiki/Courrier_%C3%A9lectronique" target="_blank">Wikipedia</a>
		</p>
		<br/> <a href="#" class="menu_aide">Modifier les tables</a>
		<p>
			Vous pouvez modifier les tables, c'est à dire ajouter/supprimer/renommer une activité, un lieu, un dispositif, une compagnie.<br/>
			Cliquez sur un des sous-menus du menu "Tables" pour modifier la table.<br/>
			Si il y a des étudiants qui on déjà renseigné des occupations avec un des éléments de la table que vous voulez supprimer on vous demandera de réafecter ces occupations pour garder l'intégrité des données.<br/>
			Si vous avez faits de grosses bétises contactez l'administrateur, avec un peu de chance il aura une solution à votre problème.<br/>
		</p>
		<br/> <a href="#" class="menu_aide">Voir et changer ses informations personnelles</a>
		<p>
			Pour voir et changer ses informations personnelles que vous avez rentré lors de votre première connexion allez dans l'onglet "Informations Personnelles", là vous pouvez modifier votre nom et votre prénom.
			Cliquez sur submit pour enregistrer vos modifications.
		</p>
		<br/> <a href="#" class="menu_aide">Changer son login</a>
		<p>
			Pour changer votre login allez dans l'onglet "Mon compte", rentrez une nouveau login, puis cliquez sur submit pour enregistrer vos modifications.
		</p>
		<br/> <a href="#" class="menu_aide">Changer son mot de passe</a>
		<p>
			Pour changer votre mot de passe allez dans l'onglet "Mon compte", rentrez une nouveau mot de passe, confirmez votre mot de passe, puis cliquez sur submit pour enregistrer vos modifications.
		</p>
		<br/><a href="#" class="menu_aide">Changer son adresse e-mail</a>
		<p>
			Pour changer votre adresse e-mail allez dans l'onglet "Mon compte", rentrez une nouvelle adresse e-mail, puis cliquez sur submit pour enregistrer vos modifications.
		</p>
		<br/><a href="#" class="menu_aide">Supprimer son compte</a>
		<p>
			Pour supprimer votre compte contactez l'administrateur.
		</p>
		<br/><a href="#" class="menu_aide">Contacter un administrateur</a>
		<p>
			Pour contacter un administrateur allez dans l'onglet "Messages", puis sur "Contacter un administrateur".<br/>
			Quand avez-vous besoin de contacter un administrateur sytème? <br/>
			Si vous avez des remarques à faire sur le fonctionnement du site, si vous constatez des bugs.
			Quand et comment allez-vous recevoir votre réponse? <br/>
			Quand l'administrateur vous aura répondu vous aurez un nouveau message dans l'onglet "Messages", pour l'ouvrir cliquez sur l'icone de l'enveloppe ouverte, l'administrateur n'étant pas toujours 
			disponible il peut mettre un certain temps à vous répondre. Soyez patients.
		</p>
	
	</div>
</div>
