<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Associados') ?></li>
        <li><?= $this->Html->link(__('New Associado'), ['controller'=>'Associados','action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Associados'), ['controller'=>'Associados','action' => 'index']) ?></li>
<?php if (isset($associado->id)) : ?>
        <li><?= $this->Html->link(__('Edit Associados'), ['controller'=>'Associados','action' => 'edit', $associado->id]) ?> </li>
<?php endif; ?>

        <li class="heading"><?= __('Tryout') ?></li>
        <li><?= $this->Html->link(__('New Tryout'), ['controller'=>'Tryout','action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tryout'), ['controller'=>'Tryout','action' => 'index']) ?></li>
<?php if (isset($tryout->id)) : ?>
        <li><?= $this->Html->link(__('Edit Tryout'), ['controller'=>'Tryout','action' => 'edit', $tryout->id]) ?> </li>
<?php endif; ?>

        <li class="heading"><?= __('Categorias') ?></li>
        <li><?= $this->Html->link(__('New Time'), ['controller'=>'Time','action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Time'), ['controller'=>'Time','action' => 'index']) ?></li>
<?php if (isset($time->id)) : ?>
        <li><?= $this->Html->link(__('Edit Time'), ['controller'=>'Time','action' => 'edit', $time->id]) ?> </li>
<?php endif; ?>

        <li class="heading"><?= __('Equipamentos') ?></li>
        <li><?= $this->Html->link(__('List Equipamentos'), ['controller'=>'Equipamentos','action' => 'index']) ?> </li>
<?php if (isset($equipamento->id)) : ?>
        <li><?= $this->Html->link(__('Edit Equipamento'), ['controller'=>'Equipamentos','action' => 'edit', $equipamento->id]) ?> </li>
<?php endif; ?>
        <li><?= $this->Html->link(__('New Equipamento'), ['controller'=>'Equipamentos','action' => 'add']) ?> </li>

        <li class="heading"><?= __('Inventario') ?></li>
        <li><?= $this->Html->link(__('List Inventario'), ['controller'=>'Inventario','action' => 'index']) ?> </li>
<?php if (isset($inventario->id)) : ?>
        <li><?= $this->Html->link(__('Edit Inventario'), ['controller'=>'Inventario','action' => 'edit', $inventario->id]) ?> </li>
<?php endif; ?>
        <li><?= $this->Html->link(__('New Inventario'), ['controller'=>'Inventario','action' => 'add']) ?> </li>
    </ul>
</nav>
<?= $this->fetch('content') ?>
