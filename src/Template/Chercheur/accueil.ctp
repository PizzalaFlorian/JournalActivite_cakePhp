<?php
	echo $this->element('sidebarChercheur');
 //   echo $this->Html->css('main_custom');
?>

<!-- Content -->
<div id="content">
	<div class="inner">
		<!--
		Insert content here			
		-->		
		<center>
			<h1>Bienvenue <?php echo nomChercheur();?></h1>

		</center>
		
		Il y a <b><?php echo nombreCandidat();?></b> candidat(s) inscrit(s) à l'étude qui ont renseigné un total de <b><?php echo nombreOccupation();?></b> occupations sur la période allant du <b><?php echo premierOccupation();?> au <?php echo dernierOccupation();?></b>.
		
	</div>
</div>
<div class="actualites index large-12 medium-11 columns content">
    <h3 class="souligne_red">Actualités</h3>
    
        <div style='HEIGHT: 300px; overflow:auto' size=2  multiple >
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <?php foreach ($actualites as $actualite): ?>
                    <tr>
                        <td>
                                <?= h($actualite->Date) ?>
                        </td>
                        <td>
                                <?= $this->Html->link(__(coupe($actualite->Sujet, 30)), ['controller' => 'actualites','action' => 'view', $actualite->ID]) ?>
                        </td>
                        <td>
                                <?= $this->Html->link(__(coupe($actualite->Contenue, 50)), ['controller' => 'actualites','action' => 'view', $actualite->ID]) ?>
                        </td>
                        <td class="actions">
                            <?php
                                echo $this->Html->link(
                                    $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                                    array('controller' => 'actualites','action' => 'edit', $actualite->ID),
                                    array('escape' => false) 
                                );

                                echo $this->Form->postLink(
                                    $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                                    array('controller' => 'actualites','action' => 'delete', $actualite->ID),
                                    array('escape' => false,'confirm' => __('Etes vous sur de vouloir supprimer cette actualité ?', $actualite->ID))
                                );
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?= $this->Html->link(__('Créer une Actualité'), ['controller' => 'actualites','action' => 'nouveau'],array('class' => 'button')) ?>
</div>