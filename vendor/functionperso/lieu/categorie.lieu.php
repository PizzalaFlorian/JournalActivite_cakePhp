<?php
		/* Renvoie un tableau d'objet php contenant la liste complete des CategorieLieu de la BDD*/
		function get_CategorieLieu($bdd){
			$requete = "SELECT * FROM categorielieu ";
			$sth = $bdd->prepare($requete);
			$sth->execute();
			
			while ($reponse = $sth->fetch(PDO::FETCH_ASSOC))
			{
				$listeCategorieLieu[] = new categorieLieu($reponse);
			}
			return $listeCategorieLieu;
		}
?>