<?php
    use Cake\ORM\TableRegistry;
    echo $this->element('sidebarChercheur');
//    echo $this->Html->css('main_custom');
    $liste_categorie = TableRegistry::get('categorielieu')
            ->find()
            ->toArray();
    $lieu = TableRegistry::get('lieu')
            ->find()
            ->select(array('code'=>'max(CodeLieux)'))
            ->first();
?>

<div class="lieu index large-10 medium-11 columns content">
    <?= $this->Form->create($lieu) ?>
    <fieldset>
        <legend><?= __('Ajouter un Lieu ou un Transport') ?></legend>
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
    <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button")).' ';
        echo $this->Form->button(__('Ajouter')); ?>
    <?= $this->Form->end() ?>
</div>
