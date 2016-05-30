<?php
    echo $this->Html->css('main_custom');
    if($_SESSION['Auth']['User']['typeUser'] == 'chercheur'){
     echo $this->element('sidebarChercheur');
    }
    if($_SESSION['Auth']['User']['typeUser'] == 'candidat'){
     echo $this->element('sidebarCandidat');
    }
    if($_SESSION['Auth']['User']['typeUser'] == 'admin'){
     echo $this->element('sidebarAdmin');
    }
?>
<div id="content">
    <?php 
        echo $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $actualite->ID],
                array("class"=>"button",'confirm' => __('Are you sure you want to delete # {0}?', $actualite->ID))
            ).' ';
        echo $this->Html->link(__('Retour acceuil'),
         ['controller' => "$monController",'action' => "$monAction"],
         array("class"=>"button"));
        ?>

<div class="actualites form large-11 medium-11 columns content">
    <?= $this->Form->create($actualite) ?>
    <fieldset>
        <legend><?= __('Modifier l\'Actualitée') ?></legend>
        <?php
            echo $this->Form->input('Sujet');
            echo $this->Form->input('Contenue');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
</div>