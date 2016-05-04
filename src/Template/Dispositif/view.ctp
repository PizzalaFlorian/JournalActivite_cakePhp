<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dispositif'), ['action' => 'edit', $dispositif->CodeDispositif]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dispositif'), ['action' => 'delete', $dispositif->CodeDispositif], ['confirm' => __('Are you sure you want to delete # {0}?', $dispositif->CodeDispositif)]) ?> </li>
        <li><?= $this->Html->link(__('List Dispositif'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dispositif'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dispositif view large-9 medium-8 columns content">
    <h3><?= h($dispositif->CodeDispositif) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('NomDispositif') ?></th>
            <td><?= h($dispositif->NomDispositif) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeDispositif') ?></th>
            <td><?= $this->Number->format($dispositif->CodeDispositif) ?></td>
        </tr>
    </table>
</div>
