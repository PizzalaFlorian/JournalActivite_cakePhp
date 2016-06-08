<?php
    echo $this->element('sidebarAdmin');
    echo $this->Html->css('main_custom');
?>


<div class="users form large-12 medium-11 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Modifier l\'utilisateur') ?></legend>
        <?php
            echo $this->Form->input('login');
            echo $this->Form->input('typeUser');
            echo $this->Form->input('password');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
<?php echo $this->Html->link(__('Retour'), ['action' => 'index'],['class'=>'button']).' '.$this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $user->ID],
                ['class'=>'button','confirm' => __('Êtes-vous sur de vouloir supprimer # {0}?', $user->email)]).' '.$this->Form->postLink(
                __('Réinitialiser le mots de passe'),
                ['action' => 'resetMDP', 'Email' => $user->email],
                ['class'=>'button']
                );
        ?>
</div>
