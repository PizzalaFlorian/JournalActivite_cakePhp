<?php
	echo $this->element('sidebarAdmin');
//    echo $this->Html->css('main_custom');
?>

<div class="actualites index large-12 medium-11 columns content">
	<h3>Edition du message de Droit d'opposition </h3>
	 <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Edition du message') ?></legend>
        <p>Ce message est affiché lors de la suppression d'un compte 'Candidat'. L'utilisateur est alors informé que toutes ses données seront supprimées</p>
        <?php
        	$file = file_get_contents(ROOT.'/webroot/files/message_suppression_données_utilisateur.ctp');
            echo $this->Form->input('message',['type'=>'textarea','required'=>true,'default'=>$file]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>