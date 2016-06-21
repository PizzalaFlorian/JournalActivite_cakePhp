<?php
	echo $this->element('sidebarCandidat');
//	echo $this->Html->css('main_custom');
?>

<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<a><h1>But de l'experience</h1></a>
			
		</center>
		<?php	
			echo file_get_contents(ROOT.'/webroot/files/but_experience.ctp');
		?>
	</div>
</div>
