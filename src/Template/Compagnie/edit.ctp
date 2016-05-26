<?php
    echo $this->element('sidebarChercheur');
?>
<div class="compagnie form large-12 medium-11 columns content">
    <?= $this->Form->create($compagnie) ?>
    <fieldset>
        <legend><?= __('Modifier la compagnie') ?></legend>
        <?php
            echo $this->Form->input('NomCompagnie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
     <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button"))
            .' '.
            $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $compagnie->CodeCompagnie],
                array("class"=>"button",'confirm' => __('Êtes-vous sur de vouloir supprimer : #{0}?', $compagnie->NomCompagnie))
            );
    ?>
</div>
