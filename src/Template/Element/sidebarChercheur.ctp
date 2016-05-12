<?php

    $this->start('sidebarChercheur');
?>
<li> 
    <?php 
        echo $this->Html->link(
            'Accueil',
            ['controller' => 'chercheur', 'action' => 'accueil', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Données',
            ['controller' => 'chercheur', 'action' => 'donnees', '_full' => true]
        );
    ?>
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Tables',
            ['controller' => 'chercheur', 'action' => 'tables', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Carnet de bord',
            ['controller' => 'chercheur', 'action' => 'carnetDeBord', '_full' => true]
        ); 
    ?> 
</li>

<li> 
    <?php 
        echo $this->Html->link(
            'Messages',
            ['controller' => 'messages', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Aide',
            ['controller' => 'chercheur', 'action' => 'aide', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Mon compte',
            ['controller' => 'users', 'action' => 'modif', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Informations Personnelles',
            ['controller' => 'chercheur', 'action' => 'modif', '_full' => true]
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