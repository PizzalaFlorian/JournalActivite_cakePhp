<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('administrateur');
?>

<div class="actualites index large-12 medium-11 columns content">
	<h4>Sauvegarde de la base de données</h4>
	<div class="monAction"><?php 
        echo $this->Html->link(
            'Sauvegarde de la base de données au format .SQL',
            ['controller' => 'administrateur', 'action' => '???', '_full' => true]
        );
    ?>
	</div>
	<br/>
	<h4>Suppression des données 'Candidats' de la base de données</h4>
	<div class="description">
		Cette action entraine la destruction des données des candidats.<br/>
		Données supprimées :
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

	</div>
	<div class="monAction"><?php 
        echo $this->Html->link(
            'Supprimer les données entrées par les Candidats',
            ['controller' => 'administrateur', 'action' => 'supprOccupation', '_full' => true],
			['confirm' => __('Attention : Cette action va entrainer la destruction de données dans la base de données. Êtes-vous sûr de vouloir continuer?')]
        );
    ?>
	</div>	
	Attention : Cette action peut durer plusieurs minutes
	<br/>
	<br/>
	<h4>Suppression des Comptes Candidats</h4>
	<div class="description">
		Cette action entraine la destruction des données des candidats, ainsi que de leurs comptes.<br/>
		Données supprimées :
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
	<div class="monAction"><?php 
        echo $this->Html->link(
            'Supprimer les comptes candidats ainsi que leurs données',
            ['controller' => 'administrateur', 'action' => 'supprCandidat', '_full' => true], 
			['confirm' => __('Attention : Cette action va entrainer la destruction de données dans la base de données. \nÊtes-vous sûr de vouloir continuer?')]
		);
    ?></div>
	Attention : Cette action peut durer plusieurs minutes
	<br/><br/><br/>
</div>