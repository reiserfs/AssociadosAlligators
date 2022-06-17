<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $posicao->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $posicao->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Posicao'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posicao form large-9 medium-8 columns content">
    <?= $this->Form->create($posicao) ?>
    <fieldset>
        <legend><?= __('Edit Posicao') ?></legend>
        <?php
            echo $this->Form->input('time',['options'=>$timesposicoes]);
            echo $this->Form->input('nome');
            echo $this->Form->input('sigla');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
