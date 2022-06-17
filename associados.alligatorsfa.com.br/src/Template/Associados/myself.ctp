<?php ->extend('/Comum/associado'); ?>
<div class="associados view large-9 medium-8 columns content">
    <h3><?= h($associado->id) ?></h3>

<table class="horizontal-table">
	<tr valign="top">
		<td width="20%" class="view_associados">
		 <center><?= $this->Html->image($this->Url->build([
								'controller' => 'Associados',
								'action'     => 'imgfoto',
								 $associado->id
							]),
						['width' => '160px', 'height' => '160px']
						) 
			?></center>
		</td>
		<td width="80%">
			<table class="horizontal-table">
				<tr valign="top">
					<td width="63%" class="view_associados">
						<b><?= __('Nome') ?>:</b> <?= h($associado->nome) ?> <?= h($associado->sobrenome) ?>
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
						<b><?= __('Apelido') ?>:</b> <?= h($associado->apelido) ?>
					</td>
					<td width="37%" class="view_associados">
						<center><?= floor((time() - strtotime($associado->nascimento)) / 31556926) ?> Anos</center>
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
						<b><?= __('Nascimento') ?>:</b> <?= h($associado->nascimento) ?>
					</td>
					<td width="37%" class="view_associados">
						<b><?= __('Data Acesso') ?>:</b> <?= h($associado->data_acesso) ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="horizontal-table">
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Mae') ?>:</b> <?= h($associado->mae) ?>
		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Pai') ?>:</b> <?= h($associado->pai) ?>
		</td>
	</tr>
</table>
<table class="horizontal-table">
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Naturalidade') ?>:</b> <?= h($associado->naturalidade) ?>
		</td>
		<td width="50%" class="view_associados">
			<b><?= __('Nacionalidade') ?>:</b> <?= h($associado->nacionalidade) ?>
		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Escolaridade') ?>:</b> <?= h($associado->escolaridade) ?>
		</td>
		<td width="50%" class="view_associados">
			<b><?= __('Superior') ?>:</b> <?= h($associado->superior) ?>
		</td>
	</tr>
</table>
<table class="horizontal-table">
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Endereco') ?>:</b> <?= h($associado->endereco) ?> <br /> <?= __('Bairro') ?>:</b> <?= h($associado->bairro) ?> <br /> <?= __('Cep') ?>: <?= h($associado->cep) ?> <br /> <?= h($associado->cidade) ?> - <?= h($associado->estado) ?>
		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Pai') ?>:</b> <?= h($associado->pai) ?>
		</td>
	</tr>
</table>
<table class="horizontal-table">

	<tr valign="top">
		<td width="50%" class="view_associados">
			<b><?= __('Cpf') ?>:</b> <?= h($associado->cpf) ?>
		</td>
		<td width="50%" class="view_associados">
			<b><?= __('Rg') ?>:</b> <?= h($associado->rg) ?> <?= h($associado->rg_emissor) ?>
		</td>
	</tr>
</table>
<table class="horizontal-table">

	<tr valign="top">
		<td width="33%" class="view_associados">
			<b><?= __('Peso') ?>:</b> <?= h($associado->peso) ?>
		</td>
		<td width="33%" class="view_associados">
			<b><?= __('Altura') ?>:</b> <?= h($associado->altura) ?>
		</td>
		<td width="33%" class="view_associados">
			<b><?= __('Sangue') ?>:</b> <?= h($associado->sangue) ?>
		</td>
	</tr>
</table>




</div>
