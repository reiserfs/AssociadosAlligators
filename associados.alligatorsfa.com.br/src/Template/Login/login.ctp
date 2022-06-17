<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
		<?= $this->Form->input('user',['autofocus'=>'autofocus','label'=>'E-mail']) ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Logar'),['style' => 'float: left; margin: 0 10px 10px 35%;background-color: #4CAF50;']); ?>
<?= $this->Html->link($this->Form->button(__('Cadastro'),['type'=>'button','style' => 'float: left; margin: 0 10px 1px;background-color: #008CBA;']),['action'=>'cadastro'],['escape'=>false]); ?>
<?= $this->Form->end() ?>
</div>

