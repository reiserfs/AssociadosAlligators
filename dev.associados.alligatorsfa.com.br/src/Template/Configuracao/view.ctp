<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuracao'), ['action' => 'edit', $configuracao->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuracao'), ['action' => 'delete', $configuracao->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configuracao->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Configuracao'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuracao'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configuracao view large-9 medium-8 columns content">
    <h3><?= h($configuracao->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Variavel') ?></th>
            <td><?= h($configuracao->variavel) ?></td>
        </tr>
        <tr>
            <th><?= __('Tabela') ?></th>
            <td><?= h($configuracao->tabela) ?></td>
        </tr>
        <tr>
            <th><?= __('Campo') ?></th>
            <td><?= h($configuracao->campo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($configuracao->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($configuracao->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($configuracao->valor) ?></td>
        </tr>
    </table>
</div>
