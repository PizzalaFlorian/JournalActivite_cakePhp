<?php
    if(!$monEmail){
		echo $this->element($sideBar);
	}
?>
<div class="messages form large-12 medium-11 columns content">
	<?php 
		if($monEmail){
			echo $this->Html->link(
				'Retour',
				['controller' => 'Users', 'action' => 'login', '_full' => true]
			); 
		}
    ?> 
    <div class="navbar">
    </div>
    <?= $this->Form->create($contact) ?>
    <fieldset>
        <legend><?= __('Nous contacter') ?></legend>
		<?php
			if($monEmail){
		?>
		<div class="input text required">
			<label for="expediteur">Adresse e-mail</label>
			<input id="expediteur" type="text" maxlength="250" required="required" name="expediteur">
		</div>
		<?php
				//echo $this->Form->input('sujet', array('label' => 'Sujet'));
				//echo $this->Form->input('contenue', array('label' => 'Contenu'));
				//echo $this->Form->input('expediteur', array('label' => 'Adresse e-mail'));
			}
		?>
		<div class="input text required">
			<label for="sujet">Sujet</label>
			<input id="sujet" type="text" maxlength="250" required="required" name="sujet">
		</div>
		<div class="input textarea required">
			<label for="contenu">Contenu</label>
			<textarea id="contenu" rows="5" required="required" name="contenu"></textarea>
		</div>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
