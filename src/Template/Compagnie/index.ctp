<?php
    echo $this->element('sidebarChercheur');
 //   echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>
<div class="compagnie index large-12 medium-11 columns content">
    <h3 class="center"><?= __('Table des compagnies') ?></h3>
    <?= $this->Html->link(__('Ajouter une nouvelle compagnie'), ['action' => 'add'],['class'=>'button']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCompagnie') ?></th>
                <th><?= $this->Paginator->sort('NomCompagnie') ?></th>
                <th><?= $this->Paginator->sort('Nombre occurences') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($compagnie as $compagnie): ?>
            <tr>
                <td><?= $this->Number->format($compagnie->CodeCompagnie) ?></td>
                <td><?= h($compagnie->NomCompagnie) ?></td>
                <td>
                <?php 
                    $count = TableRegistry::get('occupation')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeCompagnie'=>$compagnie->CodeCompagnie])
                    ->group('CodeCompagnie')
                    ->first();
                    echo $this->Number->format($count['count']);
                ?> 
                </td>
                <td class="actions">
                     <?php 
                    echo $this->Html->link(
                        $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                        array('action' => 'edit', $compagnie->CodeCompagnie),
                        array('escape' => false) 
                    );
                     
                    echo $this->Form->postLink(
                        $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                        array('action' => 'delete', $compagnie->CodeCompagnie),
                        array('escape' => false,'confirm' => __('Êtes vous sur de vouloir supprimer # {0}?', $compagnie->NomCompagnie))
                    ); 
                     
                    echo $this->Html->link(
                        $this->Html->image('reaffecter.ico', array('title' => "Réaffecter")), 
                        array('action' => 'reaffect', $compagnie->CodeCompagnie),
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
