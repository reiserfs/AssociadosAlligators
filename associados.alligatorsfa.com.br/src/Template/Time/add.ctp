<?php $this->extend('/Comum/associado'); ?>
<div class="time form large-9 medium-8 columns content">
    <?= $this->Form->create($time) ?>
    <fieldset>
        <legend><?= __('Add Time') ?></legend>
        <?php
            echo $this->Form->input('nome');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
