<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Equipatemp'), ['action' => 'edit', $equipatemp->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Equipatemp'), ['action' => 'delete', $equipatemp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipatemp->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Equipatemp'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipatemp'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="equipatemp view large-9 medium-8 columns content">
    <h3><?= h($equipatemp->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($equipatemp->tipo) ?></td>
        </tr>
        <tr>
            <th><?= __('Marca') ?></th>
            <td><?= h($equipatemp->marca) ?></td>
        </tr>
        <tr>
            <th><?= __('Modelo') ?></th>
            <td><?= h($equipatemp->modelo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($equipatemp->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Cor') ?></th>
            <td><?= h($equipatemp->cor) ?></td>
        </tr>
        <tr>
            <th><?= __('Foto Type') ?></th>
            <td><?= h($equipatemp->foto_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($equipatemp->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Foto Size') ?></th>
            <td><?= $this->Number->format($equipatemp->foto_size) ?></td>
        </tr>
    </table>
</div>
