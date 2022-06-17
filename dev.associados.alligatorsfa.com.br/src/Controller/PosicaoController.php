<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Posicao Controller
 *
 * @property \App\Model\Table\PosicaoTable $Posicao
 */
class PosicaoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $posicao = $this->paginate($this->Posicao);


	$this->set('timesposicoes',Configure::read('timesposicoes'));
        $this->set(compact('posicao'));
        $this->set('_serialize', ['posicao']);
    }

    /**
     * View method
     *
     * @param string|null $id Posicao id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $posicao = $this->Posicao->get($id, [
            'contain' => ['SquadAssociado']
        ]);

        $this->set('posicao', $posicao);
        $this->set('_serialize', ['posicao']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $posicao = $this->Posicao->newEntity();
        if ($this->request->is('post')) {
            $posicao = $this->Posicao->patchEntity($posicao, $this->request->data);
            if ($this->Posicao->save($posicao)) {
                $this->Flash->success(__('The posicao has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The posicao could not be saved. Please, try again.'));
            }
        }
	$this->set('timesposicoes',Configure::read('timesposicoes'));
        $this->set(compact('posicao'));
        $this->set('_serialize', ['posicao']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Posicao id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $posicao = $this->Posicao->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $posicao = $this->Posicao->patchEntity($posicao, $this->request->data);
            if ($this->Posicao->save($posicao)) {
                $this->Flash->success(__('The posicao has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The posicao could not be saved. Please, try again.'));
            }
        }
	$this->set('timesposicoes',Configure::read('timesposicoes'));
        $this->set(compact('posicao'));
        $this->set('_serialize', ['posicao']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Posicao id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $posicao = $this->Posicao->get($id);
        if ($this->Posicao->delete($posicao)) {
            $this->Flash->success(__('The posicao has been deleted.'));
        } else {
            $this->Flash->error(__('The posicao could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
