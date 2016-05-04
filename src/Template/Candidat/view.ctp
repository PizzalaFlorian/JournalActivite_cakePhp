<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Candidat'), ['action' => 'edit', $candidat->CodeCandidat]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Candidat'), ['action' => 'delete', $candidat->CodeCandidat], ['confirm' => __('Are you sure you want to delete # {0}?', $candidat->CodeCandidat)]) ?> </li>
        <li><?= $this->Html->link(__('List Candidat'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidat'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="candidat view large-9 medium-8 columns content">
    <h3><?= h($candidat->CodeCandidat) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('GenreCandidat') ?></th>
            <td><?= h($candidat->GenreCandidat) ?></td>
        </tr>
        <tr>
            <th><?= __('LieuxEtude') ?></th>
            <td><?= h($candidat->LieuxEtude) ?></td>
        </tr>
        <tr>
            <th><?= __('NiveauEtude') ?></th>
            <td><?= h($candidat->NiveauEtude) ?></td>
        </tr>
        <tr>
            <th><?= __('DiplomePrep') ?></th>
            <td><?= h($candidat->DiplomePrep) ?></td>
        </tr>
        <tr>
            <th><?= __('EtatCivil') ?></th>
            <td><?= h($candidat->EtatCivil) ?></td>
        </tr>
        <tr>
            <th><?= __('CodeCandidat') ?></th>
            <td><?= $this->Number->format($candidat->CodeCandidat) ?></td>
        </tr>
        <tr>
            <th><?= __('Age') ?></th>
            <td><?= $this->Number->format($candidat->Age) ?></td>
        </tr>
        <tr>
            <th><?= __('NombreEnfant') ?></th>
            <td><?= $this->Number->format($candidat->NombreEnfant) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($candidat->ID) ?></td>
        </tr>
    </table>
</div>
