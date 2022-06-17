<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Login'), ['action' => 'edit', $login->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Login'), ['action' => 'delete', $login->id], ['confirm' => __('Are you sure you want to delete # {0}?', $login->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Login'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Login'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Permissoes'), ['controller' => 'Permissoes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Permisso'), ['controller' => 'Permissoes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="login view large-9 medium-8 columns content">
   <h3><?= $login->has('associado') ? $this->Html->link($login->associado->nome . ' ('. $login->associado->apelido . ') '. $login->associado->sobrenome, ['controller' => 'Associados', 'action' => 'view', $login->associado->id]) : '' ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= h($login->user) ?></td>
            <th><?= __('Id') ?></th>
	    <td><?= $this->Html->image(($this->Number->format($login->ativo)) ? 'on.png' : 'off.png')  ?>
            <?= $this->Number->format($login->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Criacao') ?></th>
            <td><?= h($login->data_criacao) ?></td>
            <th><?= __('Ultimo Login') ?></th>
            <td><?= h($login->ultimo_login) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Permissoes') ?></h4>
        <?php if (!empty($login->permissoes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Controller') ?></th>
                <th><?= __('Action') ?></th>
                <th><?= __('Login Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($login->permissoes as $permissoes): ?>
            <tr>
                <td><?= h($permissoes->id) ?></td>
                <td><?= h($permissoes->controller) ?></td>
                <td><?= h($permissoes->action) ?></td>
                <td><?= h($permissoes->login_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Permissoes', 'action' => 'view', $permissoes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Permissoes', 'action' => 'edit', $permissoes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Permissoes', 'action' => 'delete', $permissoes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permissoes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
