<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pagamento'), ['action' => 'edit', $pagamento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pagamento'), ['action' => 'delete', $pagamento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pagamento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pagamentos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pagamento'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mensalidade'), ['controller' => 'Mensalidade', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mensalidade'), ['controller' => 'Mensalidade', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pagamentos view large-9 medium-8 columns content">
    <h3><?= h($pagamento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($pagamento->tipo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($pagamento->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($pagamento->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Mensalidade') ?></h4>
        <?php if (!empty($pagamento->mensalidade)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Associado Id') ?></th>
                <th><?= __('Vencimento') ?></th>
                <th><?= __('Pago') ?></th>
                <th><?= __('Valor Base') ?></th>
                <th><?= __('Desconto') ?></th>
                <th><?= __('Acressimo') ?></th>
                <th><?= __('Pagamento Id') ?></th>
                <th><?= __('Observacoes') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pagamento->mensalidade as $mensalidade): ?>
            <tr>
                <td><?= h($mensalidade->id) ?></td>
                <td><?= h($mensalidade->associado_id) ?></td>
                <td><?= h($mensalidade->vencimento) ?></td>
                <td><?= h($mensalidade->pago) ?></td>
                <td><?= h($mensalidade->valor_base) ?></td>
                <td><?= h($mensalidade->desconto) ?></td>
                <td><?= h($mensalidade->acressimo) ?></td>
                <td><?= h($mensalidade->pagamento_id) ?></td>
                <td><?= h($mensalidade->observacoes) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Mensalidade', 'action' => 'view', $mensalidade->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Mensalidade', 'action' => 'edit', $mensalidade->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Mensalidade', 'action' => 'delete', $mensalidade->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mensalidade->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
