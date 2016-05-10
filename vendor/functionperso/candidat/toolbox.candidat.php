<?php
	use Cake\ORM\TableRegistry;

	function print_message_acceuil_candidat($id)
	{
		$table = TableRegistry::get('candidat')
		    ->find()
		    ->where(['ID'=>$id])
		    ->toArray();
	}












?>