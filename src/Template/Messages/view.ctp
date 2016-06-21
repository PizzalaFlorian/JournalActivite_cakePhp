<?php
    echo $this->element($sideBar);
//    echo $this->Html->css('main_custom');
?>
<div id="content">
<div class="messages view large-12 medium-11 columns content">
    <table class="vertical-table">
        <tr>
            <th><?= __('Sujet :') ?></th>
            <td><?= h($message->Sujet) ?></td>
        </tr>
        <tr>
            <th><?= __('De :') ?></th>
            <td><?php echo whoIsID($message->userExpediteur); ?></td>
        </tr>
        <tr>
            <th><?= __('à :') ?></th>
            <td><?php echo whoIsID($message->userRecepteur); ?></td>
        </tr>
        <tr>
            <th><?= __('Date :') ?></th>
            <td><?= h($message->DateEnvoi) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('') ?></h4>
        <?= $this->Text->autoParagraph(h($message->ContenuMessage)); ?>
    </div>
    <?php 
                // si l'utilisateur a été supprimer, aucune possibilité de repondre
                if(!(($message->userExpediteur == 4)||($message->userRecepteur == 4))){ 
            
                    if($message->userExpediteur != $_SESSION['Auth']['User']['ID']) {
                        if(($_SESSION['Auth']['User']['typeUser'] == 'chercheur')&&($message->userRecepteur != '1')){

                        }else{
                            echo $this->Html->link(__('Répondre'), ['action' => 'repondre', $message->IDMessage],array("class"=>"button")).' ';
                        }
                    }
                    echo $this->Html->link(__('Supprimer'), ['action' => 'delete', $message->IDMessage],array("class"=>"button",'confirm' => __('Êtes-vous sur de vouloir supprimer ce message?', $message->IDMessage))).' ';
                    echo $this->Html->link(__('Retour'), ['controller' => 'messages'],array("class"=>"button")).' '; 
                }
    ?>
</div>
</div>