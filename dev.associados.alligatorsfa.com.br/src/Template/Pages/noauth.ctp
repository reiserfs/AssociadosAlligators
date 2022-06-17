<!-- File: src/Template/Users/login.ctp -->

<div class="users form">
<?= $this->Flash->render('auth') ?>
<center>
    <h3><?= __('Voce nao tem permissao para acessar este modulo') ?></h3>

<?= $this->Html->image('noauth_gator.jpg') ?>
</center>
</div>

