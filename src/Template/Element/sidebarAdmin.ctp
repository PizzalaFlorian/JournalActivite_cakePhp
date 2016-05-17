<?php
    $this->start('sidebarAdmin');
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
            'Gestion Chercheur',
            ['controller' => 'chercheur', 'action' => 'index', '_full' => true]
        );
    ?>
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Gestion Candidat',
            ['controller' => 'candidat', 'action' => 'index', '_full' => true]
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
<?php
    $this->end();
?>