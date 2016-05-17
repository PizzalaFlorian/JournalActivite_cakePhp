<?php
    echo $this->element($sideBar);
?>
<div class="actualites view large-9 medium-8 columns content">
    <h3><?= h($actualite->Sujet) ?></h3>
    Le : <?= h($actualite->Date) ?>
    <br/>
    <br/>
    <?= $this->Text->autoParagraph(h($actualite->Contenue)); ?>
<?= $this->Html->link(__('Retour'), ['controller' => "$monController",'action' => "$monAction"]) ?>
</div>