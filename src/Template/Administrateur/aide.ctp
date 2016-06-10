<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('main_custom');
	echo $this->Html->script('jquery-1.7.min');
	echo $this->Html->script('aide.js');
	echo $this->Html->css('administrateur');
?>
<div id="content">

<div id="content">
	<div class="inner">
		<center>
			<a><h1>Aide</h1></a>
		</center>
		<h4>Gestion des actualités</h4>
		<br/> <a href="#" class="menu_aide">Gestion des actualités</a>	
		<p >
			Une liste d’actualités est affichés sur la page d’accueil des utilisateurs, afin de les tenir au courant des nouvelles ou d’autre information importantes. les actualités ne peuvent être écrites par des chercheurs ou des administrateurs.
		</p>
		<br/> <a href="#" class="menu_aide">Créer une actualité</a>	
		<p >
			Pour créer une actualité, allez dans sur votre page d’accueil, puis cliquez sur le bouton ‘créer une actualité’. Un sujet et un contenu vous sera demandé. Cliquez ensuite sur le bouton ‘envoyer’ pour la diffuser.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier une actualité</a>	
		<p >
			Pour modifier une actualité, allez sur votre page d’accueil. A droite de chacune des actualités présente dans la liste, se trouve deux icônes, l’un composé de deux outils, et l’autre d’une corbeille. Cliquez sur d'icône en forme d’outil pour visualise ou modifier l’actualité.<br/>
			Vous accéderez a une interface permettant de modifier l’actualité. Cliquez sur ‘Envoyer’ une fois vos modification terminé.
		</p>
		<br/> <a href="#" class="menu_aide">Supprimer une actualité</a>	
		<p >
			Pour supprimer une actualité, allez sur votre page d’accueil. A droite de chacune des actualités présente dans la liste, se trouve deux icônes, l’un composé de deux outils, et l’autre d’une corbeille. Cliquez sur d'icône en forme de corbeille pour supprimer une actualité.
		</p>
		<h4>Gestion du site web</h4>

		<br/> <a href="#" class="menu_aide">Gestion du site web</a>	
		<p >
			La page gestion du site web permet a l’administrateur de modifier certain messages affichés, envoyés aux utilisateurs.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le but de l'expérience</a>	
		<p >
			Pour modifier le texte de but de l'expérience, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le texte rappelant le but de l'expérience’. vous accéderai a une interface vous permettant de modifier le but de l’expérience afficher au candidat. Cliquez sur ‘Envoyer’ une fois vos modification terminé.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le message envoyé lors de l’invitation d’un candidat</a>	
		<p >
			Pour modifier le corps de l’email envoyer a un candidat pour l’inviter a utiliser l’application, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp de l'email automatique pour l'invitation des candidats’. Vous accéderai a une interface vous permettant de modifier le message envoyé par mail aux candidats leur transmettant login et mots de passe afin qu’il puisse se connecter a l'application. Cliquez sur ‘Envoyer’ une fois vos modification terminé.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le message envoyé lors de l’invitation d’un chercheur</a>	
		<p >
			Pour modifier le corps de l’email envoyer a un chercheur pour l’inviter a utiliser l’application,  allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp de l'email automatique pour l'invitation des chercheurs’. Vous accéderai a une interface vous permettant de modifier le message envoyé par mail aux chercheurs leur transmettant login et mots de passe afin qu’il puisse se connecter a l'application. Cliquez sur ‘Envoyer’ une fois vos modification terminé.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le message informant la collecte ou traite des données personnelles</a>	
		<p >
			Ce message est affiché aux candidats lors de leurs premières connexions et leur bloque l'accès tant que celui n’est pas validé.<br/>
			Pour modifier ce texte, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp du message informant aux utilisateurs, que l'application collecte ou traite des données personnelles’. Vous accéderai a une interface vous permettant de modifier ce message. Cliquez sur ‘Envoyer’ une fois vos modification terminé.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le informant les utilisateurs de leurs droit d'opposition aux données les concernant</a>	
		<p >
			Ce message est affiché aux candidats sur la page ‘Supprimer mon compte’  les informant qu'ils disposent d'un droit de rétractation à l'étude, ainsi que le droit de supprimer toute leurs données.<br/>
			Pour modifier ce texte, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp du message de droit d'opposition à ce que les données concernant un utilisateur soient utilisées’. Vous accéderai a une interface vous permettant de modifier ce message. Cliquez sur ‘Envoyer’ une fois vos modification terminé.
		</p>
		<h4>Gestion des utilisateurs</h4>
		<br/> <a href="#" class="menu_aide">Gestion des utilisateurs</a>	
		<p >
			La page Gestion des utilisateurs référence tout les utilisateurs inscrit dans la base de données ('candidats' / 'chercheurs' / 'administrateurs'). Pour chaque utilisateurs, l'administrateur à la possibilité de modifier, supprimer le compte de l'utilisateur.
		</p>
		<br/> <a href="#" class="menu_aide">Gestion des Candidats</a>	
		<p >
			La page Gestion des candidats référence tout les candidats inscrit dans la base de données. Pour chaque candidats, l'administrateur à la possibilité de modifier, supprimer leurs profils.
		</p>
		<br/> <a href="#" class="menu_aide">Gestion des Chercheurs</a>	
		<p >
			La page Gestion des chercheurs référence tout les chercheurs inscrit dans la base de données. Pour chaque chercheurs, l'administrateur à la possibilité de modifier, supprimer leurs profils.  
		</p>
		<br/> <a href="#" class="menu_aide">Gestion des Administrateurs</a>	
		<p >
			La page Gestion des administrateurs référence tout les administrateurs inscrit dans la base de données. Pour chaque administrateurs, l'administrateur à la possibilité de supprimer les compte et profil.  
		</p>
		<br/> <a href="#" class="menu_aide">Inviter un Candidat</a>	
		<p >
			Pour inviter un candidat, allez sur la page ‘Gestion Candidat’ et cliquez sur le bouton ‘Inviter un Candidat’.  L’adresse Email du candidat a inviter vous sera demandé. L’application enverra un email au candidat contenant un message d’invitation définit sur la page ‘Gestion du site web’, ainsi qu’un login, un mots de passe et l’adresse du site afin que l’utilisateur puisse se connecter. 
		</p>
		<br/> <a href="#" class="menu_aide">Inviter une liste de Candidats</a>	
		<p >
			Pour inviter plusieurs candidats, allez sur la page ‘Gestion Candidat’ et cliquez sur le bouton ‘Inviter une liste de Candidats’. Vous pourrez choisir de copier/coller une liste d’email séparer par un point-virgule, ou bien de sélectionner un fichier avec le bouton parcourir. Une fois valider, l’application enverra a chaque adresse de la liste un email contenant un message d’invitation définit sur la page ‘Gestion du site web’, ainsi qu’un login, un mots de passe et l’adresse du site afin que les utilisateurs puissent se connecter.  
		</p>
		<br/> <a href="#" class="menu_aide">Inviter un Chercheur</a>	
		<p >
			Pour inviter un chercheur, allez sur la page ‘Gestion Chercheur’ et cliquez sur le bouton ‘Inviter un Chercheur’. L’adresse Email du chercheur a inviter vous sera demandé. L’application enverra un email au chercheur contenant un message d’invitation définit sur la page ‘Gestion du site web’, ainsi qu’un login, un mots de passe et l’adresse du site afin que celui-ci puisse se connecter.
		</p>
		<br/> <a href="#" class="menu_aide">Inviter un Administrateur</a>	
		<p >
			Pour inviter un administrateur, allez sur la page ‘Gestion Administrateur’ et cliquez sur le bouton ‘Inviter un Administrateur’. L’adresse Email de l’administrateur a inviter vous sera demandé. L’application enverra un email a l’administrateur contenant un message d’invitation définit sur la page ‘Gestion du site web’, ainsi qu’un login, un mots de passe et l’adresse du site afin que celui-ci puisse se connecter.
		</p>
		<h4>Gestion des données</h4>
		<br/> <a href="#" class="menu_aide">Gestion des données</a>	
		<p >
			La page Gestion des données permet à l'administrateur de supprimer partiellement ou totalement les données enregistrés des candidats.
		</p>
		<br/> <a href="#" class="menu_aide">Supprimer les données des Candidats de la base de données</a>	
		<p >
			Cette action permet de supprimer toutes les occupation entrés par les Candidats.
			
			Données supprimées :
			
				Données liées aux activités des candidats
			
			
			Données conservées :
			
				Données des Comptes Candidats/Chercheurs/Administrateurs
				Catégorie Activités/Lieux
				Activités/Lieux/Dispositifs/Compagnie
				Tous les messages envoyées
				Carnet de bord
				Actualités
			
			Pour supprimer les occupation des candidat, allez sur la page ‘Gestion des données’ et cliquez sur le bouton ‘Supprimer les données entrées par les Candidats’.
			Attention : Une fois lancé, cette action est irréversible.
		</p>
		<br/> <a href="#" class="menu_aide">Suppression des comptes Candidats</a>	
		<p >
			Cette action permet de supprimer toutes les informations entré par les Candidats ainsi que leurs comptes.<br/>
			Données supprimées :         
			Données liées aux activités des candidats
			Tous les messages envoyées
			Données des Comptes Candidats

			Données conservées :         
			Données des Comptes Chercheurs/Administrateurs
			Catégorie Activités/Lieux
			Activités/Lieux/Dispositifs/Compagnie
			Carnet de bord
			Actualités

			Pour supprimer toutes les informations des Candidats, allez sur la page ‘Gestion des données’ et cliquez sur le bouton ‘Supprimer les comptes candidats ainsi que leurs données’. 

			Attention : Une fois lancé, cette action est irréversible.
		</p>
		<h4>Messagerie</h4>
		<br/> <a href="#" class="menu_aide">Configurer la messagerie de l’application</a>	
		<p>
			La page Configuration de la messagerie permet de connecter l'application au compte d'une messagerie afin que celle-ci puisse envoyer des emails aux utilisateurs de l'application.<br/>
			<br/>
			Cas d'envoi d'email :<br/>
			<ul>
				<li>Création d'un compte</li>
				<li>Envoi d'un Email aux chercheurs lors de la réception d'un message de la part d'un candidat</li>
				<li>Envoi d'un Email aux administrateurs lors d'une demande de 'contacts'.</li>     
			</ul>
			Pour cela, l'application a besoin de connaître les informations concernant la messagerie, par exemple :<br/>
			Le nom de l'Email de l'application (par exemple : noreply.monappli@.com)
			<ul>
				<li>Le nom du serveur de messagerie (par exemple : smtp.gmail.com pour une adresse Gmail)</li>
				<li>Un identifiant, afin de pouvoir se connecter au serveur mail (les emails seront envoyés à partir de cette identifiant, sous le nom d'email noreply@monappli.com)</li>
				<li>Le mots de passe de l'identifiant saisie ci-dessus</li>
				<li>Le chiffrement utilisé par le serveur mail (SSL, TLS ou aucune sécurité)</li>
			</ul>		
			Attention : Pour prendre en compte les modifications, vous devrez redémarrer le serveur. "A CONFIRMER"
		</p>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
</div>