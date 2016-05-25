<?php
    if(!$monEmail){
		echo $this->element($sideBar);
	}
?>
<div class="messages form large-12 medium-11 columns content">
    <div class="navbar">
    </div>
    <?= $this->Form->create($contact) ?>
    <fieldset>
        <legend><?= __('Nous contacter') ?></legend>
        <?php
            echo $this->Form->input('sujet', array('label' => 'Sujet'));
            echo $this->Form->input('contenue', array('label' => 'Contenu'));
			if($monEmail){
				echo $this->Form->input('expediteur', array('label' => 'Adresse e-mail'));
			}
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
