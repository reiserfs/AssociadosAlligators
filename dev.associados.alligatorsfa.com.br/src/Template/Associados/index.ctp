<?php $this->extend('/Comum/associado'); ?>
<div class="associados index large-9 medium-8 columns content">
    <h3><?= __('Associados') ?></h3>
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

<div id="dialog" title="Ativar Desativar">
    <?= $this->Form->create($associados,['type' => 'get','url'=>['action'=>'ativa']]) ?>  
		  <?= $this->Form->input('id',['type'=>'hidden']); ?> <br />
		Alterar Plano:  <?= $this->Form->checkbox('plano',['value'=>'1','checked','hiddenField' => false]); ?> <br />
		Alterar Time:  <?= $this->Form->checkbox('time',['value'=>'1','hiddenField' => false]); ?> <br />
		Alterar Login:  <?= $this->Form->checkbox('login',['checked','hiddenField' => false]); ?> <br />
		<?php
		echo	$this->Form->input('limite',['type'=>'hidden','value'=>$limite]);
		echo	$this->Form->input('ativo',['type'=>'hidden','value'=>$ativo]);
		echo	$this->Form->input('plano',['type'=>'hidden','value'=>$plano]);
		echo	$this->Form->input('time',['type'=>'hidden','value'=>$time]);
		echo	$this->Form->input('filtro',['type'=>'hidden','value'=>$filtro]);
		?>
                <?= $this->Form->button(__('Confirmar'),['class'=>'filtrar']) ?>  
    </table>
    <?= $this->Form->end() ?>
</div>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th><?= $this->Paginator->sort('sobrenome') ?></th>
                <th width='25%'><?= $this->Paginator->sort('email') ?></th>
                <th width='5%'><?= __('Ativo') ?></th>
                <th><?= $this->Paginator->sort('apelido') ?></th>
                <th><?= $this->Paginator->sort('Time.nome',__('Time')) ?></th>
                <th width='10%' class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($associados as $associado): ?>
            <?php $sexoicon = ($associado->sexo=='F') ? $this->Html->image('f.png',['alt' => __('AlliGirl')]) : $this->Html->image('m.png',['alt' => __('AlliBoy')]); ?>
	    <?php list($ativoicon,$ativotexto) = ($associado->ativo) ? 
		    array($this->Html->image('on.png',['alt' => __('Ativo')]),'Desativar') 
		    : 
		    array($this->Html->image('off.png',['alt' => __('Desativado')]),'Ativar'); 
	     ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($associado->id) ?></td>
                <td><?= h($associado->nome) ?></td>
                <td><?= h($associado->sobrenome) ?></td>
		<td>
		   <?= $associado->has('login') ? $this->Html->image('loginlock.png',['alt' => __('Login')]) : '' ?>
		   <?= $associado->has('login') ? $this->Html->link($associado->login->user, ['controller' => 'Login', 'action' => 'view', $associado->login->id]) : h($associado->email) ?>
		</td>
                <td><?= $ativoicon  ?></td>
		<td><?= $sexoicon ?><?= h($associado->apelido) ?></td>
                <td><?= $associado->has('time') ? $this->Html->link($associado->time->nome, ['controller' => 'Time', 'action' => 'view', $associado->time->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('view.png',['alt' => __('View')]), ['action' => 'view', $associado->id],['escape'=>false]) ?>
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $associado->id],['escape'=>false]) ?>
                    <?= $this->Html->tag('a',$this->Html->image('desativa.png',['alt' =>__('Edit')]), ['escape'=>false,'label'=>$ativotexto . ' ' . $associado->nome,'class'=>'ativar','id'=>$associado->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
        <p><?= $this->Paginator->counter('Total: {{count}}') ?></p>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

<script>
$(document).ready(function() {
	    $("#dialog").dialog({ autoOpen: false});
	    $('.ativar').click(
		    function () { 
			    $("#id").val($(this).attr('id')); 
			    $("#dialog").dialog("option","title",$(this).attr('label')); 
			    $("#dialog").dialog("open"); 
		    }
	    );
});
</script>
