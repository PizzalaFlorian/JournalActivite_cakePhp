<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
?>
<h3><?php echo $lieu['NomLieux']; ?></h3>
<div class="activite form large-12 medium-11 columns content">
	<?php 
		 echo $this->Html->link(__('Annuler et retourner à la liste des lieux'), ['action' => 'index'],array("class"=>"button"));
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($lieu) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation des occupations se déroulant dans '.$lieu['NomLieux'].' dans le lieu:') ?></legend>
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
	    <center><?= $this->Form->button(__('Réaffecter')) ?></center>
	    <?= $this->Form->end() ?> 
	<br>
	<br>    
	<h4>Supprimer</h4>
	<?php 
		 echo $this->Form->postLink(__('Supprimer ce lieu et toutes les occupations associées'), ['action' => 'deleteAll',$lieu->CodeLieux], ["class"=>"button",'confirm' => __('Êtes-vous sur de vouloir supprimer toutes ces occupations de la base de données ?')]);
	?>
</div>