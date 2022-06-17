<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parceiro'), ['action' => 'edit', $parceiro->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parceiro'), ['action' => 'delete', $parceiro->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parceiro->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parceiros'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parceiro'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parceiros view large-9 medium-8 columns content">
    <h3><?= h($parceiro->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= h($parceiro->user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($parceiro->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descricao') ?></th>
            <td><?= h($parceiro->descricao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($parceiro->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Criacao') ?></th>
            <td><?= h($parceiro->data_criacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ultimo Login') ?></th>
            <td><?= h($parceiro->ultimo_login) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $parceiro->ativo ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
