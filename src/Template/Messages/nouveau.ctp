<?php
    echo $this->element($sideBar);
    echo $this->Html->css('main_custom');
    echo $this->Html->css('responsive');

?>
<div id="content">
    <div class="messages form large-12 medium-11 columns content">
        <?= $this->Form->create($message) ?>
        <p style="text-align:justify">Le message écrit doit rester anonyme pour les besoins de l'expérience : ne communiquez ni vos nom, prénom et identifiant, ni un quelconque signe permettant de vous reconnaître. Votre numéro de candidat est automatiquement transféré avec votre message.</p>
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