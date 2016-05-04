<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $chercheur->CodeChercheur],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chercheur->CodeChercheur)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Chercheur'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="chercheur form large-9 medium-8 columns content">
    <?= $this->Form->create($chercheur) ?>
    <fieldset>
        <legend><?= __('Edit Chercheur') ?></legend>
        <?php
            echo $this->Form->input('NomChercheur');
            echo $this->Form->input('PrenomChercheur');
            echo $this->Form->input('ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
