$(document).ready(function(){
	 $("#categorieModifierActivite").change(function(){
		$("#modif_cat").html("<input type=\"hidden\" name=\"id\" value=\""+$(this).val()+"\"><label>Nom de la catégorie:</label><input type=\"text\" value=\""+$("#categorieModifierActivite option:selected").text()+"\" name=\"nom_categorie\" required>");
     });
	
	$("#modifierDispostif").change(function(){
		$("#mod_disp").html("<label>ID du dispositif:</label><div id=\"idDispositifModifAjax\"></div><input type=\"hidden\" value=\""+$(this).val()+"\" id=\"id_disp_old\"><input type=\"number\" name=\"id\" value=\""+$(this).val()+"\" id=\"id_disp_new\"><br/><label>Nom du dispositif:</label><input type=\"text\" value=\""+$("#modifierDispostif option:selected").text()+"\" name=\"nom_dispositif\" required>");
     });
	
	$("#modifierCompagnie").change(function(){
		$("#mod_compagnie").html("<label>ID de la compagnie:</label><div id=\"idCompagnieModifAjax\"></div><input type=\"hidden\" value=\""+$(this).val()+"\" id=\"id_compagnie_old\"><input type=\"number\" name=\"id\" value=\""+$(this).val()+"\" id=\"id_compagnie_new\"><br/><label>Nom de la compagnie:</label><input type=\"text\" value=\""+$("#modifierCompagnie option:selected").text()+"\" name=\"nom_compagnie\" required>");
     });

	
	 $("#modifierLieu").change(function(){
		$("#mod_lieu").html("<label>ID du lieu:</label><div id=\"idLieuModifAjax\"></div><input type=\"hidden\" value=\""+$(this).val()+"\" id=\"id_lieu_old\"><input type=\"number\" name=\"id\" value=\""+$(this).val()+"\" id=\"id_lieu_new\"><br/><label>Nom du lieu:</label><input type=\"text\" value=\""+$("#modifierLieu option:selected").text()+"\" name=\"nom_lieu\" required>");
     });
	
/*Ajax pour la modification d'activite*/	
	$("#modifierActivite").change(function(){
		$.ajax({
		   url : '../modele/modifier_activite.php',
		   type : 'POST',
		   data : 'code=' + $(this).val() + '&nom='+$("#modifierActivite option:selected").text(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
			$("#mod_act").html(code_html);
		   }
		});
     });
	
	
    $("#modLieu").click(function(event){
		event.preventDefault();
        $("#modifLieu").slideToggle();
		$("#modifDisp").hide();
		$("#modifAct").hide();
		$("#modifCat").hide();
		$("#modifCompagnie").hide();
    });
	
	$("#modDisp").click(function(event){
		event.preventDefault();
        $("#modifLieu").hide();
		$("#modifDisp").slideToggle();
		$("#modifAct").hide();
		$("#modifCat").hide();
		$("#modifCompagnie").hide();
    });
	
	$("#modAct").click(function(event){
		event.preventDefault();
        $("#modifLieu").hide();
		$("#modifDisp").hide();
		$("#modifAct").slideToggle();
		$("#modifCat").hide();
		$("#modifCompagnie").hide();
    });

	$("#modCat").click(function(event){
		event.preventDefault();
        $("#modifLieu").hide();
		$("#modifDisp").hide();
		$("#modifAct").hide();
		$("#modifCat").slideToggle();
		$("#modifCompagnie").hide();
    });
	
	$("#modCompagnie").click(function(event){
		event.preventDefault();
        $("#modifLieu").hide();
		$("#modifDisp").hide();
		$("#modifAct").hide();
		$("#modifCat").hide();
		$("#modifCompagnie").slideToggle();
    });
	
	$("#afficherCat").click(function(event){
		event.preventDefault();
		$("#afficheCat").slideToggle();
    });
	
	$("#afficherAct").click(function(event){
		event.preventDefault();
		$("#afficheAct").slideToggle();
    });
	
	$("#afficherLieu").click(function(event){
		event.preventDefault();
		$("#afficheLieu").slideToggle();
    });
	
	$("#afficherDisp").click(function(event){
		event.preventDefault();
		$("#afficheDisp").slideToggle();
    });
	
	$("#afficherCompagnie").click(function(event){
		event.preventDefault();
		$("#afficheCompagnie").slideToggle();
    });
	
	
	$(".ss_cat").click(function(event){
		event.preventDefault();
		$(this).next().slideToggle();
	});
	
	$(".ss_cat").next().hide();
	$(".allAfficheListe").hide();
	$(".allModdifListe").hide();
	
	
	// ajax pour l'ajout du  code lieu
	$("#ajoutCodeLieu").bind('keyup click',function(){
		$.ajax({
		   url : '../modele/idLieuAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#ajoutCodeLieu').val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idLieuAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour l'ajout du code activite
	$("#ajoutCodeActivite").bind('keyup click',function(){
		$.ajax({
		   url : '../modele/idActiviteAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#ajoutCodeActivite').val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idActiviteAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour la modification du code activite
	// il faut passer avec la méthode on car le code a été ajouté par ajax donc non dispo à la fin du cargement du dom :)
	  $("#mod_act").on('keyup click','#new_id_activite',function(){
		console.log("Boum");
		$.ajax({
		   url : '../modele/idActiviteModifAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#new_id_activite').val() + '&old_code=' + $("#old_id_activite").val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idActiviteModifAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour la modification du code dispositif
	// il faut passer avec la méthode on car le code a été ajouté par ajax donc non dispo à la fin du cargement du dom :)
	  $("#mod_disp").on('keyup click','#id_disp_new',function(){
		$.ajax({
		   url : '../modele/idDispositifModifAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#id_disp_new').val() + '&old_code=' + $("#id_disp_old").val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idDispositifModifAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour la modification du code lieu
	// il faut passer avec la méthode on car le code a été ajouté par ajax donc non dispo à la fin du cargement du dom :)
	  $("#mod_lieu").on('keyup click','#id_lieu_new',function(){
		$.ajax({
		   url : '../modele/idLieuModifAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#id_lieu_new').val() + '&old_code=' + $("#id_lieu_old").val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idLieuModifAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour la modification du code compagnie
	// il faut passer avec la méthode on car le code a été ajouté par ajax donc non dispo à la fin du cargement du dom :)
	  $("#mod_compagnie").on('keyup click','#id_compagnie_new',function(){
		$.ajax({
		   url : '../modele/idCompagnieModifAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#id_compagnie_new').val() + '&old_code=' + $("#id_compagnie_old").val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idCompagnieModifAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour l'ajout du code dispositif
	$("#ajoutCodeDispositif").bind('keyup click',function(){
		$.ajax({
		   url : '../modele/idDispositifAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#ajoutCodeDispositif').val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idDispositifAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour l'ajout du code compagnie
	$("#ajoutCodeCompagnie").bind('keyup click',function(){
		$.ajax({
		   url : '../modele/idCompagnieAjax.php',
		   type : 'POST',
		   data : 'code=' + $('#ajoutCodeCompagnie').val(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#idCompagnieAjax").html(code_html);
		   }
		});
	});
	
	
	//ajax pour la suppression d'une compagnie
	$("#supprCompagnie").change(function(){
		$.ajax({
		   url : '../modele/supprCompagnieAjax.php',
		   type : 'POST',
		   data : 'code=' + $(this).val() + '&nom='+$("#supprCompagnie option:selected").text(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#compagnieSupprAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour la suppression d'un lieu
	$("#supprLieu").change(function(){
		$.ajax({
		   url : '../modele/supprLieuAjax.php',
		   type : 'POST',
		   data : 'code=' + $(this).val() + '&nom='+$("#supprLieu option:selected").text(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#lieuSupprAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour la suppression d'un dispositif
	$("#supprDispositif").change(function(){
		$.ajax({
		   url : '../modele/supprDispositifAjax.php',
		   type : 'POST',
		   data : 'code=' + $(this).val() + '&nom='+$("#supprDispositif option:selected").text(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#dispositifSupprAjax").html(code_html);
		   }
		});
	});
	
	//ajax pour la suppression d'un dispositif
	$("#supprActivite").change(function(){
		$.ajax({
		   url : '../modele/supprActiviteAjax.php',
		   type : 'POST',
		   data : 'code=' + $(this).val() + '&nom='+$("#supprActivite option:selected").text(),
		   dataType : 'html', // On désire recevoir du HTML
		   success : function(code_html, statut){ // code_html contient le HTML renvoyé
				$("#activiteSupprAjax").html(code_html);
		   }
		});
	});

});