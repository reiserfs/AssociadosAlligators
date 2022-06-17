<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Equipatemp'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="equipatemp index large-9 medium-8 columns content">
    <h3><?= __('Equipatemp') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('tipo') ?></th>
                <th><?= $this->Paginator->sort('marca') ?></th>
                <th><?= $this->Paginator->sort('modelo') ?></th>
                <th><?= $this->Paginator->sort('descricao') ?></th>
                <th><?= $this->Paginator->sort('cor') ?></th>
                <th><?= $this->Paginator->sort('foto_size') ?></th>
                <th><?= $this->Paginator->sort('foto_type') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipatemp as $equipatemp): ?>
            <tr>
                <td><?= $this->Number->format($equipatemp->id) ?></td>
                <td><?= h($equipatemp->tipo) ?></td>
                <td><?= h($equipatemp->marca) ?></td>
                <td><?= h($equipatemp->modelo) ?></td>
                <td><?= h($equipatemp->descricao) ?></td>
                <td><?= h($equipatemp->cor) ?></td>
                <td><?= $this->Number->format($equipatemp->foto_size) ?></td>
                <td><?= h($equipatemp->foto_type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $equipatemp->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $equipatemp->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $equipatemp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipatemp->id)]) ?>
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
