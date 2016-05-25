<?php
    echo $this->element($sideBar);
	echo $this->Html->css('messagerie');
?>
<div class="contacts index large-9 medium-8 columns content">
    <h3><?= __('Messagerie') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
			    <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('expediteur') ?></th>
                <th><?= $this->Paginator->sort('sujet') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
				<?php $lu = contact_Lu($contact); ?>
			    <td class="<?php echo $lu; ?>">
					<?= h($contact->dateEnvoie) ?>
				</td>
                <td class="<?php echo $lu; ?>">
					<?= $this->Html->link(h(substr($contact->expediteur, 0, 40)), ['action' => 'view', $contact->ID]) ?>
				</td>
                <td class="<?php echo $lu; ?>">
				    <?= $this->Html->link(h(substr($contact->sujet, 0, 30)), ['action' => 'view', $contact->ID]) ?>
				</td>
				
                <td class="actions">
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $contact->ID], ['confirm' => __('Êtes-vous sûr de vouloir supprimer ce message?', $contact->ID)]) ?>
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
