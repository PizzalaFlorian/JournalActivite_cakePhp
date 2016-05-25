<?php
    echo $this->element($sideBar);
?>
<div class="contacts view large-9 medium-8 columns content">
	<?= $this->Html->link(__('Répondre'), ['action' => 'repondre', $contact->ID]) ?> <br/>
	<?= $this->Html->link(__('Supprimer'), ['action' => 'delete', $contact->ID], ['confirm' => __('Etes vous sur de vouloir supprimer ce message?', $contact->ID)]) ?> <br/>
	<?= $this->Html->link(__('Retour'), ['controller' => 'contacts']) ?>
    <table class="vertical-table">
	    <tr>
            <th><?= __('Sujet : ') ?></th>
            <td><?= h($contact->sujet) ?></td>
        </tr>
        <tr>
            <th><?= __('De : ') ?></th>
            <td><?= h($contact->expediteur) ?></td>
        </tr>
        <tr>
            <th><?= __('Date : ') ?></th>
            <td><?= h($contact->dateEnvoie) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Contenue') ?></h4>
        <?= $this->Text->autoParagraph(h($contact->contenue)); ?>
    </div>
</div>
