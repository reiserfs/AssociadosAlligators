<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Posicao'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posicao index large-9 medium-8 columns content">
    <h3><?= __('Posicao') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%' scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th width='20%' scope="col"><?= $this->Paginator->sort('sigla') ?></th>
                <th width='10%' scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posicao as $posicao): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($posicao->id) ?></td>
                <td><?= h($timesposicoes[$posicao->time]) ?></td>
                <td><?= h($posicao->nome) ?></td>
                <td><?= h($posicao->sigla) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $posicao->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $posicao->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $posicao->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $posicao->id)]) ?>
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
