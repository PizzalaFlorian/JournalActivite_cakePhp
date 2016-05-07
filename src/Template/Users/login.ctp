<div class='hidden'><?= $this->layout = 'loginlayout' ?></div>
<div id='login'>
	<h1>Connexion</h1>
	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create('user') ?>
    <fieldset>
        <legend><?= __("Merci de rentrer vos nom d'utilisateur et mot de passe") ?></legend>
        <?= $this->Form->input('login') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Se Connecter')); ?>
<?= $this->Form->end() ?>
</div>