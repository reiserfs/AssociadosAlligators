<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $log->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $log->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Log'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="log form large-9 medium-8 columns content">
    <?= $this->Form->create($log) ?>
    <fieldset>
        <legend><?= __('Edit Log') ?></legend>
        <?php
            echo $this->Form->input('login_id',['options' => $login]);
            echo $this->Form->input('controller');
            echo $this->Form->input('action');
            echo $this->Form->input('info');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
