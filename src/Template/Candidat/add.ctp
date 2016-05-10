<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Candidat'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="candidat form large-9 medium-8 columns content">
    <?= $this->Form->create($candidat) ?>
    <fieldset>
        <legend><?= __('Add Candidat') ?></legend>
        <?php
            echo $this->Form->input('NomCandidat');
            echo $this->Form->input('PrenomCandidat');
            echo $this->Form->input('Age');
            echo $this->Form->input('GenreCandidat');
            echo $this->Form->input('LieuxEtude');
            echo $this->Form->input('NiveauEtude');
            echo $this->Form->input('DiplomePrep');
            echo $this->Form->input('EtatCivil');
            echo $this->Form->input('NombreEnfant');
            echo $this->Form->input('ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
