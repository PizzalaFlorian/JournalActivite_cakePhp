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

<div class="actualites index large-9 medium-8 columns content">
    <h3>News</h3>
    <div style='HEIGHT: 180px; overflow:auto' size=2  multiple >
        <table cellpadding="0" cellspacing="0" >
            <tbody>
                <?php foreach ($actualites as $actualite): ?>
                <tr style='HEIGHT: 60px;'>
                    <td>
                            <?= h($actualite->Date) ?>
                    </td>
                    <td>
                            <?= $this->Html->link(h(substr($actualite->Sujet, 0, 30)), ['controller' => 'actualites','action' => 'view', $actualite->ID]) ?>
                    </td>
                    <td>
                            <?= h(substr($actualite->Contenue, 0, 100)) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>