<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mensalidade'), ['action' => 'edit', $mensalidade->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mensalidade'), ['action' => 'delete', $mensalidade->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mensalidade->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mensalidade'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mensalidade'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pagamentos'), ['controller' => 'Pagamentos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pagamento'), ['controller' => 'Pagamentos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mensalidade view large-9 medium-8 columns content">
    <h3><?= h($mensalidade->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Associado') ?></th>
            <td><?= $mensalidade->has('associado') ? $this->Html->link($mensalidade->associado->id, ['controller' => 'Associados', 'action' => 'view', $mensalidade->associado->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Pagamento') ?></th>
            <td><?= $mensalidade->has('pagamento') ? $this->Html->link($mensalidade->pagamento->id, ['controller' => 'Pagamentos', 'action' => 'view', $mensalidade->pagamento->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Observacoes') ?></th>
            <td><?= h($mensalidade->observacoes) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($mensalidade->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor Base') ?></th>
            <td><?= $this->Number->format($mensalidade->valor_base) ?></td>
        </tr>
        <tr>
            <th><?= __('Desconto') ?></th>
            <td><?= $this->Number->format($mensalidade->desconto) ?></td>
        </tr>
        <tr>
            <th><?= __('Acressimo') ?></th>
            <td><?= $this->Number->format($mensalidade->acressimo) ?></td>
        </tr>
        <tr>
            <th><?= __('Vencimento') ?></th>
            <td><?= h($mensalidade->vencimento) ?></td>
        </tr>
        <tr>
            <th><?= __('Pago') ?></th>
            <td><?= h($mensalidade->pago) ?></td>
        </tr>
    </table>
</div>
