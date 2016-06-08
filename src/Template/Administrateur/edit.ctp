<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $administrateur->CodeAdmin],
                ['confirm' => __('Êtes-vous sur de vouloir supprimer # {0}?', $administrateur->CodeAdmin)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Administrateur'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="administrateur form large-9 medium-8 columns content">
    <?= $this->Form->create($administrateur) ?>
    <fieldset>
        <legend><?= __('Edition Administrateur') ?></legend>
        <?php
            echo $this->Form->input('ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
