<?php
	echo $this->element('sidebarAdmin');
 //   echo $this->Html->css('main_custom');
?>

<div class="actualites index large-12 medium-11 columns content">
	<h3>Edition du message d'invitation des candidats</h3>
	 <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Edition du message') ?></legend>
        <p>A la suite de ce message, le candidat trouvera joins ses identifiants pour le site, où il devra terminer son inscription lors de la première connexion.</p>
        <?php
        	$file = file_get_contents(ROOT.'/webroot/files/message_collecte_données_utilisateur.ctp');
            echo $this->Form->input('message',['type'=>'textarea','required'=>true,'default'=>$file]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>