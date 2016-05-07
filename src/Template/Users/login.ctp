<div class='hidden'><?= $this->layout = 'loginlayout' ?></div>
<div id='login'>
	<h1>Connexion</h1>
	<?= $this->Form->create() ?>
	<?= $this->Form->input('login') ?>
	<?= $this->Form->input('password') ?>
	<?= $this->Form->button('Se connecter') ?>
	<?= $this->Form->end() ?>
</div>