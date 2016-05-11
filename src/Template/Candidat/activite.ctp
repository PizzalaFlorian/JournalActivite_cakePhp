<!-- Content -->
<?php
    /***********************************Variables dates**************************************/
    $SemaineCourante = date("W");
    if(isset($_POST['semaine'])){
        $Semaine = $_POST['semaine'];
    }
    else{
        $Semaine=null;
    }  
    $Week = SemaineCourante ((date("W")), $Semaine) ;
    $currentWeek = get_date_lundi_to_Sunday_from_week($Week,date("Y"),1);
    $queryWeek = get_date_lundi_to_Sunday_from_week_for_query($Week,date("Y"));


    /***********************************fenetre modale**************************************/
    $liste_Activites = get_Activites();
    $liste_CategorieActivite = get_CategorieActivite();
    $liste_ActiviteDefault = get_Activites(1);
    $liste_CategorieLieu = get_CategorieLieu(1);
    $liste_LieuDefault = get_Lieux(1);     
    $liste_compagnie = get_Compagnie();
    $liste_dispositif = get_dispositif();

    echo $this->element('sidebarCandidat');

    echo $this->Html->script('jquery-1.7.min');
    echo $this->Html->script('jquery-ui-1.7.2.custom.min');
    echo $this->Html->script('jquery.corner');
    echo $this->Html->script('jquery.mobile.custom.min');
    echo $this->Html->script('candidat.activite');
    echo $this->Html->script('candidat_Renseignement.activite');
    echo $this->Html->script('Demo_calendar_script');

    echo $this->Html->css('modale');
    echo $this->Html->css('occupation');
    echo $this->Html->css('Demo_calendar_style');
    echo $this->Html->css('Demo_calendar_jquery');
?>

	<div id="content">
            <div id="gen_new_content" title="Nouvel événement">
                <form action="">
                    <input type="hidden" id="new_event_day"/>
                    
                    <label class="label_evenement" for="new_event_heure_debut">			Heure de début :</label>
					<input type="text" id="new_event_heure_debut"/>
					
					<label class="label_evenement" for="new_event_heure_fin">			Heure de fin :</label>
					<input type="text" id="new_event_heure_fin"/>
                    
                    <label class="label_evenement" for="new_event_categorieActivite">	Categorie Activitée :</label>
                    <select type="text" class="lab RA_target" name="new_event_categorieActivite" id="new_event_categorieActivite">
							<?php foreach($liste_CategorieActivite as $id => $object){
									echo'<option id="'.$object->CodeCategorieActivite.'">'.$object->NomCategorie.'</option>';}
							?>
					</select><br />
					<label class="label_evenement" for="new_event_codeActivite">				Activitée :</label>
					<select type="text" class="lab RA_activ" name="new_event_codeActivite" id="new_event_codeActivite">
							<?php foreach($liste_ActiviteDefault as $id => $object){
									echo'<option id="'.$object->CodeActivite.'">'.$object->NomActivite.'</option>';}
							?>
					</select><br />
					
                    <label class="label_evenement" for="new_event_categorieLieu">		Categorie Lieu :</label>
					<select type="text" class="lab RA_target" name="new_event_categorieLieu" id="new_event_categorieLieu" >
							<?php 
								foreach($liste_CategorieLieu as $id => $object){
									echo'<option id="'.$object->CodeCategorieLieux.'">'.$object->NomCategorie.'</option>';}
							?>
					</select><br />
					
					<label class="label_evenement" for="new_event_lieu">				Lieu :</label>
					<select type="text" class="lab RA_Lieu" name="new_event_lieu" id="new_event_lieu">
							<?php
								foreach($liste_LieuDefault as $id => $object){
									echo'<option id="'.$object->CodeLieux.'">'.$object->NomLieux.'</option>';}
							?>
					</select><br />
                    
                    <label class="label_evenement" for="new_event_compagnie">			Compagnie :</label>
                    <select type="text" class="lab" name="new_event_compagnie" id="new_event_compagnie">
						<option id="0"> - - - - - </option>
					</select><br />
						
                    <label class="label_evenement" for="new_event_dispositif">			Dispositif :</label>
                    <select type="text" class="lab" name="new_event_dispositif" id="new_event_dispositif">
							<?php
								foreach($liste_dispositif as $id => $object){
									echo'<option id="'.$object->CodeDispositif.'">'.$object->NomDispositif.'</option>';}
							?>
					</select>
                </form>
            </div>

            <div id="gen_new_calendar" title="Nouvel agenda">
                <form action="">
                    <label class="label_evenement" for="new_event_activite">Activitée : </label><input type="text" class="lab" name="new_event_activite" id="new_event_activite" />
                </form>
            </div>
            <div id="create_event"></div>
            <!-- <div id="ajax_load" class="info_activation_module"></div> -->
            <div id="dialog" title="Suppression">Veuillez confirmer la suppression</div>

            <?php echo genererChoixSemaine($Week,date("Y")); ?>
            
            <div id="calendrier">
                <table id="calendar_table">
                    <thead>
                        <tr>
                            <th></th>
                            <?php
								remplirEnteteCalendar($Week);
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="info_horaires">
                                <div class='info_horaires_content'>00h00</div>
                                <div class='info_horaires_content'>01h00</div>
                                <div class='info_horaires_content'>02h00</div>
                                <div class='info_horaires_content'>03h00</div>
                                <div class='info_horaires_content'>04h00</div>
                                <div class='info_horaires_content'>05h00</div>
                                <div class='info_horaires_content'>06h00</div>
                                <div class='info_horaires_content'>07h00</div>
                                <div class='info_horaires_content'>08h00</div>
                                <div class='info_horaires_content'>09h00</div>
                                <div class='info_horaires_content'>10h00</div>
                                <div class='info_horaires_content'>11h00</div>
                                <div class='info_horaires_content'>12h00</div>
                                <div class='info_horaires_content'>13h00</div>
                                <div class='info_horaires_content'>14h00</div>
                                <div class='info_horaires_content'>15h00</div>
                                <div class='info_horaires_content'>16h00</div>
                                <div class='info_horaires_content'>17h00</div>
                                <div class='info_horaires_content'>18h00</div>
                                <div class='info_horaires_content'>19h00</div>
                                <div class='info_horaires_content'>20h00</div>
                                <div class='info_horaires_content'>21h00</div>
                                <div class='info_horaires_content'>22h00</div>
                                <div class='info_horaires_content'>23h00</div>                                    
                            </td>
                            <?php
								//var_dump($_SESSION);
								print_table($queryWeek,$_SESSION['Auth']['User']['ID']);
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div>

