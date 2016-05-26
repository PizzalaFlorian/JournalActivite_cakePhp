<?php
    echo $this->element('sidebarChercheur');
?>
<div class="carnetdebord form large-11 medium-12 columns content">
    <?= $this->Form->create($carnetdebord) ?>
    <fieldset>
        <legend><?= __('Modifier entrée du carnet de bord') ?></legend>
        <?php
            echo $this->Form->input('Date',['type'=>'hidden','value'=>date("Y-m-d H:i:s")]);
            echo $this->Form->input('Sujet');
            echo $this->Form->input('Commentaire');
            echo $this->Form->input('CodeChercheur',['type'=>'hidden']);
        ?>
    </fieldset>
    <?php 
        echo $this->Form->button(__('Submit')); 
    ?>
    <?= $this->Form->end() ?>
    <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button"))
            .' '.
            $this->Form->postLink(
                __('Supprimer cette entrée du carnet de bord'),
                ['action' => 'delete', $carnetdebord->CodeEntree],array("class"=>"button"),
                ['confirm' => __('Êtes vous sur de vouloir supprimée l\'entrée : {0}?', $carnetdebord->Sujet)]
            );
    ?>
</div>
