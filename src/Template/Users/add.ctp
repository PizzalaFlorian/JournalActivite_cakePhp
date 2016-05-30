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
            echo $this->Form->input('password');
            echo $this->Form->input('comfirmez password',['type'=>'password','required'=>true]);
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('S\'inscrire')) ?>
    <?= $this->Form->end() ?>
</div>
