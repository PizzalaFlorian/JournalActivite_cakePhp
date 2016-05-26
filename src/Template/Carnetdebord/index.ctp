<?php
    echo $this->element('sidebarChercheur');
    use Cake\ORM\TableRegistry;
?>
<div class="carnetdebord index large-11 medium-12 columns content">
    <h3 class="center"><?= __('Carnet de bord') ?></h3>
    <?= $this->Html->link(__('Nouvelle entrée'), ['action' => 'add'],array('class' => 'button')) ?>
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
                    <?php 
                    echo $this->Html->link(
                         $this->Html->image('open.png', array('title' => "Lire")),
                        ['action' => 'view', $carnetdebord->CodeEntree],
                        array('escape' => false)
                        ); 
                    echo $this->Html->link(
                        $this->Html->image('modifier.ico', array('title' => "Modifier")),
                     ['action' => 'edit', $carnetdebord->CodeEntree],
                     array('escape' => false)
                     ); 
                    echo $this->Form->postLink(
                         $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                     ['action' => 'delete', $carnetdebord->CodeEntree],
                     array('escape' => false),
                      ['confirm' => __('Êtes vous sur de vouloir supprimée l\'entrée : {0}?', $carnetdebord->Sujet)]); 
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
