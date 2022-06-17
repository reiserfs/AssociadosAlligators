<?php $this->extend('/Comum/associado'); ?>
<?= $this->Farbtastic->includeHead(); ?>
<div class="inventario form large-9 medium-8 columns content">
    <?= $this->Form->create($inventario) ?>
    <fieldset>
        <legend><?= __('Add Inventario') ?></legend>
        <?php
            echo $this->Form->input('equipamento_id', ['options' => $equipamentos]);
            echo $this->Form->input('associado_id', ['options' => $associados]);
            echo $this->Form->input('tamanho');
	    echo "<input type='checkbox' name='desliga' id='desliga' onclick='ligacor()'>". __('Usar cor padrao');
            echo $this->Farbtastic->input('inventario.sobrecor');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
	<script type="text/javascript" charset="utf-8">
		function ligacor() {
			if(document.getElementById('desliga').checked){
    				document.getElementById("inventarioSobrecor").disabled = true;
    				document.getElementById("inventarioSobrecor").value = '';
			}
			else {
    				document.getElementById("inventarioSobrecor").disabled = false;
    				document.getElementById("inventarioSobrecor").value = '#000000';
			}
		}
 		$(document).ready(function() {
        	<?php  echo $this->Farbtastic->readyJS('inventario.sobrecor');   ?>
    		});
	</script>
</div>
