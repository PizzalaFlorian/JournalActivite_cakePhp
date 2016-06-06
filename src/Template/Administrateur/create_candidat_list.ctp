<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>
<div class="administrateur index large-11 medium-12 columns content">
    
    <?= $this->Form->create($liste, array('type' => 'file')) ?>
    <fieldset>
        <legend><?= __('Inviter une liste de Candidat') ?></legend>
        <p>Veuillez séléctionner un fichier ou entrer une liste d'emails de candidats séparées par des points virgules ";"</p>
        <?php
            echo $this->Form->input('liste email',['type'=>'textarea']);
        ?>
        <?php echo $this->Form->file('file'); ?>
    </fieldset>
    <?= $this->Html->link(__('Retour'), ['controller'=>'users','action' => 'index'],['class'=>'button']) ?>
    <?= $this->Form->button(__('Inviter')) ?>
    <?= $this->Form->end() ?>
    <br>
</div>