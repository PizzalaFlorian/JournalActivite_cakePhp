<?php
    echo $this->element('sidebarChercheur');
?>
<div class="carnetdebord form large-11 medium-12 columns content">
    <?= $this->Form->create($carnetdebord) ?>
    <?= $this->Html->link(__('Retour'), ['action' => 'index']) ?>
    <fieldset>
        <legend><?= __('Add Carnetdebord') ?></legend>
        <?php
            echo $this->Form->input('Date',['type'=>'hidden','value'=>date("Y-m-d H:i:s")]);
            echo $this->Form->input('Sujet');
            echo $this->Form->input('Commentaire');
            echo $this->Form->input('CodeChercheur',['type'=>'hidden','value'=>$chercheur['CodeChercheur']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
