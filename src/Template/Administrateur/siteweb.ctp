<?php
	echo $this->element('sidebarAdmin');
//	echo $this->Html->css('main_custom');
?>
<div id="content">
<div class="actualites index large-12 medium-11 columns content">
	<h3 class="center">Outils de gestion du site web</h3>

	<h4>But de l'experience</h4>
	<?php 
        echo $this->Html->link(
            'Modifier le texte rappelant le but de l\'expérience',
            ['controller' => 'administrateur', 'action' => 'butExperience', '_full' => true]
        );
    ?>

    <h4>Invitation Candidat</h4>
	<?php 
        echo $this->Html->link(
            'Modifier le corps de l\'e-mail automatique d\'invitation des candidats',
            ['controller' => 'administrateur', 'action' => 'emailCandidat', '_full' => true]
        );
    ?>

    <h4>Invitation Chercheur</h4>
	<?php 
        echo $this->Html->link(
            'Modifier le corps de l\'e-mail automatique d\'invitation des chercheurs',
            ['controller' => 'administrateur', 'action' => 'emailChercheur', '_full' => true]
        );
    ?>

    <h4>Candidat - Droit d'accès</h4>
    <?php 
        echo $this->Html->link(
            'Modifier le corps du message informant aux utilisateurs, que l\'application collecte et traite les données personnelles',
            ['controller' => 'administrateur', 'action' => 'droitAcces', '_full' => true]
        );
    ?>

    <h4>Candidat - Droit d'opposition </h4>
    <?php 
        echo $this->Html->link(
            'Modifier le corps du message de droit d\'opposition à l\'utilisation de ses données',
            ['controller' => 'administrateur', 'action' => 'droitopposition', '_full' => true]
        );
    ?>

</div>
</div>