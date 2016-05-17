<?php
    echo $this->element('sidebarAdmin');
?>
<div class="chercheur form large-11 medium-12 columns content">
    <?= $this->Html->link(__('Retour'), ['action' => 'index']) ?>
    <?= $this->Form->create($user) ?>
 
    <fieldset>
        <legend><?= __('Ajouter l\' Utilisateur') ?></legend>
        <?php
            echo $this->Form->input('login',['default'=>$login]);
            echo $this->Form->input('typeUser',['default'=>'chercheur']);
            echo $this->Form->input('password',['default'=>$password]);
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <br>
    <!-- TODO ENVOIE DES ID PAR MESSAGE -->
    <br>
    <?= $this->Form->create($chercheur) ?>
    <fieldset>
        <legend><?= __('Ajouter le Chercheur') ?></legend>
        <?php
            echo $this->Form->input('PrenomChercheur');
            echo $this->Form->input('NomChercheur');
            echo $this->Form->input('ID',['default'=>$user->ID]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
