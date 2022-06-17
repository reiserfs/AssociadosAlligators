<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Plano'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="plano index large-9 medium-8 columns content">
    <h3><?= __('Plano') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nome_plano') ?></th>
                <th><?= $this->Paginator->sort('meses') ?></th>
                <th><?= $this->Paginator->sort('valor_base') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plano as $plano): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($plano->id) ?></td>
                <td><?= h($plano->nome_plano) ?></td>
                <td><?= $this->Number->format($plano->meses) ?></td>
			<td><?= $this->Number->currency($plano->valor_base,'BRL') ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $plano->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $plano->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $plano->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $plano->id)]) ?>
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
