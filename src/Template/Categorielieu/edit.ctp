<?php
    echo $this->element('sidebarChercheur');
?>
<div class="categorielieu form large-12 medium-11 columns content">
    <?= $this->Form->create($categorielieu) ?>
    <fieldset>
        <legend><?= __('Modifier la categorie de lieu') ?></legend>
        <?php
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
     <?php echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button"))
            .' '.
            $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $categorielieu->CodeCategorieLieux],
                array("class"=>"button",'confirm' => __('Êtes vous sur de vouloir supprimer la categorie : # {0}?', $categorielieu->NomCategorie))
            );
    ?>
</div>
