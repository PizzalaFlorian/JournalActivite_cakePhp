<?php
	use Cake\Routing\Router;
?>
<div id='loginSite'>
	<h1>Connexion</h1>
	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create('user') ?>
    <fieldset>
        <legend><?= __("Merci de rentrer vos login et mot de passe") ?></legend>
        <?= $this->Form->input('login') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<center><?php echo $this->Form->button(__('Se Connecter')).' '.$this->Html->link('S\'inscrire', '/users/add', array('class' => 'button'));  ?></center>
<?= $this->Form->end() ?>

</div>