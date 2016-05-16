<?php
    use Cake\ORM\TableRegistry;
    echo $this->element('sidebarChercheur');
    $liste_categorie = TableRegistry::get('categorielieu')
            ->find()
            ->toArray();
    $lieu = TableRegistry::get('lieu')
            ->find()
            ->select(array('code'=>'max(CodeLieux)'))
            ->first();
?>

<div class="lieu index large-12 medium-11 columns content">
<?= $this->Html->link(__('Retourner a la liste des lieux'), ['action' => 'index']) ?>
    <?= $this->Form->create($lieu) ?>
    <fieldset>
        <legend><?= __('Add Lieu') ?></legend>
        <?php
            echo $this->Form->input('CodeLieux',['type'=>'number','required'=>'true','default'=>$lieu['code']+1]);
            echo $this->Form->input('NomLieux');
            //echo $this->Form->input('CodeCategorieLieux');
            echo '<div class="input select required">';
            echo $this->Form->label('CodeCategorieLieux');
            echo '<select name="CodeCategorieLieux">';
            foreach ($liste_categorie as $categorie) {
                    echo '<option value="'.$categorie['CodeCategorieLieux'].'">'.$categorie['CodeCategorieLieux'].
                ' - '.$categorie['NomCategorie'].'</option>';
            }
            echo '</select></div>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
