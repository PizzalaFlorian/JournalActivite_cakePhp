<?php
    echo $this->element($sideBar);
?>
<div class="messages view large-12 medium-11 columns content">
    <div class="navbar">
        <fieldset>
            <?= $this->Html->link(__('Répondre'), ['action' => 'repondre', $message->IDMessage]) ?> <br/>
            <?= $this->Html->link(__('Supprimer'), ['action' => 'delete', $message->IDMessage], ['confirm' => __('Etes vous sur de vouloir supprimer ce message?', $message->IDMessage)]) ?> <br/>
            <?= $this->Html->link(__('Retour'), ['controller' => 'messages']) ?>
        </fieldset>
    </div>
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