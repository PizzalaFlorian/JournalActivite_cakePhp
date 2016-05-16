<?php
    echo $this->element('sidebarChercheur');
    echo $this->Form->postLink(
                __('Supprimer cette compagnie'),
                ['action' => 'delete', $compagnie->CodeCompagnie],
                ['confirm' => __('Are you sure you want to delete # {0}?', $compagnie->CodeCompagnie)]
            );
    echo '<br/>';
    echo $this->Html->link(__('Retourner a la liste des compagnies'), ['action' => 'index']);
?>
<div class="compagnie form large-12 medium-11 columns content">
    <?= $this->Form->create($compagnie) ?>
    <fieldset>
        <legend><?= __('Edit Compagnie') ?></legend>
        <?php
            echo $this->Form->input('NomCompagnie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
