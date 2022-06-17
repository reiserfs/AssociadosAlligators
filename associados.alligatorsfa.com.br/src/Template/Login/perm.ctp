<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Login'), ['action' => 'edit', $login->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Login'), ['action' => 'delete', $login->id], ['confirm' => __('Are you sure you want to delete # {0}?', $login->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Login'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Login'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Permissoes'), ['controller' => 'Permissoes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Permisso'), ['controller' => 'Permissoes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="login view large-9 medium-8 columns content">
   <h3><?= $login->has('associado') ? $this->Html->link($login->associado->nome . ' ('. $login->associado->apelido . ') '. $login->associado->sobrenome, ['controller' => 'Associados', 'action' => 'view', $login->associado->id]) : '' ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= h($login->user) ?></td>
            <th><?= __('Id') ?></th>
	    <td><?= $this->Html->image(($this->Number->format($login->ativo)) ? 'on.png' : 'off.png')  ?>
            <?= $this->Number->format($login->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Criacao') ?></th>
            <td><?= h($login->data_criacao) ?></td>
            <th><?= __('Ultimo Login') ?></th>
            <td><?= h($login->ultimo_login) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Permissoes') ?></h4>
	<?php 

		$controles = array();
		if (!empty($login->permissoes)) {
			foreach ($login->permissoes as $permissoes) $controles[$permissoes->controller] = $permissoes->action;	
		}		
	?>
	    <?= $this->Form->create($permissoes) ?>
	    <fieldset>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th width='20%'><?= __('Modulo') ?></th>
                <th><?= __('Permissao') ?></th>
	    </tr>
		<?php
	$this->Form->templates([
		    'nestingLabel' => '{{input}}<label{{attrs}}>{{text}}</label>',
		        'formGroup' => '{{input}}{{label}}',
		    ]);
		    foreach($controllers as $key => $value) {
			   echo "<tr bgcolor='99ff99'><td>" . $value . "</td><td> ". $this->Form->radio($key,$actions,['value'=>(isset($controles[$key]) ? $controles[$key] : null)]). "</td></tr>";
		    }
		?>
	  </table>
	    </fieldset>
	    <?= $this->Form->button(__('Submit')) ?>
	    <?= $this->Form->end() ?>
    </div>
</div>
