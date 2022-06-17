<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Outrotime'), ['action' => 'edit', $outrotime->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Outrotime'), ['action' => 'delete', $outrotime->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outrotime->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Outrotime'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Outrotime'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="outrotime view large-9 medium-8 columns content">
    <h3><?= h($outrotime->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($outrotime->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Logo') ?></th>
	 	<td width='160px'><?= $this->Html->image($this->Url->build(['controller' => 'Outrotime', 'action' => 'imgfoto', $outrotime->id ]), ['width' => '160px', 'height' => '160px']) ?></td>
        </tr>
        <tr>
            <th><?= __('Website') ?></th>
            <td><?= h($outrotime->website) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($outrotime->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($outrotime->id) ?></td>
        </tr>
    </table>
</div>
