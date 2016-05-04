<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Activite'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="activite form large-9 medium-8 columns content">
    <?= $this->Form->create($activite) ?>
    <fieldset>
        <legend><?= __('Add Activite') ?></legend>
        <?php
            echo $this->Form->input('NomActivite');
            echo $this->Form->input('DescriptifActivite');
            echo $this->Form->input('CodeCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
