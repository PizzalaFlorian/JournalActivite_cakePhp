<?php
    echo $this->element('sidebarAdmin');
?>
<div class="candidat index large-11 medium-12 columns content">
    <h3><?= __('Candidat') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCandidat') ?></th>
                <th><?= $this->Paginator->sort('NomCandidat') ?></th>
                <th><?= $this->Paginator->sort('PrenomCandidat') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidat as $candidat): ?>
            <tr>
                <td><?= $this->Number->format($candidat->CodeCandidat) ?></td>
                <td><?= h($candidat->NomCandidat) ?></td>
                <td><?= h($candidat->PrenomCandidat) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidat->CodeCandidat]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidat->CodeCandidat], ['confirm' => __('Are you sure you want to delete # {0}?', $candidat->CodeCandidat)]) ?>
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
