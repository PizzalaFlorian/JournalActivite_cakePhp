<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->link(__('Annuler et retourner a la liste des chercheurs'), ['action' => 'index']);
    echo '<br>';
    echo $this->Form->postLink(
                __('Supprimer ce chercheur'),
                ['action' => 'delete', $chercheur->CodeChercheur],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chercheur->CodeChercheur)]
            );
      
?>

<div class="chercheur form large-11 medium-12 columns content">
    <?= $this->Form->create($chercheur) ?>
    <fieldset>
        <legend><?= __('Edit Chercheur') ?></legend>
        <?php
            echo $this->Form->input('NomChercheur');
            echo $this->Form->input('PrenomChercheur');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
