<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $carnetdebord->CodeEntree],
                ['confirm' => __('Are you sure you want to delete # {0}?', $carnetdebord->CodeEntree)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Carnetdebord'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="carnetdebord form large-9 medium-8 columns content">
    <?= $this->Form->create($carnetdebord) ?>
    <fieldset>
        <legend><?= __('Edit Carnetdebord') ?></legend>
        <?php
            echo $this->Form->input('Date');
            echo $this->Form->input('Sujet');
            echo $this->Form->input('Commentaire');
            echo $this->Form->input('CodeChercheur');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
