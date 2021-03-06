<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Login'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="login index large-9 medium-8 columns content">
    <h3><?= __('Login') ?></h3>
    <?= $this->Form->create($login,['type' => 'get']) ?>  
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
                <th width='20%'><?= $this->Paginator->sort('user') ?></th>
                <th><?= $this->Paginator->sort('data_criacao') ?></th>
                <th><?= $this->Paginator->sort('ultimo_login') ?></th>
                <th width='5%'><?= $this->Paginator->sort('ativo') ?></th>
                <th width='25%'><?= $this->Paginator->sort('Associados.nome') ?></th>
		<th width='10%'><?= __('Permissoes')?> </th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($login as $login): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($login->id) ?></td>
                <td><?= h($login->user) ?></td>
                <td><?= h($login->data_criacao) ?></td>
                <td><?= h($login->ultimo_login) ?></td>
                <td><?= $this->Html->image(($this->Number->format($login->ativo)) ? 'on.png' : 'off.png')  ?></td>
                <td><?= $login->has('associado') ? $this->Html->link($login->associado->nome . ' (' . $login->associado->apelido . ') '. $login->associado->sobrenome, ['controller' => 'Associados', 'action' => 'view', $login->associado->id]) : '' ?></td>
		<td> <?= $login->has('permissoes') ? count($login->permissoes) : '0' ?> </td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $login->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('lock.png',['alt' =>__('Permissoes')]), ['action' => 'perm', $login->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $login->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $login->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $login->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
        <p><?= $this->Paginator->counter('Total: {{count}}') ?></p>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
