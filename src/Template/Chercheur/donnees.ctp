<?php
	echo $this->element('sidebarChercheur');
	echo $this->Html->css('main_custom');
	
  	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js");
	echo $this->Html->script("https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js");
	echo $this->Html->script("https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.min.js");
	
	echo $this->Html->script('chercheurDonnees');
?>
<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<a><h1>Les Données</h1></a>
		</center>
			Il y a <b><?php echo nombreCandidat();?></b> candidat(s) inscrit à l'étude qui ont renseigné un total de <b><?php echo nombreOccupation();?></b> occupations sur la période allant du <b><?php echo premierOccupation();?> au <?php echo dernierOccupation();?></b>.<br/>
			
			<h2>Téléchargement des données:</h2>
			<?php echo $this->Html->link(
            'Téléchargement des données',
            ['controller' => 'chercheur', 'action' => 'telechargerCandidatExcel', '_full' => true]
       		 ); 
       		?>
			Format: .xsl (Compatible Excel 2003)<br/>
			Les données des candidats sont sur la feuille Candidat, les occupations des candidats sont sur la feuille Occupation dans le fichier Excel. <br/>
			<?php echo $this->Html->link(
            'Téléchargement des occupations entrées par les candidats',
            ['controller' => 'chercheur', 'action' => 'telechargerDonnees', '_full' => true]
       		 ); 
       		?> Format: .csv , séparateur: " ; " <br/>
			<?php echo $this->Html->link(
            'Téléchargement des données des candidats',
            ['controller' => 'chercheur', 'action' => 'telechargerCandidat', '_full' => true]
       		 ); 
       		?> Format: .csv , séparateur: " ; " <br/>
			
			
			
			<h2>Noms correspondants au codes:</h2>
			<a href="#" id="afficheLegende">Afficher les noms correspondant aux codes</a><br/>
			<?php echo $this->Html->link(
            'Télécharger les noms correspondant au codes',
            ['controller' => 'chercheur', 'action' => 'telechargerLegende', '_full' => true]
       		 ); 
       		?>
			<div id="legende">
			<h2>Les codes des activités :</h2> 
			<?php echo tableauActivite(); ?>
			<h2>Les codes des lieux :</h2> 
			<?php echo tableauLieu(); ?>
			<h2>Les codes des compagnies :</h2>
			<?php echo tableauCompagnie(); ?>
			<h2>Les codes des dispositifs :</h2> 
			<?php echo tableauDispositif(); ?>
			<h2>Les codes candidats : </h2>ce sont les codes des candidats, leur noms n'est pas communiqué aux chercheurs à cause de la confidentialité, si vous vous rendez compte qu'un candidat rentre des mauvaises données signalez le à l'administrateur qui se chargera de supprimer le candidat.  
			</div>
						
			<h2>Apperçu des données:</h2>
			Les données sur les occupations rentrées par les candidats: 
			<?php echo tableDonnees(); ?>
			<hr/>
			Les données sur les candidats: 
			<?php echo tableCandidat(); ?>
	</div>
</div>