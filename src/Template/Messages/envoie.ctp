<?php
    echo $this->element($sideBar);
//    echo $this->Html->css('messagerie');
//    echo $this->Html->css('main_custom');
//    echo $this->Html->css('responsive');
?>
<div id="content">
    <div class="messages index large-12 medium-11 columns content">
        <div class="navbar">
        <div class="center">    
            <?= $this->Html->link(__('Retour à la Messagerie'), ['controller' => 'messages'],array('class' => 'button')) ?> <br/>
        </div>
        <h3 class="center">Historique messages envoyés</h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Envoyé le') ?></th>
                    <th><?= $this->Paginator->sort('Sujet') ?></th>
                    <th><?= $this->Paginator->sort('À') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                <tr >
                    <!-- DATE D'ENVOIE -->
                    <td>
                            <?= h($message->DateEnvoi) ?>
                    </td>
                    <!-- LIEN AFFICHE LE MESSAGE -->
                    <td>
                        <?= $this->Html->link(h(substr($message->Sujet, 0, 30)), ['action' => 'view', $message->IDMessage]) ?>
                    </td>
                    <!-- NOM DE L'EXPEDITEUR -->
                    <td>
                        <?php echo whoIsID($message->userRecepteur); ?>
                    </td>
                    <!-- ACTIONS -->
                    <td class="actions">
                        <!-- SUPPRIMER -->  
                        <?php 
                            echo $this->Form->postLink(
                                $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                                ['action' => 'delete', $message->IDMessage, 'page'=>'envoie'],
                                array('escape' => false,'confirm' => __('Êtes-vous sûr de vouloir supprimer ce message?', $message->IDMessage)));
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
</div>