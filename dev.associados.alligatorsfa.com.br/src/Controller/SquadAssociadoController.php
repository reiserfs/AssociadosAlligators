<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SquadAssociado Controller
 *
 * @property \App\Model\Table\SquadAssociadoTable $SquadAssociado
 */
class SquadAssociadoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Squad', 'Posicao', 'Associados']
        ];
        $squadAssociado = $this->paginate($this->SquadAssociado);

        $this->set(compact('squadAssociado'));
        $this->set('_serialize', ['squadAssociado']);
    }

    /**
     * View method
     *
     * @param string|null $id Squad Associado id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $squadAssociado = $this->SquadAssociado->get($id, [
            'contain' => ['Squad', 'Posicao', 'Associados']
        ]);

        $this->set('squadAssociado', $squadAssociado);
        $this->set('_serialize', ['squadAssociado']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $squadAssociado = $this->SquadAssociado->newEntity();
        if ($this->request->is('post')) {
            $squadAssociado = $this->SquadAssociado->patchEntity($squadAssociado, $this->request->data);
            if ($this->SquadAssociado->save($squadAssociado)) {
                $this->Flash->success(__('The squad associado has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The squad associado could not be saved. Please, try again.'));
            }
        }
        $squads = $this->SquadAssociado->Squad->find('list', ['limit' => 200]);
        $posicaos = $this->SquadAssociado->Posicao->find('list', ['limit' => 200]);
        $associados = $this->SquadAssociado->Associados->find('list', ['limit' => 200]);
        $this->set(compact('squadAssociado', 'squads', 'posicaos', 'associados'));
        $this->set('_serialize', ['squadAssociado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Squad Associado id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $squadAssociado = $this->SquadAssociado->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $squadAssociado = $this->SquadAssociado->patchEntity($squadAssociado, $this->request->data);
            if ($this->SquadAssociado->save($squadAssociado)) {
                $this->Flash->success(__('The squad associado has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The squad associado could not be saved. Please, try again.'));
            }
        }
        $squads = $this->SquadAssociado->Squad->find('list', ['limit' => 200]);
        $posicaos = $this->SquadAssociado->Posicao->find('list', ['limit' => 200]);
        $associados = $this->SquadAssociado->Associados->find('list', ['limit' => 200]);
        $this->set(compact('squadAssociado', 'squads', 'posicaos', 'associados'));
        $this->set('_serialize', ['squadAssociado']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Squad Associado id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $squadAssociado = $this->SquadAssociado->get($id);
        if ($this->SquadAssociado->delete($squadAssociado)) {
            $this->Flash->success(__('The squad associado has been deleted.'));
        } else {
            $this->Flash->error(__('The squad associado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
