<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Categorielieu'), ['action' => 'edit', $categorielieu->CodeCategorieLieux]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Categorielieu'), ['action' => 'delete', $categorielieu->CodeCategorieLieux], ['confirm' => __('Are you sure you want to delete # {0}?', $categorielieu->CodeCategorieLieux)]) ?> </li>
        <li><?= $this->Html->link(__('List Categorielieu'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categorielieu'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categorielieu view large-9 medium-8 columns content">
    <h3><?= h($categorielieu->CodeCategorieLieux) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('NomCategorie') ?></th>
            <td><?= h($categorielieu->NomCategorie) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCategorieLieux') ?></th>
            <td><?= $this->Number->format($categorielieu->CodeCategorieLieux) ?></td>
        </tr>
    </table>
</div>
