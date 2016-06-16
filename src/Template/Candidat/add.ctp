<?php
    echo $this->Html->css('main_custom');
?>
<div class="candidat form large-11 medium-12 columns content">
    <?= $this->Form->create($candidat) ?>
    <fieldset>
        <legend><?= __('S\'inscrire') ?></legend>
        <p> Vos informations nominatives ne seront jamais transmises aux chercheurs ou aux autres participants à l'étude.
        Cependant, il est nécéssaire que vos nom et prénom soient correctement remplis pour la génération du certificat de participation à l'étude.</p>
        <?php
            echo $this->Form->input('NomCandidat',['required'=>'true']);
            echo $this->Form->label('PrenomCandidat', 'Prénom Candidat *');
            echo $this->Form->input('PrenomCandidat',['required'=>'true','label'=>false]);
            echo $this->Form->label('Age', 'Âge *');
            echo $this->Form->input('Age',['required'=>'true','label'=>false]);
        ?>
        <div class="input select required">
        <?php
            echo $this->Form->label('GenreCandidat');
            echo $this->Form->select(
                'GenreCandidat',
                ['homme'=>'homme', 'femme'=>'femme']
            );
        ?>
        </div>
        <?php
            echo $this->Form->label('LieuxEtude', 'Lieu d\'étude *');
            echo $this->Form->input('LieuxEtude',['required'=>'true','label'=>false]);
        ?>
        <div class="input select required">
        <?php
            echo $this->Form->label('NiveauEtude','Niveau d\'étude');
            echo $this->Form->select(
                'NiveauEtude',
                ['Bac +1'=>'Bac +1',
                 'Bac +2'=>'Bac +2',
                 'Bac +3'=>'Bac +3',
                 'Bac +4'=>'Bac +4',
                 'Bac +5'=>'Bac +5', 
                 'Bac +6'=>'Bac +6', 
                 'Bac +7'=>'Bac +7',
                 'Bac +8'=>'Bac +8', 
                 'Bac +9'=>'Bac +9', 
                 'Bac +10'=>'Bac +10', 
                 'Bac +11'=>'Bac +11']
            );
        ?>
        </div>
        <div class="input select required">
        <?php    
            echo $this->Form->label('DiplomePrep','Diplôme préparé');
            echo $this->Form->select(
                'DiplomePrep',
                ["Licence"=>"Licence", 
                 "Master"=>"Master",
                 "Doctorat"=>"Doctorat",
                 "BTS"=>"BTS",
                 "DUT"=>"DUT",
                 "Diplôme d'ingénieur"=>"Diplôme d'ingénieur",
                 "Diplôme médical et paramédical"=>"Diplôme médical et paramédical",
                 "Autre diplôme"=>"Autre diplôme"
                 ]
            );
        ?>
        </div>
        <div class="input select required">
        <?php
            echo $this->Form->label('EtatCivil');
            echo $this->Form->select(
                'EtatCivil',
                ["Marié(e)"=>"Marié(e)",
                "Pacsé(e)"=>"Pacsé(e)",
                "Non marié(e) avec partenaire stable"=>"Non marié(e) avec partenaire stable",
                "Non marié(e) sans partenaire stable"=>"Non marié(e) sans partenaire stable",
                "Veuve, veuf"=>"Veuve, veuf",
                "Divorcé"=>"Divorcé"
                ]
            );
        ?>
        </div>
        <?php
            echo $this->Form->input('NombreEnfant',['required'=>'true']);
        ?>
        <?php
            echo $this->Form->input('ID',['type'=>'hidden','value'=>$_SESSION['Auth']['User']['ID']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Terminer l\'inscription')) ?>
    <?= $this->Form->end() ?>
</div>
