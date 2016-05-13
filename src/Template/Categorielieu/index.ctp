<?php
    echo $this->element('sidebarChercheur');
?>

<div class="categorielieu index large-12 medium-11 columns content">
    <h3><?= __('Categorie lieu') ?></h3>
    <?= $this->Html->link(__('Ajouter une categorie'), ['action' => 'add']); ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCategorieLieux') ?></th>
                <th><?= $this->Paginator->sort('NomCategorie') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorielieu as $categorielieu): ?>
            <tr>
                <td><?= $this->Number->format($categorielieu->CodeCategorieLieux) ?></td>
                <td><?= h($categorielieu->NomCategorie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $categorielieu->CodeCategorieLieux]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $categorielieu->CodeCategorieLieux], ['confirm' => __('Are you sure you want to delete # {0}?', $categorielieu->CodeCategorieLieux)]) ?>
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
