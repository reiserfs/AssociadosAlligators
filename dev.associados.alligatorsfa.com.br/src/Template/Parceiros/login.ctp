<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
		<?= $this->Form->input('user',['autofocus'=>'autofocus','label'=>'Usuario']) ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Logar'),['style' => 'float: left; margin: 0 10px 10px 35%;background-color: #4CAF50;']); ?>
<?= $this->Form->end() ?>
</div>

