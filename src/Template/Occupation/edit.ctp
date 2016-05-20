<?php
    echo $this->Html->script('occupation');
?>
<div class="occupation form large-9 medium-8 columns content">
    <?= $this->Form->create($occupation) ?>
    <fieldset>

        <div class="input number required"> 
            <label for="CodeCategorieActivite">Heure de début :</label>
            <input id="new_event_heure_debut" type="text" value="<?php echo retourneHeure($occupation->HeureDebut); ?>" />
        </div>
        <div class="input number required"> 
            <label for="CodeCategorieActivite">heure de fin :</label>            
            <input id="new_event_heure_fin" type="text" value="<?php echo retourneHeure($occupation->HeureFin); ?>" />
        </div>

        <div class="input number required">
            <label for="CodeCategorieActivite">Categorie d'activité' :</label>
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
            <label for="codeLieux">Lieux :</label>
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
