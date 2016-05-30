<?php
	echo $this->element('sidebarChercheur');
	echo $this->Html->css('main_custom');
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js");
	echo $this->Html->script('chercheurTables');
?>
<!-- Content -->
<div id="content">

	<div class="inner">		
		<center>
			<a><h1>Modifier les tables</h1></a>
		</center>
		
		<h4>La liste des activités</h4>
		<?php 
        echo $this->Html->link(
            'Accès liste des activités',
            ['controller' => 'activite', 'action' => 'index', '_full' => true]
	        );
	    ?>
	    <h4>La liste des catégories d'activités</h4>
		<?php 
        echo $this->Html->link(
            'Accès liste des catégories d\'activités',
            ['controller' => 'categorieactivite', 'action' => 'index', '_full' => true]
	        );
	    ?> 
		<h4>La liste des dispositifs</h4>
		<?php 
        echo $this->Html->link(
            'Accès liste des dispositifs',
            ['controller' => 'dispositifs', 'action' => 'index', '_full' => true]
	        );
	    ?>
		<h4>La liste des lieux et des transports</h4>
		<?php 
        echo $this->Html->link(
            'Accès la liste des lieux et des transports',
            ['controller' => 'lieux', 'action' => 'index', '_full' => true]
	        );
	    ?>
	    <h4>La liste des categories de lieux</h4>
		<?php 
        echo $this->Html->link(
            'Accès la liste des categorie de lieux',
            ['controller' => 'categorielieux', 'action' => 'index', '_full' => true]
	        );
	    ?>
		<h4>La liste des personnes présentes (compagnies)</h4>
		<?php 
        echo $this->Html->link(
            'Accès liste des personnes présentes',
            ['controller' => 'compagnie', 'action' => 'index', '_full' => true]
	        );
	    ?>
	    <br>
	    <br>
	    <br>
	</div>
</div>