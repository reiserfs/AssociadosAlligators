<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Meu Perfil'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Editar Perfil'), ['action' => 'edit']) ?> </li>
        <li><?= $this->Html->link(__('Outros Associados'), ['action' => 'lista']) ?> </li>
    </ul>
</nav>
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
						<b><?= __('Nascimento') ?>:</b> <?= h($associado->nascimento) ?>
					</td>
					<td width="37%" class="view_associados">
						<b><?= __('Data Acesso') ?>:</b> <?= h($associado->data_acesso) ?>
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
    <h3><?= __('Mensalidades') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width='5%'><?= $this->Paginator->sort('id') ?></th>
                <th width='20%'><?= $this->Paginator->sort('vencimento') ?></th>
                <th width='20%'><?= $this->Paginator->sort('pago') ?></th>
                <th><?= $this->Paginator->sort('desconto') ?></th>
                <th><?= $this->Paginator->sort('acressimo') ?></th>
                <th><?= $this->Paginator->sort('valor_pago') ?></th>
                <th><?= $this->Paginator->sort('pagamento_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
    <?php $this->Form->create($mensalidade); 
            $this->Form->templates([ 'dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}' ]);
        ?>
            <?php foreach ($mensalidade as $mensalidade): ?>
            <tr>
                <td><?= $this->Number->format($mensalidade->id) ?></td>
                <?php echo $this->Form->input('mensalidade_id',['type'=>'hidden'])?>
                <?php echo $this->Form->input('associado_id',['type'=>'hidden'])?>
                <td><?= $this->Form->input('vencimento',['label'=>false,'monthNames'=>false]); ?></td>
                <td><?= $this->Form->input('pago',['label'=>false,'monthNames'=>false]); ?></td>
                <td><?= $this->Form->input('desconto',['label'=>false]) ?></td>
                <td><?= $this->Form->input('acressimo',['label'=>false]) ?></td>
                <td><?= $this->Form->input('valor_base',['label'=>false]) ?></td>
                <td><?= $this->Form->input('pagamento_id',['label'=>false, 'options' => $pagamentosL]) ?></td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->image('edit.png',['alt' =>__('Edit')]), ['action' => 'edit', $mensalidade->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink($this->Html->image('delete.png',['alt' =>__('Delete')]), ['action' => 'delete', $mensalidade->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $mensalidade->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
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
