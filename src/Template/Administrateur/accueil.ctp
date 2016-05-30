<?php
	echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>
<div id="content">
<div class="actualites index large-12 medium-11 columns content">
    <h3 class="souligne_red center">Actualités</h3>
    
        <div style='HEIGHT: 300px; overflow:auto' size=2  multiple >
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <?php foreach ($actualites as $actualite): ?>
                    <tr>
                        <td>
                                <?= h($actualite->Date) ?>
                        </td>
                        <td>
                                <?= $this->Html->link(h(substr($actualite->Sujet, 0, 30)), ['controller' => 'actualites','action' => 'view', $actualite->ID]) ?>
                        </td>
                        <td>
                                <?= h(substr($actualite->Contenue, 0, 50)) ?>...
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
</div>
</div>