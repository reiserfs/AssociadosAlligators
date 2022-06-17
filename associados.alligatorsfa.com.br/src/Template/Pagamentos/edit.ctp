<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pagamento->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pagamento->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pagamentos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Mensalidade'), ['controller' => 'Mensalidade', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mensalidade'), ['controller' => 'Mensalidade', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pagamentos form large-9 medium-8 columns content">
    <?= $this->Form->create($pagamento) ?>
    <fieldset>
        <legend><?= __('Edit Pagamento') ?></legend>
        <?php
            echo $this->Form->input('tipo');
            echo $this->Form->input('descricao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
