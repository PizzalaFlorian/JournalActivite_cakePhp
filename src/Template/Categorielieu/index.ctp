<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Categorielieu'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categorielieu index large-9 medium-8 columns content">
    <h3><?= __('Categorielieu') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCategorieLieux') ?></th>
                <th><?= $this->Paginator->sort('NomCategorie') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorielieu as $categorielieu): ?>
            <tr>
                <td><?= $this->Number->format($categorielieu->CodeCategorieLieux) ?></td>
                <td><?= h($categorielieu->NomCategorie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $categorielieu->CodeCategorieLieux]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $categorielieu->CodeCategorieLieux]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $categorielieu->CodeCategorieLieux], ['confirm' => __('Are you sure you want to delete # {0}?', $categorielieu->CodeCategorieLieux)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
