<html>
	<head>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			
			<!-- Add jQuery library -->
			<script type="text/javascript" src="../js/fancybox/lib/jquery-1.10.1.min.js"></script>

			<!-- Add mousewheel plugin (this is optional) -->
			<script type="text/javascript" src="../js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

			<!-- Add fancyBox main JS and CSS files -->
			<script type="text/javascript" src="../js/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
			<link rel="stylesheet" type="text/css" href="../js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
			
			<link rel="stylesheet" href="../assets/css/main.css" />
			<link rel="stylesheet" href="../assets/css/modale.css" />
			<link rel="stylesheet" href="../assets/css/occupation.css" />
			
			<script src="../js/candidat_Renseignement.activite.js" type="text/javascript"></script>
	</head>
	<body>

		<h2>Activité du <?php //echo $date;?></h2>

		<br/>
		
			<table>
				<tr>
					<td>Activité</td>
					<td></td>
				</tr>
				<tr>
					<td>Categorie : </td>
					<td>
						<select class="target" id="activite">
							<?php
								foreach($liste_CategorieActivite as $id => $object){
									echo'<option id="'.$object->CodeCategorieActivite.'">'.$object->NomCategorie.'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Activité : </td>
					<td>
						<select class="activite" id="CodeActivite">
							<?php
								foreach($liste_ActiviteDefault as $id => $object){
									echo'<option id="'.$object->CodeActivite.'">'.$object->NomActivite.'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Lieu</td>
					<td></td>
				</tr>
				<tr>
					<td>Categorie : </td>
					<td>
						<select class="target" id="lieu">
							<?php
								foreach($liste_CategorieLieu as $id => $object){
									echo'<option id="'.$object->CodeCategorieLieux.'">'.$object->NomCategorie.'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Lieu : </td>
					<td>
						<select class="lieu" id="CodeLieux">
							<?php
								foreach($liste_LieuDefault as $id => $object){
									echo'<option id="'.$object->CodeLieux.'">'.$object->NomLieux.'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Compagnie : </td>
					<td>
						<select class="compagnie" id="CodeCompagnie">
							<option id="0"> - - - - - </option>
						</select>
					</td>
				</tr>

				<tr>
					<td>Dispositif : </td>
					<td>
						<select class="dispositif" id="CodeDispositif">
							<?php
								foreach($liste_dispositif as $id => $object){
									echo'<option id="'.$object->CodeDispositif.'">'.$object->NomDispositif.'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Heure de début : 
					</td>
					<td>
						<input type="text" id="HeureDebut" value="2016-04-07 20:30:00"></input>
					</td>
				</tr>
				<tr>
					<td>Heure de fin :
					</td>
					<td>
						<input type="text" id="HeureFin" value="2016-04-07 22:30:00"></input>
					</td>
				</tr>
			</table>
			<button id="EnvoieOccupationCandidat">Envoyer</button>
			<input type="hidden" id="CodeCandidat" value="<?php echo $_SESSION['id'];?>" />
	</body>
</html>
