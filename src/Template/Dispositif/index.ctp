<?php
    echo $this->element('sidebarChercheur');
     use Cake\ORM\TableRegistry;
?>
<div class="dispositif index large-12 medium-11 columns content">
    <h3><?= __('Dispositif') ?></h3>
    <?= $this->Html->link(__('Nouveau Dispositif'), ['action' => 'add']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeDispositif') ?></th>
                <th><?= $this->Paginator->sort('NomDispositif') ?></th>
                <th><?= $this->Paginator->sort('Nombre occurence') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dispositif as $dispositif): ?>
            <tr>
                <td><?= $this->Number->format($dispositif->CodeDispositif) ?></td>
                <td><?= h($dispositif->NomDispositif) ?></td>
                <td>
                <?php 
                    $count = TableRegistry::get('occupation')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeDispositif'=>$dispositif->CodeDispositif])
                    ->group('CodeDispositif')
                    ->first();
                    echo $this->Number->format($count['count']);
                ?>    
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $dispositif->CodeDispositif]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $dispositif->CodeDispositif], ['confirm' => __('Are you sure you want to delete # {0}?', $dispositif->CodeDispositif)]) ?>
                     <br>
                    <?= $this->Html->link(
                        'Reaffecter',
                        [ 'action' => 'reaffect', $dispositif->CodeDispositif]
                    ) ?>
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
