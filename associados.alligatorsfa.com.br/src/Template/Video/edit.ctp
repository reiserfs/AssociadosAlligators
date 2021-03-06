<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $video->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $video->id)]
            )
        ?></li>
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
        <legend><?= __('Edit Video') ?></legend>
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
<script>
	$(function() {
		$( "#data" ).datepicker();
	});   
</script>
