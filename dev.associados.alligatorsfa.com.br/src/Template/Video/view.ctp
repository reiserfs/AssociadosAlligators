<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Video'), ['action' => 'edit', $video->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Video'), ['action' => 'delete', $video->id], ['confirm' => __('Are you sure you want to delete # {0}?', $video->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Video'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Video'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Outrotime'), ['controller' => 'Outrotime', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Outrotime'), ['controller' => 'Outrotime', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Videosnap'), ['controller' => 'Videosnap', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Videosnap'), ['controller' => 'Videosnap', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="video view large-9 medium-8 columns content">
    <h3><?= h($video->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Cidade') ?></th>
            <td><?= h($video->cidade) ?></td>
        </tr>
        <tr>
            <th><?= __('Estado') ?></th>
            <td><?= h($video->estado) ?></td>
        </tr>
        <tr>
            <th><?= __('Youtube') ?></th>
            <td><?= h($video->youtube) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($video->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Time Casa') ?></th>
            <td><?= $this->Number->format($video->time_casa) ?></td>
        </tr>
        <tr>
            <th><?= __('Time Visitante') ?></th>
            <td><?= $this->Number->format($video->time_visitante) ?></td>
        </tr>
        <tr>
            <th><?= __('Placar Casa') ?></th>
            <td><?= $this->Number->format($video->placar_casa) ?></td>
        </tr>
        <tr>
            <th><?= __('Placar Visitante') ?></th>
            <td><?= $this->Number->format($video->placar_visitante) ?></td>
        </tr>
        <tr>
            <th><?= __('Data') ?></th>
            <td><?= h($video->data) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Videosnap') ?></h4>
        <?php if (!empty($video->videosnap)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Video Id') ?></th>
                <th><?= __('Inicio') ?></th>
                <th><?= __('Fim') ?></th>
                <th><?= __('Casa') ?></th>
                <th><?= __('Visitante') ?></th>
                <th><?= __('Resultado') ?></th>
                <th><?= __('Descricao') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($video->videosnap as $videosnap): ?>
            <tr>
                <td><?= h($videosnap->id) ?></td>
                <td><?= h($videosnap->video_id) ?></td>
                <td><?= h($videosnap->inicio) ?></td>
                <td><?= h($videosnap->fim) ?></td>
                <td><?= h($videosnap->casa) ?></td>
                <td><?= h($videosnap->visitante) ?></td>
                <td><?= h($videosnap->resultado) ?></td>
                <td><?= h($videosnap->descricao) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Videosnap', 'action' => 'view', $videosnap->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Videosnap', 'action' => 'edit', $videosnap->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Videosnap', 'action' => 'delete', $videosnap->id], ['confirm' => __('Are you sure you want to delete # {0}?', $videosnap->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
