<?php $this->extend('/Comum/mensalidade'); ?>
<div class="inventario index large-9 medium-8 columns content">
    <?php if(isset($gerado)): ?>
    <table cellpadding="0" cellspacing="0" id="relatorio" class="collaptable">
		<h3><?=__('Relatorio de mensalidades por periodo ') ?></h3>
		<h4><?=__('De: ') . date("d/m/Y", strtotime($gerado['inicio'])) . __(' Ate:') . date("d/m/Y", strtotime($gerado['fim']))  ?></h4>
        <thead>
            <tr>
	    	<th width='5%'>#</th>
	    	<th width='25%'><?=__('Time')?></th>
		<th><?=__('Mensalidades')?></th>
		<th><?=__('Nao Pagas')?></th>
		<th><?=__('Valor')?></th>
		<th><?=__('Valor Pago')?></th>
		<th><?=__('Saldo')?></th>
            </tr>
        </thead>
        <tbody>
	    <?php 
		$tabela = '';
		$times_nomes = $timeL->toArray();
		$aa = 300;
		$mm = 100;
		if(isset($gerado['dados'])){
			foreach($gerado['dados'] as $key => $value) {
				$mtabela = '';
				$total_time = ['mensalidades' => 0, 'naopago' => 0, 'valor' => 0, 'pago' => 0]; 
				foreach($value as $mkey => $mvalue) {
					$atabela = '';
					foreach($mvalue['associado'] as $akey => $avalue) {
							$atabela .= "<tr id='trelatorio' bgcolor='ffffaa' data-id='".($aa++)."' data-parent='".($mm)."'>
							<td> </td>
							<td>".$avalue['associado']['0'] . ' ('. $avalue['associado']['2'] . ') ' . $avalue['associado']['1'] ."</td>
							<td> </td>
							<td> </td>
							<td>". $this->Number->currency($avalue['valor_base'],'BRL') ."</td>
							<td>". $this->Number->currency($avalue['valor_pago'],'BRL') ."</td>
							<td>". $this->Number->currency($avalue['valor_pago'] - $avalue['valor_base'],'BRL')."</td>
						    </tr>";
					}
						$mtabela .= "<tr id='trelatorio' style='background:#ccffaa'; data-id='".($mm++). "' data-parent='$key'>
						<td></td>
						<td>".strftime('%B', mktime(0, 0, 0, $mkey, 10))." </td>
						<td>".$mvalue['mensalidades'] ."</td>
						<td>".$mvalue['naopago'] ."</td>
						<td>".$this->Number->currency($mvalue['valor'],'BRL') ."</td>
						<td>".$this->Number->currency($mvalue['pago'],'BRL') ."</td>
						<td>".$this->Number->currency($mvalue['pago'] - $mvalue['valor'],'BRL') ." </td>
					    </tr>";
					$total_time['mensalidades'] += $mvalue['mensalidades'];
					$total_time['naopago'] += $mvalue['naopago'];
					$total_time['valor'] += $mvalue['valor'];
					$total_time['pago'] += $mvalue['pago'];
					$mtabela .= $atabela;
				}
					$tabela .= "<tr id='trelatorio' style='background:#68d86f;' data-id='$key' data-parent=''>
						<td></td>
						<td>$times_nomes[$key] </td>
						<td>".$total_time['mensalidades']." </td>
						<td>".$total_time['naopago']." </td>
						<td>".$this->Number->currency($total_time['valor'],'BRL')." </td>
						<td>".$this->Number->currency($total_time['pago'],'BRL')." </td>
						<td>".$this->Number->currency($total_time['pago'] - $total_time['valor'],'BRL') ." </td>
					    </tr>";
				$tabela .= $mtabela;
			}
		}
		echo $tabela;

	    ?>
        </tbody>
    </table>
     <?php else: ?>
    <?= $this->Form->create($time) ?>
    <fieldset>
        <legend><?= __('Relatorio por periodo') ?></legend>
        <?php
            echo $this->Form->input('inicio',['type' =>'text', 'label' => 'Inicio']);
            echo $this->Form->input('fim',['type' =>'text', 'label' => 'Fim']);
            echo $this->Form->input('time_id', ['options' => $timeL,'multiple'=>true, 'size'=>200, 'style'=>'height:125px;']);
        ?>
    </fieldset>
    <table align="right" cellpadding="0" cellspacing="0">
            <tr>
                  <td width="60%"><?= $this->Form->button(__('Selecionar Todos'),['id'=>'select_all','type'=>'button']) ?> </td>
                  <td><?= $this->Form->button(__('Submit')) ?>  </td>
           </tr>
    </table>
    <?= $this->Form->end() ?>
     <?php endif; ?>
</div>
	<script>
	$('#select_all').click(function() {
		$('#time-id option').prop('selected', true);
	});
	$(function() {
		$( "#inicio,#fim" ).datepicker();
	});   

	$('.collaptable').aCollapTable({ 
	startCollapsed: true,
	addColumn: false, 
	plusButton: '<span class="i"><?php echo $this->Html->image('plus.png',['alt' => __('Expandir')]) ?></span>', 
	minusButton: '<span class="i"><?php echo $this->Html->image('minus.png',['alt' => __('Esconder')]) ?></span>', 
	});

	$('#trelatorio td').each(function(){
		  var text = $(this).text();
		  var num = Number(text.replace(/[R$,]+/g,""));
		    	if(num < 0)$(this).css('color','red');
		    	//if(num == 0)$(this).css('color','green');
	});

	</script>
