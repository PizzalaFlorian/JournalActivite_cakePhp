<?php

    $this->start('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>
<li class="heading"><?= __('Menu') ?></li>
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
            'Extraction Données',
            ['controller' => 'chercheur', 'action' => 'donnees', '_full' => true]
        );
    ?>
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Carnet de bord',
            ['controller' => 'carnetdebord', 'action' => 'index', '_full' => true]
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
<li class="heading"><?= __('Tables') ?></li>
<li> 
    <?php 
        echo $this->Html->link(
            'Table Activitées',
            ['controller' => 'activite', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Table Categories Activitées',
            ['controller' => 'categorieactivite', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Table Lieux',
            ['controller' => 'lieu', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Table Categories Lieux',
            ['controller' => 'categorielieu', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Table Dispositifs',
            ['controller' => 'dispositif', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Table Compagnies',
            ['controller' => 'compagnie', 'action' => 'index', '_full' => true]
        ); 
    ?> 
</li>
<li class="heading"><?= __('Mes infos') ?></li>
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
            'Aide',
            ['controller' => 'chercheur', 'action' => 'aide', '_full' => true]
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