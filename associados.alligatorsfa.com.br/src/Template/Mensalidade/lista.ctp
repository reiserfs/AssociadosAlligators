<?php $this->extend('/Comum/mensalidade'); ?>
<div class="associados index large-9 medium-8 columns content">
    <h3><?= __('Mensalidades') ?></h3>
    <?= $this->Form->create($associados,['type' => 'get']) ?>  
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
                <th width='20%'><?= $this->Paginator->sort('associado') ?></th>
                <th class="actions"><?= __('Jan') ?></th>
                <th class="actions"><?= __('Fev') ?></th>
                <th class="actions"><?= __('Mar') ?></th>
                <th class="actions"><?= __('Abr') ?></th>
                <th class="actions"><?= __('Mai') ?></th>
                <th class="actions"><?= __('Jun') ?></th>
                <th class="actions"><?= __('Jul') ?></th>
                <th class="actions"><?= __('Ago') ?></th>
                <th class="actions"><?= __('Set') ?></th>
                <th class="actions"><?= __('Out') ?></th>
                <th class="actions"><?= __('Nov') ?></th>
                <th class="actions"><?= __('Dez') ?></th>
            </tr>
        </thead>
	<tbody>
		<?php
		    $ano = (int)date("Y");
		    $planos = $planoM->toArray();
		?>
            <?php foreach ($associados as $associado): ?>
            <tr bgcolor='99ff99'>
		<td><font size=2><?= $this->Html->link($associado->nome ." ". $associado->sobrenome . " - ".$associado->apelido,['action' => 'view', $associado->id]); ?></font></td>
		<?php
		    	$mes = Array();
			if($associado->has('mensalidade')) {
				foreach($associado->mensalidade as $m)  {
					if($m->vencimento->year == $ano) {
						$mes[$m->vencimento->month] = ['dados' => $m, 'plano' => $planos[$m['plano_id']]];
						if($planos[$m['plano_id']] > 1){
							for($p=1;$p<$planos[$m['plano_id']];$p++)
								$mes[$m->vencimento->month + $p] = ['dados' => $m, 'plano' => $planos[$m['plano_id']]];
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
			}
		?>
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
</div>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <?= $this->Html->script('jquery-ui.min.js') ?>
<script type="text/javascript">
$('td').tooltip({
	content: function() {
		return $(this).attr('title');
	}
});
</script>
