<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Login Controller
 *
 * @property \App\Model\Table\LoginTable $Login
 */
class LoginController extends AppController
{

        public function login()
        {
		$this->set('success',false);
                if ($this->request->is('post')) {
                        $user = $this->Auth->identify();
                        if ($user) {
	//	$this->log(debug($this->request), 'debug');
                                $this->Auth->setUser($user);
				$id = $this->Auth->user('associado_id');
				$lastLogin = $this->Login->query();
		
				$lastLogin->update()
					->set(['ultimo_login'=>date("Y-m-d H:i:s")])
					->where(['associado_id' => $id])
					->execute();
                                if (!$this->request->is('json')) return $this->redirect($this->Auth->redirectUrl());
				else $this->set('success',true);
                        }
			else $this->Flash->error(__('Invalid username or password, try again'));
                }
                $this->set('_serialize', ['success']);
        }

        public function logout()
        {
                return $this->redirect($this->Auth->logout());
        }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

	$conditions = null;
	$whitelist = array(
		'Associados.nome',
		'id',
		'ativo',
		'user',
		'ultimo_login',
		'data_criacao',
	);
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Associados.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.email LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Login.user LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Login.id LIKE "%'.$this->request->query['filtro'].'%"';		       
		$this->set('filtro',$this->request->query['filtro']);
	}
        $this->paginate = ['contain' => ['Associados','Permissoes'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $login = $this->paginate($this->Login);
        $this->set(compact('login'));
        $this->set('_serialize', ['login']);

    }

    /**
     * View method
     *
     * @param string|null $id Login id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $login = $this->Login->get($id, [
            'contain' => ['Associados','Permissoes']
        ]);

        $this->set('login', $login);
        $this->set('_serialize', ['login']);
    }

    public function perm($id = null)
    {
        $login = $this->Login->get($id, [
            'contain' => ['Associados','Permissoes']
        ]);

        $permissoes = $this->Login->Permissoes->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
		$this->Login->Permissoes->deleteAll(['Permissoes.login_id' => $id ]);
		$permArray = array();
		$permArray[] = ['controller'=>'Perfil','action'=>'index','login_id'=>$id];
		foreach($this->request->data as $key => $value) 
			if(($value) && !($value=='none'))
				$permArray[] = ['controller'=>$key,'action'=>$value,'login_id'=>$id];

		    $created = $this->Login->Permissoes->newEntities($permArray);
		    foreach ($created as $create) $this->Login->Permissoes->save($create);
		    if (!$create->errors()) {
	        	$this->SysAna->logActions($this->name,'Permissoes',[$id,$login->user,$login->associado->nome],$this->Auth->user('id'));
            		$this->Flash->success(__('Permissoes atualizadas.'));
			return $this->redirect(array('action' => 'perm',$id));                 
		    } else {
            		 $this->Flash->error(__('Erro ao gravar permissoes.'));
		    }	
        }
        $this->set('controllers',Configure::read('controles'));
        $this->set('actions',Configure::read('acoes'));
        $this->set('login', $login);
        $this->set('permissoes', $permissoes);
        $this->set('_serialize', ['login']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $login = $this->Login->newEntity();
        if ($this->request->is('post')) {
		$this->request->data['data_criacao'] = [ 'day' 	=> date('d'), 'month'	=> date('m'), 'year'	=> date('Y') ];
            	$login = $this->Login->patchEntity($login, $this->request->data);
            if ($this->Login->save($login)) {
                $this->Flash->success(__('The login has been saved.'));
	        $this->SysAna->logActions($this->name,'Adicionar',[$login->user,$login->associado_id],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The login could not be saved. Please, try again.'));
            }
        }
        $associado = $this->Login->Associados->find('list', [
                                'keyField' => 'id',
                                'valueField' => function($row) { return $row['nome'] . ' (' . $row['apelido'] . ') ' . $row['sobrenome']; },
                                'limit' => 200
        ]);

        $this->set(compact('login','associado'));
        $this->set('_serialize', ['login']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Login id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $login = $this->Login->get($id, [
            'contain' => ['Associados']
        ]);
	
	if(empty($this->request->data['password']))
		$this->request->data['password'] = $login->password;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $login = $this->Login->patchEntity($login, $this->request->data);
            if ($this->Login->save($login)) {
                $this->Flash->success(__('The login has been saved.'));
	        $this->SysAna->logActions($this->name,'Editado',[$id,$login->user,$login->associado->nome],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
		    die(debug($login->errors()));
                $this->Flash->error(__('The login could not be saved. Please, try again.'));
            }
        }
        $associado = $this->Login->Associados->find('list', [
				'keyField' => 'id', 
				'valueField' => function($row) { return $row['nome'] . ' (' . $row['apelido'] . ') ' . $row['sobrenome']; }, 
				'limit' => 200
	]);

        $this->set(compact('login','associado'));
        $this->set('_serialize', ['login']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Login id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $login = $this->Login->get($id);

	$this->Login->Permissoes->deleteAll([
		'Permissoes.login_id' => $id
	]);

        if ($this->Login->delete($login)) {
	    $this->SysAna->logActions($this->name,'Excluido',[$id,$login->user,$login->associado_id],$this->Auth->user('id'));
            $this->Flash->success(__('The login has been deleted.'));
        } else {
            $this->Flash->error(__('The login could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function cadastro()
    {
        if ($this->request->is('post')) {
            $this->request->data['nascimento'] = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['nascimento'])));
	    $this->request->data['cpf'] = preg_replace('#[^0-9]#', '', $this->request->data['cpf']);
            $cadastro = $this->Login->Associados->find('all')
		    ->select(['id','nome','email'])
		    ->where([
			    'Associados.email'	=>	$this->request->data['email'],
			    'Associados.cpf'	=>	$this->request->data['cpf'],
			    'Associados.nascimento'	=>	$this->request->data['nascimento'],
		    ]);
	    	$row = $cadastro->first();
	    	if($row) {
			$this->request->data['user'] = $row->email;
			$this->request->data['password'] = $this->request->data['senha'];
			$this->request->data['ativo'] = '1';
			$this->request->data['associado_id'] = $row->id;
			$this->request->data['data_criacao'] = [ 'day' 	=> date('d'), 'month'	=> date('m'), 'year'	=> date('Y') ];
            		$login = $this->Login->find('all')->where(['Login.user' => $row->email]);
			$login = $login->first();
		}
	    if(!empty($login))  $this->request->data['id'] = $login->id;
            else $login = $this->Login->newEntity();
            $login = $this->Login->patchEntity($login, $this->request->data);
            if ($this->Login->save($login)) {
		$permissao = ['controller'=>'Perfil','action'=>'index','login_id'=>$login->id];
        	$permisso = $this->Login->Permissoes->newEntity();
            	$permisso = $this->Login->Permissoes->patchEntity($permisso, $permissao);
            	if ($this->Login->Permissoes->save($permisso)) {
                	$this->Flash->success(__('Sua senha foi cadastrada com sucesso favor tentar login novamente.'));
                	if (!$this->request->is('json')) return $this->redirect(['action' => 'login']);
                	$this->set('success',true);
		}
		else $this->Flash->error(__('The cadastro could not be saved. erro na permissao.'));
            } else {
                $this->Flash->error(__('Erro ao tentar salvar senha. Verifique os dados ou Faca outro cadastro'));
                $this->set('erro',true);
                $this->set('success',false);
            }
        }
        $login = $this->Login->newEntity();
        $this->set(compact('login'));
        $this->set('_serialize', ['login','success']);
    }
    public function tryout()
    {
	$this->Tryout = TableRegistry::get('Tryout');
        $associado = $this->Tryout->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['nascimento'] = Time::parseDate($this->request->data['nascimento']);
            $this->request->data['data_acesso'] = Time::parseDate($this->request->data['data_acesso']);
            $this->request->data['data_formacao'] = Time::parseDate($this->request->data['data_formacao']);
            $associado = $this->Tryout->patchEntity($associado, $this->request->data);

            unset($associado->foto);

            if ($this->Tryout->save($associado)) {
                $this->Flash->success(__('Seus dados para seletiva foram salvos com sucesso'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Erro ao enviar os dados, tente novamente.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
	$this->set('bairros',Configure::read('bairros'));
        $time = $this->Tryout->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
	$plano = [$this->SysAna->globalconfig('PLANO_ATIVO')=>'Padrao']; 
        $this->set(compact('associado', 'time','plano'));
        $this->set('_serialize', ['associado']);
    }
}
