<?php
    echo $this->element('sidebarChercheur');
?>
<div class="dispositif form large-12 medium-11 columns content">
    <?= $this->Form->create($dispositif) ?>
    <fieldset>
        <legend><?= __('Modifier le dispositif') ?></legend>
        <?php
            echo $this->Form->input('NomDispositif');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
     <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button"))
            .' '.
            $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $dispositif->CodeDispositif],
                array("class"=>"button",'confirm' => __('Êtes-vous sur de vouloir supprimer : #{0}?', $dispositif->NomDispositif))
            );
    ?>
</div>
