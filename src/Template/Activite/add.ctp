<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>

<div class="activite form large-10 medium-11 columns content">
    <?= $this->Form->create($activite) ?>
    <fieldset>
        <legend><?= __('Ajouter une Activité') ?></legend>
        <?php
            echo $this->Form->input('CodeActivite',['type'=>'number']);
            echo $this->Form->input('NomActivite');
            echo $this->Form->input('DescriptifActivite');
            echo '<div class="input select required">';
            echo $this->Form->label('CodeCategorie');
            echo '<select name="CodeCategorie">';
            $liste_categorie = get_CategorieActivite();
            foreach ($liste_categorie as $categorie) {
                if($activite['CodeCategorie'] == $categorie['CodeCategorieActivite'])
                    echo '<option value="'.$categorie['CodeCategorieActivite'].'" selected>'.$categorie['CodeCategorieActivite'].
                ' - '.$categorie['NomCategorie'].'</option>';
                else
                    echo '<option value="'.$categorie['CodeCategorieActivite'].'">'.$categorie['CodeCategorieActivite'].
                ' - '.$categorie['NomCategorie'].'</option>';
            }
            echo '</select></div>';
        ?>
    </fieldset>
    <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button")).' '.$this->Form->button(__('Ajouter')); ?>
    <?= $this->Form->end() ?>

</div>
