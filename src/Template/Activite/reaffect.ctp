<?php
    echo $this->element('sidebarChercheur');
?>
<h3><?php echo $activite['NomActivite']; ?></h3>
<div class="activite form large-12 medium-11 columns content">
	<?php 
		 echo $this->Html->link(__('Annuler et retourner a la liste des activitées'), ['action' => 'index'],array("class"=>"button"));
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($activite) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation les occupations de '.$activite['NomActivite'].' dans :') ?></legend>
	        <?php
	            echo '<select name="CodeActivite">';
	            foreach ($list_activite as $acti) {
	                if($activite['CodeActivite'] == $acti['CodeActivite'])
	                    echo '<option value="'.$acti['CodeActivite'].'" selected>'.$acti['CodeActivite'].
	                ' - '.$acti['NomActivite'].'</option>';
	                else
	                    echo '<option value="'.$acti['CodeActivite'].'">'.$acti['CodeActivite'].
	                ' - '.$acti['NomActivite'].'</option>';
	            }
	            echo '</select>';
	        ?>
	    </fieldset>
	    <center><?= $this->Form->button(__('Submit')) ?></center>
	    <?= $this->Form->end() ?> 
	<br>
	<br>    
	<h4>Supprimer</h4>
	<?php 
		 
		 echo $this->Form->postLink(__('Supprimer cette activitée et toutes les occupations associées'), ['action' => 'deleteAll',$activite->CodeActivite],array("class"=>"button"), ['confirm' => __('êtes vous sur de vouloir supprimée toutes ces occupations de la base de données ?')]);
	?>
</div>