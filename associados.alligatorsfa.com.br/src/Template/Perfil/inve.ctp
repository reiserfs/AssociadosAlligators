<?php $this->extend('/Comum/perfil'); ?>
<?php
$htmlInve = '';

foreach ($inventario as $inventario) $optionsInve[$inventario->equipamento->tipo][]  = $inventario; 

foreach ($optionsInve as $key => $value) {
	$op = '';
	$equipado = false;
	foreach($value as $options) {
		$op[$options['id']] = $options->equipamento['marca'] . ' ' . $options->equipamento['modelo'];
		if(!$equipado) $equipado = ($options['equipado']) ? $options['id'] : false;
	}
//	$htmlInve .= "<h4>". __($key)." </h4> \n\n";
//	$htmlInve .= "<fieldset> \n\n";
        $htmlInve .= $this->Form->input($key,['options' => $op, 'size'=>200, 'style'=>'height:125px;', 'value' => $equipado]);
//	$htmlInve .= "</fieldset>\n\n\n";
}
?>

<div class="login form large-9 medium-8 columns content">
    <?= $this->Form->create($inventario) ?>
    <fieldset>
        <legend><?= __('Material Equipado') ?></legend>
        <?php
		echo $htmlInve;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
	<script type="text/javascript" charset="utf-8">
	// FILTRO
	  $(document).ready(function () {
	    //copy options
	    var options = $('#equipamento-id option').clone();
	    //react on keyup in textbox
	    $('#search_input').keyup(function () {
	      var val = $(this).val();
	      $('#equipamento-id').empty();
	      //take only the options containing your filter text or all if empty
	      options.filter(function (idx, el) {
		return val === '' || $(el).text().indexOf(val) >= 0;
	      }).appendTo('#equipamento-id');//add it to list
	     });
	  });
	</script>
