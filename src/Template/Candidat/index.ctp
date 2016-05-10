<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Candidat'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="candidat index large-9 medium-8 columns content">
    <h3><?= __('Candidat') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCandidat') ?></th>
                <th><?= $this->Paginator->sort('NomCandidat') ?></th>
                <th><?= $this->Paginator->sort('PrenomCandidat') ?></th>
                <th><?= $this->Paginator->sort('Age') ?></th>
                <th><?= $this->Paginator->sort('GenreCandidat') ?></th>
                <th><?= $this->Paginator->sort('LieuxEtude') ?></th>
                <th><?= $this->Paginator->sort('NiveauEtude') ?></th>
                <th><?= $this->Paginator->sort('DiplomePrep') ?></th>
                <th><?= $this->Paginator->sort('EtatCivil') ?></th>
                <th><?= $this->Paginator->sort('NombreEnfant') ?></th>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidat as $candidat): ?>
            <tr>
                <td><?= $this->Number->format($candidat->CodeCandidat) ?></td>
                <td><?= h($candidat->NomCandidat) ?></td>
                <td><?= h($candidat->PrenomCandidat) ?></td>
                <td><?= $this->Number->format($candidat->Age) ?></td>
                <td><?= h($candidat->GenreCandidat) ?></td>
                <td><?= h($candidat->LieuxEtude) ?></td>
                <td><?= h($candidat->NiveauEtude) ?></td>
                <td><?= h($candidat->DiplomePrep) ?></td>
                <td><?= h($candidat->EtatCivil) ?></td>
                <td><?= $this->Number->format($candidat->NombreEnfant) ?></td>
                <td><?= $this->Number->format($candidat->ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $candidat->CodeCandidat]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidat->CodeCandidat]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidat->CodeCandidat], ['confirm' => __('Are you sure you want to delete # {0}?', $candidat->CodeCandidat)]) ?>
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
