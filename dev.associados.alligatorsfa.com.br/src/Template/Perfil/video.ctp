<?php $this->extend('/Comum/perfil'); ?>
<?php if(!isset($data)) : ?>
<div class="video index large-9 medium-8 columns content">
    <h3><?= __('Video') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th width='20%'><?= $this->Paginator->sort('time_casa') ?></th>
		<th width='3%'> </th>
                <th width='20%' ><?= $this->Paginator->sort('time_visitante') ?></th>
                <th><?= $this->Paginator->sort('cidade') ?></th>
                <th><?= $this->Paginator->sort('estado') ?></th>
                <th><?= $this->Paginator->sort('data') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($video as $video): ?>
            <tr bgcolor='99ff99'>
                <td><?= $this->Number->format($video->id) ?></td>
		<td><?= $video->outrotime_casa->nome ?> (<?= $this->Number->format($video->placar_casa) ?>)  </td>
		<td> X </td>
		<td> (<?= $this->Number->format($video->placar_visitante) ?>) <?= $video->outrotime_visitante->nome ?></td>
                <td><?= h($video->cidade) ?></td>
                <td><?= h($video->estado) ?></td>
                <td><?= h($video->data->i18nFormat('dd/MM/YYYY')) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('videosnap.png',['alt' =>__('Detalhes')]), ['action' => 'video', $video->id],['escape'=>false]) ?>
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
<?php else: ?>
<div class="video view large-9 medium-8 columns content">
           <p style="text-align:center;font-weight: bold;"> 
		<?= $this->Html->image($this->Url->build(['controller' => 'Outrotime', 'action' => 'imgfoto', $video->time_casa ]), ['width' => '100px', 'height' => '100px']) ?> 
                <?= h($video->outrotime_casa->nome) ?> (<?= $this->Number->format($video->placar_casa) ?>) vs
		(<?= $this->Number->format($video->placar_visitante)?>) <?= h($video->outrotime_visitante->nome) ?>
		<?= $this->Html->image($this->Url->build(['controller' => 'Outrotime', 'action' => 'imgfoto', $video->time_visitante]), ['width' => '100px', 'height' => '100px']) ?> 
	    </p>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div id="wrap">
	<!-- Feedback message zone -->
	<div id="message"></div>
	    <div id="toolbar">
	<table>
	    <tr>
		<td colspan="6" style="text-align:center"> 
			<iframe width="576" height="324" src="//www.youtube.com/embed/<?=$video->youtube ?>?enablejsapi=1&controls=1&fs=0&modestbranding=1&rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen id="video"></iframe>
	        </td>
	    </tr>
            <tr>
                  <td><?= $this->Form->input('Inicio',['label'=>false,'id'=>'filteri','placeholder'=>'Filtro Inicio']); ?></td>
                  <td><?= $this->Form->input('Fim',['label'=>false,'id'=>'filterf','placeholder'=>'Filtro Fim']); ?></td>
                  <td><?= $this->Form->input('Casa',['label'=>false,'id'=>'filterc','empty'=>'Filtro Casa','options'=>$times]); ?></td>
                  <td><?= $this->Form->input('Visitante',['label'=>false,'id'=>'filterv','empty'=>'Filtro Visitante','options'=>$times]); ?></td>
                  <td><?= $this->Form->input('Resultados',['label'=>false,'id'=>'filterr','empty'=>'Filtro Resultados','options'=>$resultados]); ?></td>
                  <td><?= $this->Form->input('Descricao',['label'=>false,'id'=>'filterd','placeholder'=>'Descricao']); ?></td>
           </tr>
	</table>
	    </div>
	<!-- Grid contents -->
	<div id="tablecontent"></div>

	<!-- Paginator control -->
	<div id="paginator"></div>
</div>  
    <?= $this->Form->end() ?>
		
    <?= $this->Html->script('video_controle.js') ?>
<script>
    var datagrid = new DatabaseGrid("<?=$this->Url->build(['controller' => 'perfil', 'action' => 'video',$video->id .'.json'])?>");
	window.onload = function() { 
		$("#filterr").change(function() { datagrid.editableGrid.filter( $(this).val(),[5]); });
		$("#filterc").change(function() { datagrid.editableGrid.filter( $(this).val(),[3]); });
		$("#filterv").change(function() { datagrid.editableGrid.filter( $(this).val(),[4]); });
		$("#filteri").change(function() { datagrid.editableGrid.filter( $(this).val(),[1]); });
		$("#filterf").change(function() { datagrid.editableGrid.filter( $(this).val(),[2]); });
		$("#filterd").change(function() { datagrid.editableGrid.filter( $(this).val(),[6]); });

		$("#addbutton").click(function() {
		  datagrid.addRow();
		});
	}; 
</script>
</div>
<?php endif; ?>
