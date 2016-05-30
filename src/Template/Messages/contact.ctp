<?php
    echo $this->element($sideBar);
    echo $this->Html->css('main_custom');
?>
<div id="content">
    <div class="messages form large-12 medium-11 columns content">
        <div class="navbar">
        </div>
        <?= $this->Form->create($message) ?>
        <fieldset>
            <legend><?= __('Nous contacter') ?></legend>
            <?php
                echo $this->Form->input('Sujet', array('label' => 'Sujet'));
                echo $this->Form->input('ContenuMessage', array('label' => 'Contenu'));
    			echo $email;
            ?>
        </fieldset>
        <?= $this->Form->button(__('Envoyer')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
