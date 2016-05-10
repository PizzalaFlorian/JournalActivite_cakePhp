<?php
	use Cake\ORM\TableRegistry;

	function print_message_acceuil_candidat($id)
	{
		$res = TableRegistry::get('candidat')
		    ->find()
		    ->where(['ID'=>$id])
		    ->first();
		
		echo $res['PrenomCandidat'].' '.$res['NomCandidat'];
	}












?>