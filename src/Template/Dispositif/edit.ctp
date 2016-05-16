<?php
    echo $this->element('sidebarChercheur');
    echo $this->Form->postLink(
                __('Supprimer ce dispositif'),
                ['action' => 'delete', $dispositif->CodeDispositif],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dispositif->CodeDispositif)]
            );
    echo '<br/>';
    echo $this->Html->link(__('Retourner a la liste des dispositifs'), ['action' => 'index']);
?>
<div class="dispositif form large-12 medium-11 columns content">
    <?= $this->Form->create($dispositif) ?>
    <fieldset>
        <legend><?= __('Edit Dispositif') ?></legend>
        <?php
            echo $this->Form->input('NomDispositif');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
