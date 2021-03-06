<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Database\Type;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public $dominio;
    public function initialize()
    {
        parent::initialize();
	$this->dominio 	= Configure::read('dominio');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('SysAna');
	$this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
	if($this->dominio == 'associados') {
		$this->loadComponent('Auth', [
		    'authenticate' => [
			'Form' => [
				'userModel' => 'Login',
				'fields' => ['username' => 'user', 'password' => 'password'],
				'scope' => ['ativo' => true],
				'contain' => 'Permissoes'
				]
		    ],
		    'loginAction' => [
			'controller' => 'Login',
			'action' => 'login',
		    ],
		    'loginRedirect' => [
			'controller' => 'Perfil',
			'action' => 'index'
		    ],
		    'logoutRedirect' => [
			'controller' => 'Login',
			'action' => 'login',
		    ],
		    'unauthorizedRedirect' => [
			'controller' => 'Pages',
			'action' => 'display',
			'noauth'
		    ],
		    'authError' => 'Sem Permissao',

		    'authorize' => 'Controller'

		]);
	}
	if($this->dominio == 'parceiros') {
		$this->loadComponent('Auth', [
		    'authenticate' => [
			'Form' => [
				'userModel' => 'Parceiros',
				'fields' => ['username' => 'user', 'password' => 'password'],
				'scope' => ['ativo' => true],
				]
		    ],
		    'loginAction' => [
			'controller' => 'Parceiros',
			'action' => 'login',
		    ],
		    'loginRedirect' => [
			'controller' => 'Parceiros',
			'action' => 'check'
		    ],
		    'logoutRedirect' => [
			'controller' => 'Parceiros',
			'action' => 'login',
		    ],
		    'unauthorizedRedirect' => [
			'controller' => 'Pages',
			'action' => 'display',
			'noauth'
		    ],
		    'authError' => 'Sem Permissao',

		    'authorize' => 'Controller'

		]);
	}
    }


    public function beforeFilter(Event $event)
    {
	$this->_userModel = 'Login';
        //$this->Auth->allow(['index', 'view', 'display', 'edit', 'add']);
	$this->Auth->allow(['display','logout','cadastro','tryout','login']);
	$this->set('userDetails',$this->Auth->user());
	$this->Security->config('unlockedActions', ['login','vdel','edit','vadd','vedit']);
	if (empty($this->params['imgfoto'])) {
		$this->Security->requireSecure();
	}
    }

    public function forceSSL()
    {
	return $this->redirect('https://' . env('SERVER_NAME') . $this->request->here);
    }
    
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
	//    $this->viewBuilder()->theme('AdminLTE');
	if($this->dominio == 'associados')  $this->set('theme', Configure::read('Theme'));
	if($this->dominio == 'parceiros')  $this->viewBuilder()->theme('Parceiros'); 
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function isAuthorized($user)
    {
	switch($this->dominio) {
		case 'associados':
			if($this->name == 'Perfil' || $this->request->params['action'] == 'imgfoto') return true;
			$value_action = (array_search($this->name,array_column($user['permissoes'],'controller')) > -1) ? 
				array_keys(array_column($user['permissoes'],'controller'),$this->name) : false;
			if (!$value_action) return false;
			foreach($value_action as $v) 
				if ($this->request->params['action'] == $user['permissoes'][$v]['action'] || $user['permissoes'][$v]['action'] == 'all') return true;
			break;
		case 'parceiros':
			if((in_array($this->name,['Parceiros'])) && (in_array($this->request->params['action'],['check']))) return true;
			if((in_array($this->name,['Associados'])) && (in_array($this->request->params['action'],['imgfoto']))) return true;
			break;
		case 'torcedor':
			break;
	}
	return false;
    }
}
