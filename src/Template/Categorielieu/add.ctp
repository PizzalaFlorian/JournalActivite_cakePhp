<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
    
    use Cake\ORM\TableRegistry;
    $max = TableRegistry::get('categorielieu')
            ->find()
            ->select(array('code'=>'max(CodeCategorieLieux)'))
            ->first();


?>
<div class="categorielieu form large-12 medium-11 columns content">
    <?= $this->Form->create($categorielieu) ?>
    <fieldset>
        <legend><?= __('Ajouter une categorie de lieu') ?></legend>
        <?php
            echo $this->form->input('CodeCategorieLieux',['required'=>true,'default'=>$max['code']+1]);
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Ajouter')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link(__('Retourner a la liste des categories'), ['action' => 'index'],array("class"=>"button")) ?>
</div>
