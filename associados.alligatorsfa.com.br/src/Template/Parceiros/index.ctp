<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Parceiro'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="parceiros index large-9 medium-8 columns content">
    <h3><?= __('Parceiros') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data_criacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ultimo_login') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ativo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descricao') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parceiros as $parceiro): ?>
	    <?php list($ativoicon,$ativotexto) = ($parceiro->ativo) ? 
		    array($this->Html->image('on.png',['alt' => __('Ativo')]),'Desativar') 
		    : 
		    array($this->Html->image('off.png',['alt' => __('Desativado')]),'Ativar'); 
	     ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($parceiro->id) ?></td>
                <td><?= h($parceiro->user) ?></td>
                <td><?= h($parceiro->data_criacao) ?></td>
                <td><?= h($parceiro->ultimo_login) ?></td>
                <td><?= $ativoicon  ?></td>
                <td><?= h($parceiro->descricao) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $parceiro->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $parceiro->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $parceiro->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $parceiro->user)]) ?>
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
