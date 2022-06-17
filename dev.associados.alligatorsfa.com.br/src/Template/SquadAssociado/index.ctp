<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="squadAssociado index large-9 medium-8 columns content">
    <h3><?= __('Squad Associado') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('squad_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('posicao_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('associados_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($squadAssociado as $squadAssociado): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($squadAssociado->id) ?></td>
                <td><?= $this->Number->format($squadAssociado->squad_id) ?></td>
                <td><?= $this->Number->format($squadAssociado->posicao_id) ?></td>
                <td><?= $squadAssociado->has('associado') ? $this->Html->link($squadAssociado->associado->id, ['controller' => 'Associados', 'action' => 'view', $squadAssociado->associado->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $squadAssociado->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $squadAssociado->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $squadAssociado->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $squadAssociado->id)]) ?>
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
