<?php
    echo $this->element($sideBar);
    echo $this->Html->css('messagerie');
?>
<div id="content">
    <div class="messages index large-12 medium-11 columns content">
        <div class="navbar">
        <?= $this->Html->link(__('Messagerie'), ['controller' => 'messages'],array('class' => 'button')) ?> <br/>
        <h3>Historique messages envoyés</h3>
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
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $message->IDMessage], ['confirm' => __('Êtes-vous sûr de vouloir supprimer ce message?', $message->IDMessage)]) ?>
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