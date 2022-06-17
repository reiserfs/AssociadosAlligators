<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $permisso->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $permisso->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Permissoes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="permissoes form large-9 medium-8 columns content">
    <?= $this->Form->create($permisso) ?>
    <fieldset>
        <legend><?= __('Edit Permisso') ?></legend>
        <?php
            echo $this->Form->input('controller');
            echo $this->Form->input('action');
            echo $this->Form->input('login_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
