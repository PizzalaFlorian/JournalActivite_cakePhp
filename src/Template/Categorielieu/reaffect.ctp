<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>
<h3 class="center"><?php echo $categorielieu['NomCategorie']; ?></h3>
<div class="categorielieu form large-12 medium-11 columns content">
	<?php 
		 echo $this->Html->link(__('Annuler et retourner a la liste des catégories de lieux'), ['action' => 'index'],array("class"=>"button"));
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($categorielieu) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation les lieux de '.$categorielieu['NomCategorie'].' dans') ?></legend>
	        <?php
	            echo '<select name="CodeCategorieLieux">';
	            foreach ($list_categorie as $acti) {
	                if($categorielieu['CodeCategorieLieux'] == $acti['CodeCategorieLieux'])
	                    echo '<option value="'.$acti['CodeCategorieLieux'].'" selected>'.$acti['CodeCategorieLieux'].
	                ' - '.$acti['NomCategorie'].'</option>';
	                else
	                    echo '<option value="'.$acti['CodeCategorieLieux'].'">'.$acti['CodeCategorieLieux'].
	                ' - '.$acti['NomCategorie'].'</option>';
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
		$flag = 0;
		 $list_lieux_suppr = TableRegistry::get('lieu')
		 	->find()
		 	->where(['CodeCategorieLieux'=>$categorielieu->CodeCategorieLieux])
		 	->toArray();
		 foreach ($list_lieux_suppr as $lieu_suppr) {
		 	 $count = TableRegistry::get('occupation')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeLieux'=>$lieu_suppr->CodeLieux])
                    ->group('CodeLieux')
                    ->first();
            if(isset($count['count'])){
            	$flag = 1;
            	echo 'Le lieu "'.$lieu_suppr->NomLieux.'" présent dans cette catégorie est utilisé '.$count['count'].' fois dans la base de données.';
            	echo '<br>';
            }     
		 }
		if($flag == 0){
		 echo $this->Form->postLink(__('Supprimer cette categorie et toutes les lieux associées'), ['action' => 'deleteAll',$categorielieu->CodeCategorieLieux], ['class'=>'button','confirm' => __('êtes vous sur de vouloir supprimée toutes ces lieux de la base de données ?')]);
		}
		else {
			echo 'Suppression impossible, veuillez réaffecter ou supprimer les lieux utilisées de la base de données avant de réaliser cette opération.';
		}
	?>
</div>