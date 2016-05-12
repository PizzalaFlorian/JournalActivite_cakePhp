<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Répondre'), ['action' => 'repondre', $message->IDMessage]) ?> </li>
        <li><?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $message->IDMessage], ['confirm' => __('Etes vous sur de vouloir supprimer ce message?', $message->IDMessage)]) ?> </li>
        <li><?= $this->Html->link(__('Messagerie'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messages view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th><?= __('Sujet :') ?></th>
            <td><?= h($message->Sujet) ?></td>
        </tr>
        <tr>
            <th><?= __('De :') ?></th>
            <td><?= $this->Number->format($message->IDExpediteur) ?></td>
        </tr>
        <tr>
            <th><?= __('Date :') ?></th>
            <td><?= h($message->DateEnvoi) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('') ?></h4>
        <?= $this->Text->autoParagraph(h($message->ContenuMessage)); ?>
    </div>
</div>