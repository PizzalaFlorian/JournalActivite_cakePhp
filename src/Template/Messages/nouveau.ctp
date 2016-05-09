<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Messagerie'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messages form large-9 medium-8 columns content">
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
