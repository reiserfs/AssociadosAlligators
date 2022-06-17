<?php $this->extend('/Comum/mensalidade'); ?>
<div class="associados view large-9 medium-8 columns content">
<table class="horizontal-table">
	<tr valign="top">
		<td width="10%" class="view_associados">
		 <center><?= $this->Html->image($this->Url->build([
								'controller' => 'Associados',
								'action'     => 'imgfoto',
								 $associado->id
							]),
						['width' => '100px', 'height' => '100px']
						) 
			?></center>
		</td>
		<td width="80%">
			<table class="horizontal-table">
				<tr valign="top">
					<td width="63%" class="view_associados">
   					<?php $sexoicon = ($associado->sexo=='F') ? $this->Html->image('f.png',['alt' => __('AlliGirl')]) : $this->Html->image('m.png',['alt' => __('AlliBoy')]); ?>
						<b><?= __('Associado') ?>:</b> <?= h($associado->nome) ?> <?= h($associado->sobrenome) ?> <?php echo $sexoicon?><?= h($associado->apelido) ?>

                    				<?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['controller'=>'Associados','action' => 'edit', $associado->id],['escape'=>false]) ?>
					</td>
					<td width="37%" class="view_associados">
						<center>
               					 <?= $this->Html->image(($this->Number->format($associado->ativo)) ? 'on.png' : 'off.png')  ?>
						<?= $associado->has('time') ? $this->Html->link($associado->time->nome, ['controller' => 'Time', 'action' => 'view', $associado->time->id]) : '' ?>
					-	<?= $associado->has('plano') ? $this->Html->link($associado->plano->nome_plano, ['controller' => 'Plano', 'action' => 'view', $associado->plano->id]) : '' ?>
</center>
					</td>
				</tr>
				<tr valign="top">
					<td width="63%" class="view_associados">
						<b><?= __('Email') ?>:</b> <a href="mailto:<?= $associado->email ?>"><?= h($associado->email) ?></a>
					</td>
					<td width="37%" class="view_associados">
						<center><?= h($associado->profissao) ?></center>
					</td>
				</tr>
				<tr valign="top">
					<td width="63%" class="view_associados">
						<b><?= __('Celular') ?>:</b> <?= h($associado->celular) ?>
					</td>
					<td width="37%" class="view_associados">
						<b> <?= __('Fixo') ?>:</b> <?= h($associado->fixo) ?>
					</td>
				</tr>
				<tr valign="top">
					<td width="63%" class="view_associados">
						<b><?= __('Nascimento') ?>:</b> <?= h($associado->nascimento->i18nFormat('dd/MM/YYYY')) ?>
					</td>
					<td width="37%" class="view_associados">
						<b><?= __('Data Acesso') ?>:</b> <?= h($associado->data_acesso->i18nFormat('dd/MM/YYYY')) ?>
					</td>
				</tr>
				<tr valign="top">
					<td width="63%" class="view_associados">
						<b><?= __('Sexo') ?>:</b> <?= h(($associado->sexo=='M') ? 'Masculino' : 'Feminino') ?>
					</td>
					<td width="37%" class="view_associados">
						<b><?= __('Numero') ?>:</b> #<?= h($associado->numero) ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="horizontal-table">
	<tr valign="middle">
		<td width="10%" class="view_mensalidades">
			<?php echo date("Y"); ?>	
		</td>
		<?php
		    $ano = date("y");
		    $df = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Sao_Paulo',IntlDateFormatter::GREGORIAN, 'MMMM');
    		    $planos = $planoM->toArray();
    		    foreach($data['data'] as $eita){
			    list($day, $month, $year) = explode("/",$eita['values'][1]);
			    if($ano == $year) {
			    	$mes[(int)$month] = ['dados' => $eita['values'], 'plano' => $planos[$eita['values'][8]]];
				if($planos[$eita['values'][8]] > 1){
					for($p=1;$p<$planos[$eita['values'][8]];$p++)
			    			$mes[(int)$month + $p] = ['dados' => $eita['values'], 'plano' => $planos[$eita['values'][8]]];
				}
			    }
		    }
		    for($m=1;$m<13;$m++){
			    if(isset($mes[$m])) {
			    	    list($day, $month, $year) = explode("/",$mes[$m]['dados'][1]);
				    $classe = ($mes[$m]['dados'][6]) ? 'view_mensalidades_pago' :'view_mensalidades_naopago';
				    $dados = __('Vencimento') .": ".$mes[$m]['dados'][1];
				    $child = ((int)$month == $m) ? '' : '_child';
			    }
			    else {
				    $classe = 'view_mensalidades';
				    $dados = __('Mensalidade nao gerada');
				    $child = '';
			    }
			    echo "<td class=".$classe.$child." ><b>".$df->format(mktime(0,0,0,$m,2,'2000')) . "</b><br /><font size='1'>". $dados . "</font></td>"; 
		    }		    
		?>
	</tr>
</table>

    <h4><?= __('Mensalidades') ?></h4>

<div id="wrap">
	<!-- Feedback message zone -->
	<div id="message"></div>
	    <div id="toolbar">
	<table>
            <tr>
                  <td width="80%"><?= $this->Form->input('filter',['label'=>false,'placeholder'=>'Filtrar mensalidades','id'=>'filter']); ?></td>
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
            echo $this->Form->input('delurl',['type' => 'hidden', 'value' => $this->Url->build(['controller' => 'mensalidade', 'action' => 'vdel',$associado->id .'.json'])]);
            echo $this->Form->input('editurl',['type' => 'hidden', 'value' => $this->Url->build(['controller' => 'mensalidade', 'action' => 'vedit',$associado->id .'.json'])]);
            echo $this->Form->input('associado_id',['type' => 'hidden', 'value' => $associado->id]);
            echo $this->Form->input('plano_id',['type' => 'hidden', 'value' => $associado->plano_id]);
            echo $this->Form->input('vencimento',['type' =>'text', 'label' => 'Vencimento']);
            echo $this->Form->input('valor_base',['value' => $associado->plano->valor_base]);
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

    var datagrid = new DatabaseGrid("<?=$this->Url->build(['controller' => 'mensalidade', 'action' => 'view',$associado->id .'.json'])?>");
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
