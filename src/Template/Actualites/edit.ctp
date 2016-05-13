<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $actualite->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $actualite->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Retour acceuil'), ['controller' => "$monController",'action' => "$monAction"]) ?></li>
    </ul>
</nav>
<div class="actualites form large-9 medium-8 columns content">
    <?= $this->Form->create($actualite) ?>
    <fieldset>
        <legend><?= __('Edit Actualite') ?></legend>
        <?php
            echo $this->Form->input('Date');
            echo $this->Form->input('Sujet');
            echo $this->Form->input('Contenue');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
