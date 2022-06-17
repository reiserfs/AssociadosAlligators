<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Squad'), ['action' => 'edit', $squad->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Squad'), ['action' => 'delete', $squad->id], ['confirm' => __('Are you sure you want to delete # {0}?', $squad->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Squad'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Squad'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="squad view large-9 medium-8 columns content">
    <h3><?= h($squad->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($squad->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($squad->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coach') ?></th>
            <td><?= $this->Number->format($squad->coach) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modalidade') ?></th>
            <td><?= $this->Number->format($squad->modalidade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data') ?></th>
            <td><?= h($squad->data) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Desativado') ?></th>
            <td><?= $squad->ativo ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Squad Associado') ?></h4>
        <?php if (!empty($squad->squad_associado)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Squad Id') ?></th>
                <th scope="col"><?= __('Posicao Id') ?></th>
                <th scope="col"><?= __('Associados Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($squad->squad_associado as $squadAssociado): ?>
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
