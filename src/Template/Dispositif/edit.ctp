<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dispositif->CodeDispositif],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dispositif->CodeDispositif)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dispositif'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dispositif form large-9 medium-8 columns content">
    <?= $this->Form->create($dispositif) ?>
    <fieldset>
        <legend><?= __('Edit Dispositif') ?></legend>
        <?php
            echo $this->Form->input('NomDispositif');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
