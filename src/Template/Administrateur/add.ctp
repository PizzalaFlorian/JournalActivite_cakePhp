<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Administrateur'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="administrateur form large-9 medium-8 columns content">
    <?= $this->Form->create($administrateur) ?>
    <fieldset>
        <legend><?= __('Add Administrateur') ?></legend>
        <?php
            echo $this->Form->input('ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
