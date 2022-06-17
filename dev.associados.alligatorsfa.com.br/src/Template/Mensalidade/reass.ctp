<?php $this->extend('/Comum/mensalidade'); ?>
<div class="inventario index large-9 medium-8 columns content">
		<h3><?=__('Associados Inadimplentes') ?></h3>
    <?= $this->Form->create('',['type' => 'get']) ?>  
    <table align="right" cellpadding="0" cellspacing="0">
            <tr>
	    	  <td width="10%"><?= $this->Form->select('ativo', ['t'=>'Todos','a'=>'Ativos','i'=>'Inativos'],['default'=>(isset($ativo) ? $ativo : 't')]) ?></td>
                  <td width="80%"><?= $this->Form->input('filtro',['label'=>false,'value'=>((isset($filtro)) ? $filtro : '')]); ?></td>
                  <td><?= $this->Form->button(__('Filtrar'),['class'=>'filtrar']) ?>          </td>
           </tr>
    </table>
    <?= $this->Form->end() ?>
    <?php if(isset($gerado)): ?>
    <table cellpadding="0" cellspacing="0" id="relatorio" class="collaptable">
        <thead>
            <tr>
	    	<th width='35%'><?=__('Associado')?></th>
		<th width='25%'><?=__('Time / Plano')?></th>
		<th><?=__('Qtd')?></th>
		<th><?=__('Valor')?></th>
		<th><?=__('Valor Pago')?></th>
		<th><?=__('Saldo')?></th>
            </tr>
        </thead>
        <tbody>
	    <?php 
		foreach($gerado as $key) {
			echo "<tr id='trelatorio' bgcolor='99ff99'>

				<td>".$this->Html->link($key['nome'], ['controller' => 'Mensalidade', 'action' => 'view', $key['id']])." </td>
				<td>".$this->Html->image(($this->Number->format($key['ativo'])) ? 'on.png' : 'off.png') . " " .$key['timeplano']." </td>
				<td><font color='red'>".$key['mensalidade']['naopago']."</font> de ".$key['mensalidade']['mensalidade']." </td>
				<td>".$this->Number->currency($key['mensalidade']['valor'])." </td>
				<td>".$this->Number->currency($key['mensalidade']['pago'])." </td>
				<td>".$this->Number->currency($key['mensalidade']['pago'] - $key['mensalidade']['valor'])." </td>
				";
		}
	    ?>
        </tbody>
    </table>
<br> 
        <p>Total: <?= count($gerado) ?></p>
     <?php endif; ?>
</div>
