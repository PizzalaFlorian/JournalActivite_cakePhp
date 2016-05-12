<?php
    echo $this->element('sidebarChercheur');
?>
<div class="chercheur form large-9 medium-8 columns content">
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
