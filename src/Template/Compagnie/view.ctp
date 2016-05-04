<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Compagnie'), ['action' => 'edit', $compagnie->CodeCompagnie]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Compagnie'), ['action' => 'delete', $compagnie->CodeCompagnie], ['confirm' => __('Are you sure you want to delete # {0}?', $compagnie->CodeCompagnie)]) ?> </li>
        <li><?= $this->Html->link(__('List Compagnie'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Compagnie'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="compagnie view large-9 medium-8 columns content">
    <h3><?= h($compagnie->CodeCompagnie) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('NomCompagnie') ?></th>
            <td><?= h($compagnie->NomCompagnie) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCompagnie') ?></th>
            <td><?= $this->Number->format($compagnie->CodeCompagnie) ?></td>
        </tr>
    </table>
</div>
