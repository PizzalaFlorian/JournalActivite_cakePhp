<?php
    echo $this->element('sidebarChercheur');

    use Cake\ORM\TableRegistry;
    $max = TableRegistry::get('compagnie')
            ->find()
            ->select(array('code'=>'max(CodeCompagnie)'))
            ->first();
?>
<div class="compagnie form large-12 medium-11 columns content">
    <?= $this->Html->link(__('Retourner a la liste des compagnie'), ['action' => 'index']) ?>
    <?= $this->Form->create($compagnie) ?>
    <fieldset>
        <legend><?= __('Add Compagnie') ?></legend>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
