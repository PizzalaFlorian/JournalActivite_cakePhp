<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>

<div class="candidat form large-11 medium-11 columns content">
    <?= $this->Form->create($candidat) ?>
    <fieldset>
        <legend><?= __('Modifier un candidat') ?></legend>
        <?php
            echo $this->Form->input('NomCandidat',['required'=>'true']);
            echo $this->Form->input('PrenomCandidat',['required'=>'true']);
            echo $this->Form->input('Age',['required'=>'true']);
        ?>
        <div class="input select required">
        <?php
            echo $this->Form->label('GenreCandidat');
            echo $this->Form->select(
                'GenreCandidat',
                ['homme'=>'homme', 'femme'=>'femme'],
                ['default' => $candidat['GenreCandidat']]
            );
        ?>
        </div>
        <?php
            echo $this->Form->input('LieuxEtude',['required'=>'true']);
        ?>
        <div class="input select required">
        <?php
            echo $this->Form->label('NiveauEtude');
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
                 'Bac +11'=>'Bac +11'],
                ['default' => $candidat['NiveauEtude']]
            );
        ?>
        </div>
        <div class="input select required">
        <?php    
            echo $this->Form->label('DiplomePrep');
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
                 ],
                ['default' => $candidat['DiplomePrep']]
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
                ],
                ['default' => $candidat['EtatCivil']]
            );
        ?>
        </div>
        <?php
            echo $this->Form->input('NombreEnfant',['required'=>'true']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
    <?php
        echo $this->Html->link(__('Retour'), ['action' => 'index'],['class'=>'button']).' '.$this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $candidat->CodeCandidat],
                ['class'=>'button',"confirm"=>__('Etes-vous sur de vouloir supprimer # {0}?', $candidat->PrenomCandidat.' '.$candidat->NomCandidat)]
            );
     
        ?>
</div>
