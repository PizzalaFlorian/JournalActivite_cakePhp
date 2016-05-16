<?php
    echo $this->element('sidebarChercheur');
    echo $this->Form->postLink(
                __('Supprimer cette Categorie'),
                ['action' => 'delete', $categorieactivite->CodeCategorieActivite],
                ['confirm' => __('Are you sure you want to delete # {0}?', $categorieactivite->CodeCategorieActivite)]
            );
    echo '<br>';
    echo $this->Html->link(__('Retourner a la liste des categories'), ['action' => 'index']); 
?>
   
<div class="categorieactivite form large-12 medium-11 columns content">
    <?= $this->Form->create($categorieactivite) ?>
    <fieldset>
        <legend><?= __('Edit Categorieactivite') ?></legend>
        <?php
            echo $this->Form->input('NomCategorie');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
