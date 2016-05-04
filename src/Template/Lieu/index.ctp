<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Lieu'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lieu index large-9 medium-8 columns content">
    <h3><?= __('Lieu') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeLieux') ?></th>
                <th><?= $this->Paginator->sort('NomLieux') ?></th>
                <th><?= $this->Paginator->sort('CodeCategorieLieux') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lieu as $lieu): ?>
            <tr>
                <td><?= $this->Number->format($lieu->CodeLieux) ?></td>
                <td><?= h($lieu->NomLieux) ?></td>
                <td><?= $this->Number->format($lieu->CodeCategorieLieux) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $lieu->CodeLieux]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lieu->CodeLieux]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lieu->CodeLieux], ['confirm' => __('Are you sure you want to delete # {0}?', $lieu->CodeLieux)]) ?>
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
