<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>
<div class="chercheur form large-10 medium-9 columns content">
    <?= $this->Form->create($chercheur) ?>
    <fieldset>
        <legend><?= __('Modifier mes informations') ?></legend>
        <?php
            echo $this->Form->input('NomChercheur');
            echo $this->Form->input('PrenomChercheur');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
</div>
