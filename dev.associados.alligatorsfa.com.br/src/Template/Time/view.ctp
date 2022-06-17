<?php $this->extend('/Comum/associado'); ?>
<div class="time view large-9 medium-8 columns content">
    <h3><?= h($time->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($time->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($time->id) ?></td>
        </tr>
    </table>
</div>
