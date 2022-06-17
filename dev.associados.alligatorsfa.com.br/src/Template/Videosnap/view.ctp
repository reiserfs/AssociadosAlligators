<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Videosnap'), ['action' => 'edit', $videosnap->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Videosnap'), ['action' => 'delete', $videosnap->id], ['confirm' => __('Are you sure you want to delete # {0}?', $videosnap->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Videosnap'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Videosnap'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Video'), ['controller' => 'Video', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Video'), ['controller' => 'Video', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="videosnap view large-9 medium-8 columns content">
    <h3><?= h($videosnap->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Video') ?></th>
            <td><?= $videosnap->has('video') ? $this->Html->link($videosnap->video->id, ['controller' => 'Video', 'action' => 'view', $videosnap->video->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Casa') ?></th>
            <td><?= h($videosnap->casa) ?></td>
        </tr>
        <tr>
            <th><?= __('Visitante') ?></th>
            <td><?= h($videosnap->visitante) ?></td>
        </tr>
        <tr>
            <th><?= __('Resultado') ?></th>
            <td><?= h($videosnap->resultado) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($videosnap->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($videosnap->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Inicio') ?></th>
            <td><?= $this->Number->format($videosnap->inicio) ?></td>
        </tr>
        <tr>
            <th><?= __('Fim') ?></th>
            <td><?= $this->Number->format($videosnap->fim) ?></td>
        </tr>
    </table>
</div>
