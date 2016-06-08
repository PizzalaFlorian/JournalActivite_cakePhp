 $(function() {
    $( "#dialog-tuto-mobile" ).dialog({
      resizable: false,
      height:300,
      modal: true,
      buttons: {
        Fermer: function() {
          $( this ).dialog( "close" );
        },
        "Ne plus afficher cette fenêtre": function() {
            $.cookie('mobile_time_management', 'read');
          $( this ).dialog( "close" );
        }
      }
    });
  });
  
   $(function() {
    $( "#dialog-tuto-pc" ).dialog({
      resizable: false,
      height:300,
      modal: true,
      buttons: {
        Fermer: function() {
          $( this ).dialog( "close" );
        },
        "Ne plus afficher cette fenêtre": function() {
            $.cookie('pc_time_management', 'read');
          $( this ).dialog( "close" );
        }
      }
    });
  });