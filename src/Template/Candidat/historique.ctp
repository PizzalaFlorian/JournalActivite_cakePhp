<?php
	use Cake\ORM\TableRegistry;
	echo $this->element('sidebarCandidat');
//	echo $this->Html->css('main_custom');

	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js");
	if($isMobile){
	//	echo $this->Html->script('highcharts.mobile');
		echo $this->Html->script('historique_mobile');
	}
	else{
		echo $this->Html->script('historique');
//		echo $this->Html->script('highcharts');
	}
//	echo $this->Html->script('jquery.mobile.custom.min');
//	echo $this->Html->script('modernizr');
//    echo $this->Html->script('timeline');
//    echo $this->Html->script('skel.min');
//    echo $this->Html->script('util');
	
	echo $this->Html->css('timeline2');
//	echo $this->Html->css('responsive');
	
    $candidat = TableRegistry::get('candidat')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();
    $CodeCandidat = $candidat['CodeCandidat'];
    
?>

<!-- Content -->

<div class="inner">
	<h1 class="center">Mon historique</h1>	
	<?php
	if(!aucune_activite($CodeCandidat)){
	?>
	<center>Vous n'avez renseigné aucune activité pour l'instant.</center>
	<?php	
	}
	else{
		$dure_total = duree_totale($candidat['CodeCandidat']);
	?>
	<section class="cd-horizontal-timeline">
		<div class="timeline">
			<div class="events-wrapper">
				<div class="events">
					<ol>
						<li><a href="#0" data-date="<?php echo premiere_date_moins_un($candidat['CodeCandidat'])?>" class="selected">Résumé</a></li>
						<?php date_des_jours($candidat['CodeCandidat']); ?>
					</ol>

					<span class="filling-line" aria-hidden="true"></span>
				</div> <!-- .events -->
			</div> <!-- .events-wrapper -->
				
			<ul class="cd-timeline-navigation">
				<li><a href="#0" class="prev inactive">Prev</a></li>
				<li><a href="#0" class="next">Next</a></li>
			</ul> <!-- .cd-timeline-navigation -->
		</div> <!-- .timeline -->

		<div class="events-content">
			<ol>
				<li class="selected" data-date="<?php echo premiere_date_moins_un($candidat['CodeCandidat'])?>">
				<section id="all_historique">
				<div id="activite_all_camembert" style="width:100%; height:400px;"></div>
				<?php
				camembert_all_activite("activite_all_camembert",$dure_total,$CodeCandidat);
				stat_all_activite($candidat['CodeCandidat'],$dure_total);
				?>
				<div id="compagnie_all_camembert" style="width:100%; height:400px;"></div>
				<?php
				camembert_all_compagnie("compagnie_all_camembert",$dure_total,$CodeCandidat);
				stat_all_compagnie($candidat['CodeCandidat'],$dure_total);
				?>
				<div id="dispositif_all_camembert" style="width:100%; height:400px;"></div>
				<?php
				camembert_all_dispositif("dispositif_all_camembert",$dure_total,$CodeCandidat);
				stat_all_dispositif($candidat['CodeCandidat'],$dure_total);
				?>
				<div id="lieu_all_camembert" style="width:100%; height:400px;"></div>
				<?php
				camembert_all_lieu("lieu_all_camembert",$dure_total,$CodeCandidat);
				stat_all_lieu($candidat['CodeCandidat'],$dure_total);
				?>
			</section>
				</li>
				<?php contenu_date($candidat['CodeCandidat'],$dure_total);?>
			</ol>
		</div> <!-- .events-content -->
	</section>
	<?php
	}
	?>
	<a href="#" id="stat_all">Mais que font les autres étudiants?</a>
		<div>
		
	    <h3>Les statistiques en moyenne pour une journée de tous les étudiants</h3> 
	    <p class="moyenne_all">
	    <?php
	    echo $this->element("stat");
	    ?>
	    </p>
        
    </div>
</div>

