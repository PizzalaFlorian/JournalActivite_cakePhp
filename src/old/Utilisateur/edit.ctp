<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $utilisateur->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $utilisateur->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Utilisateur'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="utilisateur form large-9 medium-8 columns content">
    <?= $this->Form->create($utilisateur) ?>
    <fieldset>
        <legend><?= __('Edit Utilisateur') ?></legend>
        <?php
            echo $this->Form->input('login');
            echo $this->Form->input('typeUser');
            echo $this->Form->input('password');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
