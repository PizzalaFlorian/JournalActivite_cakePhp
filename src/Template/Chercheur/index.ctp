<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Chercheur'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="chercheur index large-9 medium-8 columns content">
    <h3><?= __('Chercheur') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeChercheur') ?></th>
                <th><?= $this->Paginator->sort('NomChercheur') ?></th>
                <th><?= $this->Paginator->sort('PrenomChercheur') ?></th>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chercheur as $chercheur): ?>
            <tr>
                <td><?= $this->Number->format($chercheur->CodeChercheur) ?></td>
                <td><?= h($chercheur->NomChercheur) ?></td>
                <td><?= h($chercheur->PrenomChercheur) ?></td>
                <td><?= $this->Number->format($chercheur->ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $chercheur->CodeChercheur]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $chercheur->CodeChercheur]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $chercheur->CodeChercheur], ['confirm' => __('Are you sure you want to delete # {0}?', $chercheur->CodeChercheur)]) ?>
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
