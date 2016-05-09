<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nouveau Message'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('Retour'), ['action' => 'users']) ?></li>
    </ul>
</nav>
<div class="messages index large-9 medium-8 columns content">
    <h3>Mes <?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
				<th>target</th>
                <th><?= $this->Paginator->sort('DateEnvoi') ?></th>
                <th><?= $this->Paginator->sort('Sujet') ?></th>
                <th><?= $this->Paginator->sort('IDExpediteur') ?></th>
                <th><?= $this->Paginator->sort('IDRecepteur') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
				<td><input type="checkbox"/></td>
                <td><?php if(! h($message->Lu)){ echo "<b>"; } ?><?= h($message->DateEnvoi) ?><?php if(! h($message->Lu)){ echo "</b>"; } ?></td>
                <td><?php if(! h($message->Lu)){ echo "<b>"; } ?><?= $this->Html->link(h($message->Sujet), ['action' => 'view', $message->IDMessage]) ?><?php if(! h($message->Lu)){ echo "</b>"; } ?></td>
                <td><?php if(! h($message->Lu)){ echo "<b>"; } ?><?= $this->Number->format($message->IDExpediteur) ?><?php if(! h($message->Lu)){ echo "</b>"; } ?></td>
                <td><?php if(! h($message->Lu)){ echo "<b>"; } ?><?= $this->Number->format($message->IDRecepteur) ?><?php if(! h($message->Lu)){ echo "</b>"; } ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->IDMessage], ['confirm' => __('Are you sure you want to delete # {0}?', $message->IDMessage)]) ?>
					<?= $this->Html->link(__('Lu'), ['action' => 'view', $message->IDMessage]) ?>
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
