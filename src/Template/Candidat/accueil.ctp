<?php
	echo $this->element('sidebarCandidat');
 //   echo $this->Html->css('main_custom');
 //   echo $this->Html->css('responsive');
?>

<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<h1>Bienvenue <?php print_message_acceuil_candidat($_SESSION['Auth']['User']['ID']); ?></h1>

		</center>
	</div>


    <div class="actualites index large-11 medium-11 columns content">
        <h3 class="souligne_red">Actualités</h3>
        <div style='HEIGHT: 300px; overflow:auto' size=2  multiple >
            <table cellpadding="0" cellspacing="0" >
                <tbody>
                    <?php foreach ($actualites as $actualite): ?>
                    <tr style='HEIGHT: 60px;'>
                        <td>
                                <?= h($actualite->Date) ?>
                        </td>
                        <td>
                                <?= $this->Html->link(__(coupe($actualite->Sujet, 30)), ['controller' => 'actualites','action' => 'view', $actualite->ID]) ?>
                        </td>
                        <td>
                                <?= $this->Html->link(__(coupe($actualite->Contenue, 50)), ['controller' => 'actualites','action' => 'view', $actualite->ID]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>