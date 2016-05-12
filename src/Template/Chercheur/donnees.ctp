<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<a><h1>Les Données</h1></a>
		</center>
			Il y a <?php echo nombreCandidat($bdd);?> candidats inscrit à l'étude qui ont renseigné un total de <?php echo nombreOccupation($bdd);?> occupations sur la période allant du <?php echo premierOccupation($bdd);?> au <?php echo dernierOccupation($bdd);?>.<br/>
			
			<h2>Téléchargement des données:</h2>
			<a href="../file/telechargerCandidatExcel.php" target="_blank">Téléchargement des données</a> Format: .xsl (Compatible Excel 2003)<br/>
			Les données des candidats sont sur la feuille Candidat, les occupations des candidats sont sur la feuille Occupation dans le fichier Excel. <br/>
			<a href="../file/telechargerDonnees.php" target="_blank">Téléchargement des occupations entrées par les candidats</a> Format: .csv , séparateur: ; <br/>
			<a href="../file/telechargerCandidat.php" target="_blank">Téléchargement des données des candidats</a> Format: .csv , séparateur: ; <br/>
			
			
			
			<h2>Noms correspondants au codes:</h2>
			<a href="#" id="afficheLegende">Afficher les noms correspondant aux codes</a><br/>
			<a href="../file/telechargerLegende.php" target="_blank">Télécharger les noms correspondant au codes</a>
			<div id="legende">
			<h2>Les codes des activités :</h2> 
			<?php echo tableauActivite($bdd); ?>
			<h2>Les codes des lieux :</h2> 
			<?php echo tableauLieu($bdd); ?>
			<h2>Les codes des compagnies :</h2>
			<?php echo tableauCompagnie($bdd); ?>
			<h2>Les codes des dispositifs :</h2> 
			<?php echo tableauDispositif($bdd); ?>
			<h2>Les codes candidats : </h2>ce sont les codes des candidats, leur noms n'est pas communiqué aux chercheurs à cause de la confidentialité, si vous vous rendez compte qu'un candidat rentre des mauvaises données signalez le à l'administrateur qui se chargera de supprimer le candidat.  
			</div>
						
			<h2>Apperçu des données:</h2>
			Les données sur les occupations rentrées par les candidats: 
			<?php echo tableDonnees($bdd); ?>
			<hr/>
			Les données sur les candidats: 
			<?php echo tableCandidat($bdd); ?>
	</div>
</div>