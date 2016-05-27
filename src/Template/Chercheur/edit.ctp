<?php
    echo $this->element('sidebarAdmin');
?>

<div class="chercheur form large-11 medium-12 columns content">
    <?= $this->Form->create($chercheur) ?>
    <fieldset>
        <legend><?= __('Modifier les informations du chercheur') ?></legend>
        <?php
            echo $this->Form->input('NomChercheur');
            echo $this->Form->input('PrenomChercheur');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
    <?php 
        echo $this->Html->link(__('Retour'), ['action' => 'index'],['class'=>'button']).' ';
    
        echo $this->Form->postLink(
                __('Supprimer ce chercheur'),
                ['action' => 'delete', $chercheur->CodeChercheur],
                ['class'=>'button',"confirm"=>__('Êtes-vous sur de vouloir supprimer # {0}?', $chercheur->PrenomChercheur.' '.$chercheur->NomChercheur)]
            );
    ?>
</div>
