<?php $this->extend('/Comum/associado'); ?>
<div class="inventario index large-9 medium-8 columns content">
    <h3><?= __('Inventario') ?></h3>
    <?= $this->Form->create($inventario,['type' => 'get']) ?>  
    <table align="right" cellpadding="0" cellspacing="0">
            <tr>
                  <td width="90%"><?= $this->Form->input('filtro',['label'=>false,'value'=>((isset($filtro)) ? $filtro : '')]); ?></td>
                  <td><?= $this->Form->button(__('Filtrar'),['class'=>'filtrar']) ?>          </td>
           </tr>
    </table>
    <?= $this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th width='10%'><?= $this->Paginator->sort('Equipamento.tipo',__('Tipo')) ?></th>
                <th width='40%'><?= $this->Paginator->sort('equipamento_id') ?></th>
                <th><?= $this->Paginator->sort('associado_id') ?></th>
                <th><?= $this->Paginator->sort('tamanho') ?></th>
                <th width='10%'><?= $this->Paginator->sort('sobrecor') ?></th>
                <th width='10%' class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventario as $inventario): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($inventario->id) ?></td>
                <td><?= h($inventario->equipamento->tipo) ?></td>
		<td><?= $inventario->has('equipamento') ? $this->Html->link(
					$inventario->equipamento->marca .' '.$inventario->equipamento->modelo, 
					['controller' => 'Equipamentos', 'action' => 'view', $inventario->equipamento->id]) : '' 
		?></td>
                <td><?= $inventario->has('associado') ? $this->Html->link($inventario->associado->nome, ['controller' => 'Associados', 'action' => 'view', $inventario->associado->id]) : '' ?></td>
                <td><?= h($inventario->tamanho) ?></td>
                <td bgcolor='<?= h($inventario->sobrecor) ?>'> &nbsp;</td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $inventario->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $inventario->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $inventario->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $inventario->id)]) ?>
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
