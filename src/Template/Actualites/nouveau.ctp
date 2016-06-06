<?php
    echo $this->Html->css('main_custom');
    if($monController == 'chercheur'){
     echo $this->element('sidebarChercheur');
    }
    if($monController == 'candidat'){
     echo $this->element('sidebarCandidat');
    }
    if($monController == 'administrateur'){
     echo $this->element('sidebarAdmin');
    }
?>
<div class="actualites form large-9 medium-8 columns content">
    <?= $this->Form->create($actualite) ?>
    <fieldset>
        <legend><?= __('Création Actualité') ?></legend>
        <?php
            echo $this->Form->input('Sujet');
            echo $this->Form->input('Contenu');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
