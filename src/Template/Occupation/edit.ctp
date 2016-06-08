<?php
    echo $this->Html->script('occupation');
    echo $this->Html->css('main_custom');
?>
<div>
    <?= $this->Form->create($occupation) ?>
    <fieldset>

        <div class="input select required"> 
            <label for="HeureDebut">Heure de début :</label>
            <!-- <input id="edit_event_heure_debut" type="text" value="<?php echo retourneHeure($occupation->HeureDebut); ?>" /> -->
            <select id="edit_heure_debut"><option id="edit_h_debut"><?php echo retourneHeure($occupation->HeureDebut); ?></option>
            </select><select id="edit_minute_debut"><option id="edit_m_debut"><?php echo retourneMinute($occupation->HeureDebut); ?></select>
        </div>
        <div class="input select required"> 
            <label for="HeureFin">Heure de fin :</label>            
            <!-- <input id="edit_event_heure_fin" type="text" value="<?php echo retourneHeure($occupation->HeureFin); ?>" /> -->
            <select id="edit_heure_fin"><option id="edit_h_fin"><?php echo retourneHeure($occupation->HeureFin); ?></option>
            </select><select id="edit_minute_fin"><option id="edit_m_fin"><?php echo retourneMinute($occupation->HeureFin); ?></select>
        </div>

        <div class="input number required">
            <label for="CodeCategorieActivite">Categorie d'activité :</label>
            <select id="Activite" class="RA_target" type="text" name="CodeCategorieActivite">
            <?php
                $required = "";
                foreach ($maCategorieactivite as $catActivite) {
                    if($catActivite->CodeCategorieActivite == $CatActiviteOccupation->CodeCategorieActivite){$required = 'selected';}
                    echo "<option value=".$catActivite->CodeCategorieActivite." $required>".$catActivite->NomCategorie."</option>";
                    $required = "";
                }
            ?>
            </select>
        </div>
        <div class="input number required">
            <label for="CodeActivite">Activité :</label>
            <select id="CodeActivite" class="Activite" type="text" name="CodeActivite">
            <?php
                $required = "";
                foreach ($monActivite as $activite) {
                    if($activite->CodeActivite == $occupation->CodeActivite){$required = 'selected';}
                    echo "<option value=".$activite->CodeActivite." $required>".$activite->NomActivite."</option>";
                    $required = "";
                }
            ?>
            </select>
        </div>

        <div class="input number required">
            <label for="CodeCategorieLieux">Categorie de lieux :</label>
            <select id="Lieu" class="RA_target" type="text" name="CodeCategorieLieux">
            <?php
                $required = "";
                foreach ($maCategorielieu as $catLieu) {
                    if($catLieu->CodeCategorieLieux == $CatLieuxOccupation->CodeCategorieLieux){$required = 'selected';}
                    echo "<option value=".$catLieu->CodeCategorieLieux." $required>".$catLieu->NomCategorie."</option>";
                    $required = "";
                }
            ?>
            </select>
        </div>
        <div class="input number required">
            <label for="codeLieux">Lieu :</label>
            <select id="CodeLieux" class="Lieu" type="text" name="CodeLieux">
            <?php
                $required = "";
                foreach ($monLieu as $lieu) {
                    if($lieu->CodeLieux == $occupation->CodeLieux){$required = 'selected';}
                    echo "<option value=".$lieu->CodeLieux." $required>".$lieu->NomLieux."</option>";
                    $required = "";
                }
            ?>
            </select>
        </div>

        <div class="input number required">
            <label for="CodeCompagnie">Compagnie :</label>
            <select id="CodeCompagnie" type="text" name="CodeCompagnie">
            <?php
                $required = "";
                foreach ($monCompagnie as $compagnie) {
                    if($compagnie->CodeCompagnie == $occupation->CodeCompagnie){$required = 'selected';}
                    echo "<option value=".$compagnie->CodeCompagnie." $required>".$compagnie->NomCompagnie."</option>";
                    $required = "";
                }
            ?>
            </select>
        </div>

        <div class="input number required">
            <label for="CodeDispositif">Dispositif :</label>
            <select id="CodeDispositif" type="text" name="CodeDispositif">
            <?php
                $required = "";
                foreach ($monDispositif as $dispositif) {
                    if($dispositif->CodeDispositif == $occupation->CodeDispositif){$required = 'selected';}
                    echo "<option value=".$dispositif->CodeDispositif." $required>".$dispositif->NomDispositif."</option>";
                    $required = "";
                }
            ?>
            </select>
        </div>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
