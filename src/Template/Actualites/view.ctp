<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Messagerie'), ['controller' => 'messages','action' => 'index']) ?></li>
    </ul>
</nav>
<div class="actualites view large-9 medium-8 columns content">
    <h3><?= h($actualite->Sujet) ?></h3>
    Le : <?= h($actualite->Date) ?>
    <br/>
    <br/>
    <?= $this->Text->autoParagraph(h($actualite->Contenue)); ?>
</div>
