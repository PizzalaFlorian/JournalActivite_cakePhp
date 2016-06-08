<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>
<div class="users index large-12 medium-12 columns content">
    <h3 class="center"><?= __('Table des Utilisateurs') ?></h3>
    <?php
        echo $this->Html->link(__('Inviter un Candidat'), ['controller'=>'administrateur','action' => 'createCandidat'],['class'=>'button']).' ';
        echo $this->Html->link(__('Inviter une liste de Candidats'), ['controller'=>'administrateur','action' => 'createCandidatList'],['class'=>'button']).' ';
        echo $this->Html->link(__('Inviter un Chercheur'), ['controller'=>'administrateur','action' => 'createChercheur'],['class'=>'button']).' '; 
        echo $this->Html->link(__('Inviter un Administrateur'), ['controller'=>'administrateur','action' => 'add'],['class'=>'button']);
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('login') ?></th>
                <th><?= $this->Paginator->sort('typeUser') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->ID) ?></td>
                <td><?= h($user->login) ?></td>
                <td><?= h($user->typeUser) ?></td>
                <td><?= h($user->email) ?></td>
                <td class="actions">
                    <?php 
                        echo $this->Html->link(
                            $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                            array('action' => 'edit', $user->ID),
                            array('escape' => false) 
                        );
                         
                        echo $this->Form->postLink(
                            $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                            array('action' => 'delete', $user->ID),
                            array('escape' => false,"confirm"=>__('Êtes-vous sur de vouloir supprimer # {0}?', $user->email))
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
