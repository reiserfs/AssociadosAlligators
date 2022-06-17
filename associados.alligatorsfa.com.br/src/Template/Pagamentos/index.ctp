<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pagamento'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mensalidade'), ['controller' => 'Mensalidade', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mensalidade'), ['controller' => 'Mensalidade', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pagamentos index large-9 medium-8 columns content">
    <h3><?= __('Pagamentos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('tipo') ?></th>
                <th><?= $this->Paginator->sort('descricao') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pagamentos as $pagamento): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($pagamento->id) ?></td>
                <td><?= h($pagamento->tipo) ?></td>
                <td><?= h($pagamento->descricao) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $pagamento->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $pagamento->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $pagamento->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $pagamento->id)]) ?>
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
