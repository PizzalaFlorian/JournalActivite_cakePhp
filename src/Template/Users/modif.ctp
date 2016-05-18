

<?php
    if($_SESSION['Auth']['User']['typeUser']=='candidat')
        echo $this->element('sidebarCandidat');
    if($_SESSION['Auth']['User']['typeUser']=='chercheur')
        echo $this->element('sidebarChercheur');
?>
<div class="users form large-11 medium-12 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('login');
            echo $this->Form->input('password',['type'=>'hidden']);
            echo $this->Form->input('nouveau password',['type'=>'password']);
            echo $this->Form->input('comfirmez password',['type'=>'password']);
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
