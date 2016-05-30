<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>

<div class="activite form large-12 medium-11 columns content">
    <?= $this->Form->create($activite) ?>
    <fieldset>
        <legend><?= __('Modifier l\'Activitée') ?></legend>
        <?php
            echo $this->Form->input('NomActivite');
            echo $this->Form->input('DescriptifActivite');
            echo '<div class="input select required">';
            echo $this->Form->label('CodeCategorie');
            echo '<select name="CodeCategorie">';
            $liste_categorie = get_CategorieActivite();
            foreach ($liste_categorie as $categorie) {
                if($activite['CodeCategorie'] == intval($categorie['CodeCategorieActivite']))
                    echo '<option value="'.$categorie['CodeCategorieActivite'].'" selected>'.$categorie['CodeCategorieActivite'].' '.$categorie['NomCategorie'].'</option>';
                else
                    echo '<option value="'.$categorie['CodeCategorieActivite'].'">'.$categorie['CodeCategorieActivite'].' '.$categorie['NomCategorie'].'</option>';
            }
            echo '</select></div>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
    <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button"))
            .' '.
            $this->Form->postLink(
                __('Supprimer cette activite'),
                ['action' => 'delete', $activite->CodeActivite],array("class"=>"button",'confirm' => __('Êtes vous sur de vouloir supprimer l\'activitée : {0}?', $activite->NomActivite))
            );
    ?>
</div>
