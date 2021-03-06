<?php $this->extend('/Comum/perfil'); ?>
<?= $this->Farbtastic->includeHead(); ?>
<div class="inventario index large-9 medium-8 columns content">
    <h3><?= __('Meus Equipamentos') ?></h3>
    <?= $this->Form->create($inventario,['type' => 'get']) ?>  
    <table align="right" cellpadding="0" cellspacing="0">
            <tr>
                  <td width="90%"><?= $this->Form->input('filtro',['label'=>false,'value'=>((isset($filtro)) ? $filtro : '')]); ?></td>
                  <td><?= $this->Form->button(__('Filtrar'),['class'=>'filtrar']) ?>          </td>
           </tr>
    </table>
    <?= $this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th width='10%'><?= $this->Paginator->sort('Equipamento.tipo',__('Tipo')) ?></th>
                <th width='50%'><?= $this->Paginator->sort('equipamento_id') ?></th>
                <th><?= $this->Paginator->sort('tamanho') ?></th>
                <th width='10%'><?= $this->Paginator->sort('sobrecor') ?></th>
                <th width='6%' class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventario as $inventario): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($inventario->id) ?></td>
                <td><?= h($inventario->equipamento->tipo) ?></td>
		<td><?= $inventario->has('equipamento') ? $this->Html->link(
					$inventario->equipamento->marca .' '.$inventario->equipamento->modelo, 
					['controller' => 'Equipamentos', 'action' => 'view', $inventario->equipamento->id]) : '' 
		?></td>
                <td><?= h($inventario->tamanho) ?></td>
                <td bgcolor='<?= h($inventario->sobrecor) ?>'> &nbsp;</td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'vequip', $inventario->equipamento->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'equipdelete', $inventario->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $inventario->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
    <?= $this->Form->create($inventarioAdd) ?>
    <fieldset>
        <legend><?= __('Add Inventario') ?></legend>
        <?php
	    echo '<input id="search_input" placeholder="Filtrar">';
            echo $this->Form->input('equipamento_id', ['options' => $equipamentos, 'size'=>200, 'style'=>'height:125px;']);
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

	// FILTRO
	  $(document).ready(function () {
	    //copy options
	    var options = $('#equipamento-id option').clone();
	    //react on keyup in textbox
	    $('#search_input').keyup(function () {
	      var val = $(this).val();
	      $('#equipamento-id').empty();
	      //take only the options containing your filter text or all if empty
	      options.filter(function (idx, el) {
		return val === '' || $(el).text().indexOf(val) >= 0;
	      }).appendTo('#equipamento-id');//add it to list
	     });
	  });
	</script>
</div>
