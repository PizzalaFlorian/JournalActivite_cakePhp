<?php
    echo $this->Html->css('main-custom');
?>
<div id="content">
	<div class="candidat form large-12 medium-12 columns content">
		<h3 class="center"> Charte d'utilisation des données personnelles</h3>

		<p class="grey-box">
		Les informations recueillies à partir de ce formulaire font l’objet d’un traitement informatique destiné à :
		<br>
		<br>
		<strong>LSE (Laboratoire des Sciences de l'Education)</strong>
		<br>
		<br>
		Pour la ou les finalité(s) suivante(s) : 
		<br>
		<br>
		<strong>Les données ainsi récoltées seront utilisées pour mieux comprendre le rythme de vie et les occupations des étudiants d'aujourd'hui.</strong>
		<br>
		<br>
		Les données seront anonymisées et utilisées seulement par :
		<br>
		<strong>Les chercheurs du LSE de Grenoble.</strong>
		<br>
		<br>
		Conformément à la loi <a href="https://www.cnil.fr/loi-78-17-du-6-janvier-1978-modifiee">« informatique et libertés » du 6 janvier 1978 modifiée</a>, vous disposez d’un <a href="https://www.cnil.fr/le-droit-dacces">droit d’accès</a> et de <a href="https://www.cnil.fr/le-droit-de-rectification">rectification</a> aux informations qui vous concernent. 
		<br>
		<br>
		Vous pouvez accèder aux informations vous concernant en vous adressant à :
		<br>
		<br>
		<strong>Laboratoire des Sciences de l'Education<br>
		Université Pierre-Mendès-France, BP 47<br>
		F-38040 Grenoble Cedex 9<br>
		<br>
		<br>
		Ou directement sur ce site internet.
		</strong>
		<br>
		<br>
		Vous pouvez également, pour des motifs légitimes, vous <a href="https://www.cnil.fr/le-droit-dopposition">opposer au traitement des données vous concernant</a>.
		<br>
		<br>
		Pour en savoir plus, <a href="https://www.cnil.fr/comprendre-vos-droits">consultez vos droits sur le site de la CNIL</a>.
		</p>

		<div>
		    <?= $this->Form->create() ?>
		    <br/><br/><br/>En cochant cette case, vous déclarez avoir pris connaissance de vos droits, et autorisez les chercheurs du LSE à exploiter vos données dans le cadre de leur expérience.
		    Vous disposez d'un droit de rétractation, et vous pourrez à tout moment faire opposition à l'utilisation de vos données, directement depuis le site internet.
			    <fieldset>
			    	    
				    	<div id="radioButon">
				    	<?php 
				    		echo $this->Form->checkbox('published', ['hiddenField' => false]);
				   	?>J'ai pris connaissance de mes droits, et autorise les chercheurs à utiliser mes données.
				    </div>
				</fieldset>
				<div id="button">
		        	<?= $this->Form->button(__('J\'approuve la charte')) ?>
	        	</div>
		    <?= $this->Form->end() ?>
		</div>

	</div>
</div>