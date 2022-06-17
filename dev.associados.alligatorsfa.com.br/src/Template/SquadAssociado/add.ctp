<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="squadAssociado form large-9 medium-8 columns content">
    <?= $this->Form->create($squadAssociado) ?>
    <fieldset>
        <legend><?= __('Add Squad Associado') ?></legend>
        <?php
            echo $this->Form->input('squad_id');
            echo $this->Form->input('posicao_id');
            echo $this->Form->input('associados_id', ['options' => $associados]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
