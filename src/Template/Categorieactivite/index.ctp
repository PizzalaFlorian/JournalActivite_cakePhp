<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Categorieactivite'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categorieactivite index large-9 medium-8 columns content">
    <h3><?= __('Categorieactivite') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCategorieActivite') ?></th>
                <th><?= $this->Paginator->sort('NomCategorie') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorieactivite as $categorieactivite): ?>
            <tr>
                <td><?= $this->Number->format($categorieactivite->CodeCategorieActivite) ?></td>
                <td><?= h($categorieactivite->NomCategorie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $categorieactivite->CodeCategorieActivite]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $categorieactivite->CodeCategorieActivite]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $categorieactivite->CodeCategorieActivite], ['confirm' => __('Are you sure you want to delete # {0}?', $categorieactivite->CodeCategorieActivite)]) ?>
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
