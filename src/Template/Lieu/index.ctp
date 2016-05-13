<?php
    echo $this->element('sidebarChercheur');
?>

<div class="lieu index large-12 medium-11 columns content">
    <h3><?= __('Lieu') ?></h3>
    <?= $this->Html->link(__('Ajouter un Lieu'), ['action' => 'add']) ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
    </div>
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
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $lieu->CodeLieux]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $lieu->CodeLieux], ['confirm' => __('Are you sure you want to delete # {0}?', $lieu->CodeLieux)]) ?>
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
