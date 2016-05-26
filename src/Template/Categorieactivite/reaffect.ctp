<?php
    echo $this->element('sidebarChercheur');
    use Cake\ORM\TableRegistry;
?>
<h3 class="center"><?php echo $categorieactivite['NomCategorie']; ?></h3>
<div class="categorieactivite form large-12 medium-11 columns content">
	<?php 
		 echo $this->Html->link(__('Annuler et retourner a la liste des categories d\'activitées'), ['action' => 'index'],array("class"=>"button"));
	?>
	<h4>Réaffecter</h4>	
		<?= $this->Form->create($categorieactivite) ?>
	    <fieldset>
	        <legend><?= __('Réaffectation les activitées de '.$categorieactivite['NomCategorie'].' dans') ?></legend>
	        <?php
	            echo '<select name="CodeCategorieActivite">';
	            foreach ($list_categorie as $acti) {
	                if($categorieactivite['CodeCategorieActivite'] == $acti['CodeCategorieActivite'])
	                    echo '<option value="'.$acti['CodeCategorieActivite'].'" selected>'.$acti['CodeCategorieActivite'].
	                ' - '.$acti['NomCategorie'].'</option>';
	                else
	                    echo '<option value="'.$acti['CodeCategorieActivite'].'">'.$acti['CodeCategorieActivite'].
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
		 $list_activite = TableRegistry::get('activite')
		 	->find()
		 	->where(['CodeCategorie'=>$categorieactivite->CodeCategorieActivite])
		 	->toArray();
		 foreach ($list_activite as $activite) {
		 	 $count = TableRegistry::get('occupation')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeActivite'=>$activite->CodeActivite])
                    ->group('CodeActivite')
                    ->first();
            if(isset($count['count'])){
            	$flag = 1;
            	echo 'l\'activite "'.$activite->NomActivite.'" présente dans cette catégorie est utilisée '.$count['count'].' fois dans la base de données.';
            	echo '<br>';
            }     
		 }
		if($flag == 0){
		 echo $this->Form->postLink(__('Supprimer cette categorie et toutes les activitées associées'), ['action' => 'deleteAll',$categorieactivite->CodeCategorieActivite],array("class"=>"button"), ['confirm' => __('êtes vous sur de vouloir supprimée toutes ces activitées de la base de données ?')]);
		}
		else {
			echo 'Suppression impossible, veuillez réaffecter ou supprimer les activitées utilisées de la base de données avant de réalisé cette opération';
		}
	?>
</div>