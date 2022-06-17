<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Permisso'), ['action' => 'edit', $permisso->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Permisso'), ['action' => 'delete', $permisso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permisso->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Permissoes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Permisso'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="permissoes view large-9 medium-8 columns content">
    <h3><?= h($permisso->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Controller') ?></th>
            <td><?= h($permisso->controller) ?></td>
        </tr>
        <tr>
            <th><?= __('Action') ?></th>
            <td><?= h($permisso->action) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($permisso->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Login Id') ?></th>
            <td><?= $this->Number->format($permisso->login_id) ?></td>
        </tr>
    </table>
</div>
