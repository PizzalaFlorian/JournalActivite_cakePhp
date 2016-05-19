$(function() {
	// mets a jours les activités ou lieux en focntion de la cat choisi
	$( ".RA_target" ).change(function() {
		// alert();
		//Initialisation
		var targetCategorie = "";

		// recuperation de la categorie choisit, et de la value choisit
		var categorie = $(this).attr('id');
		var codeCategorie = $(this).find("option:selected").attr('value');
		console.log("cat : "+categorie);
		console.log("cde : "+codeCategorie);

		// if(categorie == "CategorieLieux")		{targetCategorie = "RA_activ"; cat = "activite";}
		// if(categorie == "CategorieActivite")	{targetCategorie = "RA_Lieu"; cat = "lieu";}
		$.ajax({
		// 	// url: "../../vendor/functionperso/requestactivite.php",
			url: "../"+categorie+"/request",
		 	type : 'POST',
		 	data : 'value='+codeCategorie,
		 	dataType : 'html',
		 	success : function(reponse, statut){
				console.log('succes');
		 		console.log('rep : '+reponse);
		 		$( "."+categorie ).html(reponse);
		 	},
		// 	 error: function (request, status, error) {
  //     		 	alert(request.responseText);
  //   		}
		});
	});
});