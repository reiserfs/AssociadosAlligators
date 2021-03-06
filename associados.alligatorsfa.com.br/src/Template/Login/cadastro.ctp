<div class="login form large-9 medium-8 columns content">
    <?= $this->Form->create($login) ?>
    <fieldset>
        <legend><?= __('Cadastro Associado') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('cpf');
            echo $this->Form->input('nascimento',['type' =>'text', 'label' => 'Data de Nascimento']);
            echo $this->Form->input('senha',['type' => 'password']);
            echo $this->Form->input('confirma_senha',['type' => 'password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
<?php if (isset($erro)) : ?>
    <?= $this->Html->link($this->Form->button(__('Novo Cadastro'),['type'=>'button','style' => 'float: left; margin: 0 10px 1px;background-color: #008CBA;']),['action'=>'tryout'],['escape'=>false]); ?>
<?php endif; ?>
    <?= $this->Form->end() ?>
</div>
<script>
	$(function() {
		$( "#nascimento" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '-80:+0' 
		});
	});    
</script>
