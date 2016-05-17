<?php
    echo $this->element($sideBar);
    echo $this->Html->css('messagerie');
?>
<nav id="messagerieMenu" class="large-2 medium-3 columns">
    <div><?= $this->Html->link(__('Nouveau Message'), ['action' => 'nouveau']) ?></div>
    <div><?= $this->Html->link(__('Messages envoyés'), ['action' => 'envoie']) ?></div>
</nav>




<div class="messages index large-12 medium-11 columns content">
    <h3>Mes <?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Reçu le') ?></th>
                <th><?= $this->Paginator->sort('Sujet') ?></th>
                <th><?= $this->Paginator->sort('Expediteur') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr >
                <?php $lu = message_Lu($message); ?>
                <!-- DATE D'ENVOIE -->
                <td class="<?php echo $lu; ?>">
                        <?= h($message->DateEnvoi) ?>
                </td>
                <!-- LIEN AFFICHE LE MESSAGE -->
                <td class="<?php echo $lu; ?>">
                    <?= $this->Html->link(h(substr($message->Sujet, 0, 30)), ['action' => 'view', $message->IDMessage]) ?>
                </td>
                <!-- NOM DE L'EXPEDITEUR -->
                <td class="<?php echo $lu; ?>">
                    <?php echo whoIsID($message->IDExpediteur); ?>
                </td>
                <!-- ACTIONS -->
                <td class="actions">
                    <!-- REPONDRE -->  
                    <?= $this->Html->link(__('Répondre'), ['action' => 'repondre', $message->IDMessage]) ?>
                    <br/>
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
