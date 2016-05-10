<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau Message'), ['action' => 'nouveau']) ?></li>
        <li><?= $this->Html->link(__('Message envoyé'), ['action' => 'view']) ?></li>
        <li><?= $this->Html->link(__('Retour'), ['action' => 'users']) ?></li>
    </ul>
</nav>
<div class="actualites index large-9 medium-8 columns content">
    <h3>Actualités</h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
                <th><?= $this->Paginator->sort('DateEnvoi') ?></th>
                <th><?= $this->Paginator->sort('Expediteur') ?></th>
                <th><?= $this->Paginator->sort('ContenuMessage') ?></th>
        </thead>
        <tbody>
        </tbody>
    </table>


</div>
<div class="messages index large-9 medium-8 columns content">
    <h3>Mes <?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('DateEnvoi') ?></th>
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
                    <?= $this->Html->link(h(substr($message->Sujet, 0, 15)), ['action' => 'view', $message->IDMessage]) ?>
                </td>
                <!-- NOM DE L'EXPEDITEUR -->
                <td class="<?php echo $lu; ?>">
                    Candidat <?= $this->Number->format($message->IDExpediteur) ?>
                </td>
                <!-- ACTIONS -->
                <td class="actions">
                    <!-- REPONDRE -->  
                    <?= $this->Form->postLink(__('Répondre'), ['action' => 'repondre', $message->IDMessage])?>
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
