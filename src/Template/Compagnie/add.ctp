<?php
    echo $this->element('sidebarChercheur');
    echo $this->Html->css('main_custom');

    use Cake\ORM\TableRegistry;
    $max = TableRegistry::get('compagnie')
            ->find()
            ->select(array('code'=>'max(CodeCompagnie)'))
            ->first();
?>
<div class="compagnie form large-12 medium-11 columns content">
    <?= $this->Form->create($compagnie) ?>
    <fieldset>
        <legend><?= __('Ajouter une compagnie') ?></legend>
        <?php
            echo $this->Form->input('CodeCompagnie',
                [
                'type'=>'number',
                'required'=>true,
                'default'=>$max['code']+1
                ]);
            echo $this->Form->input('NomCompagnie');
        ?>
    </fieldset>
    <?= $this->Html->link(__('Retourner a la liste des compagnie'), ['action' => 'index'],['class'=>'button']) ?>
    <?= $this->Form->button(__('Ajouter')) ?>
    <?= $this->Form->end() ?>
</div>
