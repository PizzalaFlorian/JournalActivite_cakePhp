<?php
    echo $this->element('sidebarAdmin');
?>
<div class="users index large-11 medium-12 columns content">
    <h3><?= __('Utilisateurs') ?></h3>
    <?= $this->Html->link(__('Inviter un Candidat'), ['controller'=>'administrateur','action' => 'createCandidat']) ?>
    <br>
    <?= $this->Html->link(__('Inviter une liste de Candidats'), ['controller'=>'administrateur','action' => 'createCandidatList']) ?>
    <br>
    <?= $this->Html->link(__('Inviter un chercheur'), ['controller'=>'administrateur','action' => 'createChercheur']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('login') ?></th>
                <th><?= $this->Paginator->sort('typeUser') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->ID) ?></td>
                <td><?= h($user->login) ?></td>
                <td><?= h($user->typeUser) ?></td>
                <td><?= h($user->email) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $user->ID)]) ?>
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
