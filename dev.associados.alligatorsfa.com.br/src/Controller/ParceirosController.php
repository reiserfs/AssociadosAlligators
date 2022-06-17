<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Parceiros Controller
 *
 * @property \App\Model\Table\ParceirosTable $Parceiros
 */
class ParceirosController extends AppController
{

        public function login()
        {
                if ($this->request->is('post')) {
                        $user = $this->Auth->identify();
                        if ($user) {
                                $this->Auth->setUser($user);
				$id = $this->Auth->user('id');
				$lastLogin = $this->Parceiros->query();
		
				$lastLogin->update()
					->set(['ultimo_login'=>date("Y-m-d H:i:s")])
					->where(['id' => $id])
					->execute();
                                return $this->redirect($this->Auth->redirectUrl());
                        }
                        $this->Flash->error(__('Invalid username or password, try again'));
                }
        }

        public function logout()
        {
                return $this->redirect($this->Auth->logout());
        }

    public function check($id = null)
    {
	if(!empty($this->request->data['valor'])) $id = $this->request->data['valor'];    
	if(!empty($id)) {
		$this->Associados = TableRegistry::get('Associados');
		$naopago = 0;
		$conditions = 'Associados.cpf = "'.$id.'"' . 
			      'OR Associados.carteira = "'.$id.'"';

		$associado = $this->Associados->find('all', ['conditions' => $conditions, 'contain' => ['Mensalidade','Time','Plano']] );
		$associado = $associado->first();

		if(isset($associado['mensalidade'])) {
			foreach($associado['mensalidade'] as $gvmens){
				if(!($gvmens['valor_pago'] >= $gvmens['valor_base']) && ($gvmens['vencimento'] < Time::now())) {
					$naopago++;
				}
			}
		}

		$this->set('associado', $associado);
		$this->set('naopago', $naopago);
		$this->set('_serialize', ['associado']);
	}
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $parceiros = $this->paginate($this->Parceiros);

        $this->set(compact('parceiros'));
        $this->set('_serialize', ['parceiros']);
    }

    /**
     * View method
     *
     * @param string|null $id Parceiro id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parceiro = $this->Parceiros->get($id, [
            'contain' => []
        ]);

        $this->set('parceiro', $parceiro);
        $this->set('_serialize', ['parceiro']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parceiro = $this->Parceiros->newEntity();
        if ($this->request->is('post')) {
	    $this->request->data['data_criacao'] = [ 'day' 	=> date('d'), 'month'	=> date('m'), 'year'	=> date('Y') ];
            $parceiro = $this->Parceiros->patchEntity($parceiro, $this->request->data);
            if ($this->Parceiros->save($parceiro)) {
                $this->Flash->success(__('The parceiro has been saved.'));
	        $this->SysAna->logActions($this->name,'Adicionar',[$parceiro->user,$parceiro->descricao],$this->Auth->user('id'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parceiro could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parceiro'));
        $this->set('_serialize', ['parceiro']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parceiro id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parceiro = $this->Parceiros->get($id, [
            'contain' => []
        ]);

	if(empty($this->request->data['password']))
		$this->request->data['password'] = $parceiro->password;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $parceiro = $this->Parceiros->patchEntity($parceiro, $this->request->data);
            if ($this->Parceiros->save($parceiro)) {
                $this->Flash->success(__('The parceiro has been saved.'));
	        $this->SysAna->logActions($this->name,'Editar',[$parceiro->user,$parceiro->descricao],$this->Auth->user('id'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parceiro could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parceiro'));
        $this->set('_serialize', ['parceiro']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parceiro id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parceiro = $this->Parceiros->get($id);
        if ($this->Parceiros->delete($parceiro)) {
            $this->Flash->success(__('The parceiro has been deleted.'));
	        $this->SysAna->logActions($this->name,'Excluir',[$parceiro->user,$paceiro->descricao],$this->Auth->user('id'));
        } else {
            $this->Flash->error(__('The parceiro could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
