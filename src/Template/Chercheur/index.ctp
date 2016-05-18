<?php
    echo $this->element('sidebarAdmin');
?>

<div class="chercheur index large-11 medium-12 columns content">
    <h3><?= __('Chercheur') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeChercheur') ?></th>
                <th><?= $this->Paginator->sort('PrenomChercheur') ?></th>
                <th><?= $this->Paginator->sort('NomChercheur') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chercheur as $chercheur): ?>
            <tr>
                <td><?= $this->Number->format($chercheur->CodeChercheur) ?></td>
                <td><?= h($chercheur->PrenomChercheur) ?></td>
                <td><?= h($chercheur->NomChercheur) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $chercheur->CodeChercheur]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $chercheur->CodeChercheur], ['confirm' => __('Are you sure you want to delete # {0}?', $chercheur->CodeChercheur)]) ?>
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
