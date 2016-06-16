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
		<h4>Extraire les données</h4>
		<a href="#" class="menu_aide">Récupérer les données</a>	
		<p>
			Pour récupérer les données allez dans l'onglet extraction des données.<br/>
			En cliquant sur les liens vous pouvez télécharger les données sous format csv ou xsl (Excel).<br/>
			Dans le fichier csv, les champs sont séparés par des point-virgules:  " ; ".
		</p>
		<br/> <a href="#" class="menu_aide">Obtenir les noms correspondants aux codes des données</a>
		<p>
			Pour récupérer les noms correspondant aux codes allez dans l'onglet extraction des données.<br/>
			Cliquez sur afficher les noms correspondants aux codes. <br/>
			Vous pouvez aussi télécharger cette liste en format texte en cliquant sur "Télécharger les noms correspondant aux codes". Pour modifier les codes correspondants aux noms modifiez les tables.
		</p>
		<br/>
		<h4>Carnet de bord</h4>
		<a href="#" class="menu_aide">Utiliser le carnet de bord</a>
		<p>
			Le carnet de bord permet de se laisser des messages entre chercheurs. Par exemple "Récupération des données le jeudi 12 mai 2017 pour procéder à l'analyse XY" ou "Rajout d'une activité Baignade avec le code 305 dans la catégorie Activités sportives Exercices physiques" <br/>
			Pour ajouter une nouvelle entrée dans le carnet de bord cliquez sur "Nouvelle entrée", renseignez les champs, puis cliquez sur "ajouter" pour sauvegarder la nouvelle entrée.<br/>
			Pour voir une entrée du tableau de bord cliquer sur l'icone de l'enveloppe ouverte.<br/>
			<br/>
			Vous pouvez modifier et supprimer les entrées en cliquant sur les icônes correspondant à ces actions.
		</p>
		<br/>
		<h4>Messagerie</h4>
		<a href="#" class="menu_aide">Utiliser la messagerie</a>
		<p>
			Les étudiants peuvent vous contacter via la messagerie s'ils ont des remarques sur certaines activités/catégories d'activités. <br/>
			Vous recevrez aussi un e-mail sur l'adresse e-mail qui est défini dans votre compte pour signaler tout nouveau message reçu par cette messagerie.<br/>
		</p>
		<br/> <a href="#" class="menu_aide">Contacter un administrateur</a>
		<p>
			Pour contacter un administrateur, allez dans l'onglet "Messages", puis sur "Contacter un administrateur".
		</p>
		<br/> <a href="#" class="menu_aide">Quand avez-vous besoin de contacter un administrateur ? </a>
		<p>
			Dans le cas où vous auriez des remarques ou suggestions à faire concernant le fonctionnement du site lui-même, ou si vous constatez un bug.
		</p>
		<br/> <a href="#" class="menu_aide">Quand et comment allez-vous recevoir votre réponse?  </a>
		<p>
			L'administrateur vous répondra par le biais de la messagerie du site. Vous recevrez un e-mail sur l'adresse renseignée pour vous signaler l'arrivée de ce nouveau message. Pour l'ouvrir, cliquez sur l'icone de l'enveloppe ouverte.
		</p>
		<br/>
		<h4>Modifier les tables</h4>
		<a href="#" class="menu_aide">Modifier les tables</a>
		<p>
			Vous pouvez modifier les tables, c'est-à-dire ajouter/supprimer/renommer une activité, un lieu, un dispositif ou encore une compagnie.<br/>
			Cliquez sur un des sous-menus du menu "Tables" pour modifier la table correspondante.<br/>
			Si vous souhaitez supprimer un élément, il vous sera proposé de réaffecter les occupations dans lesquelles cet élément apparaît afin de préserver l'intégrité des données. Attention cependant : la réaffectation des données est définitive. Aucun retour en arrière n'est possible une fois la réaffectation validée.<br/>
			Il est également possible de supprimer toutes les occupations où apparaît un élément que vous souhaitez supprimer. Cette option vous sera proposée lors de la tentative de suppression de cet élément.
		</p>
		<br/>
		<h4>Compte</h4>
		<a href="#" class="menu_aide">Voir et changer ses informations personnelles</a>
		<p>
			Pour voir et changer ses informations personnelles que vous avez rentré lors de votre première connexion allez dans l'onglet "Informations Personnelles", là vous pouvez modifier votre nom et votre prénom.<br/>
			Cliquez sur Modifier pour enregistrer vos modifications.
		</p>
		<br/> <a href="#" class="menu_aide">Changer son login</a>
		<p>
			Pour changer votre login, allez dans l'onglet "Mon compte", rentrez une nouveau login, puis cliquez sur Modifier pour enregistrer vos modifications.
		</p>
		<br/> <a href="#" class="menu_aide">Changer son mot de passe</a>
		<p>
			Pour changer votre mot de passe, allez dans l'onglet "Mon compte", rentrez une nouveau mot de passe, confirmez votre mot de passe, puis cliquez sur Modifier pour enregistrer vos modifications.
		</p>
		<br/> <a href="#" class="menu_aide">Changer son adresse e-mail</a>
		<p>
			Pour changer votre adresse e-mail, allez dans l'onglet "Mon compte", rentrez une nouvelle adresse e-mail, puis cliquez sur Modifier pour enregistrer vos modifications.
		</p>
		<br/> <a href="#" class="menu_aide">Supprimer son compte</a>
		<p>
			Pour supprimer votre compte, contactez l'administrateur.
		</p>
	</div>
</div>
