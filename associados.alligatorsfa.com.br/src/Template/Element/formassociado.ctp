<div class="associados form large-9 medium-8 columns content">
    <?= $this->Form->create($associado,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __($titulo) ?></legend>
        <?php
            $this->Form->templates([ 'dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}' ]);
            echo $this->Form->input('foto',['type'=>(isset($escondefoto)?$escondefoto:'file')]);
            echo $this->Form->input('nome');
            echo $this->Form->input('sobrenome');
            echo $this->Form->input('nascimento',['type' =>'text', 'label' => 'Data de Nascimento']);
            echo $this->Form->input('email');
            echo $this->Form->input('pai');
            echo $this->Form->input('mae');
            echo $this->Form->input('naturalidade');
            echo $this->Form->input('nacionalidade');
            echo $this->Form->input('profissao');
            echo $this->Form->input('empresa');
            echo $this->Form->input('profissao_pai');
            echo $this->Form->input('empresa_pai');
            echo $this->Form->input('profissao_mae');
            echo $this->Form->input('empresa_mae');
            echo $this->Form->input('escolaridade');
            echo $this->Form->input('superior');
            echo $this->Form->input('data_formacao',['type' =>'text', 'label' => 'Data Formacao']);
            echo $this->Form->input('endereco');
            echo $this->Form->input('cidade');
            echo $this->Form->input('estado',['options' => $estados]);
            echo $this->Form->input('bairro',['type'=>'text']);
            echo $this->Form->input('rg');
            echo $this->Form->input('rg_emissor');
            echo $this->Form->input('cpf');
            echo $this->Form->input('fixo',['type'=>'number']);
            echo $this->Form->input('celular',['type'=>'number']);
            echo $this->Form->input('contato_emergencia');
            echo $this->Form->input('contato_numero',['type'=>'number']);
            echo $this->Form->input('plano_de_saude');
            echo $this->Form->input('abrangencia');
            echo $this->Form->input('altura');
            echo $this->Form->input('peso');
            echo $this->Form->radio('sexo',[['value' => 'M', 'text' =>'Masculino'],['value' => 'F', 'text' =>'Feminino']]);
            echo $this->Form->input('civil',['options' => ['solteiro'=>'Solteiro','casado'=>'Casado','divorciado'=>'Divorciado','viuvo'=>'Viuvo'], 'label'=>'Estado Civil']);
            echo $this->Form->input('numero');
            echo $this->Form->input('sangue');
            echo $this->Form->input('apelido');
            echo $this->Form->input('cep');
            echo $this->Form->input('time_id', ['options' => $time]);
            echo $this->Form->input('plano_id', ['options' => $plano]);
            echo $this->Form->input('data_acesso',['type' =>'text', 'label' => 'Data Acesso ao Time']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
  var bairros = <?= json_encode($bairros)?>;
  $( "#estado" ).change(function() { $("#bairro").autocomplete('option','source',bairros[$(this).val()]); });
  $( function() {
    $( "#bairro" ).autocomplete({
	    source: bairros['DF'],
	    change: function (event, ui) {
		if(!ui.item){
			$(event.target).val("");
		}
	    }, 
		focus: function (event, ui) {
		    return false;
	    }	    
    });
  } );
  $(function() {
	$( "#nascimento" ).datepicker({changeMonth: true, changeYear: true, yearRange: '-80:+0'});
	$( "#data-acesso" ).datepicker({changeMonth: true, changeYear: true, yearRange: '-80:+0'});
	$( "#data-formacao" ).datepicker({changeMonth: true, changeYear: true, yearRange: '-80:+0'});
  });   
  
</script>
