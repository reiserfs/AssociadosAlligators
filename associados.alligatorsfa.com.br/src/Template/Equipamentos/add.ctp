<?php $this->extend('/Comum/associado'); ?>
<?= $this->Farbtastic->includeHead(); ?>

<div class="equipamentos form large-9 medium-8 columns content">
    <?= $this->Form->create($equipamento,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Equipamento') ?></legend>
        <?php
            echo $this->Form->select('tipo',$slots);
            echo $this->Form->input('marca');
            echo $this->Form->input('modelo');
            echo $this->Form->input('descricao',['type'=>'textarea']);
            echo $this->Farbtastic->input('equipamento.cor');
            echo $this->Form->input('foto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
	<script type="text/javascript" charset="utf-8">
 		$(document).ready(function() {
        	<?php  echo $this->Farbtastic->readyJS('equipamento.cor');   ?>
    		});
	</script>
</div>
