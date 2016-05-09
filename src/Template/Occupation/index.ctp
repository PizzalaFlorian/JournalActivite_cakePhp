<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Occupation'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="occupation index large-9 medium-8 columns content">
    <h3><?= __('Occupation') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeOccupation') ?></th>
                <th><?= $this->Paginator->sort('HeureDebut') ?></th>
                <th><?= $this->Paginator->sort('HeureFin') ?></th>
                <th><?= $this->Paginator->sort('CodeCandidat') ?></th>
                <th><?= $this->Paginator->sort('CodeLieux') ?></th>
                <th><?= $this->Paginator->sort('CodeActivite') ?></th>
                <th><?= $this->Paginator->sort('CodeCompagnie') ?></th>
                <th><?= $this->Paginator->sort('CodeDispositif') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($occupation as $occupation): ?>
            <tr>
                <td><?= $this->Number->format($occupation->CodeOccupation) ?></td>
                <td><?= h($occupation->HeureDebut) ?></td>
                <td><?= h($occupation->HeureFin) ?></td>
                <td><?= $this->Number->format($occupation->CodeCandidat) ?></td>
                <td><?= $this->Number->format($occupation->CodeLieux) ?></td>
                <td><?= $this->Number->format($occupation->CodeActivite) ?></td>
                <td><?= $this->Number->format($occupation->CodeCompagnie) ?></td>
                <td><?= $this->Number->format($occupation->CodeDispositif) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $occupation->CodeOccupation]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $occupation->CodeOccupation]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $occupation->CodeOccupation], ['confirm' => __('Are you sure you want to delete # {0}?', $occupation->CodeOccupation)]) ?>
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
