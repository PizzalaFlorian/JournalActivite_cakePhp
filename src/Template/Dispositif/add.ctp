<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Dispositif'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dispositif form large-9 medium-8 columns content">
    <?= $this->Form->create($dispositif) ?>
    <fieldset>
        <legend><?= __('Add Dispositif') ?></legend>
        <?php
            echo $this->Form->input('NomDispositif');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
