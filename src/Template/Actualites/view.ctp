<?php
    echo $this->element($sideBar);
    echo $this->Html->css('main_custom');
?>
<div class="actualites view large-12 medium-11 columns content">
    <h3><?= h($actualite->Sujet) ?></h3>
    Le : <?= h($actualite->Date) ?>
    <br/>
    <br/>
    <div class="justify"><?= $this->Text->autoParagraph(h($actualite->Contenue)); ?></div>
<?= $this->Html->link(__('Retour'), ['controller' => "$monController",'action' => "$monAction"], ['class' => 'button']) ?>
</div>