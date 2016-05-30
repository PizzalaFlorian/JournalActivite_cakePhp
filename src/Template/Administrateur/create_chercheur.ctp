<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>
<div class="administrateur index large-11 medium-12 columns content">
    <?= $this->Form->create($user) ?>
 
    <fieldset>
        <legend><?= __('Ajouter le chercheur') ?></legend>
        <?php
            echo $this->Form->input('login',['type'=>'hidden','value'=>$login]);
            echo $this->Form->input('typeUser',['type'=>'hidden','value'=>'chercheur']);
            echo $this->Form->input('password',['type'=>'hidden','value'=>$password]);
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Html->link(__('Retour'), ['action' => 'index'],['class'=>'button']) ?>
    <?= $this->Form->button(__('Inviter')) ?>
    <?= $this->Form->end() ?>
    <br>
</div>