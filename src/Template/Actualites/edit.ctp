<?php
    echo $this->Html->css('main_custom');
    if($monController == 'chercheur'){
     echo $this->element('sidebarChercheur');
    }
    if($monController == 'candidat'){
     echo $this->element('sidebarCandidat');
    }
    if($monController == 'administrateur'){
     echo $this->element('sidebarAdmin');
    }
?>

<div class="actualites form large-11 medium-11 columns content">
<div id="content">
    <?php 
        echo $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $actualite->ID],
                array("class"=>"button",'confirm' => __('Êtes-vous sûr de vouloir supprimer cette actualité?', $actualite->ID))
            ).' ';
        echo $this->Html->link(__('Retour accueil'),
         ['controller' => "$monController",'action' => "$monAction"],
         array("class"=>"button"));
        ?>
</div>
    <?= $this->Form->create($actualite) ?>
    <fieldset>
        <legend><?= __('Modifier l\'Actualité') ?></legend>
        <?php
            echo $this->Form->input('Sujet');
            echo $this->Form->label('Contenue', 'Contenu *');
            echo $this->Form->input('Contenue',['label'=>false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
