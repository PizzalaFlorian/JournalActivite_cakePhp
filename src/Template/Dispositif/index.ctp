<?php
    echo $this->element('sidebarChercheur');
//    echo $this->Html->css('main_custom');
     use Cake\ORM\TableRegistry;
?>
<div class="dispositif index large-12 medium-11 columns content">
    <h3 class="center"><?= __('Table des Dispositifs') ?></h3>
    <?= $this->Html->link(__('Nouveau Dispositif'), ['action' => 'add'],['class'=>'button']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeDispositif') ?></th>
                <th><?= $this->Paginator->sort('NomDispositif') ?></th>
                <th><?= $this->Paginator->sort('Nombre occurences') ?></th>
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
                    <?php 
                    echo $this->Html->link(
                        $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                        array('action' => 'edit', $dispositif->CodeDispositif),
                        array('escape' => false) 
                    );
                     
                    echo $this->Form->postLink(
                        $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                        array('action' => 'delete', $dispositif->CodeDispositif),
                        array('escape' => false,'confirm' => __('Êtes vous sur de vouloir supprimer # {0}?', $dispositif->NomDispositif))
                    ); 
                     
                    echo $this->Html->link(
                        $this->Html->image('reaffecter.ico', array('title' => "Réaffecter")), 
                        array('action' => 'reaffect', $dispositif->CodeDispositif),
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
