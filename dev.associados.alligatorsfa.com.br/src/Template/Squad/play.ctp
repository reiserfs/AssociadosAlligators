<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Squad Associado'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Associados'), ['controller' => 'Associados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Associado'), ['controller' => 'Associados', 'action' => 'add']) ?></li>
    </ul>
</nav>

<div class="squadAssociado form large-9 medium-8 columns content">
    <?= $this->Form->create($squad) ?>
    <fieldset>
        <legend><?= __('Edit Squad Associado') ?></legend>

	<div class="divTable">
	<div class="divTableBody">
		<div class="divTableRow">
			<div class="divTableCell">
				<div class="box follow-scroll">
				<?php
				    echo $this->Form->input('id',['type'=>'hidden']);
				    echo $this->Form->input('jogadorid',['type'=>'hidden']);
				    echo $this->Form->input('posicao_id');
            			    echo $this->Form->input('jogadores',['type'=>'text']);
				?>
				</div>
			</div>
			<div class="divTableCell">
				<?php
				    $associados = $associados->toArray();
				    foreach($timesposicoes as $key=>$value) {
					    $opcoes = array();
					    if(isset($squadarray[$key]))
						    foreach($squadarray[$key] as $s) {
						    	$opcoes["[$s->posicao_id,$s->associados_id]"] = '('. $s->posicao->sigla .') '. $s->posicao->nome . ' ' . $associados[$s->associados_id];
						    }
					echo "<a id='add_".strtolower(preg_replace('/\s+/', '-', $value))."' > [+] </a>";
					echo "<a id='rem_".strtolower(preg_replace('/\s+/', '-', $value))."' > [-] </a>";
            			   	echo $this->Form->input($value, ['name'=>$value.'[]','options' => $opcoes, 'multiple', 'size'=>200, 'style'=>'height:225px;']);
				    }
				?>
			</div>
		</div>
		<div class="divTableRow">
			<div class="divTableCell">&nbsp;</div>
			<div class="divTableCell">
    				<?= $this->Form->button(__('Salvar'),['id'=>'salvar']) ?>
			</div>
		</div>
	</div>
	</div>
    </fieldset>
    <?= $this->Form->end() ?>
	<?php foreach($associados as $key=>$value) $json[] = array("id"=>$key,"value"=>$value); ?> 
</div>
<script>
	$(document).ready(function () {
	  $("#add_ataque, #add_defesa, #add_diretoria, #add_special-teams, #add_comissao-tecnica").click(function () {
 	      if($("#jogadorid").val() > 0) {		
		    var time = $(this).attr('id').substring(4);
		    var posicao = $("#posicao-id").find(":selected").text();
		    var posicaoid = $("#posicao-id").find(":selected").val();
		    var jogador = $("#jogadores").val();
		    var jogadorid = $("#jogadorid").val();
		    //alert( posicao + posicaoid + jogador + jogadorid );
		    $("#"+time).append('<option value="['+ posicaoid + ',' + jogadorid +']">'+ posicao+ ' ' + jogador +'</option>');
	      }
	  });
	  $("#rem_ataque, #rem_defesa, #rem_diretoria, #rem_special-teams, #rem_comissao-tecnica").click(function () {
		    var time = $(this).attr('id').substring(4);
		    $("#"+time).find(":selected").remove();
	  });
	});

	$('#salvar').click(function() {
		$('select option').prop('selected', true);
	});

	var associados = <?= json_encode($json) ?>;
	$( function() {
		$( "#jogadores" ).autocomplete({
		    source: associados,

		    select: function( event, ui ) {
			    $( "#jogadores" ).val( ui.item.value);
			    $( "#jogadorid" ).val( ui.item.id);

			    return false;
		    },	    

		    focus: function (event, ui) {
			    return false;
		    },	    
		    change: function (event, ui) {
			if(!ui.item){
				$(event.target).val("");
			}
		    }, 
		});
	} );
	(function($) {
	    var element = $('.follow-scroll'),
		originalY = element.offset().top;
	    
	    // Space between element and top of screen (when scrolling)
	    var topMargin = 20;
	    
	    // Should probably be set in CSS; but here just for emphasis
	    element.css('position', 'relative');
	    
	    $(window).on('scroll', function(event) {
		var scrollTop = $(window).scrollTop();
		
		element.stop(false, false).animate({
		    top: scrollTop < originalY
			    ? 0
			    : scrollTop - originalY + topMargin
		}, 300);
	    });
	})(jQuery);
</script>
