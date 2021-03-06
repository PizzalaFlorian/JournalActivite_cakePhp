<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>
<div class="candidat index large-11 medium-12 columns content">
    <h3 class="center"><?= __('Table des Candidats') ?></h3>
    <?php
        echo $this->Html->link(__('Inviter un Candidat'), ['controller'=>'administrateur','action' => 'createCandidat'],['class'=>'button']).' ';
        echo $this->Html->link(__('Inviter une liste de Candidats'), ['controller'=>'administrateur','action' => 'createCandidatList'],['class'=>'button']).' ';
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCandidat','Code Candidat') ?></th>
                <th><?= $this->Paginator->sort('NomCandidat','Nom Candidat') ?></th>
                <th><?= $this->Paginator->sort('PrenomCandidat','Prénom Candidat') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidat as $candidat): ?>
            <tr>
                <td><?= $this->Number->format($candidat->CodeCandidat) ?></td>
                <td><?= h($candidat->NomCandidat) ?></td>
                <td><?= h($candidat->PrenomCandidat) ?></td>
                <td class="actions">
                     <?php 
                        echo $this->Html->link(
                            $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                            array('action' => 'edit', $candidat->CodeCandidat),
                            array('escape' => false) 
                        );
                         
                        echo $this->Form->postLink(
                            $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                            array('action' => 'delete', $candidat->CodeCandidat),
                            array('escape' => false,"confirm"=>__('Etes-vous sur de vouloir supprimer # {0}?', $candidat->PrenomCandidat.' '.$candidat->NomCandidat))
                        ); 
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
