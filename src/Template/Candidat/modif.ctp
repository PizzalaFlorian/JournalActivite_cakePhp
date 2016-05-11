<?php
    use Cake\ORM\TableRegistry;
    echo $this->element('sidebarCandidat');
    $candidat = TableRegistry::get('candidat')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();
?>

<div class="candidat form large-9 medium-8 columns content">
    <?= $this->Form->create($candidat) ?>
    <fieldset>
        <legend><?= __('Edit Candidat') ?></legend>
        <?php
            echo $this->Form->input('NomCandidat');
            echo $this->Form->input('PrenomCandidat');
            echo $this->Form->input('Age');
        ?>
        <div class="input select required">
        <?php
            echo $this->Form->label('GenreCandidat');
            echo $this->Form->select(
                'GenreCandidat',
                ['homme', 'femme'],
                ['default' => $candidat['GenreCandidat']]
            );
        ?>
        </div>
        <?php
            echo $this->Form->input('LieuxEtude');
        ?>
        <div class="input select required">
        <?php
            echo $this->Form->label('NiveauEtude');
            echo $this->Form->select(
                'NiveauEtude',
                ['Bac +1', 'Bac +2', 'Bac +3', 'Bac +4', 'Bac +5', 'Bac +6', 'Bac +7', 'Bac +8', 'Bac +9', 'Bac +10', 'Bac +11'],
                ['default' => $candidat['NiveauEtude']]
            );
        ?>
        </div>
        <div class="input select required">
        <?php    
            echo $this->Form->label('DiplomePrep');
            echo $this->Form->select(
                'DiplomePrep',
                ["Licence", "Master","Doctorat","BTS","DUT","Diplôme d'ingénieur","Diplôme médical et paramédical","Autre diplôme"],
                ['default' => $candidat['DiplomePrep']]
            );
        ?>
        </div>
        <div class="input select required">
        <?php
            echo $this->Form->label('EtatCivil');
            echo $this->Form->select(
                'EtatCivil',
                ["Marié(e)","Pacsé(e)","Non marié(e) avec partenaire stable","Non marié(e) sans partenaire stable","Veuve, veuf","Divorcé"],
                ['default' => $candidat['EtatCivil']]
            );
        ?>
        </div>
        <?php
            echo $this->Form->input('NombreEnfant');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
