<?php
	use Cake\Routing\Router;
	echo $this->Html->css('main_custom');
?>
<div id='loginSite'>
	<div class="users login large-5 medium-5 columns content">
	
		<h1>Connexion</h1>
		<!-- <?= $this->Flash->render('auth') ?> -->
		<?= $this->Form->create('user') ?>
	    <fieldset>
	        <legend><?= __("Merci de rentrer vos login et mot de passe") ?></legend>
	        <?= $this->Form->input('login') ?>
	        <?= $this->Form->input('password') ?>
	    </fieldset>
		<center><?php echo $this->Form->button(__('Se Connecter')).' '.$this->Html->link('S\'inscrire', '/users/add', array('class' => 'button'));  ?></center>
		<?= $this->Form->end() ?>
		<div class="contact">
			<?= $this->Html->link(
						'Contact', 
						['controller' => 'contacts', 'action' => 'contact'],
						array('class' => 'button')
					);
			?>
		</div>
	</div>
</div>