<?php
    echo $this->element('sidebarAdmin');
?>
<div class="administrateur index large-11 medium-12 columns content">
    <?= $this->Html->link(__('Retour'), ['action' => 'index']) ?>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <br>
</div>