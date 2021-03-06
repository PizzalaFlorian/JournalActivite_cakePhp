<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('administrateur');
//	echo $this->Html->css('main_custom');
?>

<div class="actualites index large-12 medium-11 columns content">

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
			<li>Catégories Activités/Lieux</li>
			<li>Activités/Lieux/Dispositifs/Compagnie</li>
			<li>Tous les messages envoyés</li>
			<li>Carnet de bord</li>
			<li>Actualités</li>
		</ul>

	</div>
	<div class="monAction"><?php 
        echo $this->Html->link(
            'Supprimer les données entrées par les Candidats',
            ['controller' => 'administrateur', 'action' => 'supprOccupation', '_full' => true],
			['class'=>'button','confirm' => __('Attention : Cette action va entrainer la destruction de données dans la base de données. Êtes-vous sûr de vouloir continuer?')]
        );
    ?>
	</div>	
	Attention : La suppression peut nécessiter plusieurs minutes
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
			<li>Catégories Activités/Lieux</li>
			<li>Activités/Lieux/Dispositifs/Compagnies</li>
			<li>Carnet de bord</li>
			<li>Actualités</li>
		</ul>
	</div>
	<div class="monAction"><?php 
        echo $this->Html->link(
            'Supprimer les comptes candidats ainsi que leurs données',
            ['controller' => 'administrateur', 'action' => 'supprCandidat', '_full' => true], 
			['class'=>'button','confirm' => __('Attention : Cette action va entrainer la destruction de données dans la base de données. \nÊtes-vous sûr de vouloir continuer?')]
		);
    ?></div>
	Attention : La suppression peut nécessiter plusieurs minutes
	<br/><br/><br/>
</div>