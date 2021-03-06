<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Video'), ['action' => 'edit', $video->id]) ?> </li>
        <li><?= $this->Html->link(__('List Video'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Video'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Outrotime'), ['controller' => 'Outrotime', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Outrotime'), ['controller' => 'Outrotime', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Videosnap'), ['controller' => 'Videosnap', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Videosnap'), ['controller' => 'Videosnap', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="video view large-9 medium-8 columns content">
           <p style="text-align:center;font-weight: bold;"> 
		<?= $this->Html->image($this->Url->build(['controller' => 'Outrotime', 'action' => 'imgfoto', $video->time_casa ]), ['width' => '100px', 'height' => '100px']) ?> 
                <?= h($video->outrotime_casa->nome) ?> (<?= $this->Number->format($video->placar_casa) ?>) vs
		(<?= $this->Number->format($video->placar_visitante)?>) <?= h($video->outrotime_visitante->nome) ?>
		<?= $this->Html->image($this->Url->build(['controller' => 'Outrotime', 'action' => 'imgfoto', $video->time_visitante]), ['width' => '100px', 'height' => '100px']) ?> 
	    </p>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?= $this->Form->create($videosnap,['url' => ['action' => 'vadd.json']]) ?>
        <?php
            echo $this->Form->input('delurl',['type' => 'hidden', 'value' => $this->Url->build(['controller' => 'video', 'action' => 'vdel',$video->id .'.json'])]);
            echo $this->Form->input('editurl',['type' => 'hidden', 'value' => $this->Url->build(['controller' => 'video', 'action' => 'vedit',$video->id .'.json'])]);
            echo $this->Form->input('video_id',['type' => 'hidden', 'value' => $video->id]);
        ?>
<div id="wrap">
	<!-- Feedback message zone -->
	<div id="message"></div>
	    <div id="toolbar">
	<table>

            <tr>
                  <td width="10%"><?= $this->Form->input('inicio',['id'=>'inicio','value'=>'00:00','disabled']); ?></td>
                  <td width="10%"><?= $this->Form->input('fim',['id'=>'fim','value'=>'00:00','disabled']); ?></td>
                  <td><?= $this->Form->input('casa',['id'=>'casa','label'=>h($video->outrotime_casa->nome),'options'=>$times]); ?></td>
                  <td><?= $this->Form->input('visitante',['id'=>'visitante','label'=>h($video->outrotime_visitante->nome),'options'=>$times]); ?></td>
                  <td><?= $this->Form->input('resultado',['id'=>'resultado','options'=>$resultados]); ?></td>
                  <td width="25%"><?= $this->Form->input('descricao',['id'=>'descricao']); ?></td>
           </tr>
		<tr>
			<td colspan="6"  style="text-align:center">  
                                <?= $this->Html->tag('a',$this->Html->image('playpause.png'),['id' => 'play-button','escape'=>false]) ?>
                                <?= $this->Html->tag('a',$this->Html->image('inicio.png'),['id' => 'inicio-button','escape'=>false]) ?>
                                <?= $this->Html->tag('a',$this->Html->image('fim.png'),['id' => 'fim-button','escape'=>false]) ?>
                                <?= $this->Html->tag('a',$this->Html->image('add.png'),['id' => 'addbutton','escape'=>false]) ?>
			</td>
		</tr>
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
    var datagrid = new DatabaseGrid("<?=$this->Url->build(['controller' => 'video', 'action' => 'snap',$video->id .'.json'])?>");
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
