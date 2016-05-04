<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Utilisateur'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="utilisateur index large-9 medium-8 columns content">
    <h3><?= __('Utilisateur') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Login') ?></th>
                <th><?= $this->Paginator->sort('TypeUser') ?></th>
                <th><?= $this->Paginator->sort('MotDePasse') ?></th>
                <th><?= $this->Paginator->sort('MailCandidat') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateur as $utilisateur): ?>
            <tr>
                <td><?= $this->Number->format($utilisateur->ID) ?></td>
                <td><?= h($utilisateur->Login) ?></td>
                <td><?= h($utilisateur->TypeUser) ?></td>
                <td><?= h($utilisateur->MotDePasse) ?></td>
                <td><?= h($utilisateur->MailCandidat) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $utilisateur->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $utilisateur->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $utilisateur->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $utilisateur->ID)]) ?>
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
