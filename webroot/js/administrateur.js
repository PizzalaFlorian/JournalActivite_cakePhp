	$(document).ready(function(){
		$('#legende').hide();
		
		$("#afficheLegende").click(function(event){
			event.preventDefault();
			$("#legende").slideToggle();
		});
		
		
		$("#generer_legende").click(function(event){
			event.preventDefault();
			$("#legende").slideToggle();
		});
		
	});