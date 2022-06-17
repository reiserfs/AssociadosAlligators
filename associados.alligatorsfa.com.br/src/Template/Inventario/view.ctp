<?php $this->extend('/Comum/associado'); ?>
<div class="inventario view large-9 medium-8 columns content">
    <h3><?= h($inventario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Equipamento') ?></th>
            <td><?= $inventario->has('equipamento') ? $this->Html->link($inventario->equipamento->id, ['controller' => 'Equipamentos', 'action' => 'view', $inventario->equipamento->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Associado') ?></th>
            <td><?= $inventario->has('associado') ? $this->Html->link($inventario->associado->id, ['controller' => 'Associados', 'action' => 'view', $inventario->associado->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tamanho') ?></th>
            <td><?= h($inventario->tamanho) ?></td>
        </tr>
        <tr>
            <th><?= __('Sobrecor') ?></th>
            <td><?= h($inventario->sobrecor) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($inventario->id) ?></td>
        </tr>
    </table>
</div>
