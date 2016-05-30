<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>

<div class="categorielieu index large-12 medium-11 columns content">
    <h3 class="center"><?= __('Table des categories de lieux') ?></h3>
    <?= $this->Html->link(__('Ajouter une categorie'), ['action' => 'add'],array("class"=>"button")); ?>
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
                    <?php 
                    echo $this->Html->link(
                        $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                        array('action' => 'edit', $categorielieu->CodeCategorieLieux),
                        array('escape' => false) 
                    );
                     
                    echo $this->Form->postLink(
                        $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                        array('action' => 'delete', $categorielieu->CodeCategorieLieux),
                        array('escape' => false,'confirm' => __('Êtes vous sur de vouloir supprimer # {0}?', $categorielieu->NomCategorie))
                    ); 
                     
                    echo $this->Html->link(
                        $this->Html->image('reaffecter.ico', array('title' => "Réaffecter")), 
                        array('action' => 'reaffect', $categorielieu->CodeCategorieLieux),
                        array('escape' => false) 
                    ); 
                    ?>
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
