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
    <?= $this->Html->link(__('Créer une News'), ['controller' => 'actualites','action' => 'nouveau']) ?>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <?php foreach ($actualites as $actualite): ?>
            <tr>
                <td>
                        <?= h(transformeDate($actualite->Date)) ?>
                </td>
                <td>
                        <?= $this->Html->link(h(substr($actualite->Sujet, 0, 30)), ['controller' => 'actualites','action' => 'view', $actualite->ID]) ?>
                </td>
                <td>
                        <?= h(substr($actualite->Contenue, 0, 100)) ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Editer'), ['controller' => 'actualites','action' => 'edit', $actualite->ID]) ?><br />
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'actualites','action' => 'delete', $actualite->ID], ['confirm' => __('Etes vous sur de vouloir supprimer cette actualité ?', $actualite->ID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>