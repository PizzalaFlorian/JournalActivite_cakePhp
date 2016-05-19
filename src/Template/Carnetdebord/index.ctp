<?php
    echo $this->element('sidebarChercheur');
    use Cake\ORM\TableRegistry;
?>
<div class="carnetdebord index large-11 medium-12 columns content">
    <h3><?= __('Carnet de bord') ?></h3>
    <?= $this->Html->link(__('Nouvelle entrée'), ['action' => 'add']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeEntree') ?></th>
                <th><?= $this->Paginator->sort('Date') ?></th>
                <th><?= $this->Paginator->sort('Sujet') ?></th>
                <th><?= $this->Paginator->sort('Nom Chercheur') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carnetdebord as $carnetdebord): ?>
            <tr>
                <td><?= $this->Number->format($carnetdebord->CodeEntree) ?></td>
                <td><?= h($carnetdebord->Date) ?></td>
                <td><?= h($carnetdebord->Sujet) ?></td>
                <td>
                <?php
                    $chercheur = TableRegistry::get('chercheur')
                        ->find()
                        ->where(['CodeChercheur'=>$carnetdebord->CodeChercheur])
                        ->first();
                    echo $chercheur['PrenomChercheur'].' '.$chercheur['NomChercheur'];
                ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Lire'), ['action' => 'view', $carnetdebord->CodeEntree]) ?>
                    <br>
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $carnetdebord->CodeEntree]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $carnetdebord->CodeEntree], ['confirm' => __('Are you sure you want to delete # {0}?', $carnetdebord->CodeEntree)]) ?>
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
