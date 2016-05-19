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

</div>