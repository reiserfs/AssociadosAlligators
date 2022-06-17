<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Mensalidades') ?></li>
        <li><?= $this->Html->link(__('Por Associados'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Todas Mensalidades'), ['action' => 'mens']) ?> </li>
        <li><?= $this->Html->link(__('Gerar Mensalidades'), ['action' => 'gera']) ?> </li>
        <li><?= $this->Html->link(__('Listar Mensalidades'), ['action' => 'lista']) ?> </li>
        <li><?= $this->Html->link(__('Adicionar Mensalidade'), ['action' => 'add']) ?> </li>
        <li class="heading"><?= __('Planos') ?></li>
        <li><?= $this->Html->link(__('Novo Plano'), ['controller' => 'plano', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Planos'), ['controller' => 'plano', 'action' => 'index']) ?> </li>
        <li class="heading"><?= __('Formas de Pagamento') ?></li>
        <li><?= $this->Html->link(__('Nova Forma de Pagamento'), ['controller' => 'pagamentos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Formas de Pagamento'), ['controller' => 'pagamentos', 'action' => 'index']) ?> </li>
        <li class="heading"><?= __('Relatorios') ?></li>
        <li><?= $this->Html->link(__('Por periodo'), ['action' => 'reper']) ?> </li>
        <li><?= $this->Html->link(__('Inadimplentes'), ['action' => 'reass']) ?> </li>
    </ul>
</nav>
<div class="associados view large-9 medium-8 columns content">
    <h4><?= __('Mensalidades') ?></h4>

<div id="wrap">
	<!-- Feedback message zone -->
	<div id="message"></div>
	    <div id="toolbar">
	<table>
            <tr>
                  <td width="80%"><?= $this->Form->input('filter',['label'=>false,'placeholder'=>'Filtar mensalidades','id'=>'filter']); ?></td>
                  <td><a id="showaddformbutton" class="button green"><i class="fa fa-plus"></i> Adicionar nova mensalidade </a> </td>
           </tr>
	</table>
	    </div>
	<!-- Grid contents -->
	<div id="tablecontent"></div>

	<!-- Paginator control -->
	<div id="paginator"></div>
</div>  
		
<div id="addform" class="mensalidade form large-9 medium-8 columns content">
    <?= $this->Form->create($mensalidade,['url' => ['action' => 'vadd.json']]) ?>
        <legend><?= __('Add Mensalidade') ?></legend>
        <?php
            echo $this->Form->input('delurl',['type' => 'hidden', 'value' => $this->Url->build(['controller' => 'mensalidade', 'action' => 'vdel','0.json'])]);
            echo $this->Form->input('editurl',['type' => 'hidden', 'value' => $this->Url->build(['controller' => 'mensalidade', 'action' => 'vedit','0.json'])]);
            echo $this->Form->input('associado_id',['options' => $associadosL]);
            echo $this->Form->input('plano_id',['options' => $planoL]);
            echo $this->Form->input('vencimento',['type' =>'text', 'label' => 'Vencimento']);
            echo $this->Form->input('valor_base',['value' => '0.00']);
            echo $this->Form->input('desconto',['value' => '0.00']);
            echo $this->Form->input('acressimo',['value' => '0.00']);
            echo $this->Form->input('valor_pago',['value' => '0.00']);
            echo $this->Form->input('observacoes');
        ?>
            <div class="row tright">
              <a id="addbutton" class="button green" ><i class="fa fa-save"></i> Adicionar </a>
              <a id="cancelbutton" class="button delete">Fechar</a>
            </div>
    <?= $this->Form->end() ?>
</div>

    <?= $this->Html->script('mensalidade_controle.js') ?>
<script>

    var datagrid = new DatabaseGrid("<?=$this->Url->build(['controller' => 'mensalidade', 'action' => 'mens','.json'])?>");
	window.onload = function() { 
		// key typed in the filter field
		$("#filter").keyup(function() {
		    datagrid.editableGrid.filter( $(this).val());

		    // To filter on some columns, you can set an array of column index 
		    //datagrid.editableGrid.filter( $(this).val(), [0,3,5]);
		  });

		$("#showaddformbutton").click( function()  {
		  showAddForm();
		});
		$("#cancelbutton").click( function() {
		  showAddForm();
		});

		$("#addbutton").click(function() {
		  datagrid.addRow();
		});
	}; 

	$(function() {
		$( "#vencimento" ).datepicker();
	});    

</script>
</div>
