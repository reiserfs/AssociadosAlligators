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
 * @since         0.10.8
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Configure paths required to find CakePHP + general filepath
 * constants
 */
require __DIR__ . '/paths.php';

// Use composer to load the autoloader.
require ROOT . DS . 'vendor' . DS . 'autoload.php';

/**
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

// You can remove this if you are confident you have intl installed.
if (!extension_loaded('intl')) {
    trigger_error('You must enable the intl extension to use CakePHP.', E_USER_ERROR);
}

use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\Network\Request;
use Cake\Routing\DispatcherFactory;
use Cake\Utility\Inflector;
use Cake\Utility\Security;

/**
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

// Load an environment local configuration file.
// You can use a file like app_local.php to provide local overrides to your
// shared configuration.
//Configure::load('app_local', 'default');

// When debug = false the metadata cache should last
// for a very very long time, as we don't want
// to refresh the cache while users are doing requests.
if (!Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+1 years');
    Configure::write('Cache._cake_core_.duration', '+1 years');
}

/**
 * Set server timezone to UTC. You can change it to another timezone of your
 * choice but using UTC makes time calculations / conversions easier.
 */
date_default_timezone_set('UTC');

/**
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(Configure::read('App.encoding'));

/**
 * Set the default locale. This controls how dates, number and currency is
 * formatted and sets the default language to use for translations.
 */
//;ini_set('intl.default_locale', Configure::read('App.defaultLocale'));
ini_set('intl.default_locale', 'pt_BR');

/**
 * Register application error and exception handlers.
 */
$isCli = PHP_SAPI === 'cli';
if ($isCli) {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
    (new ErrorHandler(Configure::read('Error')))->register();
}

// Include the CLI bootstrap overrides.
if ($isCli) {
    require __DIR__ . '/bootstrap_cli.php';
}

/**
 * Set the full base URL.
 * This URL is used as the base of all absolute links.
 *
 * If you define fullBaseUrl in your config file you can remove this.
 */
if (!Configure::read('App.fullBaseUrl')) {
    $s = null;
    if (env('HTTPS')) {
        $s = 's';
    }

    $httpHost = env('HTTP_HOST');
    if (isset($httpHost)) {
        Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
    }
    unset($httpHost, $s);
}

Cache::config(Configure::consume('Cache'));
ConnectionManager::config(Configure::consume('Datasources'));
Email::configTransport(Configure::consume('EmailTransport'));
Email::config(Configure::consume('Email'));
Log::config(Configure::consume('Log'));
Security::salt(Configure::consume('Security.salt'));

/**
 * The default crypto extension in 3.0 is OpenSSL.
 * If you are migrating from 2.x uncomment this code to
 * use a more compatible Mcrypt based implementation
 */
//Security::engine(new \Cake\Utility\Crypto\Mcrypt());

/**
 * Setup detectors for mobile and tablet.
 */
Request::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();
    return $detector->isMobile();
});
Request::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();
    return $detector->isTablet();
});

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize
 * table, model, controller names or whatever other string is passed to the
 * inflection functions.
 *
 * Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
 * Inflector::rules('irregular', ['red' => 'redlings']);
 * Inflector::rules('uninflected', ['dontinflectme']);
 * Inflector::rules('transliteration', ['/å/' => 'aa']);
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on Plugin to use more
 * advanced ways of loading plugins
 *
 * Plugin::loadAll(); // Loads all plugins at once
 * Plugin::load('Migrations'); //Loads a single plugin named Migrations
 *
 */

Plugin::load('Migrations');

// Only try to load DebugKit in development mode
// Debug Kit should not be installed on a production system
if (Configure::read('debug')) {
    Plugin::load('DebugKit', ['bootstrap' => true]);
}
//Plugin::load('AdminLTE', ['bootstrap' => true, 'routes' => true]);

Plugin::load('Parceiros');

/**
 * Connect middleware/dispatcher filters.
 */
DispatcherFactory::add('Asset');
DispatcherFactory::add('Routing');
DispatcherFactory::add('ControllerFactory');

/**
 * Enable default locale format parsing.
 * This is needed for matching the auto-localized string output of Time() class when parsing dates.
 *
 * Also enable immutable time objects in the ORM.
 */
Type::build('time')
    ->useImmutable()
    ->useLocaleParser();
Type::build('date')
    ->useImmutable()
    ->useLocaleParser();
Type::build('datetime')
    ->useImmutable()
    ->useLocaleParser();

$acoes = ['index'=>'index','add'=>'add','edit'=>'edit','delete'=>'delete','view'=>'view','all'=>'all','none'=>'none'];

$notas = [
	'Ativar Associado',
	'Desativar Associado',
	'Mudar Plano',
	'Alterar Mensalidade',
	'Afastar Jogador',
	];

$estados = [
	'AC' => 'Acre',
	'AL' => 'Alagoas',
	'AP' => 'Amapá',
	'AM' => 'Amazonas',
	'BA' => 'Bahia', 
	'CE' => 'Ceará', 
	'DF' => 'Distrito Federal',
	'ES' => 'Espírito Santo',
	'GO' => 'Goiás',
	'MA' => 'Maranhão',
	'MT' => 'Mato Grosso',
	'MS' => 'Mato Grosso do Sul',
	'MG' => 'Minas Gerais',
	'PA' => 'Pará',
	'PB' => 'Paraíba',
	'PR' => 'Paraná',
	'PE' => 'Pernambuco',
	'PI' => 'Piauí',
	'RJ' => 'Rio de Janeiro',
	'RN' => 'Rio Grande do Norte',
	'RS' => 'Rio Grande do Sul',
	'RO' => 'Rondônia',
	'RR' => 'Roraima',
	'SC' => 'Santa Catarina',
	'SP' => 'São Paulo',
	'SE' => 'Sergipe',
	'TO' => 'Tocantins'
];


$controles = [
	'Associados'	=>	'Associados',
	'Tryout'	=>	'Tryout',
	'Time'		=>	'Times',
	'Login'		=>	'Login',
	'Configuracao'  =>	'Configuracao',
	'Permissoes'	=>	'Permissoes',
	'Log'		=>	'Log',
	'Equipamentos'	=>	'Equipamentos',
	'Equipatemp'	=>	'Sugestoes Equipamentos',
	'Inventario'	=>	'Inventario',
	'Plano'		=>	'Plano',
	'Pagamentos'	=>	'Formas de Pagamentos',
	'Mensalidade'	=>	'Mensalidade',
	'Outrotime'	=>	'Outrotime',
	'Video'		=>	'Video',
	'Videosnap'	=>	'Videosnap',
	'Parceiros'	=>	'Parceiros',
	'Notas'		=>	'Notas',
	'Relatorio'	=>	'Relatorio',
];

$slots = [
	'Capacete'	=>	'Capacete',
	'Shoulderpad'	=>	'Shoulderpad',
	'Luva'		=>	'Luva',
	'Calca'		=>	'Cal�a',
	'Chuteira'	=>	'Chuteira',
	'Camisa'	=>	'Camisa',
	'Meiao'		=>	'Mei�o'
];

$bairros = ['DF' => [
	'Alto da Boa Vista (Sobradinho)',
	'Arapoanga (Planaltina)',
	'Area Alfa (Santa Maria)',
	'Area de Desenvolvimento Economico (Aguas Claras)',
	'Area de Desenvolvimento Economico (Ceilandia)',
	'Area de Desenvolvimento Economico (Nucleo Bandeirante)',
	'Area Octogonal',
	'Area Universitaria (Planaltina)',
	'Areal (Aguas Claras)',
	'Asa Norte',
	'Asa Sul',
	'Bela Vista (Sao Sebastiao)',
	'Bonsucesso (Sao Sebastiao)',
	'Brazlandia',
	'Campus Universitario Darcy Ribeiro',
	'Candangolandia',
	'Ceilandia Centro (Ceilandia)',
	'Ceilandia Norte (Ceilandia)',
	'Ceilandia Sul (Ceilandia)',
	'Centro (Sao Sebastiao)',
	'Cidade Nova (Gama)',
	'Condominio Chacaras Ana Maria (Santa Maria)',
	'Condominio Comercial e Residencial Sobradinho (Sobradinho)',
	'Condominio Coohaplan - Itiquira (Planaltina)',
	'Condominio Guirra (Planaltina)',
	'Condominio Imperio dos Nobres (Sobradinho)',
	'Condominio Mansoes Sobradinho (Sobradinho)',
	'Condominio Mestre DArmas (Planaltina)',
	'Condominio Mirante da Serra (Sobradinho)',
	'Condominio Nosso Lar (Planaltina)',
	'Condominio Nova Esperanca (Planaltina)',
	'Condominio Parque Monaco (Planaltina)',
	'Condominio Parque Monaco II (Planaltina)',
	'Condominio Prado (Planaltina)',
	'Condominio Prive Lucena Roriz (Ceilandia)',
	'Condominio Residencial Morada Nobre (Planaltina)',
	'Condominio Residencial Santa Maria (Santa Maria)',
	'Condominio Residencial Santa Monica (Santa Maria)',
	'Condominio Santa Monica (Planaltina)',
	'Condominio Vale dos Pinheiros (Sobradinho)',
	'Cruzeiro Novo',
	'Cruzeiro Velho',
	'Del Lago I (Itapoa)',
	'Del Lago II (Itapoa)',
	'Del Lago II (Paranoa)',
	'Engenho das Lages (Gama)',
	'Estancia Mestre DArmas I (Planaltina)',
	'Estancia Mestre DArmas II (Planaltina)',
	'Estancia Mestre DArmas III (Planaltina)',
	'Estancia Mestre DArmas IV (Planaltina)',
	'Estancia Mestre DArmas V (Planaltina)',
	'Estancia Mestre DArmas VI (Planaltina)',
	'Estancia Planaltina (Planaltina)',
	'Estancias Vila Rica (Sobradinho)',
	'Fazenda Mestre DArmas (Etapa I - Planaltina)',
	'Fazenda Mestre DArmas (Etapa II - Planaltina)',
	'Fazenda Mestre DArmas (Etapa III - Planaltina)',
	'Fazendinha (Itapoa)',
	'Gama',
	'Grande Colorado (Sobradinho)',
	'Granja do Torto',
	'Guara I',
	'Guara II',
	'Incra 8 (Brazlandia)',
	'Itapoa I',
	'Itapoa II',
	'Jardim Roriz (Planaltina)',
	'Jardins Mangueiral (Sao Sebastiao)',
	'Joao Candido (Sao Sebastiao)',
	'Mansoes Abraao I (Santa Maria)',
	'Mansoes Abraao II (Santa Maria)',
	'Mansoes do Amanhecer (Planaltina)',
	'Metropolitana (Nucleo Bandeirante)',
	'Morro Azul (Sao Sebastiao)',
	'Norte (Aguas Claras)',
	'Nossa Senhora de Fatima (Planaltina)',
	'Nova Colina (Sobradinho)',
	'Nucleo Bandeirante',
	'Nucleo Rural Alagados (Santa Maria)',
	'Nucleo Rural Hortigranjeiro de Santa Maria',
	'Nucleo Rural Lago Oeste (Sobradinho)',
	'Nucleo Rural Santa Maria',
	'Nucleo Rural Vargem Bonita (Nucleo Bandeirante)',
	'Paranoa',
	'Paranoa Parque (Paranoa)',
	'Planaltina',
	'Ponte Alta (Gama)',
	'Portal do Amanhecer (Planaltina)',
	'Portal do Amanhecer I (Planaltina)',
	'Portal do Amanhecer III (Planaltina)',
	'Portal do Amanhecer V (Planaltina)',
	'Portal do Amanhecer V (Prive - Planaltina)',
	'Quadras Economicas Lucio Costa (Guara)',
	'Quinta dos Ipes (Sao Sebastiao)',
	'Quintas do Amanhecer II (Planaltina)',
	'Quintas do Amanhecer III (Planaltina)',
	'Recanto das Emas',
	'Recanto do Sossego (Planaltina)',
	'Recanto Feliz (Planaltina)',
	'Regiao dos Lagos (Sobradinho)',
	'Residencial Bica do DER (Gleba B - Planaltina)',
	'Residencial Cachoeira (Planaltina)',
	'Residencial Condominio Marissol (Planaltina)',
	'Residencial do Bosque (Sao Sebastiao)',
	'Residencial Flamboyant (Planaltina)',
	'Residencial Itaipu (Sao Sebastiao)',
	'Residencial Morro da Cruz (Sao Sebastiao)',
	'Residencial Nova Esperanca (Planaltina)',
	'Residencial Nova Planaltina (Planaltina)',
	'Residencial Samauma (Planaltina)',
	'Residencial Sandray (Planaltina)',
	'Residencial Santos Dumont (Santa Maria)',
	'Residencial Sao Francisco I (Planaltina)',
	'Residencial Sao Francisco II (Planaltina)',
	'Residencial Sarandy (Planaltina)',
	'Residencial Vitoria (Sao Sebastiao)',
	'Riacho Fundo I',
	'Riacho Fundo II',
	'Samambaia Norte (Samambaia)',
	'Samambaia Sul (Samambaia)',
	'San Sebastian (Planaltina)',
	'Santa Maria',
	'Sao Bartolomeu (Sao Sebastiao)',
	'Sao Francisco (Sao Sebastiao)',
	'Sao Gabriel (Sao Sebastiao)',
	'Serra Azul (Sobradinho)',
	'Setor Administrativo (Planaltina)',
	'Setor Central (Gama)',
	'Setor Central (Vila Estrutural - Guara)',
	'Setor Comercial Central (Planaltina)',
	'Setor de Areas Isoladas Sul (Nucleo Bandeirante)',
	'Setor de Chacaras Corrego da Onca (Nucleo Bandeirante)',
	'Setor de Desenvolvimento Economico (Taguatinga)',
	'Setor de Educacao (Planaltina)',
	'Setor de Habitacoes Individuais Norte',
	'Setor de Habitacoes Individuais Sul',
	'Setor de Hoteis e Diversoes (Planaltina)',
	'Setor de Industrias Bernardo Sayao (Nucleo Bandeirante)',
	'Setor de Mansoes de Sobradinho',
	'Setor de Mansoes do Lago Norte',
	'Setor de Mansoes Dom Bosco',
	'Setor de Mansoes Mestre DArmas (Planaltina)',
	'Setor de Mansoes Park Way',
	'Setor de Materiais de Construcao (Ceilandia)',
	'Setor de Postos e Moteis Norte (Lago Norte)',
	'Setor de Postos e Moteis Sul (Nucleo Bandeirante)',
	'Setor Economico de Sobradinho (Sobradinho)',
	'Setor Especial (Vila Estrutural - Guara)',
	'Setor Habitacional Arniqueira (Aguas Claras)',
	'Setor Habitacional Contagem (Sobradinho)',
	'Setor Habitacional Fercal (Sobradinho)',
	'Setor Habitacional Jardim Botanico (Lago Sul)',
	'Setor Habitacional Por do Sol (Ceilandia)',
	'Setor Habitacional Ribeirao (Santa Maria)',
	'Setor Habitacional Samambaia (Vicente Pires)',
	'Setor Habitacional Sol Nascente (Ceilandia)',
	'Setor Habitacional Taquari (Lago Norte)',
	'Setor Habitacional Tororo (Santa Maria)',
	'Setor Habitacional Vereda Grande (Taguatinga)',
	'Setor Habitacional Vicente Pires',
	'Setor Habitacional Vicente Pires (Taguatinga)',
	'Setor Hospitalar (Planaltina)',
	'Setor Industrial (Ceilandia)',
	'Setor Industrial (Gama)',
	'Setor Industrial (Sobradinho)',
	'Setor Industrial (Taguatinga)',
	'Setor Leste (Gama)',
	'Setor Leste (Vila Estrutural - Guara)',
	'Setor Mansoes Itiquira (Planaltina)',
	'Setor Meireles (Santa Maria)',
	'Setor Militar Urbano',
	'Setor Noroeste',
	'Setor Norte (Brazlandia)',
	'Setor Norte (Gama)',
	'Setor Norte (Planaltina)',
	'Setor Norte (Vila Estrutural - Guara)',
	'Setor Oeste (Gama)',
	'Setor Oeste (Sobradinho II)',
	'Setor Oeste (Vila Estrutural - Guara)',
	'Setor Placa da Mercedes (Nucleo Bandeirante)',
	'Setor Policial Sul',
	'Setor Recreativo e Cultural (Planaltina)',
	'Setor Residencial Leste (Planaltina)',
	'Setor Residencial Mestre DArmas (Planaltina)',
	'Setor Residencial Norte (Planaltina)',
	'Setor Residencial Oeste (Planaltina)',
	'Setor Residencial Oeste (Sao Sebastiao)',
	'Setor Sudoeste',
	'Setor Sul (Brazlandia)',
	'Setor Sul (Gama)',
	'Setor Sul (Planaltina)',
	'Setor Tradicional (Brazlandia)',
	'Setor Tradicional (Planaltina)',
	'Setor Tradicional (Sao Sebastiao)',
	'Setores Complementares',
	'Sobradinho',
	'Sul (Aguas Claras)',
	'Taguatinga Centro (Taguatinga)',
	'Taguatinga Norte (Taguatinga)',
	'Taguatinga Sul (Taguatinga)',
	'Taquara (Planaltina)',
	'Vale das Acacias (Sobradinho)',
	'Vale do Amanhecer (Planaltina)',
	'Vale do Sol (Planaltina)',
	'Varjao',
	'Veneza I (Planaltina)',
	'Veneza II (Planaltina)',
	'Veneza III (Planaltina)',
	'Veredas (Brazlandia)',
	'Vila Cauhy (Nucleo Bandeirante)',
	'Vila da Telebrasilia',
	'Vila Dimas (Planaltina)',
	'Vila do Boa (Sao Sebastiao)',
	'Vila Estrutural',
	'Vila Feliz (Planaltina)',
	'Vila Nossa Senhora de Fatima (Planaltina)',
	'Vila Nova (Sao Sebastiao)',
	'Vila Planalto',
	'Vila Rabelo I (Sobradinho)',
	'Vila Rabelo II (Sobradinho)',
	'Vila Sao Jose (Brazlandia)',
	'Vila Sao Jose (Sao Sebastiao)',
	'Vila Sao Jose (Vicente Pires)',
	'Vila Vicentina (Planaltina)',
	'Zona Civico-Administrativa',
	'Zona de Dinamizacao (Santa Maria)',
	'Zona Industrial',
	'Zona Industrial (Guara)',
	],
	'GO' => ['Valparaiso','Vila Isabel'],
];

$dominio = explode('.',$_SERVER['SERVER_NAME']);
$dominio = ($dominio[0]=='dev') ? $dominio[1] : $dominio[0];

Configure::write('notas',$notas);
Configure::write('estados',$estados);
Configure::write('controles',$controles);
Configure::write('acoes',$acoes);
Configure::write('slots',$slots);
Configure::write('bairros',$bairros);
Configure::write('dominio',$dominio);

Configure::write('CakePdf', [
	'engine' => 'CakePdf.WkHtmlToPdf',
	'margin' => [
	    'bottom' => 15,
	    'left' => 50,
	    'right' => 30,
	    'top' => 45
	],
	'options' => [
		'print-media-type' => false,
		'outline' => true,
		'dpi' => 96
	],
	'orientation' => 'landscape',
	'download' => true
]);
