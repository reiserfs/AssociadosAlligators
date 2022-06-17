<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Nota'), ['action' => 'edit', $nota->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Nota'), ['action' => 'delete', $nota->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nota->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Nota'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Login'), ['controller' => 'Login', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Login'), ['controller' => 'Login', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notas view large-9 medium-8 columns content">
    <h3><?= h($nota->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Associado') ?></th>
            <td><?= $nota->has('associado') ? $this->Html->link($nota->associado->id, ['controller' => 'Associados', 'action' => 'view', $nota->associado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login') ?></th>
            <td><?= $nota->has('login') ? $this->Html->link($nota->login->id, ['controller' => 'Login', 'action' => 'view', $nota->login->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($nota->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nota') ?></th>
            <td><?= h($nota->nota) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($nota->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data') ?></th>
            <td><?= h($nota->data) ?></td>
        </tr>
    </table>
</div>
