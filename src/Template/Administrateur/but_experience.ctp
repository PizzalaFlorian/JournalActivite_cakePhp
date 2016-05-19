<?php
	echo $this->element('sidebarAdmin');
?>

<div class="actualites index large-12 medium-11 columns content">
	<h3>Edition du message d'explication du but de l'expérience</h3>
	 <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Edition du message') ?></legend>
        <?php
        	$file = file_get_contents(ROOT.'/webroot/files/but_experience.ctp');
            echo $this->Form->input('message',['type'=>'textarea','required'=>true,'default'=>$file]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>