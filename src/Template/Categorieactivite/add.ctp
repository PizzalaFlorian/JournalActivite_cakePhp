<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Categorieactivite'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="categorieactivite form large-9 medium-8 columns content">
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
