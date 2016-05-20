<?php
	echo $this->element('sidebarAdmin');
?>
<div class="actualites index large-12 medium-11 columns content">
    <h3>Actualités</h3>
    <?= $this->Html->link(__('Créer une Actualité'), ['controller' => 'actualites','action' => 'nouveau']) ?>
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
        </div>
</div>