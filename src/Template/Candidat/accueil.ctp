<?php
	echo $this->element('sidebarCandidat');
?>

<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<h1>Bienvennue <?php print_message_acceuil_candidat($_SESSION['Auth']['User']['ID']); ?></h1>

		</center>
	</div>
</div>
