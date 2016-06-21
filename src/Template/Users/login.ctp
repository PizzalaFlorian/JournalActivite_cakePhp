<?php
	use Cake\Routing\Router;
//	echo $this->Html->css('main_custom');
?>
<div id='loginSite'>
	<div class="users login large-5 medium-5 columns content">
		<div class="dark-blue-box">
			<h1>Connexion</h1>
			<!-- <?= $this->Flash->render('auth') ?> -->
			<?= $this->Form->create('user') ?>
		    <fieldset>
		        <legend><?= __("Merci de renseigner votre login et mot de passe") ?></legend>
		    	<?= $this->Form->label('login', 'Identifiant') ?>
		        <?= $this->Form->input('login',['required'=>'true','label'=>false]) ?>
		        <?= $this->Form->label('password', 'Mot de passe') ?>
		        <?= $this->Form->input('password',['required'=>'true','label'=>false]) ?>
		    </fieldset>
			<center><?php echo $this->Form->button(__('Se Connecter')).' '.$this->Html->link('S\'inscrire', '/users/add', array('class' => 'button'));  ?></center>
			<?= $this->Form->end() ?>
			<div class="contact">
				<?= $this->Html->link('Mot de passe oublié', '/users/reset', array('class' => 'button'))
				?>
				<?= $this->Html->link(
							'Contact', 
							['controller' => 'contacts', 'action' => 'contact'],
							array('class' => 'button')
						);
				?>
			</div>
		</div>
	</div>
</div>