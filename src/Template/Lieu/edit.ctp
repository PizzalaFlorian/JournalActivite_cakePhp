<?php
    use Cake\ORM\TableRegistry;
    echo $this->element('sidebarChercheur');
    $liste_categorie = TableRegistry::get('categorielieu')
            ->find()
            ->toArray();
?>
<div class="lieu form large-12 medium-11 columns content">
    <?= $this->Form->create($lieu) ?>
    <fieldset>
        <legend><?= __('Modifier ce Lieu/Transport') ?></legend>
        <?php
            echo $this->Form->input('NomLieux',['default'=>$lieu['NomLieux']]);
            //echo $this->Form->input('CodeCategorieLieux',['default'=>$data['CodeCategorieLieux']]);
            echo '<div class="input select required">';
            echo $this->Form->label('CodeCategorieLieux');
            echo '<select name="CodeCategorieLieux">';
            foreach ($liste_categorie as $categorie) {
                if($lieu['CodeCategorieLieux']==$categorie['CodeCategorieLieux'])
                    echo '<option value="'.$categorie['CodeCategorieLieux'].'" selected>'.$categorie['CodeCategorieLieux'].
                ' - '.$categorie['NomCategorie'].'</option>';
                else
                    echo '<option value="'.$categorie['CodeCategorieLieux'].'">'.$categorie['CodeCategorieLieux'].
                ' - '.$categorie['NomCategorie'].'</option>';
            }
            echo '</select></div>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
    <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button"))
            .' '.
            $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $lieu->CodeLieux],
                array("class"=>"button",'confirm' => __('Êtes vous sur de vouloir supprimer ce lieu/transport : {0}?', $lieu->NomLieux))
            );
    ?>
</div>
