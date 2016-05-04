<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Utilisateur'), ['action' => 'edit', $utilisateur->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Utilisateur'), ['action' => 'delete', $utilisateur->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $utilisateur->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Utilisateur'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Utilisateur'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="utilisateur view large-9 medium-8 columns content">
    <h3><?= h($utilisateur->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Login') ?></th>
            <td><?= h($utilisateur->Login) ?></td>
        </tr>
        <tr>
            <th><?= __('TypeUser') ?></th>
            <td><?= h($utilisateur->TypeUser) ?></td>
        </tr>
        <tr>
            <th><?= __('MotDePasse') ?></th>
            <td><?= h($utilisateur->MotDePasse) ?></td>
        </tr>
        <tr>
            <th><?= __('MailCandidat') ?></th>
            <td><?= h($utilisateur->MailCandidat) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($utilisateur->ID) ?></td>
        </tr>
    </table>
</div>
