<?php
    echo $this->element('sidebarChercheur');
    echo $this->Form->postLink(
                __('Supprimer cette categorie'),
                ['action' => 'delete', $categorielieu->CodeCategorieLieux],
                ['confirm' => __('Are you sure you want to delete # {0}?', $categorielieu->CodeCategorieLieux)]
            );
    echo '<br>';
    echo $this->Html->link(__('Retour'), ['action' => 'index']);
?>
<div class="categorielieu form large-12 medium-11 columns content">
    <?= $this->Form->create($categorielieu) ?>
    <fieldset>
        <legend><?= __('Edit Categorielieu') ?></legend>
        <?php
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
