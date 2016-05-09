<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau Message'), ['action' => 'nouveau']) ?></li>
        <li><?= $this->Html->link(__('Message envoyé'), ['action' => 'view']) ?></li>
        <li><?= $this->Html->link(__('Retour'), ['action' => 'users']) ?></li>
    </ul>
</nav>
<div class="messages index large-9 medium-8 columns content">
    <h3>Mes <?= __('Messages') ?></h3>
    <!-- Menu Messagerie -->
    <div class="navbar"><button>Marquer comme non lu</button></div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th></th>
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
                <td>
                    <input type="checkbox"/>
                </td>
                <td class="<?php echo $lu; ?>">
                        <?= h($message->DateEnvoi) ?>
                </td>
                <td class="<?php echo $lu; ?>">
                    <?= $this->Html->link(h(substr($message->Sujet, 0, 15)), ['action' => 'view', $message->IDMessage]) ?>
                </td>
                <td class="<?php echo $lu; ?>">
                    Candidat <?= $this->Number->format($message->IDExpediteur) ?>
                </td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Répondre'), ['action' => 'repondre', $message->IDMessage])?><br/>
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
