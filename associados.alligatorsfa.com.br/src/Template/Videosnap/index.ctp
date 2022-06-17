<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Videosnap'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Video'), ['controller' => 'Video', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Video'), ['controller' => 'Video', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="videosnap index large-9 medium-8 columns content">
    <h3><?= __('Videosnap') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('video_id') ?></th>
                <th><?= $this->Paginator->sort('inicio') ?></th>
                <th><?= $this->Paginator->sort('fim') ?></th>
                <th><?= $this->Paginator->sort('casa') ?></th>
                <th><?= $this->Paginator->sort('visitante') ?></th>
                <th><?= $this->Paginator->sort('resultado') ?></th>
                <th><?= $this->Paginator->sort('descricao') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videosnap as $videosnap): ?>
            <tr>
                <td><?= $this->Number->format($videosnap->id) ?></td>
                <td><?= $videosnap->has('video') ? $this->Html->link($videosnap->video->id, ['controller' => 'Video', 'action' => 'view', $videosnap->video->id]) : '' ?></td>
                <td><?= $this->Number->format($videosnap->inicio) ?></td>
                <td><?= $this->Number->format($videosnap->fim) ?></td>
                <td><?= h($videosnap->casa) ?></td>
                <td><?= h($videosnap->visitante) ?></td>
                <td><?= h($videosnap->resultado) ?></td>
                <td><?= h($videosnap->descricao) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $videosnap->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $videosnap->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $videosnap->id], ['confirm' => __('Are you sure you want to delete # {0}?', $videosnap->id)]) ?>
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
