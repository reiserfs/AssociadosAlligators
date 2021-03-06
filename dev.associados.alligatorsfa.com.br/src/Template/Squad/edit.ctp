<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $squad->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $squad->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Squad'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Squad Associado'), ['controller' => 'SquadAssociado', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="squad form large-9 medium-8 columns content">
    <?= $this->Form->create($squad) ?>
    <fieldset>
        <legend><?= __('Edit Squad') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('data',['type' =>'text', 'label' => 'Data Formacao']);
            echo $this->Form->input('ativo');
            echo $this->Form->input('coach', ['options' => $associado]);
            echo $this->Form->input('modalidade');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>

  $(function() {
	$( "#data" ).datepicker({changeMonth: true, changeYear: true, yearRange: '-80:+0'});
  });   
  
</script>
