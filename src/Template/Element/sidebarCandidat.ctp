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
            'Actualitées',
            ['controller' => 'candidat', 'action' => 'actualite', '_full' => true]
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
            'Aide',
            ['controller' => 'candidat', 'action' => 'aide', '_full' => true]
        ); 
    ?> 
</li>

<li> 
    <?php 
        echo $this->Html->link(
            'Mon Compte',
            ['controller' => 'candidat', 'action' => 'compte', '_full' => true]
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