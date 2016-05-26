<?php
    echo $this->element($sideBar);
?>
<div id="content">
    <div class="messages form large-12 medium-11 columns content">
        <div class="navbar">
            <fieldset>
                <?= $this->Html->link(__('Retour'), ['controller' => 'messages']) ?>
            </fieldset>
        </div>
        <?= $this->Form->create($message) ?>
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
    </div>
</div>