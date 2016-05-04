<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Dispositif'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dispositif index large-9 medium-8 columns content">
    <h3><?= __('Dispositif') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeDispositif') ?></th>
                <th><?= $this->Paginator->sort('NomDispositif') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dispositif as $dispositif): ?>
            <tr>
                <td><?= $this->Number->format($dispositif->CodeDispositif) ?></td>
                <td><?= h($dispositif->NomDispositif) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dispositif->CodeDispositif]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dispositif->CodeDispositif]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dispositif->CodeDispositif], ['confirm' => __('Are you sure you want to delete # {0}?', $dispositif->CodeDispositif)]) ?>
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
