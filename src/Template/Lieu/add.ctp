<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Lieu'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="lieu form large-9 medium-8 columns content">
    <?= $this->Form->create($lieu) ?>
    <fieldset>
        <legend><?= __('Add Lieu') ?></legend>
        <?php
            echo $this->Form->input('NomLieux');
            echo $this->Form->input('CodeCategorieLieux');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>