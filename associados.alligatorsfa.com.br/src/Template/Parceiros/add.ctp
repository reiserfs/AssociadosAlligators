<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Parceiros'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="parceiros form large-9 medium-8 columns content">
    <?= $this->Form->create($parceiro) ?>
    <fieldset>
        <legend><?= __('Add Parceiro') ?></legend>
        <?php
            echo $this->Form->input('user');
            echo $this->Form->input('password');
            echo $this->Form->input('ativo');
            echo $this->Form->input('descricao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
