<?php $this->extend('/Comum/mensalidade'); ?>
<div class="inventario index large-9 medium-8 columns content">
    <?php if(isset($gerado)): ?>
<?php 
	$blacklist = '';
	$whitelist = '';
	$mY = 0;
	$df = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Sao_Paulo',IntlDateFormatter::GREGORIAN, 'MMMM');
	foreach ($associados as $associado) {
             	$sexoicon = ($associado->sexo=='F') ? $this->Html->image('f.png',['alt' => __('AlliGirl')]) : $this->Html->image('m.png',['alt' => __('AlliBoy')]); 
		if(isset($gerado['blacklist'][$associado->id])) {
			$blacklist.= " <tr bgcolor='99ff99'>";
			$blacklist.= " <td>". h($associado->nome) ." ". h($associado->sobrenome) ." ". $sexoicon . " " .h($associado->apelido) ."</td>";
			$blacklist.= " <td>". date('d/m/Y',strtotime($gerado['blacklist'][$associado->id]['vencimento'])) ."</td>";
			$blacklist.= " <td>". $this->Number->currency($gerado['blacklist'][$associado->id]['valor_base'],'BRL') ."</td>";
			$blacklist.= " <td>". h($associado->plano->nome_plano) ."</td>";
		}
		if(isset($gerado['whitelist'][$associado->id])) {
			list($year, $month, $day) = explode("-",$gerado['whitelist'][$associado->id]['vencimento']);
			$whitelist .= " <tr bgcolor='99ff99'>";
			$whitelist .= " <td>". h($associado->nome) ." ". h($associado->sobrenome) ." ". $sexoicon . " " .h($associado->apelido) ."</td>";
			$whitelist .= " <td>". date('d/m/Y',strtotime($gerado['whitelist'][$associado->id]['vencimento'])) ."</td>";
			$whitelist .= " <td>". $this->Number->currency($gerado['whitelist'][$associado->id]['valor_base'],'BRL') ."</td>";
			$whitelist .= " <td>". h($associado->plano->nome_plano) ."</td>";
			$whitelist .= $this->Form->input('Mensalidade.'.$mY.'.associado_id',['type'=>'hidden','value'=>$associado->id]);
			$whitelist .= $this->Form->input('Mensalidade.'.$mY.'.vencimento.year',['type'=>'hidden','value'=>$year]);
			$whitelist .= $this->Form->input('Mensalidade.'.$mY.'.vencimento.month',['type'=>'hidden','value'=>$month]);
			$whitelist .= $this->Form->input('Mensalidade.'.$mY.'.vencimento.day',['type'=>'hidden','value'=>$day]);
			$whitelist .= $this->Form->input('Mensalidade.'.$mY.'.valor_base',['type'=>'hidden','value'=>$gerado['whitelist'][$associado->id]['valor_base']]);
			$whitelist .= $this->Form->input('Mensalidade.'.$mY.'.plano_id',['type'=>'hidden','value'=>$associado->plano_id]);
		}
		$mY++;
	}	
     ?>
    <table cellpadding="0" cellspacing="0">
		<h3><?=__('Associados que ja possuem mensalidade do mes de: ') . $df->format(mktime(0,0,0,date('m',strtotime($gerado['vencimento'])),2,'2000')) ?></h3>
        <thead>
            <tr>
	    	<th width="40%"><?=__('Associado')?></th>
		<th><?=__('Vencimento')?></th>
		<th><?=__('Valor')?></th>
		<th><?=__('Plano')?></th>
            </tr>
        </thead>
        <tbody>
            <?php echo $blacklist; ?>
        </tbody>
    </table>
    <table cellpadding="0" cellspacing="0">
		<h3><?=__('Associados que terao mensalidade gerada para o mes de: ') . $df->format(mktime(0,0,0,date('m',strtotime($gerado['vencimento'])),2,'2000')) ?></h3>
    <?= $this->Form->create($mensalidade) ?>
        <thead>
            <tr>
	    	<th width="40%"><?=__('Associado')?></th>
		<th><?=__('Vencimento')?></th>
		<th><?=__('Valor')?></th>
		<th><?=__('Plano')?></th>
            </tr>
        </thead>
        <tbody>
            <?php echo $whitelist; ?>
        </tbody>
    </table>
<?= $this->Form->button(__('Submit')) ?> 
    <?= $this->Form->end() ?>
     <?php else: ?>
    <?= $this->Form->create($time) ?>
    <fieldset>
        <legend><?= __('Gerar Mensalidade') ?></legend>
        <?php
            echo $this->Form->input('vencimento',['type' =>'text', 'label' => 'Vencimento']);
            echo $this->Form->input('time_id', ['options' => $timeL,'multiple'=>true, 'size'=>200, 'style'=>'height:125px;']);
        ?>
    </fieldset>
    <table align="right" cellpadding="0" cellspacing="0">
            <tr>
                  <td width="90%"><?= $this->Form->button(__('Selecionar Todos'),['id'=>'select_all','type'=>'button']) ?> </td>
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
		$( "#vencimento" ).datepicker();
	});   
	</script>
