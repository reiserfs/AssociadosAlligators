<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $parceiro->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $parceiro->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Parceiros'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="parceiros form large-9 medium-8 columns content">
    <?= $this->Form->create($parceiro) ?>
    <fieldset>
        <legend><?= __('Edit Parceiro') ?></legend>
        <?php
            echo $this->Form->input('user');
     	    echo $this->Form->input('password',['value' => '']);
 	    echo $this->Form->input('data_criacao',['type'=>'hidden']);
	    echo $this->Form->input('ultimo_login',['type'=>'hidden']);        
            echo $this->Form->input('ativo');
            echo $this->Form->input('descricao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
