<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Video'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Outrotime'), ['controller' => 'Outrotime', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Outrotime'), ['controller' => 'Outrotime', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Videosnap'), ['controller' => 'Videosnap', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Videosnap'), ['controller' => 'Videosnap', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="video form large-9 medium-8 columns content">
    <?= $this->Form->create($video) ?>
    <fieldset>
        <legend><?= __('Add Video') ?></legend>
        <?php
            echo $this->Form->input('time_casa', ['options' => $outrotimecasa]);
            echo $this->Form->input('time_visitante', ['options' => $outrotimevisitante]);
            echo $this->Form->input('cidade');
            echo $this->Form->select('estado', $estados);
            echo $this->Form->input('data',['type' =>'text', 'label' => 'Data']);
            echo $this->Form->input('placar_casa');
            echo $this->Form->input('placar_visitante');
            echo $this->Form->input('youtube');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <?= $this->Html->script('jquery-ui.min.js') ?>
    <?= $this->Html->script('datepicker-pt-BR.js') ?>
	<script>
	$(function() {
		$( "#data" ).datepicker();
	});   
	</script>
