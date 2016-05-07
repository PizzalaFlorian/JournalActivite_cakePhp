<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<a><h1>Mon historique</h1></a>
			
		</center>
<section class="cd-horizontal-timeline">
	<div class="timeline">
		<div class="events-wrapper">
			<div class="events">
				<ol>
					<li><a href="#0" data-date="<?php echo premiere_date_moins_un($bdd)?>" class="selected">Résumé</a></li>
					<?php date_des_jours($bdd); ?>
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
			<li class="selected" data-date="<?php echo premiere_date_moins_un($bdd)?>">
			<section id="all_historique">
			<div id="activite_all_camembert" style="width:100%; height:400px;"></div>
			<?php
			camembert_all_activite($bdd,"activite_all_camembert");
			stat_all_activite($bdd);
			?>
			<div id="compagnie_all_camembert" style="width:100%; height:400px;"></div>
			<?php
			camembert_all_compagnie($bdd,"compagnie_all_camembert");
			stat_all_compagnie($bdd);
			?>
			<div id="dispositif_all_camembert" style="width:100%; height:400px;"></div>
			<?php
			camembert_all_dispositif($bdd,"dispositif_all_camembert");
			stat_all_dispositif($bdd);
			?>
			<div id="lieu_all_camembert" style="width:100%; height:400px;"></div>
			<?php
			camembert_all_lieu($bdd,"lieu_all_camembert");
			stat_all_lieu($bdd);
			?>
		</section>
			</li>
			<?php contenu_date($bdd);?>
		</ol>
	</div> <!-- .events-content -->
</section>
		
	<script src="../js/jquery.mobile.custom.min.js"></script>
	
	<script src="../js/modernizr.js"></script>		
	<script src="../js/timeline.js"></script> 	
		
		
	</div>
</div>
