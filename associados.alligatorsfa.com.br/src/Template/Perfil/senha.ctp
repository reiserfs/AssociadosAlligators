<?php $this->extend('/Comum/perfil'); ?>
<div class="login form large-9 medium-8 columns content">
    <?= $this->Form->create($login) ?>
    <fieldset>
        <legend><?= __('Edit Login') ?></legend>
        <?php
    	    echo $this->Form->input('senha',['value' => '','type'=>'password']);
    	    echo $this->Form->input('confirma_senha',['value' => '','type'=>'password']);

            echo $this->Form->input('user',['type'=>'hidden']);
 	    echo $this->Form->input('data_criacao',['type'=>'hidden']);
	    echo $this->Form->input('ultimo_login',['type'=>'hidden']);        
            echo $this->Form->input('ativo',['type'=>'hidden']);

            echo $this->Form->input('nome',['value'=>1, 'type'=>'hidden']);
            echo $this->Form->input('email',['value'=>1, 'type'=>'hidden']);
            echo $this->Form->input('nascimento',['value'=>1, 'type'=>'hidden']);
            echo $this->Form->input('cpf',['value'=>1, 'type'=>'hidden']);

            echo $this->Form->input('associado_id', ['type'=>'hidden']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
