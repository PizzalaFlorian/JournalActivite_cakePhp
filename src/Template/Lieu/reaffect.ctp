<?php
    echo $this->element('sidebarChercheur');
?>
<h3><?php echo $lieu['NomLieux']; ?></h3>
<div class="activite form large-12 medium-11 columns content">
	<h4>Annuler</h4>
	<?php 
		 echo $this->Html->link(__('Annuler et retourner a la liste des lieux'), ['action' => 'index']);
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($lieu) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation les occupations se déroulans dans '.$lieu['NomLieux'].' dans le lieux:') ?></legend>
	        <?php
	            echo '<select name="CodeLieux">';
	            foreach ($list_lieux as $acti) {
	                if($activite['CodeLieux'] == $acti['CodeLieux'])
	                    echo '<option value="'.$acti['CodeLieux'].'" selected>'.$acti['CodeLieux'].
	                ' - '.$acti['NomLieux'].'</option>';
	                else
	                    echo '<option value="'.$acti['CodeLieux'].'">'.$acti['CodeLieux'].
	                ' - '.$acti['NomLieux'].'</option>';
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
		 echo $this->Form->postLink(__('Supprimer ce lieu et toutes les occupations associées'), ['action' => 'deleteAll',$lieu->CodeLieux], ['confirm' => __('êtes vous sur de vouloir supprimée toutes ces occupations de la base de données ?')]);
	?>
</div>