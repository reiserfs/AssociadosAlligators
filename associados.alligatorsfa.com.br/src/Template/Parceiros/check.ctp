
<?php if (isset($associado)): ?> 
<br>
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
			?>
		</center>
		</td>
		<td width="80%">
			<table class="horizontal-table">
				<tr valign="top">
					<td width="53%" class="view_associados">
						<b><?= __('Nome') ?>:</b> <?= h($associado->nome) ?> <?= h($associado->sobrenome) ?>
					</td>
					<td width="47%" class="view_associados">
						<center>
               					 <?= $this->Html->image(($this->Number->format($associado->ativo)) ? 'on.png' : 'off.png')  ?>
						<?= $associado->has('time') ? $associado->time->nome : '' ?>
					-	<?= $associado->has('plano') ? $associado->plano->nome_plano : '' ?>

						</center>
					</td>
				</tr>
				<tr valign="top">
					<td  class="view_associados">
						<b><?= __('Email') ?>:</b> <a href="mailto:<?= $associado->email ?>"><?= h($associado->email) ?></a>
					</td>
					<td  class="view_associados">
					<center><?php echo ($naopago > 0 ) ? '<span style="color:red;"> Inadimplente</span>' : '<span style="color:green;"> Adimplente</span>'; ?> </center>
					</td>
				</tr>
				<tr valign="top">
					<td class="view_associados">
						<b><?= __('Apelido') ?>:</b> <?= h($associado->apelido) ?>
					</td>
					<td class="view_associados">
						<center><?= h(ucfirst($associado->civil)) ?> <?= floor((time() - $associado->nascimento->toUnixString()) / 31556926) ?> Anos</center>
					</td>
				</tr>
				<tr valign="top">
					<td  class="view_associados">
						<b><?= __('Celular') ?>:</b> <?= h($associado->celular) ?>
					</td>
					<td class="view_associados">
						<b> <?= __('Fixo') ?>:</b> <?= h($associado->fixo) ?>
					</td>
				</tr>
				<tr valign="top">
					<td class="view_associados">
						<b><?= __('Nascimento') ?>:</b> <?= h($associado->nascimento->i18nFormat('dd/MM/YYYY')) ?>
					</td>
					<td  class="view_associados">
						<b><?= __('Data Acesso') ?>:</b> <?= h($associado->data_acesso->i18nFormat('dd/MM/YYYY')) ?>
					</td>
				</tr>
				<tr valign="top">
					<td class="view_associados">
						<b><?= __('Sexo') ?>:</b> <?= h(($associado->sexo=='M') ? 'Masculino' : 'Feminino') ?>
					</td>
					<td  class="view_associados">
						<b><?= __('Numero') ?>:</b> #<?= h($associado->numero) ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>

<?php endif; ?>
<div class="users form">
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Digite CPF ou Registro do Associado ou Socio torcedor') ?></legend>
		<?= $this->Form->input('valor',['autofocus'=>'autofocus','label'=>'Consulta','placeholder'=>'CPF ou Registro']) ?>
    </fieldset>
<?= $this->Form->button(__('Consultar'),['style' => 'float: left; margin: 0 10px 10px 35%;background-color: #4CAF50;']); ?>
<?= $this->Form->end() ?>
</div>
<br />
<br />
<br />
<br />

