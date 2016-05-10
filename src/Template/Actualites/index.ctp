<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Actualite'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="actualites index large-9 medium-8 columns content">
    <h3><?= __('Actualites') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Sujet') ?></th>
                <th><?= $this->Paginator->sort('Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actualites as $actualite): ?>
            <tr>
                <td><?= $this->Number->format($actualite->ID) ?></td>
                <td><?= h($actualite->Sujet) ?></td>
                <td><?= h($actualite->Date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $actualite->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $actualite->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $actualite->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $actualite->ID)]) ?>
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
