

<?php
    if($_SESSION['Auth']['User']['typeUser']=='candidat')
        echo $this->element('sidebarCandidat');
    if($_SESSION['Auth']['User']['typeUser']=='chercheur')
        echo $this->element('sidebarChercheur');
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('login');
            echo $this->Form->input('password');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
