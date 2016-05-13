<?php
    echo $this->element('sidebarChercheur');
?>

<div class="activite form large-10 medium-11 columns content">
<?= $this->Html->link(__('Retour'), ['action' => 'index']) ?>
    <?= $this->Form->create($activite) ?>
    <fieldset>
        <legend><?= __('Add Activite') ?></legend>
        <?php
            echo $this->Form->input('CodeActivite',['type'=>'number']);
            echo $this->Form->input('NomActivite');
            echo $this->Form->input('DescriptifActivite');
            echo '<div class="input select required">';
            echo $this->Form->label('CodeCategorie');
            echo '<select name="CodeCategorie">';
            $liste_categorie = get_liste_categorie_activite();
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>
