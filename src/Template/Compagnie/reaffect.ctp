<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>
<h3 class="center"><?php echo $compagnie['NomCompagnie']; ?></h3>
<div class="compagnie form large-12 medium-11 columns content">
	<?php 
		 echo $this->Html->link(__('Annuler et retourner à la liste des compagnies'), ['action' => 'index'],['class'=>'button']);
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($compagnie) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation les occupations contenant  '.$compagnie['NomCompagnie'].' avec :') ?></legend>
	        <?php
	            echo '<select name="CodeCompagnie">';
	            foreach ($list_compagnie as $acti) {
	                if($compagnie['CodeCompagnie'] == $acti['CodeCompagnie'])
	                    echo '<option value="'.$acti['CodeCompagnie'].'" selected>'.$acti['CodeCompagnie'].
	                ' - '.$acti['NomCompagnie'].'</option>';
	                else
	                    echo '<option value="'.$acti['CodeCompagnie'].'">'.$acti['CodeCompagnie'].
	                ' - '.$acti['NomCompagnie'].'</option>';
	            }
	            echo '</select>';
	        ?>
	    </fieldset>
	    <center><?= $this->Form->button(__('Réaffecter')) ?></center>
	    <?= $this->Form->end() ?> 
	<br>
	<br>    
	<h4>Supprimer</h4>
	<?php 
		 
		 echo $this->Form->postLink(__('Supprimer cette compagnie et toutes les occupations associées'), ['action' => 'deleteAll',$compagnie->CodeCompagnie], ['class'=>'button','confirm' => __('Êtes vous sur de vouloir supprimer toutes ces occupations de la base de données ?')]);
	?>
</div>