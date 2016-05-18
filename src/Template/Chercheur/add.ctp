<div class="chercheur form large-11 medium-12 columns content">
    <?= $this->Form->create($chercheur) ?>
    <fieldset>
        <legend><?= __('S\'inscrire') ?></legend>
        <?php
            echo $this->Form->input('PrenomChercheur');
            echo $this->Form->input('NomChercheur');
            echo $this->Form->input('ID',['type'=>'hidden','value'=>$_SESSION['Auth']['User']['ID']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
