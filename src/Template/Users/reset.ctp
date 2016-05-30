<?php
    echo $this->Html->css('main_custom');
?>

<div class="users form large-11 medium-12 columns content">
    <?= $this->Form->create() ?>
	<fieldset>
        <legend><?= __('Rentrez votre adresse email') ?></legend>
         <?php
            echo $this->Form->input('Email',['required'=>'true']);
        ?>
        </fieldset>
    	<?= $this->Form->button(__('Renvoyer un nouveau mot de passe')) ?>
    	<?= $this->Form->end() ?>
</div>