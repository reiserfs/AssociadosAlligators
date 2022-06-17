<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Equipatemp'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="equipatemp form large-9 medium-8 columns content">
    <?= $this->Form->create($equipatemp) ?>
    <fieldset>
        <legend><?= __('Add Equipatemp') ?></legend>
        <?php
            echo $this->Form->input('tipo');
            echo $this->Form->input('marca');
            echo $this->Form->input('modelo');
            echo $this->Form->input('descricao');
            echo $this->Form->input('cor');
            echo $this->Form->input('foto_size');
            echo $this->Form->input('foto_type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
