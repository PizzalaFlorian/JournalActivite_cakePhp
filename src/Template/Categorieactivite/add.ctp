<?php
    echo $this->element('sidebarChercheur');
?>
<div class="categorieactivite form large-12 medium-11 columns content">

    <?= $this->Form->create($categorieactivite) ?>
    <fieldset>
        <legend><?= __('Ajouter une categorie d\'activitée') ?></legend>
        <?php
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Ajouter')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link(__('Retourner a la liste des categories'), ['action' => 'index'],array("class"=>"button")) ?>
</div>
