<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Time Controller
 *
 * @property \App\Model\Table\TimeTable $Time
 */
class TimeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $time = $this->paginate($this->Time);

        $this->set(compact('time'));
        $this->set('_serialize', ['time']);
    }

    /**
     * View method
     *
     * @param string|null $id Time id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $time = $this->Time->get($id, [
            'contain' => []
        ]);

        $this->set('time', $time);
        $this->set('_serialize', ['time']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $time = $this->Time->newEntity();
        if ($this->request->is('post')) {
            $time = $this->Time->patchEntity($time, $this->request->data);
            if ($this->Time->save($time)) {
                $this->Flash->success(__('The time has been saved.'));
	        $this->SysAna->logActions($this->name,'Adicionado',[$time->nome],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The time could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('time'));
        $this->set('_serialize', ['time']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Time id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $time = $this->Time->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $time = $this->Time->patchEntity($time, $this->request->data);
            if ($this->Time->save($time)) {
                $this->Flash->success(__('The time has been saved.'));
	        $this->SysAna->logActions($this->name,'Editado',[$id,$time->nome],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The time could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('time'));
        $this->set('_serialize', ['time']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Time id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $time = $this->Time->get($id);
        if ($this->Time->delete($time)) {
	        $this->SysAna->logActions($this->name,'Excluido',[$id,$time->nome],$this->Auth->user('id'));
            $this->Flash->success(__('The time has been deleted.'));
        } else {
            $this->Flash->error(__('The time could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
