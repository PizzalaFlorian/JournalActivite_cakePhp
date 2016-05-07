	$('#table').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
	
	$('#table2').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
	
	$('.table_act').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/French.json"
        }
    });
	
	
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