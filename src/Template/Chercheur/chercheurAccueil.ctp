<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<h1>Bienvennue <?php echo nomChercheur($bdd);?></h1>

		</center>
		
		Il y a <?php echo nombreCandidat($bdd);?> candidats inscrit à l'étude qui ont renseigné un total de <?php echo nombreOccupation($bdd);?> occupations sur la période allant du <?php echo premierOccupation($bdd);?> au <?php echo dernierOccupation($bdd);?>.
		
	</div>
</div>
