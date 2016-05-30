<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>

<div class="lieu index large-12 medium-11 columns content">
    <h3 class="center"><?= __('Table des Lieux et Transports') ?></h3>
    <?= $this->Html->link(__('Ajouter un Lieu'), ['action' => 'add'],array("class"=>"button")) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeLieux') ?></th>
                <th><?= $this->Paginator->sort('NomLieux') ?></th>
                <th><?= $this->Paginator->sort('CodeCategorieLieux') ?></th>
                <th><?= $this->Paginator->sort('Nombre occurences') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lieu as $lieu): ?>
            <tr>
                <td><?= $this->Number->format($lieu->CodeLieux) ?></td>
                <td><?= h($lieu->NomLieux) ?></td>
                <td><?= $this->Number->format($lieu->CodeCategorieLieux) ?></td>
                <td><?php 
                    $count = TableRegistry::get('occupation')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeLieux'=>$lieu->CodeLieux])
                    ->group('CodeLieux')
                    ->first();
                    echo $this->Number->format($count['count']);
                ?>    
                </td>
                <td class="actions">
                    <?php 
                    echo $this->Html->link(
                        $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                        array('action' => 'edit', $lieu->CodeLieux),
                        array('escape' => false) 
                    );
                     
                    echo $this->Form->postLink(
                        $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                        array('action' => 'delete', $lieu->CodeLieux),
                        array('escape' => false,"confirm"=>__('Êtes-vous sur de vouloir supprimer # {0}?', $lieu->NomLieux))
                    ); 
                     
                    echo $this->Html->link(
                        $this->Html->image('reaffecter.ico', array('title' => "Réaffecter")), 
                        array('action' => 'reaffect', $lieu->CodeLieux),
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
