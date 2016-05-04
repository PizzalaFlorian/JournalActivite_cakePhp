<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activite'), ['action' => 'edit', $activite->CodeActivite]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activite'), ['action' => 'delete', $activite->CodeActivite], ['confirm' => __('Are you sure you want to delete # {0}?', $activite->CodeActivite)]) ?> </li>
        <li><?= $this->Html->link(__('List Activite'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activite'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activite view large-9 medium-8 columns content">
    <h3><?= h($activite->CodeActivite) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('NomActivite') ?></th>
            <td><?= h($activite->NomActivite) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeActivite') ?></th>
            <td><?= $this->Number->format($activite->CodeActivite) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCategorie') ?></th>
            <td><?= $this->Number->format($activite->CodeCategorie) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('DescriptifActivite') ?></h4>
        <?= $this->Text->autoParagraph(h($activite->DescriptifActivite)); ?>
    </div>
</div>
