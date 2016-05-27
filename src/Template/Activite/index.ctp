<?php
    echo $this->element('sidebarChercheur');
    use Cake\ORM\TableRegistry;
?>
<div class="activite index large-12 medium-11 columns content">

    <h3 class="center"><?= __('Table des Activités') ?></h3>
    <?= $this->Html->link(__('Ajouter une activite'), ['action' => 'add'],array('class' => 'button')) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeActivite') ?></th>
                <th><?= $this->Paginator->sort('NomActivite') ?></th>
                <th><?= $this->Paginator->sort('CodeCategorie') ?></th>
                <th><?= $this->Paginator->sort('Nombre occurences') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activite as $activite): ?>
            <tr>
                <td><?= $this->Number->format($activite->CodeActivite) ?></td>
                <td><?= h($activite->NomActivite) ?></td>
                <td><?= $this->Number->format($activite->CodeCategorie) ?></td>
                <td>
                <?php 
                    $count = TableRegistry::get('occupation')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeActivite'=>$activite->CodeActivite])
                    ->group('CodeActivite')
                    ->first();
                    echo $this->Number->format($count['count']);
                ?>    
                </td>
                <td class="actions">
                    <?php 
                    echo $this->Html->link(
                        $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                        array('action' => 'edit', $activite->CodeActivite),
                        array('escape' => false) 
                    );
                     
                    echo $this->Form->postLink(
                        $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                        array('action' => 'delete', $activite->CodeActivite),
                        array('escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $activite->CodeActivite))
                    ); 
                     
                    echo $this->Html->link(
                        $this->Html->image('reaffecter.ico', array('title' => "Réaffecter")), 
                        array('action' => 'reaffect', $activite->CodeActivite),
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
