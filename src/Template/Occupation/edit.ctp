<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $occupation->CodeOccupation],
                ['confirm' => __('Are you sure you want to delete # {0}?', $occupation->CodeOccupation)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Occupation'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="occupation form large-9 medium-8 columns content">
    <?= $this->Form->create($occupation) ?>
    <fieldset>
        <legend><?= __('Edit Occupation') ?></legend>
        <?php
            echo $this->Form->input('HeureDebut');
            echo $this->Form->input('HeureFin');
            echo $this->Form->input('CodeCandidat');
            echo $this->Form->input('CodeLieux');
            echo $this->Form->input('CodeActivite');
            echo $this->Form->input('CodeCompagnie');
            echo $this->Form->input('CodeDispositif');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
