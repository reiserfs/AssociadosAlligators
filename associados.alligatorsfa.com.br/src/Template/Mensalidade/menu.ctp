<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Mensalidades') ?></li>
        <li><?= $this->Html->link(__('Por Associados'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Todas Mensalidades'), ['action' => 'mens']) ?> </li>
        <li><?= $this->Html->link(__('Gerar Mensalidades'), ['action' => 'gera']) ?> </li>
        <li><?= $this->Html->link(__('Listar Mensalidades'), ['action' => 'lista']) ?> </li>
        <li><?= $this->Html->link(__('Adicionar Mensalidade'), ['action' => 'add']) ?> </li>
        <li class="heading"><?= __('Planos') ?></li>
        <li><?= $this->Html->link(__('Novo Plano'), ['controller' => 'plano', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Planos'), ['controller' => 'plano', 'action' => 'index']) ?> </li>
        <li class="heading"><?= __('Formas de Pagamento') ?></li>
        <li><?= $this->Html->link(__('Nova Forma de Pagamento'), ['controller' => 'pagamentos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Formas de Pagamento'), ['controller' => 'pagamentos', 'action' => 'index']) ?> </li>
    </ul>
</nav>
