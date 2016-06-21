<?php
    use Cake\ORM\TableRegistry;
    $this->start('sidebarCandidat');
 //   echo $this->Html->css('main_custom');
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
            'Mes Activités',
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
        $count = TableRegistry::get('messages')
                        ->find()
                        ->select(array('count'=>'COUNT(*)'))
                        ->where(['IDRecepteur'=>$_SESSION['Auth']['User']['ID'],'recepteurLU'=>0])
                        ->group('IDRecepteur')
                        ->first();
        if(isset($count['count'])){
            echo $this->Html->link(
                'Messages ('.$count['count'].')',
                ['controller' => 'messages', 'action' => 'index', '_full' => true]
            );
        }   
        else{      
            echo $this->Html->link(
                'Messages',
                ['controller' => 'messages', 'action' => 'index', '_full' => true]
            ); 
        }
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
            'Générer certificat participation',
            ['controller' => 'candidat', 'action' => 'generate', '_full' => true]
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
            'Supprimer mon compte',
            ['controller' => 'users', 'action' => 'suppressioncompte', '_full' => true]
        ); 
    ?> 
</li>
<li> 
    <?php 
        echo $this->Html->link(
            'Déconnexion',
            ['controller' => 'users', 'action' => 'logout', '_full' => true]
        ); 
    ?> 
</li>
<?php
    $this->end();
?>