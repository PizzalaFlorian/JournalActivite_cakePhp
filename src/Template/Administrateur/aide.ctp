<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('main_custom');
	echo $this->Html->script('jquery-1.7.min');
	echo $this->Html->script('aide.js');
	echo $this->Html->css('administrateur');

?>
<div id="content">
<h3 class="center">Aide</h3>
	<h4 class="menu_aide">Gestion des actualités</h4>
	<div class="aide">
	</div>
	<h4 class="menu_aide">Gestion du site web</h4>
	<div class="aide">
		La page <?php echo $this->Html->link('Gestion du site web','/administrateur/siteweb'); ?> permet de modifier certain messages affiché, envoyé aux utilisateurs.<br/>
		<table>
			<tr>
				<td width="200">But de l'experience</td>
				<td>Modifie le texte rappellant le but de l'experience au candidat. Ce texte est affiché sur la page 'But de l'experience' des candidats, leurs résumant le buts de l'experience.</td>
			</tr>
			<tr>
				<td width="200">Invitation Candidat</td>
				<td>Modifie le corp de l'email automatique pour l'invitation d'un candidat.</td>
			</tr>
			<tr>
				<td width="200">Invitation Chercheur</td>
				<td>Modifier le corp de l'email automatique pour l'invitation d'un chercheur.</td>
			</tr>
			<tr>
				<td width="200">Candidat - Droit d'accès</td>
				<td>Modifie le corp du message informant les candidats que l'application collecte ou traite des données personnelles. Ce message s'affiche lors de la première connexion d'un candidat et lui bloquera l'accès tant qu'il n'aura pas été validé.<br/>
				Les candidats ne voulant pas approuvé ce messages ne pourront pas utilisé l'application.<br/>
				</td>
			</tr>
			<tr>
				<td width="200">Candidat - Droit d'opposition</td>
				<td>Modifie le corp du message de droit d'opposition a ce que les données concernant un candidat soient utilisées. Ce message est affiché dans la page 'Supprimer mon compte' des candidats et les informe qu'il disposent d'un droit de rétractation à l'étude, ainsi que le droit de supprimer toute leurs données.<br/>
				Si l'utilisateur décide de supprimer son compte, toute les données le concernant seront supprimé.<br/>
				</td>
			</tr>
		</table>
	</div>
	<h4 class="menu_aide">Gestion des utilisateurs</h4>
	<div class="aide">
	La page <?php echo $this->Html->link('Gestion des utilisateurs','/users'); ?> référence tout les utilisateurs inscrit dans la base de données ('candidats' / 'chercheurs' / 'administrateurs').<br/>
	Pour chaque utilisateur, l'administrateur à la possibilité de modifier, supprimer les données de l'utilisateur.
		<table>
			<tr>
				<td width="200">Inviter un candidat</td>
				<td>
					Créer un compte de type candidat et envoi un mail d'invitaion à l'adresse Email spécifié. Les informations du compte (Login / Mots de passe) sont transmit dans le mail.<br/>
					Le contenue de l'Email envoyé au candidat peut être modifier sur la page <?php echo $this->Html->link('Gestion site web/Invitation Candidat','/administrateur/email-candidat'); ?>.
				</td>
			</tr>
			<tr>
				<td width="200">Inviter une liste de candidats</td>
				<td>
					Créer un compte de type candidat et envoi un mail d'invitaion au adresse Email dans la liste transmise en paramêtre.
					Les informations du compte (Login / Mots de passe) sont transmit dans le mail.<br/>
					Le contenue de l'Email envoyé aux candidats peut être modifier sur la page <?php echo $this->Html->link('Gestion site web/Invitation Candidat','/administrateur/email-candidat'); ?>.
				</td>
			</tr>
			<tr>
				<td width="200">Inviter un chercheur</td>
				<td>
					Créer un compte de type chercheur et envoi un mail d'invitaion à l'adresse Email spécifié. Les informations du compte (Login / Mots de passe) sont transmit dans le mail.<br/>
					Le contenue de l'Email envoyé au chercheur peut être modifier sur la page <?php echo $this->Html->link('Gestion site web/Invitation chercheur','/administrateur/email-chercheur'); ?>.
					
				</td>
			</tr>
			<tr>
				<td width="200">Inviter un administrateur</td>
				<td>
					Créer un compte de type administrateur et envoi un mail d'invitaion à l'adresse Email spécifié. Les informations du compte (Login / Mots de passe) sont transmit dans le mail.
				</td>
			</tr>
		</table>
	</div>
	<h4 class="menu_aide">Gestion des candidats web</h4>
	<div class="aide">
		La page <?php echo $this->Html->link('Gestion des candidats','/candidat'); ?> référence tout les candidats inscrit dans la base de données.<br/>
		Pour chaque candidat, l'administrateur à la possibilité de modifier, supprimer les données.
		<table>
			<tr>
				<td width="200">Inviter un candidat</td>
				<td>
					Créer un compte de type candidat et envoi un mail d'invitaion à l'adresse Email spécifié. Les informations du compte (Login / Mots de passe) sont transmit dans le mail.<br/>
					Le contenue de l'Email envoyé au candidat peut être modifier sur la page <?php echo $this->Html->link('Gestion site web/Invitation Candidat','/administrateur/email-candidat'); ?>.
				</td>
			</tr>
			<tr>
				<td width="200">Inviter une liste de candidats</td>
				<td>
					Créer un compte de type candidat et envoi un mail d'invitaion au adresse Email dans la liste transmise en paramêtre.
					Les informations du compte (Login / Mots de passe) sont transmit dans le mail.<br/>
					Le contenue de l'Email envoyé aux candidats peut être modifier sur la page <?php echo $this->Html->link('Gestion site web/Invitation Candidat','/administrateur/email-candidat'); ?>.
				</td>
			</tr>
		</table>
	</div>
	<h4 class="menu_aide">Gestion des chercheurs</h4>
	<div class="aide">
		La page <?php echo $this->Html->link('Gestion des chercheurs','/chercheur'); ?> référence tout les chercheurs inscrit dans la base de données.<br/>
		Pour chaque chercheur, l'administrateur à la possibilité de modifier, supprimer les données.
		<table>
			<tr>
				<td width="200">Inviter un chercheur</td>
				<td>
					Créer un compte de type chercheur et envoi un mail d'invitaion à l'adresse Email spécifié. Les informations du compte (Login / Mots de passe) sont transmit dans le mail.<br/>
					Le contenue de l'Email envoyé au chercheur peut être modifier sur la page <?php echo $this->Html->link('Gestion site web/Invitation chercheur','/administrateur/email-chercheur'); ?>.
				</td>
			</tr>
		</table>
	</div>
	<h4 class="menu_aide">Gestion des administrateurs</h4>	
	<div class="aide">
		La page <?php echo $this->Html->link('Gestion des administrateurs','/administrateur'); ?> référence tout les administrateurs inscrit dans la base de données.<br/>
		Pour chaque administrateurs, l'administrateur à la possibilité de modifier, supprimer les données.
		<table>
			<tr>
				<td width="200">Inviter un administrateur</td>
				<td>
					Créer un compte de type administrateur et envoi un mail d'invitaion à l'adresse Email spécifié. Les informations du compte (Login / Mots de passe) sont transmit dans le mail.
				</td>
			</tr>
		</table>
	</div>
	<h4 class="menu_aide">Gestion des données</h4>	
	<div class="aide">
		La page <?php echo $this->Html->link('Gestion des données','/administrateur/gestion-donnees'); ?> permet à l'administrateur de supprimer partielement ou totalement les données enregistrés des candidats.<br/><br/>
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
	<h4 class="menu_aide">Configuration Messagerie</h4>	
	<div class="aide">
		<img> - image de gestion de messagerie - </img><br/>
		La page <?php echo $this->Html->link('Configuration de la messagerie','/administrateur/messagerie'); ?> permet de connecter l'application au compte d'une messagerie afin que celle-ci puisse envoyer des emails aux utilisateurs de l'application.<br/>
		Cas d'envoie d'emails : <br/>
		<ul>
			<li>Création d'un compte</li>
			<li>Envoie d'un Email aux chercheurs lors de la reception d'un message de la part d'un candidat</li>
			<li>Envoie d'un Email aux administrateurs lors d'une demande de 'contacts'.
		</ul>	
		Pour cela, l'application a besoin de connaitre les information concernant la messagerie, par exemple :<br/>
		<ul>
			<li>Le nom de l'Email de l'application (par exemple : noreply.monappli@.com)</li>
			<li>Le nom du serveur de messagerie (par exemple : smtp.gmail.com pour une adresse gmail)</li>
			<li>un identifiant, afin de pouvoir se connecter au serveur mail (les emails seront envoyés à partir de cette identifiant, sous le nom d'email noreply@monappli.com)</li>
			<li>Le mots de passe de l'identifiant saisie ci-dessus</li>
			<li>Le chiffrement utilisé par le serveur mail (SSL, TLS ou aucune sécurité)</li>
		</ul>
		Attention! Pour prendre en compte les modifications, vous devrez redémarer le serveur. "A CONFIRMER"
	</div>	
	<h4>Mon Compte</h4>	
</div>