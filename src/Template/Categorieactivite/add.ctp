<?php
    echo $this->element('sidebarChercheur');
?>
<div class="categorieactivite form large-12 medium-11 columns content">
<?= $this->Html->link(__('Retour'), ['action' => 'index']) ?>
    <?= $this->Form->create($categorieactivite) ?>
    <fieldset>
        <legend><?= __('Add Categorieactivite') ?></legend>
        <?php
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
