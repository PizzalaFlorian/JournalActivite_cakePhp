<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $categorieactivite->CodeCategorieActivite],
                ['confirm' => __('Are you sure you want to delete # {0}?', $categorieactivite->CodeCategorieActivite)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Categorieactivite'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="categorieactivite form large-9 medium-8 columns content">
    <?= $this->Form->create($categorieactivite) ?>
    <fieldset>
        <legend><?= __('Edit Categorieactivite') ?></legend>
        <?php
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
