<?php
    echo $this->element($sideBar);
    echo $this->Html->css('main_custom');
?>
<div id="content">
    <div class="messages form large-12 medium-11 columns content">
        <?= $this->Form->create($message) ?>
        <p>Ce message doit rester anonyme. Ne transmettez pas votre nom, prénom, ou votre identifiant. Votre numéro de candidat sera transféré automatiquement.</p>
        <fieldset>
            <div class="input text required">
                <label for="idrecepteur">Répondre à :</label>
                <select id="idrecepteur" type="text" name="IDRecepteur">   
                    <?php echo "<option value=".$pseudoID.">".$pseudo."</option>"; ?>
                </select>
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
        <?= $this->Html->link(__('Retour'), ['controller' => 'messages'],array('class' => 'button')) ?>
    </div>
</div>