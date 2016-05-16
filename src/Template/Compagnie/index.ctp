<?php
    echo $this->element('sidebarChercheur');
?>
<div class="compagnie index large-12 medium-11 columns content">
    <h3><?= __('Compagnie') ?></h3>
    <?= $this->Html->link(__('Ajouter une nouvelle compagnie'), ['action' => 'add']) ?>
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
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $compagnie->CodeCompagnie]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $compagnie->CodeCompagnie], ['confirm' => __('Are you sure you want to delete # {0}?', $compagnie->CodeCompagnie)]) ?>
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
