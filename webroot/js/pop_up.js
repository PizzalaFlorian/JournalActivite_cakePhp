 $(function() {
    $( "#dialog-tuto-mobile" ).dialog({
      resizable: true,
      height:350,
      width:100+'%',
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

    $( "#dialog-tuto-pc" ).dialog({
      resizable: true,
      height:450,
      width:700,
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
    
    $("#supprCookiePc").click(function(e){
        $.removeCookie('pc_time_management');
        location.reload(true);
    });
    
    $("#supprCookieMobile").click(function(e){
        $.removeCookie('mobile_time_management');
        location.reload(true);
    });
  });