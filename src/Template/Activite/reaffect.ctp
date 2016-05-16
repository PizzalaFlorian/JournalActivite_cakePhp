<?php
    echo $this->element('sidebarChercheur');
?>
<div class="activite form large-12 medium-11 columns content">
	<h4>Annuler</h4>
	<?php 
		 echo $this->Html->link(__('Annuler et retourner a la liste des activitées'), ['action' => 'index']);
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($activite) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation des occupations liées a cette activitée') ?></legend>
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
		 
		 echo $this->Form->postLink(__('Supprimer cette activitée et toutes les occupations associées'), ['action' => 'deleteAll',$activite->CodeActivite], ['confirm' => __('êtes vous sur de vouloir supprimée toutes ces occupations de la base de données ?')]);
	?>
</div>