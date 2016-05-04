<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Administrateur'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="administrateur index large-9 medium-8 columns content">
    <h3><?= __('Administrateur') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeAdmin') ?></th>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($administrateur as $administrateur): ?>
            <tr>
                <td><?= $this->Number->format($administrateur->CodeAdmin) ?></td>
                <td><?= $this->Number->format($administrateur->ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $administrateur->CodeAdmin]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $administrateur->CodeAdmin]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $administrateur->CodeAdmin], ['confirm' => __('Are you sure you want to delete # {0}?', $administrateur->CodeAdmin)]) ?>
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
