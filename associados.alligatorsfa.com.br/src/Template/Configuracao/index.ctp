<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Configuracao'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configuracao index large-9 medium-8 columns content">
    <h3><?= __('Configuracao') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('variavel') ?></th>
                <th><?= $this->Paginator->sort('valor') ?></th>
                <th><?= $this->Paginator->sort('tabela') ?></th>
                <th><?= $this->Paginator->sort('campo') ?></th>
                <th><?= $this->Paginator->sort('descricao') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configuracao as $configuracao): ?>
            <tr>
                <td><?= $this->Number->format($configuracao->id) ?></td>
                <td><?= h($configuracao->variavel) ?></td>
                <td><?= $this->Number->format($configuracao->valor) ?></td>
                <td><?= h($configuracao->tabela) ?></td>
                <td><?= h($configuracao->campo) ?></td>
                <td><?= h($configuracao->descricao) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $configuracao->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configuracao->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $configuracao->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configuracao->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
