<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\Time;

/**
 * Notas Controller
 *
 * @property \App\Model\Table\NotasTable $Notas
 */
class NotasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Associados', 'Login']
        ];
        $notas = $this->paginate($this->Notas);

        $this->set(compact('notas'));
        $this->set('_serialize', ['notas']);
    }

    /**
     * View method
     *
     * @param string|null $id Nota id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nota = $this->Notas->get($id, [
            'contain' => ['Associados', 'Login']
        ]);

        $this->set('nota', $nota);
        $this->set('_serialize', ['nota']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nota = $this->Notas->newEntity();
        if ($this->request->is('post')) {
	    $this->request->data['data'] = Time::createFromFormat('Y-m-d', date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['data']))));
            $nota = $this->Notas->patchEntity($nota, $this->request->data);
            if ($this->Notas->save($nota)) {
                $this->Flash->success(__('The nota has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The nota could not be saved. Please, try again.'));
            }
        }
	$this->set('tiponota',array_combine(Configure::read('notas'),Configure::read('notas')));
        $associados = $this->Notas->Associados->find('list', ['keyField' => 'id', 'valueField' => 'nome','limit' => 200]);
        $login = $this->Notas->Login->find('list', ['keyField' => 'id', 'valueField' => 'user','limit' => 200]);
        $this->set(compact('nota', 'associados', 'login'));
        $this->set('_serialize', ['nota']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Nota id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nota = $this->Notas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
	    $this->request->data['data'] = Time::createFromFormat('Y-m-d', date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['data']))));
            $nota = $this->Notas->patchEntity($nota, $this->request->data);
            if ($this->Notas->save($nota)) {
                $this->Flash->success(__('The nota has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The nota could not be saved. Please, try again.'));
            }
        }
	$this->set('tiponota',array_combine(Configure::read('notas'),Configure::read('notas')));
        $associados = $this->Notas->Associados->find('list', ['keyField' => 'id', 'valueField' => 'nome','limit' => 200]);
        $login = $this->Notas->Login->find('list', ['keyField' => 'id', 'valueField' => 'user','limit' => 200]);
        $this->set(compact('nota', 'associados', 'login'));
        $this->set('_serialize', ['nota']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Nota id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nota = $this->Notas->get($id);
        if ($this->Notas->delete($nota)) {
            $this->Flash->success(__('The nota has been deleted.'));
        } else {
            $this->Flash->error(__('The nota could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
