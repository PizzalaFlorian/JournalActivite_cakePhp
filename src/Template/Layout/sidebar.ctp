<?php

	$this->start('sidebar');
	echo $this->Html->link(
    	'Accueil',
    	['controller' => 'candidat', 'action' => 'accueil', '_full' => true]
 	);
	$this->end();

?>