<!-- Content -->
<div id="content">

	<div class="inner">
	<?php include("../modele/chercheurTables.modele.php"); ?>
		<!--
		Insert content here			
		-->		
		<center>
			<a><h1>Modifier les tables</h1></a>
		</center>
		<h2>La liste des catégories d'activités</h2>
		<a href="#" id="afficherCat">Afficher la liste des catégories d'activités</a><br/>
		<section class="allAfficheListe" id ="afficheCat">
			<?php echo tableauCategorie($bdd);?>
		</section>
		<a href="#" id="modCat">Modifier la liste des catégories d'activités</a><br/>
		<section id="modifCat" class="allModdifListe">
			<a href="#" class="margin_left_30 ss_cat">Ajouter une catégorie d'activité</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Ajouter une catégorie d'activité:</legend>
						<label>Nom de la catégorie: </label>
						<input type="text" name="nom_categorie" required/>
						<input type="submit" name="add_categorie" value="Ajouter">
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Modifier une catégorie d'activité</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Modifier une catégorie d'activité:</legend>
						<label>Sélectionez une catégorie d'activité: </label>
						<?php echo selectCategorieVide($bdd,"categorieModifierActivite","id_ancien");?>
						<div id="modif_cat">
						</div>
						<input type="submit" name="mod_categorie" value="Modifier"><br/>
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Supprimer une catégorie d'activité</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Supprimer une catégorie d'activité:</legend>
						<label>Sélectionez une catégorie d'activité:  </label>
						<?php echo selectCategorie($bdd,"categorieActivite","code_categorie");?>
						<input type="submit" name="sup_categorie" value="Supprimer">
				</fieldset>		
			</form>
		</section>
		<h2>La liste des activités</h2>
		<a href="#" id="afficherAct">Afficher la liste des activités</a><br/>
		<section class="allAfficheListe" id ="afficheAct">
			<?php echo tableauActivite($bdd); ?>
		</section>
		<a href="#" id="modAct">Modifier la liste des activités</a><br/>
		<section id="modifAct" class="allModdifListe">
			<a href="#" class="margin_left_30 ss_cat">Ajouter une activité</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Ajouter une activité:</legend>
						<label>Nom d l'activité: </label>
						<input type="text" name="nom_activite"/>
						<label>ID de l'activité:</label>
						<div id="idActiviteAjax"></div>
						<input type="number" name="id" id="ajoutCodeActivite"/><br/>
						<label>Sélectionez une catégorie pour l'activité: </label>
						<?php echo selectCategorie($bdd,"categorieActivite","cat_activite");?>
						<label>Description de l'activité</label>
						<textarea name="desc"></textarea>
						<input type="submit" name="add_activite" value="Ajouter">
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Modifier une activité</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Modifier une activité:</legend>
						<label>Sélectionez une activité: </label>
						<?php echo selectActiviteModif($bdd,"modifierActivite","id_old");?>
						<div id="mod_act"></div>
						<input type="submit" name="mod_activite" value="Modifier"><br/>
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Supprimer une activité</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Supprimer une activité:</legend>
						<label>Sélectionez une activité:  </label>
						<?php echo selectActiviteVide($bdd,"supprActivite","id");?>
						<div id="activiteSupprAjax"></div>
						<input type="submit" name="sup_activite" value="Supprimer">
				</fieldset>		
			</form>
		</section>
		
		<h2>La liste des dispositifs</h2>
		<a href="#" id="afficherDisp">Afficher la liste des dispositifs</a><br/>
		<section class="allAfficheListe" id ="afficheDisp">
			<?php echo tableauDispositif($bdd)?>
		</section>
		<a href="#" id="modDisp">Modifier la liste des dispositifs</a><br/>
		<section id="modifDisp" class="allModdifListe">
			<a href="#" class="margin_left_30 ss_cat">Ajouter un dispositif</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Ajouter un dispositif:</legend>
						<label>Nom du dispositif: </label>
						<input type="text" name="nom_dispositif" required/>
						<label>ID du dispositif:</label>
						<div id="idDispositifAjax"></div>
						<input type="number" name="id"  id="ajoutCodeDispositif" required/><br/>
						<input type="submit" name="add_dispositif" value="Ajouter">
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Modifier un dispositif</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Modifier un dispositif:</legend>
						<label>Sélectionez un dispositif: </label>
						<?php echo selectDispositif($bdd,"modifierDispostif","id_old");?>
						<div id="mod_disp"></div>
						<input type="submit" name="mod_dispositif" value="Modifier"><br/>
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Supprimer un dispositif</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Supprimer un dispositif:</legend>
						<label>Sélectionez un dispositif:  </label>
						<?php echo selectDispositif($bdd,"supprDispositif","id");?>
						<div id="dispositifSupprAjax"></div>
						<input type="submit" name="sup_dispositif" value="Supprimer">
				</fieldset>		
			</form>
		</section>
		<h2>La liste des lieux et des transports</h2>
		<a href="#" id="afficherLieu">Afficher la liste des lieux et des transports</a><br/>
		<section id="afficheLieu" class="allAfficheListe">
			<?php echo tableauLieu($bdd)?>
		</section>
		<a href="#" id="modLieu">Modifier la liste des lieux et des transports</a><br/>
		<section id="modifLieu" class="allModdifListe">
			<br/><a href="#" class="margin_left_30 ss_cat">Ajouter un lieu & transport</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Ajouter un lieu & transport:</legend>
						<label>Nom du lieu: </label>
						<input type="text" name="nom_lieu"/>
						<label>ID du lieu:</label>
						<div id="idLieuAjax"></div>
						<input type="number" id="ajoutCodeLieu" name="id_lieu"/><br/>
						<label>Catégorie du lieu:</label>
						<select name="cat">
							<option value="1">Lieu</option>
							<option value="2">Transport</option>
						</select>
						<input type="submit" name="add_lieu" value="Ajouter">
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Modifier un lieu & transport</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Modifier un lieu & transport:</legend>
						<label>Sélectionez un lieu: </label>
						<?php echo selectLieuVide($bdd,"modifierLieu","id_old");?>
						<div id="mod_lieu"></div>
						<input type="submit" name="mod_lieu" value="Modifier"><br/>
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Supprimer un lieu & transport</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Supprimer un lieu & transport:</legend>
						<label>Sélectionez un lieu:  </label>
						<?php echo selectLieuVide($bdd,"supprLieu","id");?>
						<div id="lieuSupprAjax"></div>
						<input type="submit" name="sup_lieu" value="Supprimer">
				</fieldset>		
			</form>
		</section>
		
		<h2>La liste des personnes présentes</h2>
		<a href="#" id="afficherCompagnie">Afficher la liste des personnes présentes</a><br/>
		<section id="afficheCompagnie" class="allAfficheListe">
			<?php echo tableauCompagnie($bdd)?>
		</section>
		<a href="#" id="modCompagnie">Modifier la liste des personnes présentes</a><br/>
		<section id="modifCompagnie" class="allModdifListe">
			<br/><a href="#" class="margin_left_30 ss_cat">Ajouter une compagnie</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Ajouter une compagnie:</legend>
						<label>Nom de la compagnie: </label>
						<input type="text" name="nom_compagnie"/>
						<label>ID de la compagnie:</label>
						<div id="idCompagnieAjax"></div>
						<input type="number" id="ajoutCodeCompagnie" name="id_compagnie"/><br/>
						<input type="submit" name="add_compagnie" value="Ajouter">
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Modifier une compagnie</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Modifier une compagnie:</legend>
						<label>Sélectionez une compaagnie: </label>
						<?php echo selectCompagnieVide($bdd,"modifierCompagnie","id_old");?>
						<div id="mod_compagnie"></div>
						<input type="submit" name="mod_compagnie" value="Modifier"><br/>
				</fieldset>
			</form>
			<br/><a href="#" class="margin_left_30 ss_cat">Supprimer une compagnie</a>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<fieldset>
					<legend>Supprimer une compagnie:</legend>
						<label>Sélectionez une compagnie:  </label>
						<?php echo selectCompagnieVide($bdd,"supprCompagnie","id");?>
						<div id="compagnieSupprAjax"></div>
						<input type="submit" name="sup_compagnie" value="Supprimer">
				</fieldset>		
			</form>
		</section>
		
		
	</div>
</div>