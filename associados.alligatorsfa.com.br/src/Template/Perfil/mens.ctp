<?php $this->extend('/Comum/perfil'); ?>
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
					</td>
					<td width="37%" class="view_associados">
						<center><?= $associado->has('time') ? $this->Html->link($associado->time->nome, ['controller' => 'Time', 'action' => 'view', $associado->time->id]) : '' ?></center>
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
		    $ano = date("Y");
		    $df = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Sao_Paulo',IntlDateFormatter::GREGORIAN, 'MMMM');
    		    $planos = $planoM->toArray();
		    $dataA = $data->toArray();
    		    foreach($dataA as $m){
			    if($ano == $m->vencimento->year) {
			    	$mes[$m->vencimento->month] = ['dados' => $m, 'plano' => $planos[$m['plano_id']]];
				if($planos[$m['plano_id']] > 1){
					for($p=1;$p<$planos[$m['plano_id']];$p++)
			    			$mes[$m->vencimento->month + $p] = ['dados' => $m, 'plano' => $planos[$eita['plano_id']]];
				}
			    }
		    }

		    for($m=1;$m<13;$m++){
			    if(isset($mes[$m])) {
				    $month = $mes[$m]['dados']['vencimento']->month;
				    $classe = ($mes[$m]['dados']['valor_pago']) ? 'view_mensalidades_pago' :'view_mensalidades_naopago';
				    $dados = __('Vencimento') .": ".$mes[$m]['dados']['vencimento'];
				    $child = ($month == $m) ? '' : '_child';
				    $titulo = "Valor: " . $this->Number->currency($mes[$m]['dados']['valor_base'],'BRL');
				   if(isset($mes[$m]['dados']['pago'])) $titulo .= "<br/>Pago em: " .$mes[$m]['dados']['pago']->i18nFormat('dd/MM/YYYY');
			    }
			    else {
				    $classe = 'view_mensalidades';
				    $dados = __('Mensalidade nao gerada');
				    $child = '';
				    $titulo = 'Nao existe mensalidade gerada para este mes';
			    }
			    echo "<td title='".$titulo."' class=".$classe.$child." ><br /><font size='1'>". $dados . "</font></td>"; 
		    }	
		?>
	</tr>
</table>

    <h4><?= __('Mensalidades') ?></h4>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('vencimento') ?></th>
                <th><?= $this->Paginator->sort('pago') ?></th>
                <th><?= $this->Paginator->sort('valor_base') ?></th>
                <th><?= $this->Paginator->sort('desconto') ?></th>
                <th><?= $this->Paginator->sort('acressimo') ?></th>
                <th><?= $this->Paginator->sort('valor_pago') ?></th>
                <th><?= $this->Paginator->sort('pagamento_id') ?></th>
                <th><?= $this->Paginator->sort('plano_id') ?></th>
                <th><?= $this->Paginator->sort('observacoes') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $mensalidade): ?>
            <tr bgcolor='99ff99'>
		<?php $classe = ($mensalidade->valor_pago) ? 'view_mensalidades_pago' :'view_mensalidades_naopago'?>
                <td><?= $this->Number->format($mensalidade->id) ?></td>
                <td class='<?=$classe?>'><?= h($mensalidade->vencimento->i18nFormat('dd/MM/YYYY')) ?></td>
                <td class='<?=$classe?>'><?php if(isset($mensalidade->pago)) echo h($mensalidade->pago->i18nFormat('dd/MM/YYYY')) ?></td>
                <td><?= $this->Number->currency($mensalidade->valor_base,'BRL') ?></td>
                <td><?= $this->Number->currency($mensalidade->desconto) ?></td>
                <td><?= $this->Number->currency($mensalidade->acressimo) ?></td>
		<td class='<?=$classe?>'><?= $this->Number->currency($mensalidade->valor_pago) ?></td>
                <td><?= $mensalidade->has('pagamento') ? $this->Html->link($mensalidade->pagamento->tipo, ['controller' => 'Pagamentos', 'action' => 'view', $mensalidade->pagamento->id]) : '' ?></td>
                <td><?= $mensalidade->has('plano') ? $this->Html->link($mensalidade->plano->nome_plano, ['controller' => 'Plano', 'action' => 'view', $mensalidade->plano->id]) : '' ?></td>
                <td><?= h($mensalidade->observacoes) ?></td>
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
<script>
$('td').tooltip({
	content: function() {
		return $(this).attr('title');
	}
});
</script>
</div>
