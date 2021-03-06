<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Configuracao Controller
 *
 * @property \App\Model\Table\ConfiguracaoTable $Configuracao
 */
class ConfiguracaoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $configuracao = $this->paginate($this->Configuracao);

        $this->set(compact('configuracao'));
        $this->set('_serialize', ['configuracao']);
    }

    /**
     * View method
     *
     * @param string|null $id Configuracao id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configuracao = $this->Configuracao->get($id, [
            'contain' => []
        ]);

        $this->set('configuracao', $configuracao);
        $this->set('_serialize', ['configuracao']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configuracao = $this->Configuracao->newEntity();
        if ($this->request->is('post')) {
            $configuracao = $this->Configuracao->patchEntity($configuracao, $this->request->data);
            if ($this->Configuracao->save($configuracao)) {
                $this->Flash->success(__('The configuracao has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuracao could not be saved. Please, try again.'));
            }
        }
        $this->set('controllers',Configure::read('controles'));
        $this->set(compact('configuracao'));
        $this->set('_serialize', ['configuracao']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuracao id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configuracao = $this->Configuracao->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuracao = $this->Configuracao->patchEntity($configuracao, $this->request->data);
            if ($this->Configuracao->save($configuracao)) {
                $this->Flash->success(__('The configuracao has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuracao could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('configuracao'));
        $this->set('_serialize', ['configuracao']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuracao id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configuracao = $this->Configuracao->get($id);
        if ($this->Configuracao->delete($configuracao)) {
            $this->Flash->success(__('The configuracao has been deleted.'));
        } else {
            $this->Flash->error(__('The configuracao could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
