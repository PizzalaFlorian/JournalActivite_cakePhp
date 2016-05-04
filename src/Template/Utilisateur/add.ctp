<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Utilisateur'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="utilisateur form large-9 medium-8 columns content">
    <?= $this->Form->create($utilisateur) ?>
    <fieldset>
        <legend><?= __('Add Utilisateur') ?></legend>
        <?php
            echo $this->Form->input('Login');
            echo $this->Form->input('TypeUser');
            echo $this->Form->input('MotDePasse');
            echo $this->Form->input('MailCandidat');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
