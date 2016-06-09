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

    /*drop zone*/
    $(".calendar_event").mousedown(function(){
        drag_id = $(this).attr('id');
        //console.log("mouse dowm",drag_id);
    });
    $('.ui-droppable').droppable({
        drop : function(){
             // cette alerte s'exécutera une fois le bloc déposé
            
            jour_drop = $(this).attr('id');
            console.log('drop chez moi',jour_drop);
        }
    });
    /*  Déplacement event */
    //TODO
    $(".calendar_event").draggable({
        //containment: "parent",
        containment: $("#containment_tr"),
        //revert:'valid',
        grid: [$(".calendar_td").width()+(td_width-(td_width*0.85))/8, 1],
        delay: 100,
        drag: function(event, ui) {
            var object_drop = $(this);
            var object_position=object_drop.position();
            var this_position=$(this).parent().position();
            current_position=object_position.top - this_position.top - 1;

            /*placement de l'evenement*/
            var marg_css=object_drop.css("margin-top");
            var marg_css_value=parseInt(marg_css.replace(".px",""));
            var margin_top=marg_css_value+current_position;
            if(margin_top<0)margin_top=0;
            margin_top=parseInt(margin_top);



            /*changement affichage horaire*/
            var event_id=object_drop.attr("id");

            var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
            var depart_en_millisec=depart_en_sec*1000;
            var height_css=object_drop.css("height");
            var height_css_value=parseInt(height_css.replace(".px",""));
            var duree_en_sec=(((height_css_value/10)/4)*60)*60;
            var duree_en_millisec=duree_en_sec*1000;
            var fin_en_sec=depart_en_sec + duree_en_sec;
            var fin_en_millisec=depart_en_millisec + duree_en_millisec;
            nouvelle_heure_depart = new Date();
            nouvelle_heure_depart.setTime(depart_en_millisec);
            nouvelle_heure_fin = new Date();
            nouvelle_heure_fin.setTime(fin_en_millisec);
            $("#"+event_id+"_date_debut_heure").html(afficheTime(nouvelle_heure_depart.getHours()));
            $("#"+event_id+"_date_debut_minute").html(afficheTime(nouvelle_heure_depart.getMinutes()));
            $("#"+event_id+"_date_fin_heure").html(afficheTime(nouvelle_heure_fin.getHours()));
            $("#"+event_id+"_date_fin_minute").html(afficheTime(nouvelle_heure_fin.getMinutes()));
        },
        stop: function(event, ui) {
            var object_drop = $(this);
            var object_position=object_drop.position();
            var this_position=$(this).parent().position();
            current_position=object_position.top - this_position.top - 1;

            /*placement de l'evenement*/
            var marg_css=object_drop.css("margin-top");
            console.log("new margin 2",marg_css);

            var marg_css_value=parseInt(marg_css.replace(".px",""));
            var margin_top=marg_css_value+current_position;
            if(margin_top<0)margin_top=0;
            margin_top=parseInt(margin_top);



            /*changement affichage horaire*/
            var event_id=object_drop.attr("id");

            var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
            var depart_en_millisec=depart_en_sec*1000;
            var height_css=object_drop.css("height");
            var height_css_value=parseInt(height_css.replace(".px",""));
            var duree_en_sec=(((height_css_value/10)/4)*60)*60;
            var duree_en_millisec=duree_en_sec*1000;
            var fin_en_sec=depart_en_sec + duree_en_sec;
            var fin_en_millisec=depart_en_millisec + duree_en_millisec;
            nouvelle_heure_depart = new Date();
            nouvelle_heure_depart.setTime(depart_en_millisec);
            nouvelle_heure_fin = new Date();
            nouvelle_heure_fin.setTime(fin_en_millisec);
            $("#"+event_id+"_date_debut_heure").html(afficheTime(nouvelle_heure_depart.getHours()));
            $("#"+event_id+"_date_debut_minute").html(afficheTime(nouvelle_heure_depart.getMinutes()));
            $("#"+event_id+"_date_fin_heure").html(afficheTime(nouvelle_heure_fin.getHours()));
            $("#"+event_id+"_date_fin_minute").html(afficheTime(nouvelle_heure_fin.getMinutes()));

            console.log('Jai bougé');
            //var jour_deb = $(this).closest('td').attr('id');
            if(typeof jour_drop != 'undefined'){
                var jour_deb = jour_drop;
            }
            else{
                var jour_deb = $(this).closest('td').attr('id'); 
            }
            var drag_event_heure_debut=jour_deb+" "+nouvelle_heure_depart.getHours()+":"+nouvelle_heure_depart.getMinutes()+":00";
            var drag_event_heure_fin=jour_deb+" "+nouvelle_heure_fin.getHours()+":"+nouvelle_heure_fin.getMinutes()+":00";
            //DATA CHANGE DRAG
            $(".ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable").dialog('destroy');
            $.ajax({  
                    url : '../occupation/editHeure/'+event_id,
                    type : 'POST',
                    data :  'CodeOccupation=' + event_id +
                            '&HeureDebut=' + drag_event_heure_debut + 
                            '&HeureFin=' + drag_event_heure_fin,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                    }
                });

            $("#dialog").dialog('destroy');
            $("#ui-dialog-title-dialog").dialog('destroy');
            $("#gen_new_content").dialog('destroy');
            $(".ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable").dialog('destroy');
        //    $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenement/id/"+event_id+"/d/"+depart_en_sec+"/f/"+fin_en_sec);
       // $("#ajax_load").html("Modifications enregistr&eacute;es.");
        }
    });


    /* Redimensionnement event */
    //TODO
    $(".calendar_event").resizable({
        handles: 's',
        grid: [0, 10],
        stop: function(event, ui) {
            var object_drop = $(this);
            var event_id=object_drop.attr("id");
            var height_css=object_drop.css("height");
            var height_css_value=parseInt(height_css.replace(".px",""));
            var duree_en_sec=(((height_css_value/10)/4)*60)*60;

            console.log("changement de taille");
            var jour_deb = $(this).closest('td').attr('id');
            var drag_event_heure_fin=jour_deb+" "+$("#"+event_id+"_date_fin_heure").html()+":"+$("#"+event_id+"_date_fin_minute").html()+":00";
            //var drag_event_heure_fin=jour_deb+" "+new_heure.getHours()+":"+new_heure.getMinutes()+":00";

            $("#dialog").dialog('destroy');
            $("#ui-dialog-title-dialog").dialog('destroy');
            $("#gen_new_content").dialog('destroy');
            $(".ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable").dialog('destroy');

            $.ajax({  
                    url : '../occupation/editHeureFin/'+event_id,
                    type : 'POST',
                    data :  'CodeOccupation=' + event_id +
                            '&HeureFin=' + drag_event_heure_fin,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                    }
                });

            $("#dialog").dialog('destroy');
            $("#ui-dialog-title-dialog").dialog('destroy');
            $("#gen_new_content").dialog('destroy');
            $(".ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable").dialog('destroy');
 //           $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenementresize/id/"+event_id+"/dur/"+duree_en_sec);
 //$("#ajax_load").html("Heure de fin correctement modifi&eacute;e.");
        },
        resize: function(event,ui) {
            var object_drop = $(this);
            var event_id=object_drop.attr("id");   
            var heure_depart=parseInt($("#"+event_id+"_date_debut_heure").html());
            var min_depart=parseInt($("#"+event_id+"_date_debut_minute").html());  
            var heure_ref = new Date();
            heure_ref.setHours(heure_depart, min_depart, 0, 0);
            var timestamp=heure_ref.getTime();
            var height_css=object_drop.css("height");
            var height_css_value=parseInt(height_css.replace(".px",""));
            var duree_en_milli=((((height_css_value/10)/4)*60)*60)*1000;
    
            var new_heure = new Date();
            new_heure.setTime(timestamp+duree_en_milli);
    
            $("#"+event_id+"_date_fin_heure").html(afficheTime(new_heure.getHours()));
            $("#"+event_id+"_date_fin_minute").html(afficheTime(new_heure.getMinutes()));

        }
    });


    /* cp -coller */
    $(document).on('contextmenu', '.calendar_event,', function(e) {
        var object_clicked = $(this);
        event_right_cliked = object_clicked.attr("id");
        var event_id=object_clicked.attr("id");
        //TEST recup heure //
        jour_deb = $(this).closest('td').attr('id');
        console.log('jai clique droit',event_id)
        $("#click-menue").css({top:e.pageY,left:e.pageX}).show();
        $("#paste-menue").hide();
        $("#cp").click(function(e){
            console.log("copier out",event_id);
            buffer_event_id = event_id;
            buffer_height =  $('#'+event_id).css('height');
            if($('#'+event_id).css('top') != null){
                var hdeb = parseInt($('#'+event_id+'_date_debut_heure').html());
                var mdeb = parseInt($('#'+event_id+'_date_debut_minute').html());
                var $depSec = hdeb*60*60 + mdeb*60; 
                var $margin_top = ((($depSec/60)/60)*4)*10;
                buffer_margin = $margin_top+"px";
            } 
            else {
                buffer_margin = $('#'+event_id).css('margin-top');
            }
            console.log("height",buffer_height);
            console.log("margin",buffer_margin);
            buffer_heure_debut = $('#'+event_id+'_date_debut_heure').html();
            buffer_minute_debut = $('#'+event_id+'_date_debut_minute').html();
            buffer_heure_fin = $('#'+event_id+'_date_fin_heure').html();
            buffer_minute_fin = $('#'+event_id+'_date_fin_minute').html();
            buffer_activite = $('#'+event_id+'_activite').html();
            buffer_lieu = $('#'+event_id+'_lieu').html();
            buffer_compagnie = $('#'+event_id+'_compagnie').html();
            buffer_dispositif = $('#'+event_id+'_dispositif').html();
        });
        e.preventDefault();
        return false;
    });

    $("#sp").click(function(e){
            console.log("Supprimer");
            $("#supp").html("Veuillez Confirmer la suppression");
            var event_id = event_right_cliked;
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

    $(document).click(function(e){
        $("#click-menue").hide();
        $("#paste-menue").hide();
    });

    /* debut cp-cl*/
    $(document).on('contextmenu', '.other_day,', function(e) {
        $("#vd").click(function(e){
            console.log("vider");
            buffer_event_id = '';
            buffer_height =  '';
            buffer_margin = '';
            buffer_heure_debut = '';
            buffer_minute_debut = '';
            buffer_heure_fin = '';
            buffer_minute_fin = '';
            buffer_activite = '';
            buffer_lieu = '';
            buffer_compagnie = '';
            buffer_dispositif = '';
        });
        if(buffer_event_id != null){
            $("#paste-menue").css({top:e.pageY,left:e.pageX}).show();
        }
        $("#click-menue").hide();
        column_target = $(this);
        jour_deb = $(this).attr('id');
         
        e.preventDefault();
        return false;
    }); /*fin cp-cl*/
    //COLLER//
    $("#cl").click(function(e){
        console.log("coller dans ",jour_deb);
        
        //var event_id = "cp_"+buffer_event_id;
        //var jour_deb = $(this).closest('td').attr('id');
        console.log("new jour : ",jour_deb);
    
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

        /*creation de l'event dans la bdd*/
        //TODO ?//
        var url_create=getBaseURL()+"/admin/ajax/evenementcreation/ds/"+day_start+"/de/"+day_end+"/ag/"+agenda_first_id;

        var event_id=0;
        /*Initialisation - dialog de remplissage*/
        //ADD EVENT CP
        //recolte des champs du buffer

       
        var nom_activit=buffer_activite;
        var new_event_heure_debut=jour_deb+" "+buffer_heure_debut+":"+buffer_minute_debut+":00";
        var new_event_heure_fin=jour_deb+" "+buffer_heure_fin+":"+buffer_minute_fin+":00";

        //console.log('event',new_event_heure_debut);
        var tab_debut = new_event_heure_debut.split(' ');
        var h_debut =  tab_debut[1].split(':');

        var tab_fin = new_event_heure_fin.split(' ');
        var h_fin =  tab_fin[1].split(':');

        var depSec = (parseInt(h_debut[0]) * 60 + parseInt(h_debut[1])) * 60;
        var finSec = (parseInt(h_fin[0]) * 60 + parseInt(h_fin[1])) * 60;
        var dureeSec = finSec - depSec;
        
        var margin_top_o = (((depSec/60)/60)*4)*10;
        var height_o = (((dureeSec/60)/60)*4)*10; 
        console.log('height',buffer_height);
        console.log('margin',buffer_margin);
        
        $("#ajax_load").html("");
        var event = $('<div></div>')
        .appendTo(column_target)
        .attr('class','calendar_event select_agenda_red')
        .attr('id',event_id+"_main")
        .css({
            height:buffer_height,
            marginTop:buffer_margin
        });
        
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
        .attr('class','calendar_event_activite')
        .attr('id',event_id+'_activite');

        if(buffer_lieu != null){
            var modif_lieu =  $('<div>'+buffer_lieu+'</div>')
            .appendTo(event)
            .attr('class','calendar_event_lieu')
            .attr('id',event_id+'_lieu');
        }
        if(buffer_compagnie != null){
            var modif_compagnie = $('<div>'+buffer_compagnie+'</div>')
            .appendTo(event)
            .attr('class','calendar_event_compagnie')
            .attr('id',event_id+'_compagnie');
        }
        if(buffer_dispositif != null){
            var modif_dispositif =  $('<div>'+buffer_dispositif+'</div>')
            .appendTo(event)
            .attr('class','calendar_event_dispositif')
            .attr('id',event_id+'_dispositif');
        }

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

        //AJAX CP-CL
         $.ajax({  
                    url : '../occupation/copier/',
                    type : 'POST',
                    data : "CodeOccupation=" + buffer_event_id +
                           '&HeureDebut=' + new_event_heure_debut + 
                           '&HeureFin=' + new_event_heure_fin,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                        console.log(code_html);
                        var event_id = code_html;
                        $('#0_main').attr('id',event_id);
                        $('#0_tmp').remove();
                        $('#0_activite').attr('id',event_id+'_activite');
                        $('#0_lieu').attr('id',event_id+'_lieu');
                        $('#0_compagnie').attr('id',event_id+'_compagnie');
                        $('#0_dispositif').attr('id',event_id+'_dispositif');
                        $('#0_calendar_event_date').attr('id',event_id+'_calendar_event_date');
                        $('#0_date_debut_heure').attr('id',event_id+'_date_debut_heure');
                        $('#0_date_debut_minute').attr('id',event_id+'_date_debut_minute');
                        $('#0_date_fin_heure').attr('id',event_id+'_date_fin_heure');
                        $('#0_date_fin_minute').attr('id',event_id+'_date_fin_minute');
            }
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
        /*application des interactions avec l'event*/
        event.draggable({
            //containment: "parent",
            containment: $("#containment_tr"),
            //revert:'valid',
            grid: [$(".calendar_td").width()+(td_width-(td_width*0.85))/8, 1],
            delay: 100,
            drag: function(event, ui) {
                var object_drop = $(this);
                var object_position=object_drop.position();
                var this_position=$(this).parent().position();
                current_position=object_position.top - this_position.top - 1;

                /*placement de l'evenement*/
                var marg_css=object_drop.css("margin-top");
                var marg_css_value=parseInt(marg_css.replace(".px",""));
                var margin_top=marg_css_value+current_position;
                if(margin_top<0)margin_top=0;
                margin_top=parseInt(margin_top);



                /*changement affichage horaire*/
                var event_id=object_drop.attr("id");

                var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
                var depart_en_millisec=depart_en_sec*1000;
                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_sec=(((height_css_value/10)/4)*60)*60;
                var duree_en_millisec=duree_en_sec*1000;
                var fin_en_sec=depart_en_sec + duree_en_sec;
                var fin_en_millisec=depart_en_millisec + duree_en_millisec;
                nouvelle_heure_depart = new Date();
                nouvelle_heure_depart.setTime(depart_en_millisec);
                nouvelle_heure_fin = new Date();
                nouvelle_heure_fin.setTime(fin_en_millisec);
                $("#"+event_id+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
                $("#"+event_id+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
                $("#"+event_id+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
                $("#"+event_id+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());
            },
            stop: function(event, ui) {
                var object_drop = $(this);
                var object_position=object_drop.position();
                var this_position=$(this).parent().position();
                current_position=object_position.top - this_position.top - 1;

                /*placement de l'evenement*/
                var marg_css=object_drop.css("margin-top");
                console.log("new margin 3",marg_css);

                var marg_css_value=parseInt(marg_css.replace(".px",""));
                var margin_top=marg_css_value+current_position;
                if(margin_top<0)margin_top=0;
                margin_top=parseInt(margin_top);



                /*changement affichage horaire*/
                var event_id=object_drop.attr("id");

                var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
                var depart_en_millisec=depart_en_sec*1000;
                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_sec=(((height_css_value/10)/4)*60)*60;
                var duree_en_millisec=duree_en_sec*1000;
                var fin_en_sec=depart_en_sec + duree_en_sec;
                var fin_en_millisec=depart_en_millisec + duree_en_millisec;
                nouvelle_heure_depart = new Date();
                nouvelle_heure_depart.setTime(depart_en_millisec);
                nouvelle_heure_fin = new Date();
                nouvelle_heure_fin.setTime(fin_en_millisec);
                $("#"+event_id+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
                $("#"+event_id+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
                $("#"+event_id+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
                $("#"+event_id+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());
                var jour_deb = jour_drop;
                var drag_event_heure_debut=jour_deb+" "+nouvelle_heure_depart.getHours()+":"+nouvelle_heure_depart.getMinutes()+":00";
                var drag_event_heure_fin=jour_deb+" "+nouvelle_heure_fin.getHours()+":"+nouvelle_heure_fin.getMinutes()+":00";
                //DATA CHANGE DRAG
                $(".ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable").dialog('destroy');
                $.ajax({  
                        url : '../occupation/editHeure/'+event_id,
                        type : 'POST',
                        data :  'CodeOccupation=' + event_id +
                                '&HeureDebut=' + drag_event_heure_debut + 
                                '&HeureFin=' + drag_event_heure_fin,
                        dataType : 'html', 
                        success : function(code_html, statut){ 
                        }
                    });
        //        $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenement/id/"+event_id+"/d/"+depart_en_sec+"/f/"+fin_en_sec);
        //$("#ajax_load").html("Modifications enregistr&eacute;.");
            }
        });
        event.resizable({
            handles: 's',
            grid: [0, 5],
            stop: function(event, ui) {
                var object_drop = $(this);
                var event_id=object_drop.attr("id");
                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_sec=(((height_css_value/10)/4)*60)*60;
                var jour_deb = $(this).closest('td').attr('id');
                var drag_event_heure_fin=jour_deb+" "+$("#"+event_id+"_date_fin_heure").html()+":"+$("#"+event_id+"_date_fin_minute").html()+":00";

                $.ajax({  
                    url : '../occupation/editHeureFin/'+event_id,
                    type : 'POST',
                    data :  'CodeOccupation=' + event_id +
                            '&HeureFin=' + drag_event_heure_fin,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                    }
                });

            },
            resize: function(event,ui) {
                var object_drop = $(this);
                var event_id=object_drop.attr("id");

                var heure_depart=parseInt($("#"+event_id+"_date_debut_heure").html());
                var min_depart=parseInt($("#"+event_id+"_date_debut_minute").html());

                var heure_ref = new Date();
                heure_ref.setHours(heure_depart, min_depart, 0, 0);

                var timestamp=heure_ref.getTime();




                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_milli=((((height_css_value/10)/4)*60)*60)*1000;

                var new_heure = new Date();
                new_heure.setTime(timestamp+duree_en_milli);

                $("#"+event_id+"_date_fin_heure").html(new_heure.getHours());
                $("#"+event_id+"_date_fin_minute").html(new_heure.getMinutes());

            //        $("#"+event_id+"_date").corner("top");
            }
        });
        //TODO
        //event.click(function(e){
        $("#md").click(function(e){
            // var object_clicked = $(this);
            // var event_id=object_clicked.attr("id");
            // console.log('jai clique',event_id);
            var event_id = event_right_cliked;
            //var jour_deb = $(this).closest('td').attr('id');
            
            $("#dialog").dialog({
                bgiframe: true,
                resizable: true,
                height:720,
                width:500,
                modal: true,
                overlay: {
                    backgroundColor: '#000',
                    opacity: 0.5
                },
                beforeclose: function(event, ui) {
                    $(this).dialog('destroy');
                },
                open: function(event, ui) {
                    var heure_debut=$("#"+event_id+"_date_debut_heure").html();
                var minute_debut=$("#"+event_id+"_date_debut_minute").html();
                var heure_fin=$("#"+event_id+"_date_fin_heure").html();
                var minute_fin=$("#"+event_id+"_date_fin_minute").html();
                var titre_eve=$("#"+event_id+"_title").html();
                var lieu_eve=$("#"+event_id+"_lieu").html();
                var contenu = "";
                $("#ui-dialog-title-dialog").html("Détail");
                $("#dialog").html("veuillez patienter pendant le chargement des données");
                $.ajax({  
                    url : '../occupation/edit/'+event_id,
                    type : 'GET',
                    data : event_id,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                        contenu = code_html;
                
                        $("#dialog").html(contenu);
                        var width_select = $("#edit_heure_debut").width();
                        $("#edit_heure_debut").css({
                        "width" : width_select*0.2});
                        $("#edit_minute_debut").css({
                                        "width" : width_select*0.2});
                        $("#edit_heure_fin").css({
                                        "width" : width_select*0.2});
                        $("#edit_minute_fin").css({
                                        "width" : width_select*0.2});
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
                        $("#edit_heure_debut").html(liste_heure_debut);
                        $("#edit_minute_debut").html(liste_minute_debut);
                        $("#edit_heure_fin").html(liste_heure_fin);
                        $("#edit_minute_fin").html(liste_minute_fin);

                        $("#edit_heure_fin").change(function(e){
                            heure_fin = $("#edit_heure_fin option:selected").html();
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
                            $("#edit_minute_fin").html(liste_minute_fin_modif);
                        });
                        $("#edit_minute_fin").change(function(e){
                            minute_fin = $("#edit_minute_fin option:selected").html();
                        });
                        $("#edit_heure_debut").change(function(e){
                            console.log("click edit heure",$("#edit_heure_debut option:selected").html());
                            var heure_debut_modif = $("#edit_heure_debut option:selected").html();
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
                            $("#edit_heure_fin").html(liste_heure_fin_modif);
                            $("#edit_minute_fin").html(liste_minute_fin_modif);

                        });

                        $("#edit_minute_debut").change(function(e){
                            console.log("click edit minute",$("#edit_minute_debut option:selected").html());
                            var minute_debut_modif = $("#edit_minute_debut option:selected").html();

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
                            $("#edit_minute_fin").html(liste_minute_fin_modif2);

                        });
                    }
                });
                },
                buttons: {
                    'Modifier': function(){
                    var new_activit=$("#CodeActivite").find("option:selected").attr('value');
                    var nom_activit=$("#CodeActivite").find("option:selected").html();
                    var new_lieu=$("#CodeLieux").find("option:selected").attr('value');
                    var nom_lieu=$("#CodeLieux").find("option:selected").html();
                    var new_compagnie=$("#CodeCompagnie").find("option:selected").attr('value');
                    var nom_compagnie=$("#CodeCompagnie").find("option:selected").html();
                    var new_dispositif=$("#CodeDispositif").find("option:selected").attr('value');
                    var nom_dispositif=$("#CodeDispositif").find("option:selected").html();
                    var new_event_heure_debut=jour_deb+" "+$("#edit_heure_debut").find("option:selected").html()+":"+$("#edit_minute_debut").find("option:selected").html()+":00";
                    var new_event_heure_fin=jour_deb+" "+$("#edit_heure_fin").find("option:selected").html()+":"+$("#edit_minute_fin").find("option:selected").html()+":00";

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

                    var event_modif_height = $('#'+event_id)
                    .css( "height",height_o+"px");

                    var event_modif_height = $('#'+event_id)
                    .css( "marginTop",margin_top_o+"px");
                    
                    var modif_event_date_heure_debut = $('#'+event_id+"_date_debut_heure")
                    .replaceWith('<span>'+h_debut[0]+'</span>');
                    
                    var modif_event_date_minute_debut = $('#'+event_id+"_date_debut_minute")
                    .replaceWith('<span>'+h_debut[1]+'</span>');
                    
                    var modif_event_date_heure_fin = $('#'+event_id+"_date_fin_heure")
                    .replaceWith('<span>'+h_fin[0]+'</span>');
                    
                    var modif_event_date_minute_fin = $('#'+event_id+"_date_fin_minute")
                    .replaceWith('<span>'+h_fin[1]+'</span>');

                    if(height_o>=60){
                        var modif_event_date_titre = $('#'+event_id+"_activite")
                        .replaceWith('<div id="'+event_id+'_activite">'+nom_activit+'</div>');
                    }
                    if(height_o>=140){
                        var modif_lieu = $('#'+event_id+"_lieu")
                        .replaceWith('<div id="'+event_id+'_lieu">'+nom_lieu+'</div>')
                    }
                    if(height_o>=180){
                        var modif_compagnie = $('#'+event_id+"_compagnie")
                        .replaceWith('<div id="'+event_id+'_compagnie">'+nom_compagnie+'</div>');
                
                        var modif_dispositif = $('#'+event_id+"_dispositif")
                        .replaceWith('<div id="'+event_id+'_dispositif">'+nom_dispositif+'</div>');
                    }
                    $.ajax({
                        url: "../occupation/edit/"+event_id,
                        type :  'POST',
                        data :  'CodeOccupation=' + event_id +
                                '&HeureDebut=' + new_event_heure_debut + 
                                '&HeureFin=' + new_event_heure_fin  + 
                                '&CodeLieux=' + new_lieu  + 
                                '&CodeActivite=' + new_activit  + 
                                '&CodeCompagnie=' + new_compagnie  + 
                                '&CodeDispositif=' + new_dispositif,
                        dataType : 'html',
                        success : function(rep, statut){ 
                            
                            console.log('modif success');
                        }
                    });
                    $(this).dialog('destroy');
                }
                }

            });
        });
    });//FIN COLLER

    /*nouvel event*/
    $(".calendar_td").dblclick(function(e){
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
						data : 	'HeureDebut=' + new_event_heure_debut + 
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

        /*application des interactions avec l'event*/
        event.draggable({
            //containment: "parent",
            containment: $("#containment_tr"),
            //revert:'valid',
            grid: [$(".calendar_td").width()+(td_width-(td_width*0.85))/8, 1],
            delay: 100,
            drag: function(event, ui) {
                var object_drop = $(this);
                var object_position=object_drop.position();
                var this_position=$(this).parent().position();
                current_position=object_position.top - this_position.top - 1;

                /*placement de l'evenement*/
                var marg_css=object_drop.css("margin-top");
                var marg_css_value=parseInt(marg_css.replace(".px",""));
                var margin_top=marg_css_value+current_position;
                if(margin_top<0)margin_top=0;
                margin_top=parseInt(margin_top);



                /*changement affichage horaire*/
                var event_id=object_drop.attr("id");

                var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
                var depart_en_millisec=depart_en_sec*1000;
                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_sec=(((height_css_value/10)/4)*60)*60;
                var duree_en_millisec=duree_en_sec*1000;
                var fin_en_sec=depart_en_sec + duree_en_sec;
                var fin_en_millisec=depart_en_millisec + duree_en_millisec;
                nouvelle_heure_depart = new Date();
                nouvelle_heure_depart.setTime(depart_en_millisec);
                nouvelle_heure_fin = new Date();
                nouvelle_heure_fin.setTime(fin_en_millisec);
                $("#"+event_id+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
                $("#"+event_id+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
                $("#"+event_id+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
                $("#"+event_id+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());
            },
            stop: function(event, ui) {
                var object_drop = $(this);
                var object_position=object_drop.position();
                var this_position=$(this).parent().position();
                current_position=object_position.top - this_position.top - 1;

                /*placement de l'evenement*/
                var marg_css=object_drop.css("margin-top");
                console.log("new margin 1",marg_css);
                var marg_css_value=parseInt(marg_css.replace(".px",""));
                var margin_top=marg_css_value+current_position;
                if(margin_top<0)margin_top=0;
                margin_top=parseInt(margin_top);



                /*changement affichage horaire*/
                var event_id=object_drop.attr("id");

                var depart_en_sec=(((margin_top/10)/4-1)*60)*60;
                var depart_en_millisec=depart_en_sec*1000;
                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_sec=(((height_css_value/10)/4)*60)*60;
                var duree_en_millisec=duree_en_sec*1000;
                var fin_en_sec=depart_en_sec + duree_en_sec;
                var fin_en_millisec=depart_en_millisec + duree_en_millisec;
                nouvelle_heure_depart = new Date();
                nouvelle_heure_depart.setTime(depart_en_millisec);
                nouvelle_heure_fin = new Date();
                nouvelle_heure_fin.setTime(fin_en_millisec);
                $("#"+event_id+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
                $("#"+event_id+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
                $("#"+event_id+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
                $("#"+event_id+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());

                var jour_deb = jour_drop;
                var drag_event_heure_debut=jour_deb+" "+nouvelle_heure_depart.getHours()+":"+nouvelle_heure_depart.getMinutes()+":00";
                var drag_event_heure_fin=jour_deb+" "+nouvelle_heure_fin.getHours()+":"+nouvelle_heure_fin.getMinutes()+":00";
                //DATA CHANGE DRAG
                $(".ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable").dialog('destroy');
                $.ajax({  
                        url : '../occupation/editHeure/'+event_id,
                        type : 'POST',
                        data :  'CodeOccupation=' + event_id +
                                '&HeureDebut=' + drag_event_heure_debut + 
                                '&HeureFin=' + drag_event_heure_fin,
                        dataType : 'html', 
                        success : function(code_html, statut){ 
                        }
                    });

        //        $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenement/id/"+event_id+"/d/"+depart_en_sec+"/f/"+fin_en_sec);
        //$("#ajax_load").html("Modifications enregistr&eacute;.");
            }
        });
        event.resizable({
            handles: 's',
            grid: [0, 5],
            stop: function(event, ui) {
                var object_drop = $(this);
                var event_id=object_drop.attr("id");
                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_sec=(((height_css_value/10)/4)*60)*60;
                var jour_deb = $(this).closest('td').attr('id');
                var drag_event_heure_fin=jour_deb+" "+$("#"+event_id+"_date_fin_heure").html()+":"+$("#"+event_id+"_date_fin_minute").html()+":00";

                $.ajax({  
                    url : '../occupation/editHeureFin/'+event_id,
                    type : 'POST',
                    data :  'CodeOccupation=' + event_id +
                            '&HeureFin=' + drag_event_heure_fin,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                    }
                });

            },
            resize: function(event,ui) {
                var object_drop = $(this);
                var event_id=object_drop.attr("id");

                var heure_depart=parseInt($("#"+event_id+"_date_debut_heure").html());
                var min_depart=parseInt($("#"+event_id+"_date_debut_minute").html());

                var heure_ref = new Date();
                heure_ref.setHours(heure_depart, min_depart, 0, 0);

                var timestamp=heure_ref.getTime();




                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_milli=((((height_css_value/10)/4)*60)*60)*1000;

                var new_heure = new Date();
                new_heure.setTime(timestamp+duree_en_milli);

                $("#"+event_id+"_date_fin_heure").html(new_heure.getHours());
                $("#"+event_id+"_date_fin_minute").html(new_heure.getMinutes());
            //        $("#"+event_id+"_date").corner("top");
            }
        });
        //TODO
        //event.click(function(e){
        $("#md").click(function(e){
            //var object_clicked = $(this);
            //var event_id=object_clicked.attr("id");
            var event_id=event_right_cliked;
            console.log('jai clique',event_id);
            //TEST recup heure //
            //var jour_deb = $(this).closest('td').attr('id');
            
            $("#dialog").dialog({
                bgiframe: true,
                resizable: true,
                height:720,
                width:500,
                modal: true,
                overlay: {
                    backgroundColor: '#000',
                    opacity: 0.5
                },
                beforeclose: function(event, ui) {
                    $(this).dialog('destroy');
                },
                open: function(event, ui) {
                    var heure_debut=$("#"+event_id+"_date_debut_heure").html();
                var minute_debut=$("#"+event_id+"_date_debut_minute").html();
                var heure_fin=$("#"+event_id+"_date_fin_heure").html();
                var minute_fin=$("#"+event_id+"_date_fin_minute").html();
                var titre_eve=$("#"+event_id+"_title").html();
                var lieu_eve=$("#"+event_id+"_lieu").html();
                var contenu = "";
                $("#ui-dialog-title-dialog").html("Détail");
                $("#dialog").html("veuillez patienter pendant le chargement des données");
                $.ajax({  
                    url : '../occupation/edit/'+event_id,
                    type : 'GET',
                    data : event_id,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                        contenu = code_html;
                
                        $("#dialog").html(contenu);
                        var width_select = $("#edit_heure_debut").width();
                        $("#edit_heure_debut").css({
                        "width" : width_select*0.2});
                        $("#edit_minute_debut").css({
                                        "width" : width_select*0.2});
                        $("#edit_heure_fin").css({
                                        "width" : width_select*0.2});
                        $("#edit_minute_fin").css({
                                        "width" : width_select*0.2});
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
                        $("#edit_heure_debut").html(liste_heure_debut);
                        $("#edit_minute_debut").html(liste_minute_debut);
                        $("#edit_heure_fin").html(liste_heure_fin);
                        $("#edit_minute_fin").html(liste_minute_fin);

                        $("#edit_heure_fin").change(function(e){
                            heure_fin = $("#edit_heure_fin option:selected").html();
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
                            $("#edit_minute_fin").html(liste_minute_fin_modif);
                        });
                        $("#edit_minute_fin").change(function(e){
                            minute_fin = $("#edit_minute_fin option:selected").html();
                        });
                        $("#edit_heure_debut").change(function(e){
                            console.log("click edit heure",$("#edit_heure_debut option:selected").html());
                            var heure_debut_modif = $("#edit_heure_debut option:selected").html();
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
                            $("#edit_heure_fin").html(liste_heure_fin_modif);
                            $("#edit_minute_fin").html(liste_minute_fin_modif);

                        });

                        $("#edit_minute_debut").change(function(e){
                            console.log("click edit minute",$("#edit_minute_debut option:selected").html());
                            var minute_debut_modif = $("#edit_minute_debut option:selected").html();

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
                            $("#edit_minute_fin").html(liste_minute_fin_modif2);

                        });
                    }
                });
                },
                buttons: {
                    'Modifier': function(){
                    var new_activit=$("#CodeActivite").find("option:selected").attr('value');
                    var nom_activit=$("#CodeActivite").find("option:selected").html();
                    var new_lieu=$("#CodeLieux").find("option:selected").attr('value');
                    var nom_lieu=$("#CodeLieux").find("option:selected").html();
                    var new_compagnie=$("#CodeCompagnie").find("option:selected").attr('value');
                    var nom_compagnie=$("#CodeCompagnie").find("option:selected").html();
                    var new_dispositif=$("#CodeDispositif").find("option:selected").attr('value');
                    var nom_dispositif=$("#CodeDispositif").find("option:selected").html();
                    var new_event_heure_debut=jour_deb+" "+$("#edit_heure_debut").find("option:selected").html()+":"+$("#edit_minute_debut").find("option:selected").html()+":00";
                    var new_event_heure_fin=jour_deb+" "+$("#edit_heure_fin").find("option:selected").html()+":"+$("#edit_minute_fin").find("option:selected").html()+":00";

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

                    var event_modif_height = $('#'+event_id)
                    .css( "height",height_o+"px");

                    var event_modif_height = $('#'+event_id)
                    .css( "marginTop",margin_top_o+"px");
                    
                    var modif_event_date_heure_debut = $('#'+event_id+"_date_debut_heure")
                    .replaceWith('<span>'+h_debut[0]+'</span>');
                    
                    var modif_event_date_minute_debut = $('#'+event_id+"_date_debut_minute")
                    .replaceWith('<span>'+h_debut[1]+'</span>');
                    
                    var modif_event_date_heure_fin = $('#'+event_id+"_date_fin_heure")
                    .replaceWith('<span>'+h_fin[0]+'</span>');
                    
                    var modif_event_date_minute_fin = $('#'+event_id+"_date_fin_minute")
                    .replaceWith('<span>'+h_fin[1]+'</span>');

                    if(height_o>=60){
                        var modif_event_date_titre = $('#'+event_id+"_activite")
                        .replaceWith('<div id="'+event_id+'_activite">'+nom_activit+'</div>');
                    }
                    if(height_o>=140){
                        var modif_lieu = $('#'+event_id+"_lieu")
                        .replaceWith('<div id="'+event_id+'_lieu">'+nom_lieu+'</div>')
                    }
                    if(height_o>=180){
                        var modif_compagnie = $('#'+event_id+"_compagnie")
                        .replaceWith('<div id="'+event_id+'_compagnie">'+nom_compagnie+'</div>');
                
                        var modif_dispositif = $('#'+event_id+"_dispositif")
                        .replaceWith('<div id="'+event_id+'_dispositif">'+nom_dispositif+'</div>');
                    }

                     var tmp = $('<div>'+'Sauvegarde en cours'+'</div>')
                    .appendTo(event)
                    .attr('id',event_id+'_tmp');

                    $.ajax({
                        url: "../occupation/edit/"+event_id,
                        type :  'POST',
                        data :  'CodeOccupation=' + event_id +
                                '&HeureDebut=' + new_event_heure_debut + 
                                '&HeureFin=' + new_event_heure_fin  + 
                                '&CodeLieux=' + new_lieu  + 
                                '&CodeActivite=' + new_activit  + 
                                '&CodeCompagnie=' + new_compagnie  + 
                                '&CodeDispositif=' + new_dispositif,
                        dataType : 'html',
                        success : function(rep, statut){ 
                            
                            console.log('modif success');
                            $("#"+event_id+"_tmp").remove();
                        }
                    });
                    $(this).dialog('destroy');
                }
                }

            });
        });

    });


    /*info event*/
    //$(".calendar_event").click(function(e){
    $("#md").click(function(e){
        //var object_clicked = $(this);
        var event_id = event_right_cliked;
        //var event_id=object_clicked.attr("id");
        console.log('jai clique calendar event',event_id);
        
        $("#dialog").dialog({
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
            },
            open: function(event, ui) {    
                heure_debut=$("#"+event_id+"_date_debut_heure").html();
                minute_debut=$("#"+event_id+"_date_debut_minute").html();
                heure_fin=$("#"+event_id+"_date_fin_heure").html();
                minute_fin=$("#"+event_id+"_date_fin_minute").html();
                var titre_eve=$("#"+event_id+"_title").html();
                var lieu_eve=$("#"+event_id+"_lieu").html();
                var contenu = "";
                $("#ui-dialog-title-dialog").html("Détail");
                $("#dialog").html("veuillez patienter pendant le chargement des données");
                $.ajax({  
                    url : '../occupation/edit/'+event_id,
                    type : 'GET',
                    data : event_id,
                    dataType : 'html', 
                    success : function(code_html, statut){ 
                        contenu = code_html;
                
                        $("#dialog").html(contenu);
                        var width_select = $("#edit_heure_debut").width();
                        $("#edit_heure_debut").css({
                        "width" : width_select*0.2});
                        $("#edit_minute_debut").css({
                                        "width" : width_select*0.2});
                        $("#edit_heure_fin").css({
                                        "width" : width_select*0.2});
                        $("#edit_minute_fin").css({
                                        "width" : width_select*0.2});
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
                        $("#edit_heure_debut").html(liste_heure_debut);
                        $("#edit_minute_debut").html(liste_minute_debut);
                        $("#edit_heure_fin").html(liste_heure_fin);
                        $("#edit_minute_fin").html(liste_minute_fin);

                        $("#edit_heure_fin").change(function(e){
                            heure_fin = $("#edit_heure_fin option:selected").html();
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
                            $("#edit_minute_fin").html(liste_minute_fin_modif);
                        });
                        $("#edit_minute_fin").change(function(e){
                            minute_fin = $("#edit_minute_fin option:selected").html();
                        });
                        $("#edit_heure_debut").change(function(e){
                            console.log("click edit heure",$("#edit_heure_debut option:selected").html());
                            var heure_debut_modif = $("#edit_heure_debut option:selected").html();
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
                            $("#edit_heure_fin").html(liste_heure_fin_modif);
                            $("#edit_minute_fin").html(liste_minute_fin_modif);

                        });

                        $("#edit_minute_debut").change(function(e){
                            console.log("click edit minute",$("#edit_minute_debut option:selected").html());
                            var minute_debut_modif = $("#edit_minute_debut option:selected").html();
                            minute_debut = minute_debut_modif;
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
                            $("#edit_minute_fin").html(liste_minute_fin_modif2);

                        });
                    }
                });
            },
            buttons: {
                  'Modifier': function(){
                    var new_activit=$("#CodeActivite").find("option:selected").attr('value');
                    var nom_activit=$("#CodeActivite").find("option:selected").html();
                    var new_lieu=$("#CodeLieux").find("option:selected").attr('value');
                    var nom_lieu=$("#CodeLieux").find("option:selected").html();
                    var new_compagnie=$("#CodeCompagnie").find("option:selected").attr('value');
                    var nom_compagnie=$("#CodeCompagnie").find("option:selected").html();
                    var new_dispositif=$("#CodeDispositif").find("option:selected").attr('value');
                    var nom_dispositif=$("#CodeDispositif").find("option:selected").html();
                    var new_event_heure_debut=jour_deb+" "+$("#edit_heure_debut").find("option:selected").html()+":"+$("#edit_minute_debut").find("option:selected").html()+":00";
                    var new_event_heure_fin=jour_deb+" "+$("#edit_heure_fin").find("option:selected").html()+":"+$("#edit_minute_fin").find("option:selected").html()+":00";

                    console.log('event d',new_event_heure_debut);
                    console.log('event f',new_event_heure_fin);
                    // var tab_debut = new_event_heure_debut.split(' ');
                    // var h_debut =  tab_debut[1].split(':');

                    // var tab_fin = new_event_heure_fin.split(' ');
                    // var h_fin =  tab_fin[1].split(':');

                    var depSec = (parseInt(heure_debut) * 60 + parseInt(minute_debut)) * 60;
                    var finSec = (parseInt(heure_fin) * 60 + parseInt(minute_fin)) * 60;
                    var dureeSec = finSec - depSec;
                    
                    var margin_top_o = (((depSec/60)/60)*4)*10;
                    var height_o = (((dureeSec/60)/60)*4)*10; 

                    console.log("new height = ",height_o);
                    console.log("id = ",event_id);

                    var event_modif_height = $('#'+event_id)
                    .css( "height",height_o+"px");

                    var event_modif_height = $('#'+event_id)
                    .css( "marginTop",margin_top_o+"px");
                    
                    var modif_event_date_heure_debut = $('#'+event_id+"_date_debut_heure")
                    .replaceWith('<span>'+heure_debut+'</span>');
                    
                    var modif_event_date_minute_debut = $('#'+event_id+"_date_debut_minute")
                    .replaceWith('<span>'+minute_debut+'</span>');
                    
                    var modif_event_date_heure_fin = $('#'+event_id+"_date_fin_heure")
                    .replaceWith('<span>'+heure_fin+'</span>');
                    
                    var modif_event_date_minute_fin = $('#'+event_id+"_date_fin_minute")
                    .replaceWith('<span>'+minute_fin+'</span>');

                    if(height_o>=60){
                        var modif_event_date_titre = $('#'+event_id+"_activite")
                        .replaceWith('<div id="'+event_id+'_activite">'+nom_activit+'</div>');
                    }
                    if(height_o>=140){
                        var modif_lieu = $('#'+event_id+"_lieu")
                        .replaceWith('<div id="'+event_id+'_lieu">'+nom_lieu+'</div>')
                    }
                    if(height_o>=180){
                        var modif_compagnie = $('#'+event_id+"_compagnie")
                        .replaceWith('<div id="'+event_id+'_compagnie">'+nom_compagnie+'</div>');
                
                        var modif_dispositif = $('#'+event_id+"_dispositif")
                        .replaceWith('<div id="'+event_id+'_dispositif">'+nom_dispositif+'</div>');
                    }

                    var tmp = $('<div>'+'Sauvegarde en cours'+'</div>')
                    .appendTo(event)
                    .attr('id',event_id+'_tmp');

                    $.ajax({
                        url: "../occupation/edit/"+event_id,
                        type :  'POST',
                        data :  'CodeOccupation=' + event_id +
                                '&HeureDebut=' + new_event_heure_debut + 
                                '&HeureFin=' + new_event_heure_fin  + 
                                '&CodeLieux=' + new_lieu  + 
                                '&CodeActivite=' + new_activit  + 
                                '&CodeCompagnie=' + new_compagnie  + 
                                '&CodeDispositif=' + new_dispositif,
                        dataType : 'html',
                        success : function(rep, statut){ 
                            console.log('modif success'); 
                            $("#"+event_id+"_tmp").remove();                     
                        }
                    });
                   $(this).dialog('destroy'); 
                },
                
                'Annuler': function() {
                    $(this).dialog('destroy');
                }
            }

        });
    });




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




