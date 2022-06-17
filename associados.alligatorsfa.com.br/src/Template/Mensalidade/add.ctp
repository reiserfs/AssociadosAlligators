<?php $this->extend('/Comum/mensalidade'); ?>
<div class="mensalidade form large-9 medium-8 columns content">
    <?= $this->Form->create($mensalidade) ?>
    <fieldset>
        <legend><?= __('Add Mensalidade') ?></legend>
        <?php
	    echo '<input id="search_input" placeholder="Filtrar">';
            echo $this->Form->input('associado_id', ['options' => $associados]);
            echo $this->Form->input('vencimento');
            echo $this->Form->input('pago');
            echo $this->Form->input('plano_id', ['options' => $planos]);
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
	<script type="text/javascript" charset="utf-8">
	// FILTRO
	  $(document).ready(function () {
	    //copy options
	    var options = $('#associado-id option').clone();
	    //react on keyup in textbox
	    $('#search_input').keyup(function () {
	      var val = $(this).val();
	      $('#associado-id').empty();
	      //take only the options containing your filter text or all if empty
	      options.filter(function (idx, el) {
		return val === '' || $(el).text().indexOf(val) >= 0;
	      }).appendTo('#associado-id');//add it to list
	     });
	  });
	</script>
