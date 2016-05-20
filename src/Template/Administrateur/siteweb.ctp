<?php
	echo $this->element('sidebarAdmin');
	echo $this->Html->css('main_custom');
?>
<div class="actualites index large-12 medium-11 columns content">
	<h3>Outils de gestion du site web</h3>

	<h4>But de l'experience</h4>
	<?php 
        echo $this->Html->link(
            'Modifier le texte rappellant le but de l\'experience',
            ['controller' => 'administrateur', 'action' => 'butExperience', '_full' => true]
        );
    ?>

    <h4>Invitation Candidat</h4>
	<?php 
        echo $this->Html->link(
            'Modifier le corp de l\'email automatique pour l\'invitation des candidats',
            ['controller' => 'administrateur', 'action' => 'emailCandidat', '_full' => true]
        );
    ?>

    <h4>Invitation Chercheur</h4>
	<?php 
        echo $this->Html->link(
            'Modifier le corp de l\'email automatique pour l\'invitation des chercheurs',
            ['controller' => 'administrateur', 'action' => 'emailChercheur', '_full' => true]
        );
    ?>

    <h4>Candidat - Droit d'accès</h4>
    <?php 
        echo $this->Html->link(
            'Modifier le corp du message informant au utilisateur, que l\'application collecte ou traite des données personnelles',
            ['controller' => 'administrateur', 'action' => 'droitAcces', '_full' => true]
        );
    ?>

    <h4>Candidat - Droit d'opposition </h4>
    <?php 
        echo $this->Html->link(
            'Modifier le corp du message de droit d\'opposition a ce que les données concernant un utilisateur soient utilisées',
            ['controller' => 'administrateur', 'action' => 'droitopposition', '_full' => true]
        );
    ?>

</div>