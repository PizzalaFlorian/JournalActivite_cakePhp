<?php
    echo $this->element('sidebarChercheur');
//    echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>
<div class="categorieactivite index large-12 medium-11 columns content">
    <h3 class="center"><?= __('Table des catégories d\'activités') ?></h3>
    <?= $this->Html->link(__('Ajouter une catégorie'), ['action' => 'add'],array("class"=>"button")) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeCategorieActivite','Code Catégorie Activité') ?></th>
                <th><?= $this->Paginator->sort('NomCategorie','Nom Catégorie') ?></th>
                <th><?= $this->Paginator->sort('Nombre d\'activité liées') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorieactivite as $categorieactivite): ?>
            <tr>
                <td><?= $this->Number->format($categorieactivite->CodeCategorieActivite) ?></td>
                <td><?= h($categorieactivite->NomCategorie) ?></td>
                <td>
                <?php 
                    $count = TableRegistry::get('activite')
                    ->find()
                    ->select(array('count'=>'COUNT(*)'))
                    ->where(['CodeCategorie'=>$categorieactivite->CodeCategorieActivite])
                    ->group('CodeCategorie')
                    ->first();
                    echo $this->Number->format($count['count']);
                ?>
                </td>
                <td class="actions">
                    <?php 
                    echo $this->Html->link(
                        $this->Html->image('modifier.ico', array('title' => "Modifier")), 
                        array('action' => 'edit', $categorieactivite->CodeCategorieActivite),
                        array('escape' => false) 
                    );
                     
                    echo $this->Form->postLink(
                        $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                        array('action' => 'delete', $categorieactivite->CodeCategorieActivite),
                        array('escape' => false,'confirm' => __('Êtes vous sur de vouloir supprimer # {0}?', $categorieactivite->NomCategorie))
                    ); 
                     
                    echo $this->Html->link(
                        $this->Html->image('reaffecter.ico', array('title' => "Réaffecter")), 
                        array('action' => 'reaffect', $categorieactivite->CodeCategorieActivite),
                        array('escape' => false) 
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
