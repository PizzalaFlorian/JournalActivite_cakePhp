<?php
    echo $this->element('sidebarChercheur');
    echo $this->Form->postLink(
                __('Supprimer cette activite'),
                ['action' => 'delete', $activite->CodeActivite],
                ['confirm' => __('Are you sure you want to delete # {0}?', $activite->CodeActivite)]
            );
    echo '<br>';
    echo $this->Html->link(__('Retourner a la liste des activitées'), ['action' => 'index']);
?>

<div class="activite form large-12 medium-11 columns content">
    <?= $this->Form->create($activite) ?>
    <fieldset>
        <legend><?= __('Edit Activite') ?></legend>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
