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
			<a><h1>But de l'experience</h1></a>
			
		</center>
		<?php
			//header('Content-Type: text/html');
			//echo readfile(ROOT.'/webroot/files/but_experience.ctp');


			$lines = file(ROOT.'/webroot/files/but_experience.ctp');

			// display file line by line
			foreach($lines as $line_num => $line) {
			    echo htmlspecialchars($line)."<br />\n";
			}
			
		?>
	</div>
</div>
