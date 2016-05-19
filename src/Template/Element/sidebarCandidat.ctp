<?php

    $this->start('sidebarCandidat');
?>
<li> 
    <?php 
        echo $this->Html->link(
            'Accueil',
            ['controller' => 'candidat', 'action' => 'accueil', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Mes activitées',
            ['controller' => 'candidat', 'action' => 'activite', '_full' => true]
        );
    ?>
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Mon Historique',
            ['controller' => 'candidat', 'action' => 'historique', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Générer certificat',
            ['controller' => 'candidat', 'action' => 'generate', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Messagerie',
            ['controller' => 'messages', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>

<li> 
    <?php 
        echo $this->Html->link(
            'Mon Compte',
            ['controller' => 'users', 'action' => 'modif', '_full' => true]
        ); 
    ?> 
</li>

<li> 
    <?php 
        echo $this->Html->link(
            'Informations Personnelles',
            ['controller' => 'candidat', 'action' => 'modif', '_full' => true]
        ); 
    ?> 
</li>

<li> 
    <?php 
        echo $this->Html->link(
            'But de l\'expérience',
            ['controller' => 'candidat', 'action' => 'but_experience', '_full' => true]
        ); 
    ?> 
</li>

<li> 
    <?php 
        echo $this->Html->link(
            'Aide',
            ['controller' => 'candidat', 'action' => 'aide', '_full' => true]
        ); 
    ?> 
</li>

<li> 
    <?php 
        echo $this->Html->link(
            'Deconnexion',
            ['controller' => 'users', 'action' => 'logout', '_full' => true]
        ); 
    ?> 
</li>
<?php
    $this->end();
?>