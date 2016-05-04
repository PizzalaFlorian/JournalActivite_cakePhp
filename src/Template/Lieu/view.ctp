<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lieu'), ['action' => 'edit', $lieu->CodeLieux]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lieu'), ['action' => 'delete', $lieu->CodeLieux], ['confirm' => __('Are you sure you want to delete # {0}?', $lieu->CodeLieux)]) ?> </li>
        <li><?= $this->Html->link(__('List Lieu'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lieu'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lieu view large-9 medium-8 columns content">
    <h3><?= h($lieu->CodeLieux) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('NomLieux') ?></th>
            <td><?= h($lieu->NomLieux) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeLieux') ?></th>
            <td><?= $this->Number->format($lieu->CodeLieux) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCategorieLieux') ?></th>
            <td><?= $this->Number->format($lieu->CodeCategorieLieux) ?></td>
        </tr>
    </table>
</div>
