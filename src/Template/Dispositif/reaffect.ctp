<?php
    echo $this->element('sidebarChercheur');
?>
<h3><?php echo $dispositif['NomDispositif']; ?></h3>
<div class="dispositif form large-12 medium-11 columns content">
	<h4>Annuler</h4>
	<?php 
		 echo $this->Html->link(__('Annuler et retourner a la liste des activitées'), ['action' => 'index']);
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($dispositif) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation les occupations de '.$dispositif['NomDispositif'].' dans :') ?></legend>
	        <?php
	            echo '<select name="CodeDispositif">';
	            foreach ($list_dispositif as $acti) {
	                if($dispositif['CodeDispositif'] == $acti['CodeDispositif'])
	                    echo '<option value="'.$acti['CodeDispositif'].'" selected>'.$acti['CodeDispositif'].
	                ' - '.$acti['NomDispositif'].'</option>';
	                else
	                    echo '<option value="'.$acti['CodeDispositif'].'">'.$acti['CodeDispositif'].
	                ' - '.$acti['NomDispositif'].'</option>';
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
		 
		 echo $this->Form->postLink(__('Supprimer ce dispositif et toutes les occupations associées'), ['action' => 'deleteAll',$dispositif->CodeDispositif], ['confirm' => __('êtes vous sur de vouloir supprimée toutes ces occupations de la base de données ?')]);
	?>
</div>