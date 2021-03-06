<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $outrotime->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $outrotime->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Outrotime'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="outrotime form large-9 medium-8 columns content">
    <?= $this->Form->create($outrotime,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Outrotime') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('website');
            echo $this->Form->input('descricao',['type'=>'textarea']);
            echo $this->Form->input('logo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
