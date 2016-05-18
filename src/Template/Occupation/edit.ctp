
<div class="occupation form large-9 medium-8 columns content">
    <?= $this->Form->create($occupation) ?>
    <fieldset>
        <?php
            echo $this->Form->input('HeureDebut');
            echo $this->Form->input('HeureFin');
        ?>
        <div class="input number required">
            <label for="CodeCategorieActivite">Categorie d'activité' :</label>
            <select id="CodeCategorieActivite" type="text" name="CodeCategorieActivite">
            <?php
                foreach ($maCategorieactivite as $catActivite) {
                    echo "<option value=".$catActivite->CodeCategorieActivite.">".$catActivite->NomCategorie."</option>";
                }
            ?>
            </select>
        </div>
        <div class="input number required">
            <label for="CodeActivite">Activité :</label>
            <select id="CodeActivite" type="text" name="CodeActivite">
            <?php
                foreach ($monActivite as $lieu) {
                    echo "<option value=".$lieu->CodeActivite.">".$lieu->NomActivite."</option>";
                }
            ?>
            </select>
        </div>

        <div class="input number required">
            <label for="CodeCategorieLieux">Categorie de lieux :</label>
            <select id="CodeCategorieLieux" type="text" name="CodeCategorieLieux">
            <?php
                foreach ($maCategorielieu as $catLieu) {
                    echo "<option value=".$catLieu->CodeCategorieLieux.">".$catLieu->NomCategorie."</option>";
                }
            ?>
            </select>
        </div>
        <div class="input number required">
            <label for="codeLieux">Lieux :</label>
            <select id="CodeLieux" type="text" name="CodeLieux">
            <?php
                foreach ($monLieu as $lieu) {
                    echo "<option value=".$lieu->CodeLieux.">".$lieu->NomLieux."</option>";
                }
            ?>
            </select>
        </div>

        <div class="input number required">
            <label for="CodeCompagnie">Compagnie :</label>
            <select id="CodeCompagnie" type="text" name="CodeCompagnie">
            <?php
                foreach ($monCompagnie as $compagnie) {
                    echo "<option value=".$compagnie->CodeCompagnie.">".$compagnie->NomCompagnie."</option>";
                }
            ?>
            </select>
        </div>

        <div class="input number required">
            <label for="CodeDispositif">Dispositif :</label>
            <select id="CodeDispositif" type="text" name="CodeDispositif">
            <?php
                foreach ($monDispositif as $dispositif) {
                    echo "<option value=".$dispositif->CodeDispositif.">".$dispositif->NomDispositif."</option>";
                }
            ?>
            </select>
        </div>







    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
