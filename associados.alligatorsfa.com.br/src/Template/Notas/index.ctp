<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Nota'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Login'), ['controller' => 'Login', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Login'), ['controller' => 'Login', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notas index large-9 medium-8 columns content">
    <h3><?= __('Notas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th scope="col" width='30%'><?= $this->Paginator->sort('associado_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data') ?></th>
                <th scope="col"><?= $this->Paginator->sort('login_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nota') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notas as $nota): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($nota->id) ?></td>
                <td><?= $nota->has('associado') ? $this->Html->link($nota->associado->nome . ' (' . $nota->associado->apelido . ') ' . $nota->associado->sobrenome, ['controller' => 'Associados', 'action' => 'view', $nota->associado->id]) : '' ?></td>
                <td><?= h($nota->data) ?></td>
                <td><?= $nota->has('login') ? $this->Html->link($nota->login->user, ['controller' => 'Login', 'action' => 'view', $nota->login->id]) : '' ?></td>
                <td><?= h($nota->tipo) ?></td>
                <td><?= h($nota->nota) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $nota->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $nota->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $nota->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $nota->id)]) ?>
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
