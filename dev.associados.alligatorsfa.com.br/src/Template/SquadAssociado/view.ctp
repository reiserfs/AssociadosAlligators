<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Squad Associado'), ['action' => 'edit', $squadAssociado->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Squad Associado'), ['action' => 'delete', $squadAssociado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $squadAssociado->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="squadAssociado view large-9 medium-8 columns content">
    <h3><?= h($squadAssociado->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Associado') ?></th>
            <td><?= $squadAssociado->has('associado') ? $this->Html->link($squadAssociado->associado->id, ['controller' => 'Associados', 'action' => 'view', $squadAssociado->associado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($squadAssociado->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Squad Id') ?></th>
            <td><?= $this->Number->format($squadAssociado->squad_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Posicao Id') ?></th>
            <td><?= $this->Number->format($squadAssociado->posicao_id) ?></td>
        </tr>
    </table>
</div>
