<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');


    use Cake\ORM\TableRegistry;
    $max = TableRegistry::get('dispositif')
            ->find()
            ->select(array('code'=>'max(CodeDispositif)'))
            ->first();

?>
<div class="dispositif form large-12 medium-11 columns content">
    <?= $this->Form->create($dispositif) ?>
    <fieldset>
        <legend><?= __('Ajouter un Dispositif') ?></legend>
        <?php
            echo $this->Form->input('CodeDispositif',['type'=>'number','required'=>true,'default'=>$max['code']+1]);
            echo $this->Form->input('NomDispositif');
        ?>
    </fieldset>
    <?= $this->Html->link(__('Retourner à la liste des dispositifs'), ['action' => 'index'],['class'=>'button']) ?>
    <?= $this->Form->button(__('Ajouter')) ?>
    <?= $this->Form->end() ?>
</div>
