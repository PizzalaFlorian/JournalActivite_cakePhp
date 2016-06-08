<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>
<h3 class="center"><?php echo $dispositif['NomDispositif']; ?></h3>
<div class="dispositif form large-12 medium-11 columns content">
	<?php 
		 echo $this->Html->link(__('Annuler et retourner à la liste des activités'), ['action' => 'index'],['class'=>'button']);
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($dispositif) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation des occupations de '.$dispositif['NomDispositif'].' dans :') ?></legend>
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
		 
		 echo $this->Form->postLink(__('Supprimer ce dispositif et toutes les occupations associées'), ['action' => 'deleteAll',$dispositif->CodeDispositif], ['class'=>'button','confirm' => __('Êtes vous sur de vouloir supprimer toutes ces occupations de la base de données ?')]);
	?>
</div>