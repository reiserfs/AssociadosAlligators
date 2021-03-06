<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Plano Controller
 *
 * @property \App\Model\Table\PlanoTable $Plano
 */
class PlanoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $plano = $this->paginate($this->Plano);

        $this->set(compact('plano'));
        $this->set('_serialize', ['plano']);
    }

    /**
     * View method
     *
     * @param string|null $id Plano id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plano = $this->Plano->get($id, [
            'contain' => ['Associados']
        ]);

        $this->set('plano', $plano);
        $this->set('_serialize', ['plano']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $plano = $this->Plano->newEntity();
        if ($this->request->is('post')) {
            $plano = $this->Plano->patchEntity($plano, $this->request->data);
            if ($this->Plano->save($plano)) {
                $this->Flash->success(__('The plano has been saved.'));
	            $this->SysAna->logActions($this->name,'Adicionado',[$plano->nome_plano],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The plano could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('plano'));
        $this->set('_serialize', ['plano']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Plano id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $plano = $this->Plano->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plano = $this->Plano->patchEntity($plano, $this->request->data);
            if ($this->Plano->save($plano)) {
                $this->Flash->success(__('The plano has been saved.'));
	        $this->SysAna->logActions($this->name,'Editado',[$id,$plano->nome_plano],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The plano could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('plano'));
        $this->set('_serialize', ['plano']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Plano id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plano = $this->Plano->get($id);
        if ($this->Plano->delete($plano)) {
	        $this->SysAna->logActions($this->name,'Excluido',[$id,$plano->nome_plano],$this->Auth->user('id'));
            $this->Flash->success(__('The plano has been deleted.'));
        } else {
            $this->Flash->error(__('The plano could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
