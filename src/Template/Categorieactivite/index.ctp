<?php
    echo $this->element('sidebarChercheur');
?>
<div class="categorieactivite index large-12 medium-11 columns content">
    <h3><?= __('Categorieactivite') ?></h3>
    <?= $this->Html->link(__('Ajouter une categorie'), ['action' => 'add']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCategorieActivite') ?></th>
                <th><?= $this->Paginator->sort('NomCategorie') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorieactivite as $categorieactivite): ?>
            <tr>
                <td><?= $this->Number->format($categorieactivite->CodeCategorieActivite) ?></td>
                <td><?= h($categorieactivite->NomCategorie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $categorieactivite->CodeCategorieActivite]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $categorieactivite->CodeCategorieActivite], ['confirm' => __('Are you sure you want to delete # {0}?', $categorieactivite->CodeCategorieActivite)]) ?>
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
