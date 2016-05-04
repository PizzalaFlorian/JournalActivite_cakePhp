<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Activite'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="activite index large-9 medium-8 columns content">
    <h3><?= __('Activite') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeActivite') ?></th>
                <th><?= $this->Paginator->sort('NomActivite') ?></th>
                <th><?= $this->Paginator->sort('CodeCategorie') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activite as $activite): ?>
            <tr>
                <td><?= $this->Number->format($activite->CodeActivite) ?></td>
                <td><?= h($activite->NomActivite) ?></td>
                <td><?= $this->Number->format($activite->CodeCategorie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $activite->CodeActivite]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $activite->CodeActivite]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $activite->CodeActivite], ['confirm' => __('Are you sure you want to delete # {0}?', $activite->CodeActivite)]) ?>
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
