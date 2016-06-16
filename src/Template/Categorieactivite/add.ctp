<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>
<div class="categorieactivite form large-12 medium-11 columns content">

    <?= $this->Form->create($categorieactivite) ?>
    <fieldset>
        <legend><?= __('Ajouter une catégorie d\'activité') ?></legend>
        <?php
            echo $this->Form->label('NomCategorie', 'Nom Catégorie *');
            echo $this->Form->input('NomCategorie',['label'=>false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Ajouter')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link(__('Retourner a la liste des categories'), ['action' => 'index'],array("class"=>"button")) ?>
</div>
