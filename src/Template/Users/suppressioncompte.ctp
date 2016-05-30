<?php
    echo $this->element($sideBar);
    echo $this->Html->css('users');
    echo $this->Html->css('main_custom');
?>
<div id="suppression_donnees_utilisateur">
	<div id="message_suppression_title">Suppression de Compte</div>
	<div id="message_suppression_donnees_utilisateur">
	    <?php
	    	$file = file_get_contents(ROOT.'/webroot/files/message_suppression_données_utilisateur.ctp');
	    	echo $file;
	    	// $nbrLigne = substr_count($file, '\n');
	    	// echo $nbrLigne;
	        // echo $this->Form->input('message',['label'=>false, 'type'=>'textarea','required'=>true,'default'=>$file, 'disabled' => 'disabled','rows' => '']);
	    ?>
	</div>
	<div>
	    <?= $this->Form->create() ?>
	    <br/><br/><br/>En supprimant votre compte, vous vous opposer au traitement des données vous concernant. Toutes vos données seront alors supprimées de nos serveurs.
		    <fieldset>
		    	    
			    	<div id="radioButon">
			    	<?php 
			    		echo $this->Form->checkbox('published', ['hiddenField' => false]);
			   			// $options = [
					 	//        ['value' => 'supprWithData' , 'text' => "Je souhaite supprimer mon compte, ainsi que toutes les données liées à celui-ci."],
					 	//        ['value' => 'supprWithOutData', 'text' => "Je souhaite supprimer mon compte, mais j'autorise la conservation des données me concernant." ]
						// ];
						// $attribut = ['default'=>'supprCompte'];
						// echo $this->Form->radio('field', $options, $attribut);
			    	?>Je souhaite supprimer mon compte, ainsi que toutes les données liées à celui-ci.
			    </div>
			</fieldset>
			<div id="button">
	        	<?= $this->Form->button(__('Supprimer mon compte')) ?>
        	</div>
	    <?= $this->Form->end() ?>
	</div>
</div>