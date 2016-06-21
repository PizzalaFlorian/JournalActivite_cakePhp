<?php
	echo $this->element('sidebarAdmin');
//	echo $this->Html->css('main_custom');
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
		<a href="#" class="menu_aide">Gestion des actualités</a>	
		<p >
			Une liste d’actualités est affichées sur la page d’accueil des utilisateurs, afin d'être tenu au courant de toute information que les chercheurs ou l'administrateur jugent importante. Seuls ces derniers peuvent rédiger et publier des actualités.
		</p>
		<br/> <a href="#" class="menu_aide">Créer une actualité</a>	
		<p >
			Pour créer une actualité, allez dans sur votre page d’accueil. Cliquez sur le bouton ‘créer une actualité’. Un sujet et un contenu vous seront demandés. Cliquez ensuite sur le bouton ‘envoyer’ pour la diffuser.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier une actualité</a>	
		<p >
			Pour modifier une actualité, allez sur votre page d’accueil. À droite de chacune des actualités présentes dans la liste se trouve deux icônes: l’un composée de deux outils, et l’autre d’une corbeille. Cliquez sur l'icône en forme d’outil pour visualiser ou modifier l’actualité.<br/>
			Vous accéderez à une interface permettant de modifier l’actualité. Cliquez sur ‘Envoyer’ une fois vos modifications effectuées.
			<?php echo $this->Html->image('modifier.ico', array('title' => "Modifier")); ?>
		</p>
		<br/> <a href="#" class="menu_aide">Supprimer une actualité</a>	
		<p >
			Pour supprimer une actualité, allez sur votre page d’accueil. A droite de chacune des actualités présente dans la liste, se trouve deux icônes, l’un composé de deux outils, et l’autre d’une corbeille. Cliquez sur l'icône en forme de corbeille pour supprimer une actualité.
			<?php echo $this->Html->image('supprimer.ico', array('title' => "Supprimer")); ?>
		</p>
		<h4>Gestion du site web</h4>

		<a href="#" class="menu_aide">Gestion du site web</a>	
		<p >
			La page gestion du site web permet à l’administrateur de modifier certain messages affichés, envoyés aux utilisateurs.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le but de l'expérience</a>	
		<p >
			Pour modifier le texte de but de l'expérience, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le texte rappelant le but de l'expérience’. vous accéderez à une interface vous permettant de modifier le but de l’expérience afficher aux candidats. Cliquez sur ‘Envoyer’ une fois vos modifications effectuées.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le message envoyé lors de l’invitation d’un candidat</a>	
		<p >
			Pour modifier le corps de l’e-mail envoyer a un candidat lors de l'invitation à utiliser l’application, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp de l'e-mail automatique pour l'invitation des candidats’. Vous accèderez à une interface vous permettant de modifier le message envoyé par mail aux candidats leur transmettant login et mot de passe afin qu’ils puissent se connecter à l'application. Cliquez sur ‘Envoyer’ une fois vos modifications terminées.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le message envoyé lors de l’invitation d’un chercheur</a>	
		<p >
			Pour modifier le corps de l’e-mail envoyer a un chercheur lors de l'invitation à utiliser l’application,  allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp de l'e-mail automatique pour l'invitation des chercheurs’. Vous accèderez à une interface vous permettant de modifier le message envoyé par mail aux chercheurs leur transmettant login et mot de passe afin qu’ils puissent se connecter à l'application. Cliquez sur ‘Envoyer’ une fois vos modifications terminées.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le message informant la collecte ou traite des données personnelles</a>	
		<p >
			Ce message est affiché aux candidats lors de leurs premières connexions et doit être validé pour accéder au site.<br/>
			Pour modifier ce texte, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp du message informant aux utilisateurs, que l'application collecte et traite des données personnelles’. Vous accèderez à une interface vous permettant de modifier ce message. Cliquez sur ‘Envoyer’ une fois vos modifications terminées.
		</p>
		<br/> <a href="#" class="menu_aide">Modifier le informant les utilisateurs de leurs droit d'opposition aux données les concernant</a>	
		<p >
			Ce message est affiché aux candidats sur la page ‘Supprimer mon compte’,  les informant qu'ils disposent d'un droit de rétractation à l'étude, ainsi que le droit de supprimer toute leurs données.<br/>
			Pour modifier ce texte, allez sur la page ‘Gestion du site web’ puis cliquez sur le lien ‘Modifier le corp du message de droit d'opposition à ce que les données concernant un utilisateur soient utilisées’. Vous accèderez à une interface vous permettant de modifier ce message. Cliquez sur ‘Envoyer’ une fois vos modifications terminées.
		</p>
		<h4>Gestion des utilisateurs</h4>
		<a href="#" class="menu_aide">Gestion des utilisateurs</a>	
		<p >
			La page Gestion des utilisateurs référence tout les utilisateurs inscrit dans la base de données ('candidats' / 'chercheurs' / 'administrateurs'). Pour chaque utilisateurs, l'administrateur à la possibilité de modifier, supprimer le compte de l'utilisateur.
		</p>
		<br/> <a href="#" class="menu_aide">Gestion des Candidats</a>	
		<p >
			La page Gestion des candidats référence tout les candidats inscrit dans la base de données. Pour chaque candidats, l'administrateur à la possibilité de modifier, supprimer leurs comptes.
		</p>
		<br/> <a href="#" class="menu_aide">Gestion des Chercheurs</a>	
		<p >
			La page Gestion des chercheurs référence tout les chercheurs inscrit dans la base de données. Pour chaque chercheurs, l'administrateur à la possibilité de modifier, supprimer leurs comptes.  
		</p>
		<br/> <a href="#" class="menu_aide">Gestion des Administrateurs</a>	
		<p >
			La page Gestion des administrateurs référence tout les administrateurs inscrit dans la base de données. Pour chaque administrateurs, l'administrateur à la possibilité de supprimer les compte et profil.  
		</p>
		<br/> <a href="#" class="menu_aide">Inviter un Candidat</a>	
		<p >
			Pour inviter un candidat, allez sur la page ‘Gestion Candidat’ et cliquez sur le bouton ‘Inviter un Candidat’.  L’adresse e-mail du candidat à inviter vous sera demandé. L’application enverra un e-mail au candidat contenant le message d’invitation défini sur la page ‘Gestion du site web’, ainsi qu’un login, un mot de passe et l’adresse du site afin que l’utilisateur puisse se connecter. 
		</p>
		<br/> <a href="#" class="menu_aide">Inviter une liste de Candidats</a>	
		<p >
			Pour inviter plusieurs candidats, allez sur la page ‘Gestion Candidat’ et cliquez sur le bouton ‘Inviter une liste de Candidats’. Vous pourrez choisir de copier/coller une liste d’e-mail séparer par un point-virgule, ou bien de sélectionner un fichier avec le bouton parcourir. Une fois valider, l’application enverra a chaque adresse de la liste un e-mail contenant le message d’invitation défini sur la page ‘Gestion du site web’, ainsi qu’un login, un mot de passe et l’adresse du site afin que les utilisateurs puissent se connecter.  
		</p>
		<br/> <a href="#" class="menu_aide">Inviter un Chercheur</a>	
		<p >
			Pour inviter un chercheur, allez sur la page ‘Gestion Chercheur’ et cliquez sur le bouton ‘Inviter un Chercheur’. L’adresse e-mail du chercheur à inviter vous sera demandé. L’application enverra un e-mail au chercheur contenant le message d’invitation défini sur la page ‘Gestion du site web’, ainsi qu’un login, un mot de passe et l’adresse du site afin que celui-ci puisse se connecter.
		</p>
		<br/> <a href="#" class="menu_aide">Inviter un Administrateur</a>	
		<p >
			Pour inviter un administrateur, allez sur la page ‘Gestion Administrateur’ et cliquez sur le bouton ‘Inviter un Administrateur’. L’adresse e-mail de l’administrateur à inviter vous sera demandé. L’application enverra un e-mail a l’administrateur contenant le message d’invitation défini sur la page ‘Gestion du site web’, ainsi qu’un login, un mot de passe et l’adresse du site afin que celui-ci puisse se connecter.
		</p>
		<h4>Gestion des données</h4>
		<a href="#" class="menu_aide">Gestion des données</a>	
		<p >
			La page Gestion des données permet à l'administrateur de supprimer partiellement ou totalement les données enregistrées des candidats.
		</p>
		<br/> <a href="#" class="menu_aide">Supprimer les données des Candidats de la base de données</a>	
		<p >
			Cette action permet de supprimer toutes les occupation entrées par les Candidats.
			<br/>
			Données supprimées :
			<br/>
				- Données liées aux activités des candidats<br/>
			<br/>
			
			Données conservées :
			<br/>
				- Données des Comptes Candidats/Chercheurs/Administrateurs<br/>
				- Catégorise Activités/Lieux<br/>
				- Activités/Lieux/Dispositifs/Compagnies<br/>
				- Tous les messages envoyées<br/>
				- Carnet de bord<br/>
				- Actualités<br/>
			<br/>
			Pour supprimer les occupation des candidats, allez sur la page ‘Gestion des données’ et cliquez sur le bouton ‘Supprimer les données entrées par les Candidats’.<br/>
			Attention : Une fois lancé, cette action est irréversible.
		</p>
		<br/> <a href="#" class="menu_aide">Suppression des comptes Candidats</a>	
		<p >
			Cette action permet de supprimer toutes les informations entré par les Candidats ainsi que leur compte.<br/>
			<br/>
			Données supprimées :<br/>         
			<br/>
				- Données liées aux activités des candidats<br/>
				- Tous les messages envoyées<br/>
				- Données des Comptes Candidats<br/>
			<br/>
			Données conservées :<br/>
			<br/>         
				- Données des Comptes Chercheurs/Administrateurs<br/>
				- Catégories Activités/Lieux<br/>
				- Activités/Lieux/Dispositifs/Compagnies<br/>
				- Carnet de bord<br/>
				- Actualités<br/>
			<br/>
			Pour supprimer toutes les informations des Candidats, allez sur la page ‘Gestion des données’ et cliquez sur le bouton ‘Supprimer les comptes candidats ainsi que leurs données’.<br/> 

			Attention : Une fois lancé, cette action est irréversible.
		</p>
		<h4>Messagerie</h4>
		<a href="#" class="menu_aide">Configurer la messagerie de l’application</a>	
		<p>
			La page "Configuration de la messagerie" permet de connecter l'application au compte d'une messagerie afin que celle-ci puisse envoyer des e-mails aux utilisateurs de l'application.<br/>
			<br/>
			Cas d'envoi d'e-mails :<br/>
			
				- Création d'un compte<br/>
				- Envoi d'un e-mail aux chercheurs lors de la réception d'un message de la part d'un candidat<br/>
				- Envoi d'un e-mail aux administrateurs lors d'une demande de 'contact'.<br/>     
			<br/>
			Pour cela, l'application a besoin de connaître les informations concernant la messagerie, par exemple :<br/>
				- Le nom de l'e-mail de l'application (par exemple : noreply.monappli@.com)<br/>
				- Le nom du serveur de messagerie (par exemple : smtp.gmail.com pour une adresse Gmail)<br/>
				- Un identifiant, afin de pouvoir se connecter au serveur mail (les e-mails seront envoyés à partir de cet identifiant, sous le nom d'e-mail noreply@monappli.com)<br/>
				- Le mot de passe de l'identifiant saisi ci-dessus<br/>
				- Le chiffrement utilisé par le serveur mail (SSL, TLS ou aucune sécurité)<br/>
			<br/>		
			Attention : Pour prendre en compte les modifications, vous devrez redémarrer le serveur.
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