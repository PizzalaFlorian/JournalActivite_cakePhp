<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages index large-9 medium-8 columns content">
    <h3><?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('IDMessage') ?></th>
                <th><?= $this->Paginator->sort('DateEnvoi') ?></th>
                <th><?= $this->Paginator->sort('Sujet') ?></th>
                <th><?= $this->Paginator->sort('Lu') ?></th>
                <th><?= $this->Paginator->sort('IDExpediteur') ?></th>
                <th><?= $this->Paginator->sort('IDRecepteur') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= $this->Number->format($message->IDMessage) ?></td>
                <td><?= h($message->DateEnvoi) ?></td>
                <td><?= h($message->Sujet) ?></td>
                <td><?= h($message->Lu) ?></td>
                <td><?= $this->Number->format($message->IDExpediteur) ?></td>
                <td><?= $this->Number->format($message->IDRecepteur) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $message->IDMessage]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $message->IDMessage]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->IDMessage], ['confirm' => __('Are you sure you want to delete # {0}?', $message->IDMessage)]) ?>
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
