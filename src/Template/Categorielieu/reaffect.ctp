<?php
    echo $this->element('sidebarChercheur');
    use Cake\ORM\TableRegistry;
?>
<h3><?php echo $categorielieu['NomCategorie']; ?></h3>
<div class="categorielieu form large-12 medium-11 columns content">
	<h4>Annuler</h4>
	<?php 
		 echo $this->Html->link(__('Annuler et retourner a la liste des categories de lieux'), ['action' => 'index']);
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
	    <center><?= $this->Form->button(__('Submit')) ?></center>
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
            	echo 'le lieu "'.$lieu_suppr->NomLieux.'" présent dans cette catégorie est utilisée '.$count['count'].' fois dans la base de données.';
            	echo '<br>';
            }     
		 }
		if($flag == 0){
		 echo $this->Form->postLink(__('Supprimer cette categorie et toutes les lieux associées'), ['action' => 'deleteAll',$categorielieu->CodeCategorieLieux], ['confirm' => __('êtes vous sur de vouloir supprimée toutes ces lieux de la base de données ?')]);
		}
		else {
			echo 'Suppression impossible, veuillez réaffecter ou supprimer les lieux utilisées de la base de données avant de réalisé cette opération';
		}
	?>
</div>