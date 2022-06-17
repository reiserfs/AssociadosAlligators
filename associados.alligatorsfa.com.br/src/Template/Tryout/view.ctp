<?php $this->extend('/Comum/associado'); ?>
<div class="associados view large-9 medium-8 columns content">
    <h3><?= h($tryout->id) ?></h3>

<table class="horizontal-table">
	<tr valign="top">
		<td width="20%" class="view_associados">
		 <center><?= $this->Html->image($this->Url->build([
								'controller' => 'Associados',
								'action'     => 'imgfoto',
								 $tryout->id
							]),
						['width' => '160px', 'height' => '160px']
						) 
			?></center>
		</td>
		<td width="80%">
			<table class="horizontal-table">
				<tr valign="top">
					<td width="53%" class="view_associados">
						<b><?= __('Nome') ?>:</b> <?= h($tryout->nome) ?> <?= h($tryout->sobrenome) ?>
					</td>
					<td width="47%" class="view_associados">
						<center><?= $tryout->has('time') ? $this->Html->link($tryout->time->nome, ['controller' => 'Time', 'action' => 'view', $tryout->time->id]) : '' ?></center>
					</td>
				</tr>
				<tr valign="top">
					<td  class="view_associados">
						<b><?= __('Email') ?>:</b> <a href="mailto:<?= $tryout->email ?>"><?= h($tryout->email) ?></a>
					</td>
					<td  class="view_associados">
					<center><?= h($tryout->profissao) ?> / <?= h($tryout->empresa) ?> </center>
					</td>
				</tr>
				<tr valign="top">
					<td class="view_associados">
						<b><?= __('Apelido') ?>:</b> <?= h($tryout->apelido) ?>
					</td>
					<td class="view_associados">
						<center><?= h(ucfirst($tryout->civil)) ?> <?= floor((time() - $tryout->nascimento->toUnixString()) / 31556926) ?> Anos</center>
					</td>
				</tr>
				<tr valign="top">
					<td  class="view_associados">
						<b><?= __('Celular') ?>:</b> <?= h($tryout->celular) ?>
					</td>
					<td class="view_associados">
						<b> <?= __('Fixo') ?>:</b> <?= h($tryout->fixo) ?>
					</td>
				</tr>
				<tr valign="top">
					<td  class="view_associados">
						<b><?= __('Contato de Emergencia') ?>:</b> <?= h($tryout->contato_emergencia) ?>
					</td>
					<td class="view_associados">
						<b> <?= __('Telefone Contato') ?>:</b> <?= h($tryout->contato_numero) ?>
					</td>
				</tr>
				<tr valign="top">
					<td class="view_associados">
						<b><?= __('Nascimento') ?>:</b> <?= h($tryout->nascimento->i18nFormat('dd/MM/YYYY')) ?>
					</td>
					<td  class="view_associados">
						<b><?= __('Data Acesso') ?>:</b> <?= h($tryout->data_acesso->i18nFormat('dd/MM/YYYY')) ?>
					</td>
				</tr>
				<tr valign="top">
					<td class="view_associados">
						<b><?= __('Sexo') ?>:</b> <?= h(($tryout->sexo=='M') ? 'Masculino' : 'Feminino') ?>
					</td>
					<td  class="view_associados">
						<b><?= __('Numero') ?>:</b> #<?= h($tryout->numero) ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="horizontal-table">
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Mae') ?>:</b> <?= h($tryout->mae) ?>
		</td>
		<td  class="view_associados">
			<?= h($tryout->profissao_mae) ?> / <?= h($tryout->empresa_mae) ?> 
		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Pai') ?>:</b> <?= h($tryout->pai) ?>
		</td>
		<td  class="view_associados">
			<?= h($tryout->profissao_pai) ?> / <?= h($tryout->empresa_pai) ?> 
		</td>
	</tr>
</table>
<table class="horizontal-table">
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Naturalidade') ?>:</b> <?= h($tryout->naturalidade) ?>
		</td>
		<td width="50%" class="view_associados">
			<b><?= __('Nacionalidade') ?>:</b> <?= h($tryout->nacionalidade) ?>
		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Escolaridade') ?>:</b> <?= h($tryout->escolaridade) ?>
		</td>
		<td width="50%" class="view_associados">
			<b><?= __('Superior') ?>:</b> <?= h($tryout->superior) ?>
			<br> 
			<b><?= __('Data Formacao') ?>:</b> <?= h($tryout->data_formacao->i18nFormat('dd/MM/YYYY')) ?>
		</td>
	</tr>
</table>
<table class="horizontal-table">
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Endereco') ?>:</b> <?= h($tryout->endereco) ?> <br /> <?= __('Bairro') ?>:</b> <?= h($tryout->bairro) ?> <br /> <?= __('Cep') ?>: <?= h($tryout->cep) ?> <br /> <?= h($tryout->cidade) ?> - <?= h($tryout->estado) ?>
		</td>
	</tr>
</table>
<table class="horizontal-table">

	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Cpf') ?>:</b> <?= h($tryout->cpf) ?>
		</td>
		<td width="50%" class="view_associados">
			<b><?= __('Rg') ?>:</b> <?= h($tryout->rg) ?> <?= h($tryout->rg_emissor) ?>
		</td>
	</tr>
</table>
<table class="horizontal-table">

	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Plano de Saude') ?>:</b> <?= h($tryout->plano_de_saude) ?>
		</td>
		<td width="50%" class="view_associados">
			<b><?= __('Abrangencia') ?>:</b> <?= h($tryout->abrangencia) ?> 
		</td>
	</tr>
</table>
<table class="horizontal-table">

	<tr valign="top">
		<td width="33%" class="view_associados">
			<b><?= __('Peso') ?>:</b> <?= h($tryout->peso) ?>
		</td>
		<td width="33%" class="view_associados">
			<b><?= __('Altura') ?>:</b> <?= h($tryout->altura) ?>
		</td>
		<td width="33%" class="view_associados">
			<b><?= __('Sangue') ?>:</b> <?= h($tryout->sangue) ?>
		</td>
	</tr>
</table>
    <h3><?= __('Inventario') ?></h3>

<?php                 
    $tabelas = '';
    $equipado = [
	    'Camisa' => ['cor' => '#ff00ff', 'id'=>0, 'marca'=>'nao', 'modelo'=>'equipado'],
	    'Capacete' => ['cor' => '#00ff00', 'id'=>0, 'marca'=>'nao', 'modelo'=>'equipado'],
	    'Luva' =>  ['cor' => '#0000ff', 'id'=>0, 'marca'=>'nao', 'modelo'=>'equipado'],
	    'Shoulderpad' => ['cor' => '#000000', 'id'=>0, 'marca'=>'nao', 'modelo'=>'equipado'],
	    'Calca' =>  ['cor' => '#00ffff', 'id'=>0, 'marca'=>'nao', 'modelo'=>'equipado'],
	    'Meiao' => ['cor' => '#ff0000', 'id'=>0, 'marca'=>'nao', 'modelo'=>'equipado'],
	    'Chuteira' =>  ['cor' => '#ffff00', 'id'=>0, 'marca'=>'nao', 'modelo'=>'equipado'],
	    ];


    foreach ($equipamentos as $xe)  $equips[$xe->id] = $xe;

    if (!empty($tryout->inventario)) {                
       foreach ($tryout->inventario as $inventario) {
           if($inventario->equipado) $equipado[$equips[$inventario->equipamento_id]['tipo']] = $equips[$inventario->equipamento_id];
	   if($inventario->sobrecor) $equipado[$equips[$inventario->equipamento_id]['tipo']]['cor'] = $inventario->sobrecor;
           $tabelas .= "
            <tr>
	    	<td><center>". $this->Html->image(($this->Number->format($inventario->equipado)) ? 'on.png' : 'off.png') ."</center></td>
                <td><b>". h($equips[$inventario->equipamento_id]['tipo']).':</b> '.h($equips[$inventario->equipamento_id]['marca']).' '.h($equips[$inventario->equipamento_id]['modelo']) ."</td>
                <td style='background-color:". $inventario->sobrecor .";' ><p align='center' style='text-shadow: 1px 1px #000000;'>". h($inventario->tamanho) ."</p></td>
            </tr>";
       }
    }
?>
    <div class="inventarioBody" >
        <table id='fullBody' cellpadding="0" cellspacing="0">
          <tr>
            <td width='80' valign='top'>
                <table cellpadding="0" cellspacing="0">
                  <tr>
		     <th height='79.28'> 
			<?php echo $this->Html->image($this->Url->build([ 
							'controller' => 'Equipamentos', 
							'action' => 'imgfoto', 
							$equipado['Capacete']['id']
							]), 
							['class' => 'imgicon',
						        'title'=> h($equipado['Capacete']['marca']).' '.h($equipado['Capacete']['modelo']),
							'url' => ['controller' => 'Equipamentos', 'action' => 'view', $equipado['Capacete']['id']] 
							])?> 
		   </th>
                  </tr>
                  <tr>
		     <th height='79.28'> 
			<?php echo $this->Html->image($this->Url->build([ 
							'controller' => 'Equipamentos', 
							'action' => 'imgfoto', 
							$equipado['Shoulderpad']['id']]), 
							['class' => 'imgicon',
						        'title'=> h($equipado['Shoulderpad']['marca']).' '.h($equipado['Shoulderpad']['modelo']),
							'url' => ['controller' => 'Equipamentos', 'action' => 'view', $equipado['Shoulderpad']['id']] 
						 	])?> 
			</th>
                  </tr>
                  <tr>
		     <th height='79.28'> 
			<?php echo $this->Html->image($this->Url->build([ 
							'controller' => 'Equipamentos', 
							'action' => 'imgfoto', 
							$equipado['Luva']['id']]), 
							['class' => 'imgicon', 
						        'title'=> h($equipado['Luva']['marca']).' '.h($equipado['Luva']['modelo']),
							'url' => ['controller' => 'Equipamentos', 'action' => 'view', $equipado['Luva']['id']] 
							])?> 
		    </th>
                  </tr>
                  <tr>
		     <th height='79.28'> 
			<?php echo $this->Html->image($this->Url->build([ 
							'controller' => 'Equipamentos', 
							'action' => 'imgfoto', 
							$equipado['Camisa']['id']]), 
							['class' => 'imgicon', 
						        'title'=> h($equipado['Camisa']['marca']).' '.h($equipado['Camisa']['modelo']),
							'url' => ['controller' => 'Equipamentos', 'action' => 'view', $equipado['Camisa']['id']] 
							])?> 
		     </th>
                  </tr>
                  <tr>
		     <th height='79.28'> 
			<?php echo $this->Html->image($this->Url->build([ 
							'controller' => 'Equipamentos', 
							'action' => 'imgfoto', 
							$equipado['Calca']['id']]), 
							['class' => 'imgicon', 
						        'title'=> h($equipado['Calca']['marca']).' '.h($equipado['Calca']['modelo']),
							'url' => ['controller' => 'Equipamentos', 'action' => 'view', $equipado['Calca']['id']] 
							])?> 
		     </th>
                  </tr>
                  <tr>
		     <th height='79.28'> 
			<?php echo $this->Html->image($this->Url->build([ 
							'controller' => 'Equipamentos', 
							'action' => 'imgfoto', 
							$equipado['Meiao']['id']]), 
							['class' => 'imgicon', 
						        'title'=> h($equipado['Meiao']['marca']).' '.h($equipado['Meiao']['modelo']),
							'url' => ['controller' => 'Equipamentos', 'action' => 'view', $equipado['Meiao']['id']] 
							])?> 
		     </th>
                  </tr>
                  <tr>
		     <th height='79.28'> 
			<?php echo $this->Html->image($this->Url->build([ 
							'controller' => 'Equipamentos', 
							'action' => 'imgfoto', 
							$equipado['Chuteira']['id']]), 
							['class' => 'imgicon', 
						        'title'=> h($equipado['Chuteira']['marca']).' '.h($equipado['Chuteira']['modelo']),
							'url' => ['controller' => 'Equipamentos', 'action' => 'view', $equipado['Chuteira']['id']] 
							])?> 
		    </th>
                  </tr>
               </table>
           </td>
           <th width='312' height='555'>
               <canvas id="fa_body" width="312" height="555"></canvas>
          </td>

          <td valign='top'>

        <?php if (!empty($tryout->inventario)): ?>
	<div style="height: 500px; overflow-y: scroll;">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th width='5%'><?= __('E') ?></th>
                <th width='80%'><?= __('Equipamentos') ?></th>
                <th><?= __('Tamanho') ?></th>
            </tr>
             <?php echo $tabelas; ?>
        </table>
	</div>
        <?php endif; ?>
         </td>
          </tr>
        </table>
    </div>

</div>
    
<script>

function hexToRgb(hex,c) {
    hex = hex.replace(/[^0-9A-F]/gi, '');
    var bigint = parseInt(hex, 16);
    switch(c) {
	case 0:
	    return (bigint >> 16) & 255;
	    break;
	case 1:
	    return (bigint >> 8) & 255;
	    break;
	case 2:
	    return bigint & 255;
	    break;
  }
    
}  
      function drawImage(imageObj) {
        var canvas = document.getElementById('fa_body');
        var context = canvas.getContext('2d');
        var x = 0;
        var y = 0;

        context.drawImage(imageObj, x, y);

        var imageData = context.getImageData(x, y, imageObj.width, imageObj.height);
        var data = imageData.data;

        for(var i = 0; i < data.length; i += 4) {
                if(data[i] == 255 && data[i + 1] == 0 && data[i +2] == 255){
			data[i] = hexToRgb('<?=$equipado['Camisa']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Camisa']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Camisa']['cor']?>',2);
                }
                if(data[i] == 0 && data[i + 1] == 255 && data[i +2] == 0){
			data[i] = hexToRgb('<?=$equipado['Capacete']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Capacete']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Capacete']['cor']?>',2);
                }
                if(data[i] == 0 && data[i + 1] == 0 && data[i +2] == 255){
			data[i] = hexToRgb('<?=$equipado['Luva']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Luva']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Luva']['cor']?>',2);
                }
                if(data[i] == 0 && data[i + 1] == 255 && data[i +2] == 255){
			data[i] = hexToRgb('<?=$equipado['Calca']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Calca']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Calca']['cor']?>',2);
                }
                if(data[i] == 255 && data[i + 1] == 0 && data[i +2] == 0){
			data[i] = hexToRgb('<?=$equipado['Meiao']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Meiao']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Meiao']['cor']?>',2);
                }
                if(data[i] == 255 && data[i + 1] == 255 && data[i +2] == 0){
			data[i] = hexToRgb('<?=$equipado['Chuteira']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Chuteira']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Chuteira']['cor']?>',2);
                }
        }

        // overwrite original image
        context.putImageData(imageData, x, y);
	var my_gradient=context.createLinearGradient(0,100,0,200);
	my_gradient.addColorStop(0,"green");
	my_gradient.addColorStop(1,"yellow");
	context.font = "bold 70pt Calibri";
	context.fillStyle = my_gradient;
	context.strokeStyle= "#000000";
	context.fillText("<?php echo ($tryout->numero)? $tryout->numero : '00'?>", 106, 200);
	context.strokeText("<?php echo ($tryout->numero)? $tryout->numero : '00'?>", 106, 200);
      }
      
      var imageObj = new Image();
      imageObj.onload = function() {
        drawImage(this);
      };
      imageObj.src = '/img/fullpad_body.png';
</script>

<script type="text/javascript">
$(document).ready(function() {
// Tooltip only Text
$('.imgicon').hover(function(){
        // Hover over code
        var title = $(this).attr('title');
        $(this).data('tipText', title).removeAttr('title');
        $('<p class="tooltip"></p>')
        .text(title)
        .appendTo('body')
        .fadeIn('slow');
}, function() {
        // Hover out code
        $(this).attr('title', $(this).data('tipText'));
        $('.tooltip').remove();
}).mousemove(function(e) {
        var mousex = e.pageX + 20; //Get X coordinates
        var mousey = e.pageY + 10; //Get Y coordinates
        $('.tooltip')
        .css({ top: mousey, left: mousex })
});
});
</script>

