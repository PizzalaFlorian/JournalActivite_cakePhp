<?php
    echo $this->element($sideBar);
    echo $this->Html->css('main_custom');
    echo $this->Html->css('responsive');

?>
<div id="content">
    <div class="messages form large-12 medium-11 columns content">
        <?= $this->Form->create($message) ?>
        <p style="text-align:justify">Ce message doit rester anonyme. Ne transmettez pas votre nom, prénom, ou votre identifiant. Votre numéro de candidat sera transféré automatiquement.</p>
        <fieldset>
            <legend><?= __('Nouveau message') ?></legend>
            <?php
                echo '<label for="IDRecepteur">Á</label>';
                echo '<select id="IDRecepteur" type="text" name="IDRecepteur"><option value="1">Chercheur</option></select>';
                echo $this->Form->input('Sujet', array('label' => 'Sujet'));
                echo $this->Form->input('ContenuMessage', array('label' => 'Contenu'));
            ?>
        </fieldset>
        <?= $this->Html->link(__('Retour'), ['controller' => 'messages'],array('class' => 'button')) ?>
        <?= $this->Form->button(__('Envoyer')) ?>
        <?= $this->Form->end() ?>
        
    </div>
</div>