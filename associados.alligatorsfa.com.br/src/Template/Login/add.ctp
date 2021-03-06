<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Login'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="login form large-9 medium-8 columns content">
    <?= $this->Form->create($login) ?>
    <fieldset>
        <legend><?= __('Add Login') ?></legend>
        <?php
	    $this->Form->templates([
    		'dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}'
	    ]);
            echo $this->Form->input('user');
            echo $this->Form->input('password');
            echo $this->Form->input('ativo');
            echo $this->Form->input('nome',['value'=>1, 'type'=>'hidden']);
            echo $this->Form->input('email',['value'=>1, 'type'=>'hidden']);
            echo $this->Form->input('senha',['value'=>123456, 'type'=>'hidden']);
            echo $this->Form->input('confirma_senha',['value'=>123456, 'type'=>'hidden']);
            echo $this->Form->input('nascimento',['value'=>1, 'type'=>'hidden']);
            echo $this->Form->input('cpf',['value'=>1, 'type'=>'hidden']);
            echo $this->Form->input('associado_id', ['options' => $associado]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
