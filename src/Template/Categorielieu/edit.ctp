<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $categorielieu->CodeCategorieLieux],
                ['confirm' => __('Are you sure you want to delete # {0}?', $categorielieu->CodeCategorieLieux)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Categorielieu'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="categorielieu form large-9 medium-8 columns content">
    <?= $this->Form->create($categorielieu) ?>
    <fieldset>
        <legend><?= __('Edit Categorielieu') ?></legend>
        <?php
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
