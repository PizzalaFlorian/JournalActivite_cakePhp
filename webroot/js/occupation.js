$(function() {
	$( ".RA_target" ).change(function() {
		// alert();
		var categorie = $(this).attr('id');
		var codeCategorie = $(this).find("option:selected").attr('id');
		console.log("cat : "+categorie);
		console.log("cde : "+codeCategorie);
		if(categorie == "new_event_categorieActivite"){targetCategorie = "RA_activ"; cat = "activite";}
		if(categorie == "new_event_categorieLieu"){targetCategorie = "RA_Lieu"; cat = "lieu";}
		/*$.ajax({
			// url: "../../vendor/functionperso/requestactivite.php",
			url: "../candidat/request",
			type : 'POST',
			data : 'categorie=' + cat + '&codeCategorie=' + codeCategorie,
			dataType : 'html',
			success : function(reponse, statut){
				console.log('succes');
				console.log(reponse);
				$( "."+targetCategorie ).html(reponse);
			},
			 error: function (request, status, error) {
      		 	alert(request.responseText);
    		}
		});*/
	});
});