<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Meu Perfil'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Editar Perfil'), ['action' => 'edit']) ?> </li>
        <li><?= $this->Html->link(__('Mudar Senha'), ['action' => 'senha']) ?> </li>
        <li><?= $this->Html->link(__('Outros Associados'), ['action' => 'lista']) ?> </li>
        <li class="heading"><?= __('Inventario') ?></li>
        <li><?= $this->Html->link(__('Meus Equipamentos'), ['action' => 'equip']) ?> </li>
        <li><?= $this->Html->link(__('Meu Inventario'), ['action' => 'inve']) ?> </li>
        <li><?= $this->Html->link(__('Sugerir Equipamento'), ['action' => 'esug']) ?> </li>
        <li class="heading"><?= __('Financeiro') ?></li>
        <li><?= $this->Html->link(__('Mensalidades'), ['action' => 'mens']) ?> </li>
        <li class="heading"><?= __('Esportes') ?></li>
        <li><?= $this->Html->link(__('Videos'), ['action' => 'video']) ?> </li>
        <li><?= $this->Html->link(__('Outros Times'), ['action' => 'trei']) ?> </li>
        <li><?= $this->Html->link(__('Playbook'), ['action' => 'book']) ?> </li>
        <li class="heading"><?= __('Eventos') ?></li>
        <li><?= $this->Html->link(__('Cursos'), ['action' => 'curs']) ?> </li>
        <li><?= $this->Html->link(__('Festas'), ['action' => 'party']) ?> </li>
    </ul>
</nav>
<?= $this->fetch('content') ?>
