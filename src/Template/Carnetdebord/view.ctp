<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>
<div class="carnetdebord view large-11 medium-12 columns content">
    <h3><?= h($carnetdebord->Sujet) ?></h3>
    <?= $this->Html->link(__('Retour'), ['action' => 'index']) ?>
   

    <table class="vertical-table">
        <tr>
            <th><?= __('Auteur') ?></th>
            <td><?php
                    $chercheur = TableRegistry::get('chercheur')
                        ->find()
                        ->where(['CodeChercheur'=>$carnetdebord->CodeChercheur])
                        ->first();
                    echo $chercheur['PrenomChercheur'].' '.$chercheur['NomChercheur'];
                ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($carnetdebord->Date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4>Texte</h4>
        <?= $this->Text->autoParagraph(h($carnetdebord->Commentaire)); ?>
    </div>
     <br>
    <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $carnetdebord->CodeEntree]) ?>
    <br>
    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $carnetdebord->CodeEntree], ['confirm' => __('Êtes vous sur de vouloir supprimée l\'entrée : {0}?', $carnetdebord->Sujet)]) ?>
</div>