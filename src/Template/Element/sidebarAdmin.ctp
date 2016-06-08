<?php
    $this->start('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>

<li class="heading"><?= __('Menu') ?></li>
<li> 
    <?php 
        echo $this->Html->link(
            'Accueil',
            ['controller' => 'administrateur', 'action' => 'accueil', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Gestion Site Web',
            ['controller' => 'administrateur', 'action' => 'siteweb', '_full' => true]
        );
    ?>
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Gestion Utilisateurs',
            ['controller' => 'users', 'action' => 'index', '_full' => true]
        );
    ?>
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Gestion Candidats',
            ['controller' => 'candidat', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Gestion Chercheurs',
            ['controller' => 'chercheur', 'action' => 'index', '_full' => true]
        );
    ?>
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Gestion Administrateurs',
            ['controller' => 'administrateur', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Gestion des données',
            ['controller' => 'administrateur', 'action' => 'GestionDonnees', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Configuration Messagerie',
            ['controller' => 'administrateur', 'action' => 'Messagerie', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Aide',
            ['controller' => 'administrateur', 'action' => 'aide', '_full' => true]
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
            'Deconnexion',
            ['controller' => 'users', 'action' => 'logout', '_full' => true]
        ); 
    ?> 
</li>
<?php
    $this->end();
?>