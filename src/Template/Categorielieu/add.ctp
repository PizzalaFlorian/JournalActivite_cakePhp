<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->link(__('Retourner a la liste des categories'), ['action' => 'index']);
    
    use Cake\ORM\TableRegistry;
    $max = TableRegistry::get('categorielieu')
            ->find()
            ->select(array('code'=>'max(CodeCategorieLieux)'))
            ->first();


?>
<div class="categorielieu form large-12 medium-11 columns content">
    <?= $this->Form->create($categorielieu) ?>
    <fieldset>
        <legend><?= __('Add Categorielieu') ?></legend>
        <?php
            echo $this->form->input('CodeCategorieLieux',['required'=>true,'default'=>$max['code']+1]);
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
