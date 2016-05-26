<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Actualites'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="actualites form large-9 medium-8 columns content">
    <?= $this->Form->create($actualite) ?>
    <fieldset>
        <legend><?= __('Add Actualite') ?></legend>
        <?php
            echo $this->Form->input('Sujet');
            echo $this->Form->input('Contenue');
            echo $this->Form->input('Date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Ajouter')) ?>
    <?= $this->Form->end() ?>
</div>
