<?php
    echo $this->element('sidebarAdmin');
//    echo $this->Html->css('main_custom');
?>

<div class="chercheur index large-11 medium-12 columns content">
    <h3 class="center"><?= __('Table des Chercheurs') ?></h3>
    <?php
        echo $this->Html->link(__('Inviter un Chercheur'), ['controller'=>'administrateur','action' => 'createChercheur'],['class'=>'button']);
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeChercheur','Code Chercheur') ?></th>
                <th><?= $this->Paginator->sort('PrenomChercheur','Prénom Chercheur') ?></th>
                <th><?= $this->Paginator->sort('NomChercheur','Nom Chercheur') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chercheur as $chercheur): ?>
            <tr>
                <td><?= $this->Number->format($chercheur->CodeChercheur) ?></td>
                <td><?= h($chercheur->PrenomChercheur) ?></td>
                <td><?= h($chercheur->NomChercheur) ?></td>
                <td class="actions">
                    <?php 
                        echo $this->Html->link(
                            $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                            array('action' => 'edit', $chercheur->CodeChercheur),
                            array('escape' => false) 
                        );
                         
                        echo $this->Form->postLink(
                            $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                            array('action' => 'delete', $chercheur->CodeChercheur),
                            array('escape' => false,"confirm"=>__('Êtes-vous sur de vouloir supprimer # {0}?', $chercheur->PrenomChercheur.' '.$chercheur->NomChercheur))
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
