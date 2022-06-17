<?php $this->extend('/Comum/associado'); ?>
<div class="equipamentos index large-9 medium-8 columns content">
    <h3><?= __('Equipamentos') ?></h3>
    <?= $this->Form->create($equipamentos,['type' => 'get']) ?>  
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
                <th width='20%'><?= $this->Paginator->sort('tipo') ?></th>
                <th><?= $this->Paginator->sort('marca') ?></th>
                <th><?= $this->Paginator->sort('modelo') ?></th>
                <th width='5%'><?= $this->Paginator->sort('cor') ?></th>
                <th width='10%' class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipamentos as $equipamento): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($equipamento->id) ?></td>
                <td><?= h($equipamento->tipo) ?></td>
                <td><?= h($equipamento->marca) ?></td>
                <td><?= h($equipamento->modelo) ?></td>
                <td bgcolor='<?= h($equipamento->cor) ?>'> &nbsp;</td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $equipamento->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $equipamento->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $equipamento->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $equipamento->id)]) ?>
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
