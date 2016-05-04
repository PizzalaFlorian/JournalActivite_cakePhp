<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $compagnie->CodeCompagnie],
                ['confirm' => __('Are you sure you want to delete # {0}?', $compagnie->CodeCompagnie)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Compagnie'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="compagnie form large-9 medium-8 columns content">
    <?= $this->Form->create($compagnie) ?>
    <fieldset>
        <legend><?= __('Edit Compagnie') ?></legend>
        <?php
            echo $this->Form->input('NomCompagnie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
