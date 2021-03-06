<?php $this->extend('/Comum/mensalidade'); ?>
<div class="associados index large-9 medium-8 columns content">
    <h3><?= __('Mensalidades') ?></h3>
    <?= $this->Form->create($associados,['type' => 'get']) ?>  
    <table align="right" cellpadding="0" cellspacing="0">
            <tr>
                  <td width="10%"><?= $this->Form->input('limite',['label'=>false,'value'=>((isset($limite)) ? $limite : '25')]); ?></td>
	    	  <td width="10%"><?= $this->Form->select('ativo', ['t'=>'Todos','a'=>'Ativos','i'=>'Inativos'],['default'=>(isset($ativo) ? $ativo : 't')]) ?></td>
                  <td width="15%"><?= $this->Form->input('plano',['label'=>false,'empty'=>'Plano','options'=> $planos,'default'=>$plano])?></td>
                  <td width="20%"><?= $this->Form->input('time',['label'=>false,'empty'=>'Time','options'=> $times,'default'=>$time])?></td>
                  <td width="35%"><?= $this->Form->input('filtro',['label'=>false,'placeholder'=>'Filtro','value'=>((isset($filtro)) ? $filtro : '')]); ?></td>
                  <td><?= $this->Form->button(__('Filtrar'),['class'=>'filtrar']) ?>          </td>
           </tr>
    </table>
    <?= $this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='40%'><?= $this->Paginator->sort('associado') ?></th>
                <th width='20%'><?= $this->Paginator->sort('Time.nome',__('Time')) ?></th>
                <th><?= $this->Paginator->sort('plano') ?></th>
                <th width='5%' ><?= __('Ativo') ?></th>
                <th><?= $this->Paginator->sort('mensalidades') ?></th>
                <th width='5%' class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($associados as $associado): ?>
            <?php $sexoicon = ($associado->sexo=='F') ? $this->Html->image('f.png',['alt' => __('AlliGirl')]) : $this->Html->image('m.png',['alt' => __('AlliBoy')]); ?>
            <tr bgcolor='99ff99'>
		<td><?= $this->Html->link($associado->nome . ' ' . 
					  $associado->sobrenome . ' ' .
					  $sexoicon . ' ' . 
				          $associado->apelido, ['controller' => 'Associados','action' => 'view', $associado->id],['escape'=>false]) ?></td>
                <td><?= $associado->has('time') ? $this->Html->link($associado->time->nome, ['controller' => 'Time', 'action' => 'view', $associado->time->id]) : '' ?></td>
                <td><?= h($associado->plano->nome_plano) ?></td>
                <td><?= $this->Html->image(($this->Number->format($associado->ativo)) ? 'on.png' : 'off.png')  ?></td>
		<?php
			if($associado->has('mensalidade')) {
				$total_pago = 0;
				$total_naopago = 0;
				$total_mensalidade = count($associado->mensalidade);
				foreach($associado->mensalidade as $m)  ($m['valor_pago']) ? $total_pago++ : $total_naopago++;
			}
			else { 
				$total_pago = 0; $total_naopago = 0; $total_mensalidade = 0;
			}
		?>
                <td>(<b><?= $total_mensalidade . ' / <font color="green">' . $total_pago . '</font> / <font color="red">'. $total_naopago ?></font>)</b></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('money.png',['alt' => __('View')]), ['action' => 'view', $associado->id],['escape'=>false]) ?>
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
</div>
