<?php
    echo $this->element($sideBar);
    echo $this->Html->css('main_custom');
?>
<div id="content">
    <div class="messages form large-12 medium-11 columns content">
        <?= $this->Html->link(__('Retour'), ['controller' => 'messages'],array('class' => 'button')) ?>
        <?= $this->Form->create($message) ?>
        <fieldset>
            <legend><?= __('Nouveau message') ?></legend>
            <?php
                echo '<label for="IDRecepteur">Á</label>';
                echo '<select id="IDRecepteur" type="text" name="IDRecepteur"><option value="1">Chercheur</option></select>';
                echo $this->Form->input('Sujet', array('label' => 'Sujet'));
                echo $this->Form->input('ContenuMessage', array('label' => 'Contenu'));
            ?>
        </fieldset>
        <?= $this->Form->button(__('Envoyer')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>