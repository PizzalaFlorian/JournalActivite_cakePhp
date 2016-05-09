<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $message->IDMessage],
                ['confirm' => __('Are you sure you want to delete # {0}?', $message->IDMessage)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messages form large-9 medium-8 columns content">
    <?= $this->Form->create($message) ?>
    <fieldset>
        <legend><?= __('Edit Message') ?></legend>
        <?php
            echo $this->Form->input('DateEnvoi');
            echo $this->Form->input('Sujet');
            echo $this->Form->input('ContenuMessage');
            echo $this->Form->input('Lu');
            echo $this->Form->input('IDExpediteur');
            echo $this->Form->input('IDRecepteur');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
