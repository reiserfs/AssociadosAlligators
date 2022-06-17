<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Video'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Outrotime'), ['controller' => 'Outrotime', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Outrotime'), ['controller' => 'Outrotime', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Videosnap'), ['controller' => 'Videosnap', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Videosnap'), ['controller' => 'Videosnap', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="video index large-9 medium-8 columns content">
    <h3><?= __('Video') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th width='20%'><?= $this->Paginator->sort('time_casa') ?></th>
		<th width='3%'> </th>
                <th width='20%' ><?= $this->Paginator->sort('time_visitante') ?></th>
                <th><?= $this->Paginator->sort('cidade') ?></th>
                <th><?= $this->Paginator->sort('estado') ?></th>
                <th><?= $this->Paginator->sort('data') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($video as $video): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($video->id) ?></td>
		<td><?= $video->outrotime_casa->nome ?> (<?= $this->Number->format($video->placar_casa) ?>)  </td>
		<td> X </td>
		<td> (<?= $this->Number->format($video->placar_visitante) ?>) <?= $video->outrotime_visitante->nome ?></td>
                <td><?= h($video->cidade) ?></td>
                <td><?= h($video->estado) ?></td>
                <td><?= h($video->data->i18nFormat('dd/MM/YYYY')) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $video->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('videosnap.png',['alt' =>__('Detalhes')]), ['action' => 'snap', $video->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $video->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $video->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $video->id)]) ?>
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
