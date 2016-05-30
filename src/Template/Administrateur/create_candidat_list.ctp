<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>
<div class="administrateur index large-11 medium-12 columns content">
    
    <?= $this->Form->create($liste) ?>
    <fieldset>
        <legend><?= __('Inviter une liste de Candidat') ?></legend>
        <p>Veuillez entrer une liste d'email de candidat séparé par des points virgules ";"</p>
        <?php
            echo $this->Form->input('liste email',['type'=>'textarea']);
        ?>
    </fieldset>
    <?= $this->Html->link(__('Retour'), ['controller'=>'users','action' => 'index'],['class'=>'button']) ?>
    <?= $this->Form->button(__('Inviter')) ?>
    <?= $this->Form->end() ?>
    <br>
</div>