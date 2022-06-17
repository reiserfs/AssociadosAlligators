<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Posicao'), ['action' => 'edit', $posicao->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Posicao'), ['action' => 'delete', $posicao->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posicao->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Posicao'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Posicao'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="posicao view large-9 medium-8 columns content">
    <h3><?= h($posicao->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($posicao->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($posicao->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Time') ?></th>
            <td><?= $this->Number->format($posicao->time) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Squad Associado') ?></h4>
        <?php if (!empty($posicao->squad_associado)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Squad Id') ?></th>
                <th scope="col"><?= __('Posicao Id') ?></th>
                <th scope="col"><?= __('Associados Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($posicao->squad_associado as $squadAssociado): ?>
            <tr>
                <td><?= h($squadAssociado->id) ?></td>
                <td><?= h($squadAssociado->squad_id) ?></td>
                <td><?= h($squadAssociado->posicao_id) ?></td>
                <td><?= h($squadAssociado->associados_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SquadAssociado', 'action' => 'view', $squadAssociado->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SquadAssociado', 'action' => 'edit', $squadAssociado->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SquadAssociado', 'action' => 'delete', $squadAssociado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $squadAssociado->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
