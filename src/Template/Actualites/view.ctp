<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Actualite'), ['action' => 'edit', $actualite->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Actualite'), ['action' => 'delete', $actualite->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $actualite->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Actualites'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Actualite'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="actualites view large-9 medium-8 columns content">
    <h3><?= h($actualite->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Sujet') ?></th>
            <td><?= h($actualite->Sujet) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($actualite->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($actualite->Date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Contenue') ?></h4>
        <?= $this->Text->autoParagraph(h($actualite->Contenue)); ?>
    </div>
</div>
