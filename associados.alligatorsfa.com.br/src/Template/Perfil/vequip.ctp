<?php $this->extend('/Comum/perfil'); ?>
<div class="equipamentos view large-9 medium-8 columns content">
    <h3><?= h($equipamento->id) ?></h3>
    <table class="view_associados">
	<tr> 
	 	<td width='160px'><?= $this->Html->image($this->Url->build(['controller' => 'Equipamentos', 'action' => 'imgfoto', $equipamento->id ]), ['width' => '160px', 'height' => '160px']) ?></td>
		<td valign='top'>
			<p class="item_nome" style="color:<?= $equipamento->cor ?>;"><?= h($equipamento->marca) .' '. h($equipamento->modelo) ?></p> 
			<p class="item_tipo"><?= h($equipamento->tipo) ?></p> 
                        <p><?= h($equipamento->descricao) ?></p>
                </td>
	</tr>
    </table>
</div>
