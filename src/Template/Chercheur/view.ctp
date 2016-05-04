<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Chercheur'), ['action' => 'edit', $chercheur->CodeChercheur]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Chercheur'), ['action' => 'delete', $chercheur->CodeChercheur], ['confirm' => __('Are you sure you want to delete # {0}?', $chercheur->CodeChercheur)]) ?> </li>
        <li><?= $this->Html->link(__('List Chercheur'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chercheur'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="chercheur view large-9 medium-8 columns content">
    <h3><?= h($chercheur->CodeChercheur) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('NomChercheur') ?></th>
            <td><?= h($chercheur->NomChercheur) ?></td>
        </tr>
        <tr>
            <th><?= __('PrenomChercheur') ?></th>
            <td><?= h($chercheur->PrenomChercheur) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeChercheur') ?></th>
            <td><?= $this->Number->format($chercheur->CodeChercheur) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($chercheur->ID) ?></td>
        </tr>
    </table>
</div>
