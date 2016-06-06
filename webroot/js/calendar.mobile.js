$(function(){
	$( ".RA_activ" ).change(function() {
		var test = $(this).find("option:selected").attr('id');
		//   console.log(test);
	});
	
    function getBaseURL() {
        var url = location.href;  // entire url including querystring - also: window.location.href;
        var baseURL = url.substring(0, url.indexOf('/candidat', 14)); 

        if (baseURL.indexOf('http://localhost') != -1) {
            var pathname = location.pathname;  // window.location.pathname;
            var index1 = url.indexOf(pathname);
            var index2 = url.indexOf("/", index1 + 1);
            var baseLocalUrl = url.substr(0, index2);

            return baseLocalUrl;
        }
        else {
            // Root Url for domain name
            return baseURL;
        }

    }

    function afficheTime(time){
        if(parseInt(time)<10)
            return "0"+time;
        return time;
    }
    /*########################################################################################*/
    /*###########################              MODULE AGENDA                     #############*/
    /*########################################################################################*/

    
    /* Taille des events */
    var td_width=$(".calendar_td").width();
    $(".calendar_event").css({
        "width" : td_width*0.85,
        "margin-left" : (td_width-(td_width*0.85))/2,
    });

 
    /*nouvel event Ajout*/
    $(".calendar_td").on('doubletap', function(e) {
       var jour_deb = $(this).attr('id');

        //$("#ajax_load").html('<p align="center"><img src="'+getBaseURL()+'/public/themes/admin/img/loading.gif" /></p>');
        var agenda_first_id=0;
        var position_choisie=e.pageY-$(this).position().top;

        var to_round=Math.round(position_choisie);
        var to_string=String(to_round);
        var str_length=to_string.length-1;
        var to_substr=to_string.substr(0,str_length);
        var to_int=parseInt(to_substr);
        if(!to_int){
            to_int=0;
        }
        var margin_top=to_int*10;

        var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
        var depart_en_millisec=depart_en_sec*1000;
        var height_css_value=parseInt(80);
        var duree_en_sec=(((height_css_value/10)/4)*60)*60;
        var duree_en_millisec=duree_en_sec*1000;
        var fin_en_sec=depart_en_sec + duree_en_sec;
        var fin_en_millisec=depart_en_millisec + duree_en_millisec;
        nouvelle_heure_depart = new Date();
        nouvelle_heure_depart.setTime(depart_en_millisec);
        nouvelle_heure_fin = new Date();
        nouvelle_heure_fin.setTime(fin_en_millisec);


        var day_choose=(parseInt($(this).attr("id")));
        var day_start=day_choose + ( nouvelle_heure_depart.getHours() * 60 * 60 ) + ( nouvelle_heure_depart.getMinutes() * 60 );
        var day_end=day_choose + ( nouvelle_heure_fin.getHours() * 60 * 60 ) + ( nouvelle_heure_fin.getMinutes() * 60 );

                    
        var minute_debut = nouvelle_heure_depart.getMinutes();
        if(minute_debut < 10){minute_debut = "0"+minute_debut;}
        var heure_debut = nouvelle_heure_depart.getHours();
        if(heure_debut < 10){heure_debut = "0"+heure_debut;}
        var minute_fin = nouvelle_heure_fin.getMinutes();
        if(minute_fin < 10){minute_fin = "0"+minute_fin;}
        var heure_fin = nouvelle_heure_fin.getHours();
        if(heure_fin < 10){heure_fin = "0"+heure_fin;}
        /*dialog de remplissage date*/          
        $("#new_event_day").val( jour_deb);
        $("#new_event_heure_debut").val( heure_debut+':'+minute_debut+':00');
        $("#new_event_heure_fin").val( heure_fin+':'+minute_fin+':00');
        var width_select = $("#new_heure_debut").width();
        $("#new_heure_debut").css({
                        "width" : width_select});
        $("#new_minute_debut").css({
                        "width" : width_select});
        $("#new_heure_fin").css({
                        "width" : width_select});
        $("#new_minute_fin").css({
                        "width" : width_select});
        var liste_heure_debut = '';
        for (var i = 0; i<24;i++){
            var value = 0;
            if(i<10)
                value = '0'+i;
            if(i>=10){
                value = i;
            }
            if(i== parseInt(heure_debut)){
                liste_heure_debut = liste_heure_debut + '<option id="h_debut" selected>'+value+'</option>';
            }
            else
                liste_heure_debut = liste_heure_debut + '<option id="h_debut">'+value+'</option>';
        }

        var liste_minute_debut = '';
        for (var i = 0; i<60;i++){
            var value = 0;
            if(i<10)
                value = '0'+i;
            if(i>=10){
                value = i;
            }
            if(i== parseInt(minute_debut)){
                liste_minute_debut = liste_minute_debut + '<option id="m_debut" selected>'+value+'</option>';
            }
            else
                liste_minute_debut = liste_minute_debut + '<option id="m_debut">'+value+'</option>';
        }

        var liste_heure_fin = '';
        for (var i = parseInt(heure_debut); i<24;i++){
            var value = 0;
            if(i<10)
                value = '0'+i;
            if(i>=10){
                value = i;
            }
            if(i== parseInt(heure_fin)){
                liste_heure_fin = liste_heure_fin + '<option selected>'+value+'</option>';
            }
            else
                liste_heure_fin = liste_heure_fin + '<option>'+value+'</option>';
        }

        var liste_minute_fin = '';
        if(heure_fin == heure_debut){
            for (var i = parseInt(minute_debut); i<60;i++){
                var value = 0;
                if(i<10)
                    value = '0'+i;
                if(i>=10){
                    value = i;
                }
                if(i== parseInt(minute_fin)){
                    liste_minute_fin = liste_minute_fin + '<option selected>'+value+'</option>';
                }
                else
                    liste_minute_fin = liste_minute_fin + '<option>'+value+'</option>';
            }
        }
        else{
            for (var i = 0; i<60;i++){
                var value = 0;
                if(i<10)
                    value = '0'+i;
                if(i>=10){
                    value = i;
                }
                if(i== parseInt(minute_fin)){
                    liste_minute_fin = liste_minute_fin + '<option selected>'+value+'</option>';
                }
                else
                    liste_minute_fin = liste_minute_fin + '<option>'+value+'</option>';
            }
        }
        $("#new_heure_debut").html(liste_heure_debut);
        $("#new_minute_debut").html(liste_minute_debut);
        $("#new_heure_fin").html(liste_heure_fin);
        $("#new_minute_fin").html(liste_minute_fin);
        
        /*responsive time */
        $("#new_heure_fin").change(function(e){
            heure_fin = $("#new_heure_fin option:selected").html();
            var liste_minute_fin_modif = '';
            if(heure_fin <= heure_debut){
                for (var i = (parseInt(minute_debut) + 1); i<60;i++){
                    var value = 0;
                    if(i<10)
                        value = '0'+i;
                    if(i>=10){
                        value = i;
                    }
                    if(i== parseInt(minute_fin)){
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option selected>'+value+'</option>';
                    }
                    else
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option>'+value+'</option>';
                }
            }
            else{
                for (var i = 0; i<60;i++){
                    var value = 0;
                    if(i<10)
                        value = '0'+i;
                    if(i>=10){
                        value = i;
                    }
                    if(i== parseInt(minute_fin)){
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option selected>'+value+'</option>';
                    }
                    else
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option>'+value+'</option>';
                }
            }
            $("#new_minute_fin").html(liste_minute_fin_modif);
        });
        $("#new_minute_fin").change(function(e){
            minute_fin = $("#new_minute_fin option:selected").html();
        });
        $("#new_heure_debut").change(function(e){
            console.log("click new heure",$("#new_heure_debut option:selected").html());
            var heure_debut_modif = $("#new_heure_debut option:selected").html();
            heure_debut = heure_debut_modif
            var liste_heure_fin_modif = '';
            for (var i = parseInt(heure_debut_modif); i<24;i++){
                var value = 0;
                if(i<10)
                    value = '0'+i;
                if(i>=10){
                    value = i;
                }
                if(i== parseInt(heure_fin)){
                    liste_heure_fin_modif = liste_heure_fin_modif + '<option selected>'+value+'</option>';
                }
                else
                    liste_heure_fin_modif = liste_heure_fin_modif + '<option>'+value+'</option>';
            }

            var liste_minute_fin_modif = '';
            if(heure_fin <= heure_debut_modif){
                for (var i = (parseInt(minute_debut) + 1); i<60;i++){
                    var value = 0;
                    if(i<10)
                        value = '0'+i;
                    if(i>=10){
                        value = i;
                    }
                    if(i== parseInt(minute_fin)){
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option selected>'+value+'</option>';
                    }
                    else
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option>'+value+'</option>';
                }
            }
            else{
                for (var i = 0; i<60;i++){
                    var value = 0;
                    if(i<10)
                        value = '0'+i;
                    if(i>=10){
                        value = i;
                    }
                    if(i== parseInt(minute_fin)){
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option selected>'+value+'</option>';
                    }
                    else
                        liste_minute_fin_modif = liste_minute_fin_modif + '<option>'+value+'</option>';
                }
            }
            $("#new_heure_fin").html(liste_heure_fin_modif);
            $("#new_minute_fin").html(liste_minute_fin_modif);

        });

        $("#new_minute_debut").change(function(e){
            console.log("click new minute",$("#new_minute_debut option:selected").html());
            var minute_debut_modif = $("#new_minute_debut option:selected").html();

            var liste_minute_fin_modif2 = '';
            if(heure_fin <= heure_debut){
                for (var i = (parseInt(minute_debut_modif) + 1); i<60;i++){
                    var value = 0;
                    if(i<10)
                        value = '0'+i;
                    if(i>=10){
                        value = i;
                    }
                    if(i== parseInt(minute_fin)){
                        liste_minute_fin_modif2 = liste_minute_fin_modif2 + '<option selected>'+value+'</option>';
                    }
                    else
                        liste_minute_fin_modif2 = liste_minute_fin_modif2 + '<option>'+value+'</option>';
                }
            }
            else{
                for (var i = 0; i<60;i++){
                    var value = 0;
                    if(i<10)
                        value = '0'+i;
                    if(i>=10){
                        value = i;
                    }
                    if(i== parseInt(minute_fin)){
                        liste_minute_fin_modif2 = liste_minute_fin_modif2 + '<option selected>'+value+'</option>';
                    }
                    else
                        liste_minute_fin_modif2 = liste_minute_fin_modif2 + '<option>'+value+'</option>';
                }
            }
            $("#new_minute_fin").html(liste_minute_fin_modif2);

        });
        /*creation de l'event dans la bdd*/
        //TODO ?//
        var url_create=getBaseURL()+"/admin/ajax/evenementcreation/ds/"+day_start+"/de/"+day_end+"/ag/"+agenda_first_id;
/*        var event_id = $.ajax({
            url: url_create,
            async: false
        }).responseText; */
        var event_id=0;
        /*Initialisation - dialog de remplissage*/
        //ADD EVENT
        //$.mobile.changePage( "#gen_new_content", { role: "dialog" } );
        $("#gen_new_content").dialog({
            bgiframe: true,
            resizable: true,
            height:700,
            width:500,
            modal: true,
            overlay: {
                    backgroundColor: '#000',
                    opacity: 0.5
                },
            beforeclose: function(event, ui) {
                $(this).dialog('destroy');
                $("#new_event_categorieActivite").val("");  //Note il faudra surement ici inclure les valeurs
                $("#new_event_categorieLieu").val("");
                $("#new_event_lieu").val("");
                $("#new_event_compagnie").val("");
                $("#new_event_dispositif").val("");
                $("#new_event_codeActivite").val("");

                $("#0").remove();
            },
            buttons: {
                'Enregistrer': function() {
                    // console.log($("#new_event_lieu").find("option:selected").attr('id'));
                    $(this).dialog('destroy');
    //=================================================================================================================
                    //recolte des champs du formulaire
                    var new_activit=$("#new_event_codeActivite").find("option:selected").attr('id');
                    var nom_activit=$("#new_event_codeActivite").find("option:selected").html();
                    var new_lieu=$("#new_event_lieu").find("option:selected").attr('id');
                    var new_compagnie=$("#new_event_compagnie").find("option:selected").attr('id');
                    var new_dispositif=$("#new_event_dispositif").find("option:selected").attr('id');
                    var new_event_heure_debut=jour_deb+" "+$("#new_heure_debut option:selected").html()+":"+$("#new_minute_debut option:selected").html()+":00";
                    var new_event_heure_fin=jour_deb+" "+$("#new_heure_fin option:selected").html()+":"+$("#new_minute_fin option:selected").html()+":00";
                    
                    //var event_id = rep;

                    console.log('event',new_event_heure_debut);
                    var tab_debut = new_event_heure_debut.split(' ');
                    var h_debut =  tab_debut[1].split(':');

                    var tab_fin = new_event_heure_fin.split(' ');
                    var h_fin =  tab_fin[1].split(':');

                    var depSec = (parseInt(h_debut[0]) * 60 + parseInt(h_debut[1])) * 60;
                    var finSec = (parseInt(h_fin[0]) * 60 + parseInt(h_fin[1])) * 60;
                    var dureeSec = finSec - depSec;
                    
                    var margin_top_o = (((depSec/60)/60)*4)*10;
                    var height_o = (((dureeSec/60)/60)*4)*10; 
                    console.log('height',height_o);
                    
                    // var rename_event = $('#0')
                    //  .attr( 'id',event_id );
                    var event_modif_height = $('#'+event_id)
                    .css( "height",height_o+"px");

                    var event_modif_height = $('#'+event_id)
                    .css( "marginTop",margin_top_o+"px");
                    
                    var event_date = $('<div></div>')
                    .appendTo(event)
                    .attr('class','calendar_event_date')
                    .attr('id',event_id+'_calendar_event_date');

                    var event_date_heure_debut = $('<span>'+h_debut[0]+'</span>')
                    .appendTo(event_date)
                    .attr('id',event_id+'_date_debut_heure');

                    $('<span>:</span>')
                    .appendTo(event_date);

                    var event_date_minute_debut = $('<span>'+h_debut[1]+'</span>')
                    .appendTo(event_date)
                    .attr('id',event_id+'_date_debut_minute');

                    $('<span> - </span>')
                    .appendTo(event_date);

                    var event_date_heure_fin = $('<span>'+h_fin[0]+'</span>')
                    .appendTo(event_date)
                    .attr('id',event_id+'_date_fin_heure');

                    $('<span>:</span>')
                    .appendTo(event_date);
                    
                    var event_date_minute_fin = $('<span>'+h_fin[1]+'</span>')
                    .appendTo(event_date)
                    .attr('id',event_id+'_date_fin_minute');

                    var event_date_titre = $('#'+event_id+'_title')
                                    .remove();
                    var event_date_titre = $('<div>'+nom_activit+'</div>')
                    .appendTo(event)
                    .attr('class','calendar_event_title')
                    .attr('id',event_id+'_title');

                    var tmp = $('<div>'+'Sauvegarde en cours'+'</div>')
                    .appendTo(event)
                    .attr('id',event_id+'_tmp');

                    event.corner();
                    $(".calendar_event_date").corner("top cc:#fff");
                    var td_width=$(".calendar_td").width();
                    event.css({
                        "width" : td_width*0.85,
                        "margin-left" : (td_width-(td_width*0.85))/2,
                    });

                    $.ajax({
                        url: "../occupation/add",
                        type : 'POST',
                        data :  'HeureDebut=' + new_event_heure_debut + 
                                '&HeureFin=' + new_event_heure_fin  + 
                                '&CodeLieux=' + new_lieu  + 
                                '&CodeActivite=' + new_activit  + 
                                '&CodeCompagnie=' + new_compagnie  + 
                                '&CodeDispositif=' + new_dispositif,
                        dataType : 'html',
                        success : function(rep, statut){         

                            var event_id = rep;
                            $('#0_title').attr('id',event_id+'_activite');
                            $('#0_tmp').remove();
                            $('#0').attr('id',event_id);
                            $('#0_calendar_event_date').attr('id',event_id+'_calendar_event_date');
                            $('#0_date_debut_heure').attr('id',event_id+'_date_debut_heure');
                            $('#0_date_debut_minute').attr('id',event_id+'_date_debut_minute');
                            $('#0_date_fin_heure').attr('id',event_id+'_date_fin_heure');
                            $('#0_date_fin_minute').attr('id',event_id+'_date_fin_minute');
                        }
                    });
                    
            // Modif pierre - je pense que ça vien de la demos ...
      //                agenda_id=$("#agenda_id").val();
      //                if(new_titre!=""){
      //                    $("#"+event_id+'_title').html(new_titre);
      //                }
      //                if(new_lieu!=""){
      //                    $("#"+event_id+'_lieu').html(new_lieu);
      //                }
      //                new_ti=new_titre.replace(/ /gi,"&nbsp;");
      //                new_li=new_lieu.replace(/ /gi,"&nbsp;");
      //                $("#"+event_id).removeClass("select_agenda_red");
      //                class_color_agenda=$("#"+agenda_id+"_agenda_id").html();
      //                $("#"+event_id).addClass(class_color_agenda);
      //                $("#ajax_load").load(getBaseURL()+"/admin/ajax/specifyevent/id/"+event_id+"/titre/"+new_ti+"/lieu/"+new_li+"/ag/"+agenda_id);
                
                     // $("#ajax_load").html("Evenement cr&eacute&eacute..");
                    // RAZ des champs du formulaire
                    $("#new_event_categorieActivite").val("");  
                    $("#new_event_categorieLieu").val("");
                    $("#new_event_codeActivite").val("");
                    $("#new_event_lieu").val("");
                    $("#new_event_compagnie").val("");
                    $("#new_event_dispositif").val("");
                    $("#new_event_heure_debut").val("");
                    $("#new_event_heure_fin").val("");
                    $("#new_event_day").val("");
                },
                'Annuler': function() {
                    $(this).dialog('destroy');
//                    $("#ajax_load").load(getBaseURL()+"/admin/ajax/supprimerevent/id/"+event_id);
                    $("#ajax_load").html("Cr&eacute;ation de l'&eacute;v&eacute;nement annul&eacute;e.");
                    $("#"+event_id).hide("highlight",{
                        direction: "vertical",
                        color: "#A60000"
                    },1000);
                    $("#new_event_title").val("");
                    $("#new_event_lieu").val("");
                    $("#new_event_codeActivite").val("");
                    $("#new_event_categorieActivite").val("");  
                    $("#new_event_categorieLieu").val("");
                    $("#new_event_lieu").val("");
                    $("#new_event_compagnie").val("");
                    $("#new_event_dispositif").val("");
                }
                
            }
        });
        
        $("#ajax_load").html("");
        var event = $('<div></div>')
        .appendTo($(this))
        .attr('class','calendar_event select_agenda_red')
        .attr('id',event_id)
        .css({
            height:"80px",
            marginTop:margin_top+"px"
        });

        var event_date_titre = $('<div>'+'(en cours de sauvegarde)'+'</div>')
            .appendTo(event)
            .attr('class','calendar_event_title')
            .attr('id',event_id+'_title');
             
        event.corner();
        $(".calendar_event_date").corner("top cc:#fff");
        var td_width=$(".calendar_td").width();
        event.css({
            "width" : td_width*0.85,
            "margin-left" : (td_width-(td_width*0.85))/2,
        });
        $("#cp").click(function(e){
            var event_id = event_right_cliked
            console.log("copier from new event_id",event_id);
            buffer_event_id = event_id;
            buffer_height =  $('#'+event_id).css('height');
            console.log('copy from new top',$('#'+event_id).css('top'))
            buffer_margin = $('#'+event_id).css('top');
            console.log("copier from new height",buffer_height);
            console.log("copier from new margin",buffer_margin);
            buffer_heure_debut = $('#'+event_id+'_date_debut_heure').html();
            buffer_minute_debut = $('#'+event_id+'_date_debut_minute').html();
            buffer_heure_fin = $('#'+event_id+'_date_fin_heure').html();
            buffer_minute_fin = $('#'+event_id+'_date_fin_minute').html();
            buffer_activite = $('#'+event_id+'_activite').html();
            buffer_lieu = $('#'+event_id+'_lieu').html();
            buffer_compagnie = $('#'+event_id+'_compagnie').html();
            buffer_dispositif = $('#'+event_id+'_dispositif').html();
        });

         $("#sp").click(function(e){
            var event_id = event_right_cliked;
            console.log("Supprimer");
            $("#supp").html("Veuillez Confirmer la suppression");
            //$("#dialog").dialog('destroy');
            $("#supp").dialog({
                bgiframe: true,
                resizable: true,
                height:200,
                modal: true,
                beforeclose: function(event, ui) {
                    $(this).dialog('destroy');
                },
                buttons: {
                    'Supprimer': function() {
                        $(this).dialog('destroy');
                        $("#supp").html("");
                        $.ajax({  
                                url : '../occupation/delete/'+event_id,
                                type : 'POST',
                                data : event_id,
                                dataType : 'html', 
                                success : function(code_html, statut){ 
                                    console.log("ok");
                                }
                            });
                        $("#"+event_id).hide("highlight",{
                            direction: "vertical",
                            color: "#A60000"
                        },2000);
                        $("#"+event_id).remove();
                    },
                    'Annuler': function() {
                        $(this).dialog('destroy');
                        $("#supp").html("");
                    }
                }
            });
            });
    });
         /*FIN Ajout*/
      
       


//=============================================================================================================



    /*------------------   ARRONDIS  --------------------*/
    $('div#container_top').corner("top cc:#4E6257");
    $('div#header_content').corner("bottom cc:#4E6257");
    $('div#visu_page_perso').corner();
    $('div#footer').corner("bottom");
    $('.lab_form').corner();
    $('.identifiant').corner("round 9px");
    $('.password').corner("round 9px");
    $('#visu_mail').corner("round 9px cc:#CCD9C8");
    $('.infosMail').corner("round 9px cc:#CCD9C8");
    $('.contenuMail').corner();
    $('.form_contenu').corner("round 9px");
    $('.form_titre').corner("round 9px");
    $('.form_cible').corner("round 9px");
    $('#ajout_galerie').corner("round 5px");
    $('#info_activation_module').corner();
    $('.input_form').corner();
    $('.form_list').corner();
    $('.evenement_list_depart').corner();
    $('.evenement_list_fin').corner();
    $('.form_list_visible').corner();
    $('.switcher_content_content').corner("left");
    $('.calendar_event').corner("cc:#fff");
    $('.calendar_event_date').corner("top cc:#fff");
    $(".switcher_agenda_inside").corner("top");
    $("div#select_agenda").corner("top");
    $(".select_agenda_selector").corner("round 4px");
});




