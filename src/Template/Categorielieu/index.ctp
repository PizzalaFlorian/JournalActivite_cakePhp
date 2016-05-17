<?php
    echo $this->element('sidebarChercheur');
    use Cake\ORM\TableRegistry;
?>

<div class="categorielieu index large-12 medium-11 columns content">
    <h3><?= __('Categorie lieu') ?></h3>
    <?= $this->Html->link(__('Ajouter une categorie'), ['action' => 'add']); ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCategorieLieux') ?></th>
                <th><?= $this->Paginator->sort('NomCategorie') ?></th>
                <th><?= $this->Paginator->sort('Nombre de lieux liées') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorielieu as $categorielieu): ?>
            <tr>
                <td><?= $this->Number->format($categorielieu->CodeCategorieLieux) ?></td>
                <td><?= h($categorielieu->NomCategorie) ?></td>
                <td>
                <?php 
                    $count = TableRegistry::get('lieu')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeCategorieLieux'=>$categorielieu->CodeCategorieLieux])
                    ->group('CodeCategorieLieux')
                    ->first();
                    echo $this->Number->format($count['count']);
                ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $categorielieu->CodeCategorieLieux]) ?>
                    <br>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $categorielieu->CodeCategorieLieux], ['confirm' => __('Are you sure you want to delete # {0}?', $categorielieu->CodeCategorieLieux)]) ?>
                    <br>
                    <?= $this->Html->link(
                        'Reaffecter',
                        [ 'action' => 'reaffect', $categorielieu->CodeCategorieLieux]
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
