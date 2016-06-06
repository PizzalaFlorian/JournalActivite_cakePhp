<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>
<div id="content">
<div class="carnetdebord view large-11 medium-12 columns content">
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
        <tr>
            <th><?= __('Titre') ?></th>
            <td><?= h($carnetdebord->Sujet) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4>Texte</h4>
        <?= $this->Text->autoParagraph(h($carnetdebord->Commentaire)); ?>
    </div>
     <?php 
        echo $this->Html->link(__('Retour'), ['action' => 'index'],array("class"=>"button")).' '; 
        echo $this->Html->link(__('Modifier'), ['action' => 'edit', $carnetdebord->CodeEntree],array("class"=>"button")).' ';
        echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $carnetdebord->CodeEntree],array("class"=>"button"), ['confirm' => __('Etes vous sur de vouloir supprimer l\'entrée : {0}?', $carnetdebord->Sujet)]); 
    ?>
</div>
</div>
