<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Occupation'), ['action' => 'edit', $occupation->CodeOccupation]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Occupation'), ['action' => 'delete', $occupation->CodeOccupation], ['confirm' => __('Are you sure you want to delete # {0}?', $occupation->CodeOccupation)]) ?> </li>
        <li><?= $this->Html->link(__('List Occupation'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Occupation'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="occupation view large-9 medium-8 columns content">
    <h3><?= h($occupation->CodeOccupation) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('CodeOccupation') ?></th>
            <td><?= $this->Number->format($occupation->CodeOccupation) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCandidat') ?></th>
            <td><?= $this->Number->format($occupation->CodeCandidat) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeLieux') ?></th>
            <td><?= $this->Number->format($occupation->CodeLieux) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeActivite') ?></th>
            <td><?= $this->Number->format($occupation->CodeActivite) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCompagnie') ?></th>
            <td><?= $this->Number->format($occupation->CodeCompagnie) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeDispositif') ?></th>
            <td><?= $this->Number->format($occupation->CodeDispositif) ?></td>
        </tr>
        <tr>
            <th><?= __('HeureDebut') ?></th>
            <td><?= h($occupation->HeureDebut) ?></td>
        </tr>
        <tr>
            <th><?= __('HeureFin') ?></th>
            <td><?= h($occupation->HeureFin) ?></td>
        </tr>
    </table>
</div>
