<?php
	echo $this->element('sidebarChercheur');
?>

<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<h1>Bienvennue <?php echo nomChercheur();?></h1>

		</center>
		
		Il y a <b><?php echo nombreCandidat();?></b> candidat(s) inscrit à l'étude qui ont renseigné un total de <b><?php echo nombreOccupation();?></b> occupations sur la période allant du <b><?php echo premierOccupation();?> au <?php echo dernierOccupation();?></b>.
		
	</div>
</div>
