<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Squad'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="squad index large-9 medium-8 columns content">
    <h3><?= __('Squad') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%' scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th width ='10%' scope="col"><?= $this->Paginator->sort('data') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coach') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modalidade') ?></th>
                <th width='10%' scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($squad as $squad): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($squad->id) ?></td>
                <td><?= h($squad->nome) ?></td>
                <td><?= h($squad->data) ?></td>
                <td><?= h($squad->associado->nome . ' ' . $squad->associado->sobrenome) ?></td>
                <td><?= $this->Number->format($squad->modalidade) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('player.png',['alt' => __('Jogadores')]), ['action' => 'play', $squad->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $squad->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $squad->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $squad->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $squad->id)]) ?>
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
