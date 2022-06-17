<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Plano'), ['action' => 'edit', $plano->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Plano'), ['action' => 'delete', $plano->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plano->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Plano'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plano'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="plano view large-9 medium-8 columns content">
    <h3><?= h($plano->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome Plano') ?></th>
            <td><?= h($plano->nome_plano) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($plano->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Meses') ?></th>
            <td><?= $this->Number->format($plano->meses) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor Base') ?></th>
            <td><?= $this->Number->format($plano->valor_base) ?></td>
        </tr>
    </table>
</div>
