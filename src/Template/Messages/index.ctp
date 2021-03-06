<?php
    echo $this->element($sideBar);
//    echo $this->Html->css('messagerie');
//    echo $this->Html->css('main_custom');
//    echo $this->Html->css('responsive');
?>
<div id="content">
<nav id="messagerieMenu" class="large-12 medium-11 columns">
    <div class="center">
        <?php 
            if($monController == 'candidat'){
                echo $this->Html->link(__('Nouveau Message'), ['action' => 'nouveau'],array('class' => 'button')).' ';
            }
            echo $this->Html->link(__('Messages envoyés'), ['action' => 'envoie'],array('class' => 'button'));
        ?>
        <?php
            if($_SESSION['Auth']['User']['typeUser'] == 'candidat'){
                echo $this->Html->link(
                        'Contacter un administrateur', 
                        ['controller' => 'contacts', 'action' => 'contact'],
                        ['class'=>'button']
                    );
            }
        ?>

    </div>
</nav>




<div class="messages index large-12 medium-11 columns content">
    <h3 class="center">Mes <?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Reçu le') ?></th>
                <th><?= $this->Paginator->sort('Sujet') ?></th>
                <th><?= $this->Paginator->sort('Expediteur') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr >
                <?php $lu = message_Lu($message); ?>
                <?php //-- DATE D'ENVOIE --?>
                <td class="<?php echo $lu; ?>">
                        <?= h($message->DateEnvoi) ?>
                </td>
                <?php //-- LIEN AFFICHE LE MESSAGE --?>
                <td class="<?php echo $lu; ?>">
                    <?= $this->Html->link(h(substr($message->Sujet, 0, 30)), ['action' => 'view', $message->IDMessage]) ?>
                </td>
                <?php //-- NOM DE L'EXPEDITEUR --?>
                <td class="<?php echo $lu; ?>">
                    <?php echo whoIsID($message->userExpediteur); ?>
                </td>
                <?php //-- ACTIONS --?>
                <td class="actions">
                    <!-- REPONDRE -->  
                    <?php 
                        // si l'utilisateur a été supprimé, aucune possibilité de repondre
                        if(!($message->userExpediteur == 4)){ 
                            echo $this->Html->link(
                             $this->Html->image('open.png', array('title' => "Lire")),
                            ['action' => 'view', $message->IDMessage],
                            array('escape' => false)
                            );
                            echo $this->Html->link(
                            $this->Html->image('repondre.ico', array('title' => "Répondre")),
                             ['action' => 'repondre', $message->IDMessage],
                              array('escape' => false)
                             ); 
                        }
                        echo $this->Form->postLink(
                         $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                         ['action' => 'delete', $message->IDMessage, 'page' => 'index'],
                          array('escape' => false,'confirm' => __('Êtes-vous sûr de vouloir supprimer ce message?', $message->IDMessage))); 
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Précédant')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Suivant') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>