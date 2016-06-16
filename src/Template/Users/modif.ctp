

<?php
    if($_SESSION['Auth']['User']['typeUser']=='candidat')
        echo $this->element('sidebarCandidat');
    if($_SESSION['Auth']['User']['typeUser']=='chercheur')
        echo $this->element('sidebarChercheur');
    if($_SESSION['Auth']['User']['typeUser']=='admin')
        echo $this->element('sidebarAdmin');

    echo $this->Html->css('main_custom');
?>
<div class="users form large-11 medium-12 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Modifier votre compte') ?></legend>
        <?php
            echo $this->Form->input('login');
            echo $this->Form->input('password',['type'=>'hidden']);
            echo $this->Form->label('nouveau password', 'Nouveau mot de passe');
            echo $this->Form->input('nouveau password',['type'=>'password','label'=>false]);
            echo $this->Form->label('comfirmez password', 'Comfirmer le nouveau mot de passe'); 
            echo $this->Form->input('comfirmez password',['type'=>'password','required'=>true,'label'=>false]);
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
</div>
