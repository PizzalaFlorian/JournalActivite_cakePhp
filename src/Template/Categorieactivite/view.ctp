<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Categorieactivite'), ['action' => 'edit', $categorieactivite->CodeCategorieActivite]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Categorieactivite'), ['action' => 'delete', $categorieactivite->CodeCategorieActivite], ['confirm' => __('Etes vous sur de vouloir supprimer # {0}?', $categorieactivite->CodeCategorieActivite)]) ?> </li>
        <li><?= $this->Html->link(__('List Categorieactivite'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categorieactivite'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categorieactivite view large-9 medium-8 columns content">
    <h3><?= h($categorieactivite->CodeCategorieActivite) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('NomCategorie') ?></th>
            <td><?= h($categorieactivite->NomCategorie) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCategorieActivite') ?></th>
            <td><?= $this->Number->format($categorieactivite->CodeCategorieActivite) ?></td>
        </tr>
    </table>
</div>
