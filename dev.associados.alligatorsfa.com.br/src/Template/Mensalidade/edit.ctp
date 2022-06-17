<?php $this->extend('/Comum/mensalidade'); ?>
<div class="mensalidade form large-9 medium-8 columns content">
    <?= $this->Form->create($mensalidade) ?>
    <fieldset>
        <legend><?= __('Edit Mensalidade') ?></legend>
        <?php
            echo $this->Form->input('associado_id', ['options' => $associados]);
            echo $this->Form->input('vencimento');
            echo $this->Form->input('pago');
            echo $this->Form->input('valor_base');
            echo $this->Form->input('desconto');
            echo $this->Form->input('acressimo');
            echo $this->Form->input('pagamento_id', ['options' => $pagamentos]);
            echo $this->Form->input('observacoes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
