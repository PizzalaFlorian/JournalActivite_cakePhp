<?php
    echo $this->element('sidebarAdmin');
?>
<div class="administrateur index large-11 medium-12 columns content">
    <?= $this->Html->link(__('Retour'), ['action' => 'index']) ?>
    <?= $this->Form->create($liste) ?>
    <fieldset>
        <legend><?= __('Inviter une liste de Candidat') ?></legend>
        <?php
            echo $this->Form->input('liste email',['type'=>'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <br>
</div>