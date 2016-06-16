<?php
    echo $this->Html->css('main_custom');
?>

<div class="users form large-11 medium-12 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Inscription') ?></legend>
        <?php
            echo $this->Form->input('login');
            echo $this->Form->input('typeUser',['type'=>'hidden','value'=>'candidat']);
            echo $this->Form->label('password', 'Mot de passe *'); 
            echo $this->Form->input('password',['label'=>false]);
            echo $this->Form->label('comfirmez password', 'Comfirmer le mot de passe *'); 
            echo $this->Form->input('comfirmez password',['type'=>'password','required'=>true,'label'=>false]);
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('S\'inscrire')) ?>
    <?= $this->Form->end() ?>
</div>
