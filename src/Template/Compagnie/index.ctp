<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Compagnie'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="compagnie index large-9 medium-8 columns content">
    <h3><?= __('Compagnie') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('NomCompagnie') ?></th>
                <th><?= $this->Paginator->sort('CodeCompagnie') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($compagnie as $compagnie): ?>
            <tr>
                <td><?= h($compagnie->NomCompagnie) ?></td>
                <td><?= $this->Number->format($compagnie->CodeCompagnie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $compagnie->CodeCompagnie]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $compagnie->CodeCompagnie]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $compagnie->CodeCompagnie], ['confirm' => __('Are you sure you want to delete # {0}?', $compagnie->CodeCompagnie)]) ?>
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
