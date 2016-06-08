<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
    use Cake\ORM\TableRegistry;
?>
<div class="administrateur index large-12 medium-11 columns content">
    <h3 class="center"><?= __('Table des Administrateurs') ?></h3>
    <?= $this->Html->link(__('Inviter un Administrateur'), ['action' => 'add'],['class'=>'button']) ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('CodeAdmin') ?></th>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Email') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($administrateur as $administrateur): ?>
            <tr>
                <td><?= $this->Number->format($administrateur->CodeAdmin) ?></td>
                <td><?= $this->Number->format($administrateur->ID) ?></td>
                <td>
                    <?php 
                        $info = TableRegistry::get('users')
                        ->find()
                        ->where(['ID'=>$administrateur->ID])
                        ->first();
                        echo $info['email'];
                    ?>
                </td>
                <td class="actions">
                    <?php 
                        echo $this->Form->postLink(
                            $this->Html->image('supprimer.ico', array('title' => "Supprimer")),
                            array('action' => 'delete', $administrateur->CodeAdmin),
                            array('escape' => false,"confirm"=>__('Êtes-vous sur de vouloir supprimer # {0}?', $administrateur->CodeAdmin))
                        ); 
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('précedent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
