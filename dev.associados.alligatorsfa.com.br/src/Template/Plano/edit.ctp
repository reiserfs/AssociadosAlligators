<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $plano->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $plano->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Plano'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="plano form large-9 medium-8 columns content">
    <?= $this->Form->create($plano) ?>
    <fieldset>
        <legend><?= __('Edit Plano') ?></legend>
        <?php
            echo $this->Form->input('nome_plano');
            echo $this->Form->input('meses');
            echo $this->Form->input('valor_base');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
