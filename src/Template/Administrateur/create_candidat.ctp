<?php
    echo $this->element('sidebarAdmin');
?>
<div class="administrateur index large-11 medium-12 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Inviter le Candidat') ?></legend>
        <?php
            echo $this->Form->input('login',['type'=>'hidden','value'=>$login]);
            echo $this->Form->input('typeUser',['type'=>'hidden','value'=>'candidat']);
            echo $this->Form->input('password',['type'=>'hidden','value'=>$password]);
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Html->link(__('Retour'), ['action' => 'index'],['class'=>'button']) ?>
    <?= $this->Form->button(__('Inviter')) ?>
    <?= $this->Form->end() ?>
    <br>
</div>