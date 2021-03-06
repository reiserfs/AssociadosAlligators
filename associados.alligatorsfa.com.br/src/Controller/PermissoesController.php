<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Permissoes Controller
 *
 * @property \App\Model\Table\PermissoesTable $Permissoes
 */
class PermissoesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {	
	$conditions = null;
	$whitelist = array(
		'Login.user',
		'controller',
		'action',
	);
	if(isset($this->request->query['filtro'])){
		$conditions =  	'Permissoes.controller LIKE "%'.$this->request->query['filtro'].
				'%" OR Permissoes.action LIKE "%'.$this->request->query['filtro'].
				'%" OR Login.user LIKE "%'.$this->request->query['filtro'].'%"';
		$this->set('filtro',$this->request->query['filtro']);
	}
        $this->paginate = ['contain' => ['Login'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $permissoes = $this->paginate($this->Permissoes);

        $this->set(compact('permissoes'));
        $this->set('_serialize', ['permissoes']);
    }

    /**
     * View method
     *
     * @param string|null $id Permisso id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $permisso = $this->Permissoes->get($id, [
            'contain' => ['Login']
        ]);

        $this->set('permisso', $permisso);
        $this->set('_serialize', ['permisso']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $permisso = $this->Permissoes->newEntity();
        if ($this->request->is('post')) {
            $permisso = $this->Permissoes->patchEntity($permisso, $this->request->data);
            if ($this->Permissoes->save($permisso)) {
                $this->Flash->success(__('The permisso has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The permisso could not be saved. Please, try again.'));
            }
        }
        $this->set('controllers',Configure::read('controles'));
        $this->set('actions',Configure::read('acoes'));
        $logins = $this->Permissoes->Login->find('list', ['keyField' => 'id', 'valueField' => 'user', 'limit' => 200]);
        $this->set(compact('permisso', 'logins'));
        $this->set('_serialize', ['permisso']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Permisso id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $permisso = $this->Permissoes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $permisso = $this->Permissoes->patchEntity($permisso, $this->request->data);
            if ($this->Permissoes->save($permisso)) {
                $this->Flash->success(__('The permisso has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The permisso could not be saved. Please, try again.'));
            }
        }
        $this->set('controllers',Configure::read('controles'));
        $this->set('actions',Configure::read('acoes'));
        $logins = $this->Permissoes->Login->find('list', ['keyField' => 'id', 'valueField' => 'user', 'limit' => 200]);
        $this->set(compact('permisso', 'logins'));
        $this->set('_serialize', ['permisso']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Permisso id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $permisso = $this->Permissoes->get($id);
        if ($this->Permissoes->delete($permisso)) {
            $this->Flash->success(__('The permisso has been deleted.'));
        } else {
            $this->Flash->error(__('The permisso could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
