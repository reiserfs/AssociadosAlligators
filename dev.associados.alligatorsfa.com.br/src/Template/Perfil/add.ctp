<?php $this->extend('/Comum/perfil'); ?>
<div class="associados form large-9 medium-8 columns content">
    <?= $this->Form->create($associado,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Associado') ?></legend>
        <?php

	    $this->Form->templates([
    		'dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}'
	    ]);
            echo $this->Form->input('foto');
            echo $this->Form->input('nome');
            echo $this->Form->input('sobrenome');
            echo $this->Form->input('nascimento', array('minYear' => date('Y') - 70, 'maxYear' => date('Y') - 12));
            echo $this->Form->input('email');
            echo $this->Form->input('pai');
            echo $this->Form->input('mae');
            echo $this->Form->input('naturalidade');
            echo $this->Form->input('nacionalidade');
            echo $this->Form->input('profissao');
            echo $this->Form->input('escolaridade');
            echo $this->Form->input('superior');
            echo $this->Form->input('endereco');
            echo $this->Form->input('cidade');
            echo $this->Form->select('estado', $estados);
            echo $this->Form->input('bairro');
            echo $this->Form->input('rg');
            echo $this->Form->input('rg_emissor');
            echo $this->Form->input('cpf');
            echo $this->Form->input('fixo');
            echo $this->Form->input('celular');
            echo $this->Form->input('altura');
            echo $this->Form->input('peso');
            echo $this->Form->input('sexo',['options' => ['M'=>'Masculino','F'=>'Feminino'], 'type'=>'radio']);
            echo $this->Form->input('numero');
            echo $this->Form->input('sangue');
            echo $this->Form->input('apelido');
            echo $this->Form->input('cep');
            echo $this->Form->input('time');
            echo $this->Form->input('data_acesso', array('minYear' => date('Y') - 70, 'maxYear' => date('Y') - 12));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
