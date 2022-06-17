<?php $this->extend('/Comum/associado'); ?>
<div class="associados index large-9 medium-8 columns content">
    <h3><?= __('Escolha o Associado Para atualizar seus dados') ?></h3>
    <?= $this->Form->create($associados,['type' => 'get']) ?>  
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
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th><?= $this->Paginator->sort('sobrenome') ?></th>
                <th width='25%'><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('apelido') ?></th>
                <th><?= $this->Paginator->sort('Time.nome',__('Time')) ?></th>
                <th width='10%' class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($associados as $associado): ?>
            <?php $sexoicon = ($associado->sexo=='F') ? $this->Html->image('f.png',['alt' => __('AlliGirl')]) : $this->Html->image('m.png',['alt' => __('AlliBoy')]); ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($associado->id) ?></td>
                <td><?= h($associado->nome) ?></td>
                <td><?= h($associado->sobrenome) ?></td>
                <td><?= h($associado->email) ?></td>
		<td><?php echo $sexoicon?><?= h($associado->apelido) ?></td>
                <td><?= $associado->has('time') ? $this->Html->link($associado->time->nome, ['controller' => 'Time', 'action' => 'view', $associado->time->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('update.png',['alt' => __('Atualizar Dados')]), ['action' => 'update', $id, $associado->id],['escape'=>false]) ?>
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
