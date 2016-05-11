<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><li><?= $this->Html->link(__('Messagerie'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messages form large-9 medium-8 columns content">
    <?= $this->Form->create($message) ?>
    <fieldset>
        <div class="input text required">
            <label for="idrecepteur">Répondre à :</label>
            <select id="idrecepteur" type="text" name="IDRecepteur">   
                <?php echo "<option value=".$pseudoID.">".$pseudo."</option>"; ?>
            </select>
        </div>
        <div class="input text required">
            <label for="date">Date : </label>
            <input id="date" type="text" value="<?php echo date('d/m/Y'); ?>" maxlength="250" required="required" name="Date" disabled="disabled">
        </div>
        <?php echo $this->Form->input('Sujet', array('label' => 'Sujet :', 'value' => 'Re: '.$message->Sujet)); ?>
        <?php
            echo $this->Form->textarea('ContenuMessage', array(
                'label' => 'Contenu', 
                'rows' => '15', 
                'value' => "\n\n\n\n>De\t\t: ".$pseudo."\n>Le\t\t: ".$message->DateEnvoi." \n>Sujet\t: ".$message->Sujet."\n>\n>".afficheContenu($message->ContenuMessage)
                )
            );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>