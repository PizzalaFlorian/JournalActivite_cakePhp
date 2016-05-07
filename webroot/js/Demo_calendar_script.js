$(function(){
	$( ".RA_activ" ).change(function() {
		var test = $(this).find("option:selected").attr('id');
		console.log(test);
	});
	
    function getBaseURL() {
        var url = location.href;  // entire url including querystring - also: window.location.href;
        var baseURL = url.substring(0, url.indexOf('/admin', 14)); 

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

    /*########################################################################################*/
    /*###########################              MODULE AGENDA                     #############*/
    /*########################################################################################*/


    /* Taille des events */
    var td_width=$(".calendar_td").width();
    $(".calendar_event").css({
        "width" : td_width*0.85,
        "margin-left" : (td_width-(td_width*0.85))/2
    });

    /*  Déplacement event */
    $(".calendar_event").draggable({
        containment: "parent",
        grid: [10, 10],
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
            var id_event=object_drop.attr("id");

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
            $("#"+id_event+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
            $("#"+id_event+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
            $("#"+id_event+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
            $("#"+id_event+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());
        },
        stop: function(event, ui) {
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
            var id_event=object_drop.attr("id");

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
            $("#"+id_event+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
            $("#"+id_event+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
            $("#"+id_event+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
            $("#"+id_event+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());
        //    $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenement/id/"+id_event+"/d/"+depart_en_sec+"/f/"+fin_en_sec);
        $("#ajax_load").html("Modifications enregistr&eacute;es.");
        }
    });


    /* Redimensionnement event */
    $(".calendar_event").resizable({
        handles: 's',
        grid: [0, 10],
        stop: function(event, ui) {
            var object_drop = $(this);
            var id_event=object_drop.attr("id");
            var height_css=object_drop.css("height");
            var height_css_value=parseInt(height_css.replace(".px",""));
            var duree_en_sec=(((height_css_value/10)/4)*60)*60;
 //           $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenementresize/id/"+id_event+"/dur/"+duree_en_sec);
 $("#ajax_load").html("Heure de fin correctement modifi&eacute;e.");
        },
        resize: function(event,ui) {
            var object_drop = $(this);
            var id_event=object_drop.attr("id");   
            var heure_depart=parseInt($("#"+id_event+"_date_debut_heure").html());
            var min_depart=parseInt($("#"+id_event+"_date_debut_minute").html());  
            var heure_ref = new Date();
            heure_ref.setHours(heure_depart, min_depart, 0, 0);
            var timestamp=heure_ref.getTime();
            var height_css=object_drop.css("height");
            var height_css_value=parseInt(height_css.replace(".px",""));
            var duree_en_milli=((((height_css_value/10)/4)*60)*60)*1000;
    
            var new_heure = new Date();
            new_heure.setTime(timestamp+duree_en_milli);
    
            $("#"+id_event+"_date_fin_heure").html(new_heure.getHours());
            $("#"+id_event+"_date_fin_minute").html(new_heure.getMinutes());
        }
    });

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
				
				
        /*creation de l'event dans la bdd*/
        var url_create=getBaseURL()+"/admin/ajax/evenementcreation/ds/"+day_start+"/de/"+day_end+"/ag/"+agenda_first_id;
/*        var event_id = $.ajax({
            url: url_create,
            async: false
        }).responseText; */
        var event_id=1;
        /*Initialisation - dialog de remplissage*/
        $("#gen_new_content").dialog({
            bgiframe: true,
            resizable: true,
            height:800,
            width:500,
            modal: true,
            beforeclose: function(event, ui) {
                $(this).dialog('destroy');
                $("#new_event_categorieActivite").val("");  //Note il faudra surement ici inclure les valeurs
                $("#new_event_categorieLieu").val("");
                $("#new_event_lieu").val("");
                $("#new_event_compagnie").val("");
                $("#new_event_dispositif").val("");
				$("#new_event_codeActivite").val("");
            },
            buttons: {
                'Enregistrer': function() {
					// console.log($("#new_event_lieu").find("option:selected").attr('id'));
                    $(this).dialog('destroy');
					
					//recolte des champs du formulaire
                    var new_activit=$("#new_event_codeActivite").find("option:selected").attr('id');
					var new_lieu=$("#new_event_lieu").find("option:selected").attr('id');
                    var new_compagnie=$("#new_event_compagnie").find("option:selected").attr('id');
                    var new_dispositif=$("#new_event_dispositif").find("option:selected").attr('id');
                    var new_event_heure_debut=jour_deb+" "+$("#new_event_heure_debut").val();
					var new_event_heure_fin=jour_deb+" "+$("#new_event_heure_fin").val();
					
					console.log(new_activit);
					
					// envoie a controleur/CandidatRenseigneActivites.ctrl.php pour ajout BDD
					$.ajax({
						url: "../controleur/CandidatRenseigneActivites.ctrl.php",
						type : 'POST',
						data : 	'HeureDebut=' + new_event_heure_debut + 
								'&HeureFin=' + new_event_heure_fin  + 
								'&CodeLieux=' + new_lieu  + 
								'&CodeActivite=' + new_activit  + 
								'&CodeCompagnie=' + new_compagnie  + 
								'&CodeDispositif=' + new_dispositif,
						dataType : 'html',
						success : function(rep, statut){
							// console.log("Ajout finis");
							console.log(rep);				// affichage requete SQL
						}
					});
					
			// Modif pierre - je pense que ça vien de la demos ...
                    // agenda_id=$("#agenda_id").val();
                    // if(new_titre!=""){
                        // $("#"+event_id+'_title').html(new_titre);
                    // }
                    // if(new_lieu!=""){
                        // $("#"+event_id+'_lieu').html(new_lieu);
                    // }
                    // new_ti=new_titre.replace(/ /gi,"&nbsp;");
                    // new_li=new_lieu.replace(/ /gi,"&nbsp;");
                    // $("#"+event_id).removeClass("select_agenda_red");
                    // class_color_agenda=$("#"+agenda_id+"_agenda_id").html();
                    // $("#"+event_id).addClass(class_color_agenda);
                    // $("#ajax_load").load(getBaseURL()+"/admin/ajax/specifyevent/id/"+event_id+"/titre/"+new_ti+"/lieu/"+new_li+"/ag/"+agenda_id);
				
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

        var event_date = $('<div></div>')
        .appendTo(event)
        .attr('class','calendar_event_date')
        .attr('div',event_id+'_calendar_event_date');

        var event_date_heure_debut = $('<span>'+nouvelle_heure_depart.getHours()+'</span>')
        .appendTo(event_date)
        .attr('id',event_id+'_date_debut_heure');

        $('<span>:</span>')
        .appendTo(event_date);

        var event_date_minute_debut = $('<span>'+nouvelle_heure_depart.getMinutes()+'</span>')
        .appendTo(event_date)
        .attr('id',event_id+'_date_debut_minute');

        $('<span> - </span>')
        .appendTo(event_date);

        var event_date_heure_fin = $('<span>'+nouvelle_heure_fin.getHours()+'</span>')
        .appendTo(event_date)
        .attr('id',event_id+'_date_fin_heure');

        $('<span>:</span>')
        .appendTo(event_date);
        
        var event_date_heure_fin = $('<span>'+nouvelle_heure_fin.getMinutes()+'</span>')
        .appendTo(event_date)
        .attr('id',event_id+'_date_fin_minute');

        var event_date = $('<div>(Sans titre)</div>')
        .appendTo(event)
        .attr('class','calendar_event_title')
        .attr('id',event_id+'_title');

        var event_date = $('<div>(Inconnu)</div>')
        .appendTo(event)
        .attr('class','calendar_event_lieu')
        .attr('id',event_id+'_lieu');

        event.corner();
        $(".calendar_event_date").corner("top cc:#fff");
        var td_width=$(".calendar_td").width();
        event.css({
            "width" : td_width*0.85,
            "margin-left" : (td_width-(td_width*0.85))/2
        });
        

        
        /*application des interactions avec l'event*/
        event.draggable({
            containment: "parent",
            grid: [10, 10],
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
                var id_event=object_drop.attr("id");

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
                $("#"+id_event+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
                $("#"+id_event+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
                $("#"+id_event+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
                $("#"+id_event+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());
            },
            stop: function(event, ui) {
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
                var id_event=object_drop.attr("id");

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
                $("#"+id_event+"_date_debut_heure").html(nouvelle_heure_depart.getHours());
                $("#"+id_event+"_date_debut_minute").html(nouvelle_heure_depart.getMinutes());
                $("#"+id_event+"_date_fin_heure").html(nouvelle_heure_fin.getHours());
                $("#"+id_event+"_date_fin_minute").html(nouvelle_heure_fin.getMinutes());
        //        $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenement/id/"+id_event+"/d/"+depart_en_sec+"/f/"+fin_en_sec);
        $("#ajax_load").html("Modifications enregistr&eacute;.");
            }
        });
        event.resizable({
            handles: 's',
            grid: [0, 10],
            stop: function(event, ui) {
                var object_drop = $(this);
                var id_event=object_drop.attr("id");
                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_sec=(((height_css_value/10)/4)*60)*60;
 //               $("#ajax_load").load(getBaseURL()+"/admin/ajax/evenementresize/id/"+id_event+"/dur/"+duree_en_sec);
 $("#ajax_load").html("Heure de fin modifi&eacute;e.");
            },
            resize: function(event,ui) {
                var object_drop = $(this);
                var id_event=object_drop.attr("id");

                var heure_depart=parseInt($("#"+id_event+"_date_debut_heure").html());
                var min_depart=parseInt($("#"+id_event+"_date_debut_minute").html());

                var heure_ref = new Date();
                heure_ref.setHours(heure_depart, min_depart, 0, 0);

                var timestamp=heure_ref.getTime();




                var height_css=object_drop.css("height");
                var height_css_value=parseInt(height_css.replace(".px",""));
                var duree_en_milli=((((height_css_value/10)/4)*60)*60)*1000;

                var new_heure = new Date();
                new_heure.setTime(timestamp+duree_en_milli);

                $("#"+id_event+"_date_fin_heure").html(new_heure.getHours());
                $("#"+id_event+"_date_fin_minute").html(new_heure.getMinutes());
            //        $("#"+id_event+"_date").corner("top");
            }
        });
        event.click(function(e){
            var object_clicked = $(this);
            var id_event=object_clicked.attr("id");

            $("#dialog").dialog({
                bgiframe: true,
                resizable: true,
                height:800,
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
                    var heure_depart=$("#"+id_event+"_date_debut_heure").html();
                    var min_depart=$("#"+id_event+"_date_debut_minute").html();
                    var heure_fin=$("#"+id_event+"_date_fin_heure").html();
                    var min_fin=$("#"+id_event+"_date_fin_minute").html();
                    var titre_eve=$("#"+id_event+"_title").html();
                    var lieu_eve=$("#"+id_event+"_lieu").html();

                    var contenu = "<p>";
                    contenu += "<b>Durée : </b>"+heure_depart+":"+min_depart+" à ";
                    contenu += heure_fin+":"+min_fin+"<br />";
                    contenu += "<b>Lieu : </b>"+lieu_eve+"<br />";
                    contenu += "</p>";
                    $("#ui-dialog-title-dialog").html(titre_eve);
                    $("#dialog").html(contenu);
                },
                buttons: {
                    'Voir détails': function() {
                        $(this).dialog('destroy');
                        var url_details=getBaseURL()+"/admin/evenements/voir/id/"+id_event;
                        $(location).attr('href',url_details);
                    },
                    'Modifier': function() {
                        $(this).dialog('destroy');
                    },
                    'Supprimer': function() {
                        $(this).html("Veuillez Confirmer la suppression");
                        $(this).dialog('destroy');
                        $("#dialog").dialog({
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
 //                                   $("#ajax_load").load(getBaseURL()+"/admin/ajax/supprimerevent/id/"+id_event);
 $("#ajax_load").html("Evenement correctement supprim&eacute;.");
                                    $("#"+id_event).hide("highlight",{
                                        direction: "vertical",
                                        color: "#A60000"
                                    },2000);
                                },
                                'Annuler': function() {
                                    $(this).dialog('destroy');
                                }
                            }
                        });

                    }
                }

            });
        });

    });



    /*info event*/
    $(".calendar_event").click(function(e){
        var object_clicked = $(this);
        var id_event=object_clicked.attr("id");
        
        $("#dialog").dialog({
            bgiframe: true,
            resizable: true,
            height:400,
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
                var heure_depart=$("#"+id_event+"_date_debut_heure").html();
                var min_depart=$("#"+id_event+"_date_debut_minute").html();
                var heure_fin=$("#"+id_event+"_date_fin_heure").html();
                var min_fin=$("#"+id_event+"_date_fin_minute").html();
                var titre_eve=$("#"+id_event+"_title").html();
                var lieu_eve=$("#"+id_event+"_lieu").html();

                var contenu = "<p>";
                contenu += "<b>Durée : </b>"+heure_depart+":"+min_depart+" à ";
                contenu += heure_fin+":"+min_fin+"<br />";
                contenu += "<b>Lieu : </b>"+lieu_eve+"<br />";
                contenu += "</p>";
                $("#ui-dialog-title-dialog").html(titre_eve);             
                $("#dialog").html(contenu);
            },
            buttons: {
                'Voir détails': function() {
                    $(this).dialog('destroy');
                    var url_details=getBaseURL()+"/admin/evenements/voir/id/"+id_event;
                    $(location).attr('href',url_details);
                },
                'Modifier': function() {
                    $(this).dialog('destroy');
                },
                'Supprimer': function() {
                    $(this).html("Veuillez Confirmer la suppression");
                    $("#dialog").dialog('destroy');
                    $("#dialog").dialog({
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
//                                $("#ajax_load").load(getBaseURL()+"/admin/ajax/supprimerevent/id/"+id_event);
$("#ajax_load").html("Evenement correctement supprim&eacute;.");
                                $("#"+id_event).hide("highlight",{
                                    direction: "vertical",
                                    color: "#A60000"
                                },2000);
                            },
                            'Annuler': function() {
                                $(this).dialog('destroy');
                            }
                        }
                    });

                }
            }

        });
    });








    /*------------------   ARRONDIS  --------------------*/
    $('div#container_top').corner("top cc:#4E6257");
    $('div#header_content').corner("bottom cc:#4E6257");
    $('div#visu_page_perso').corner();
    $('div#footer').corner("bottom")
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




