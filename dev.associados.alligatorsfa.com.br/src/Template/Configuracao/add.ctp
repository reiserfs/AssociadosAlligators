<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Configuracao'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="configuracao form large-9 medium-8 columns content">
    <?= $this->Form->create($configuracao) ?>
    <fieldset>
        <legend><?= __('Add Configuracao') ?></legend>
        <?php
            echo $this->Form->input('variavel');
            echo $this->Form->input('valor');
            echo $this->Form->input('tabela', ['options' => $controllers]);
            echo $this->Form->input('campo');
            echo $this->Form->input('descricao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
