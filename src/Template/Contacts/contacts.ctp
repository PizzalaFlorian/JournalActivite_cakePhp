<?php 
        echo $this->Html->link(
            'Retour',
            ['controller' => 'users', 'action' => 'login', '_full' => true]
        ); 
    ?> 
<div class="messages form large-12 medium-11 columns content">
    <div class="navbar">
    </div>
    <?= $this->Form->create($contact) ?>
    <fieldset>
        <legend><?= __('Nous contacter') ?></legend>

		<div class="input text required">
			<label for="expediteur">Adresse e-mail</label>
			<input id="expediteur" type="text" maxlength="250" required="required" name="expediteur">
		</div>

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
