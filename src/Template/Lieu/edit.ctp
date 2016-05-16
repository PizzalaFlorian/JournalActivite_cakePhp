<?php
    use Cake\ORM\TableRegistry;
    echo $this->element('sidebarChercheur');
    $liste_categorie = TableRegistry::get('categorielieu')
            ->find()
            ->toArray();

    echo $this->Form->postLink(
                __('Supprimer ce lieu'),
                ['action' => 'delete', $lieu->CodeLieux],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lieu->CodeLieux)]
            );
    echo '<br>';
    echo $this->Html->link(__('Retourner a la liste des lieux'), ['action' => 'index']);
?>
<div class="lieu form large-12 medium-11 columns content">
    <?= $this->Form->create($lieu) ?>
    <fieldset>
        <legend><?= __('Edit Lieu') ?></legend>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
