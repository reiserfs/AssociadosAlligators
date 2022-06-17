<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Equipatemp Controller
 *
 * @property \App\Model\Table\EquipatempTable $Equipatemp
 */
class EquipatempController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $equipatemp = $this->paginate($this->Equipatemp);

        $this->set(compact('equipatemp'));
        $this->set('_serialize', ['equipatemp']);
    }

    /**
     * View method
     *
     * @param string|null $id Equipatemp id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $equipatemp = $this->Equipatemp->get($id, [
            'contain' => []
        ]);

        $this->set('equipatemp', $equipatemp);
        $this->set('_serialize', ['equipatemp']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipatemp = $this->Equipatemp->newEntity();
        if ($this->request->is('post')) {
            $equipatemp = $this->Equipatemp->patchEntity($equipatemp, $this->request->data);
            if ($this->Equipatemp->save($equipatemp)) {
                $this->Flash->success(__('The equipatemp has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipatemp could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('equipatemp'));
        $this->set('_serialize', ['equipatemp']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipatemp id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipatemp = $this->Equipatemp->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipatemp = $this->Equipatemp->patchEntity($equipatemp, $this->request->data);
            if ($this->Equipatemp->save($equipatemp)) {
                $this->Flash->success(__('The equipatemp has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipatemp could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('equipatemp'));
        $this->set('_serialize', ['equipatemp']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipatemp id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipatemp = $this->Equipatemp->get($id);
        if ($this->Equipatemp->delete($equipatemp)) {
            $this->Flash->success(__('The equipatemp has been deleted.'));
        } else {
            $this->Flash->error(__('The equipatemp could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
