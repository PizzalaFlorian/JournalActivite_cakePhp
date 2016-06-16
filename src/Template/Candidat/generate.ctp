<?php
    echo $this->element('sidebarCandidat');
    echo $this->Html->css('main_custom');
?>

<div class="candidat form large-11 medium-12 columns content">
    <?= $this->Form->create() ?>
	<fieldset>
        <legend><?= __('Entrez votre code étudiant') ?></legend>
         <?php
         echo $this->Form->label('Code Etudiant', 'Numéro Etudiant *');
            echo $this->Form->input('Code Etudiant',['required'=>'true','label'=>false]);
        ?>
        </fieldset>
    	<?= $this->Form->button(__('Générer mon certificat')) ?>
    	<?= $this->Form->end() ?>
</div>