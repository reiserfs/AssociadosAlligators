<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Brasilia Alligators: Associados';

// GERAR DROPDOWN MENU
function dropdown($titulo, $valores, $thiss) {
	(isset($thiss->viewVars['userDetails'])) ? $userr = $thiss->viewVars['userDetails'] : $userr = false;
	echo '<div class="dropdown">';
	echo '  <button class="dropbtn">'.$titulo.'</button>';
	echo '  <div class="dropdown-content">';
	if($userr)
	foreach($valores as $key => $value){
		if((array_search($value[0],array_column($userr['permissoes'],'controller')) > -1) || ($value[0] == 'Perfil'))
			echo $thiss->Html->link($key,['controller'=>$value[0],'action'=>$value[1]]);
	}
	echo '</div></div>';
}

if (isset($this->viewVars['userDetails'])) {
	$userHtml = $this->Html->link('Meu Perfil',['alt'=>$this->viewVars['userDetails']['user'],'controller'=>'Perfil','action'=>'index']);
	$userHtml .= " :: ";
	$userHtml .= $this->Html->link('Editar Perfil',['alt'=>$this->viewVars['userDetails']['user'],'controller'=>'Perfil','action'=>'edit']);
}
else $userHtml = $this->Html->link('Entrar', ['controller'=>'Login', 'action'=>'login']); 

$perfil = array(
	'Meu Perfil'	=>	['Perfil'	,'index'],
	'Editar Perfil'	=>	['Perfil'	,'edit'],
	'Mensalidades'	=>	['Perfil'	,'mens'],
	'Inventario'	=>	['Perfil'	,'equip'],
);

$rh = array(
	'Associados' 	=> 	['Associados' 	, 'index'],
	'Categorias' 	=> 	['Time'		, 'index'],
	'Equipamentos'	=>	['Equipamentos'	, 'index'],
	'Inventario'	=>	['Inventario'	, 'index'],
	'TryOut'	=>	['Tryout'	, 'index'],
	'Notas'		=>	['Notas'	, 'index'],
);
$fin = array(
	'Planos' 	=> 	['Plano', 'index'],
	'Formas de Pagamento' 	=> 	['Pagamentos', 'index'],
	'Mensalidades' 	=> 	['Mensalidade', 'index'],
	'Caixa' 	=> 	['#'		, '#'],
	'Compras'	=>	['#'		, '#'	  ],
);
$esp = array(
	'Treinos' 	=> 	['#' 	, '#'],
	'Roster' 	=> 	['Squad', 'index'],
	'Relatorios'	=>	['#'		, '#'	  ],
	'Videos' 	=> 	['Video' 	, 'index'],
	'Outros Times' 	=> 	['Outrotime' 	, 'index'],
);
$mkt = array(
	'Eventos'	=>	['#'		, '#'	  ],
	'Produtos'	=>	['#'		, '#'	  ],
);
$admin = array(
	'Login' 	=> 	['Login' 	, 'index'],
	'Parceiros' 	=> 	['Parceiros'		, 'index'],
	'Configuracao' 	=> 	['Configuracao'		, 'index'],
	'Logs'	=>	['Log'		, 'index'	  ],
);
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('gators.css') ?>
    <?= $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css') ?>

    <?= $this->Html->css('xstyle.css') ?>
    <?= $this->Html->css('responsive.css') ?>
    <?= $this->Html->css('responsive.css') ?>

    <?= $this->Html->script('google.js') ?>
    <?= $this->Html->script('editablegrid.js') ?>
    <?= $this->Html->script('editablegrid_renderers.js') ?>
    <?= $this->Html->script('editablegrid_editors.js') ?>
    <?= $this->Html->script('editablegrid_validators.js') ?>
    <?= $this->Html->script('editablegrid_utils.js') ?>
    <?= $this->Html->script('editablegrid_charts.js') ?>
    <?= $this->Html->script('jquery-1.12.2.min.js') ?>
    <?= $this->Html->script('jquery-ui.min.js') ?>
    <?= $this->Html->script('datepicker-pt-BR.js') ?>
    <?= $this->Html->script('jquery.aCollapTable.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <section class="right_top">
		<?php echo $userHtml; ?>
        </section>
	<?= $this->Html->image('gators.png') ?> <a href="#">Brasilia Alligators Associados</a>
    </nav>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-6 medium-4 columns">
            <li class="name">
		<?= dropdown('Perfil',$perfil, $this) ?>
		<?= dropdown('Recursos Humanos',$rh, $this) ?>
		<?= dropdown('Financeiro',$fin, $this) ?>
		<?= dropdown('Esportes',$esp, $this) ?>
		<?= dropdown('Eventos',$mkt, $this) ?>
		<?= dropdown('Admin',$admin, $this) ?>
            </li>
        </ul>
        <section class="top-bar-section">
            <ul class="right">
		<li> <?= $this->Html->link('Logout', ['controller'=>'Login', 'action'=>'logout']) ?></li>
                <li><a target="_blank" href="https://www.facebook.com/bsballigatorsfa">Facebook</a></li>
                <li><a target="_blank" href="http://alligatorsfa.com.br/">Pagina Oficial</a></li>
            </ul>
        </section>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
</body>
</html>
