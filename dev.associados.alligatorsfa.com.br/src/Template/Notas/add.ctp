<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Notas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Login'), ['controller' => 'Login', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Login'), ['controller' => 'Login', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notas form large-9 medium-8 columns content">
    <?= $this->Form->create($nota) ?>
    <fieldset>
        <legend><?= __('Add Nota') ?></legend>
        <?php
            echo $this->Form->input('associado_id', ['options' => $associados]);
            echo $this->Form->input('data',['type'=>'text','label'=>'Data']);
            echo $this->Form->input('login_id', ['type'=>'hidden','value' => $userDetails['id']]);
            echo $this->Form->input('tipo',['options'=>$tiponota]);
            echo $this->Form->input('nota');
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
