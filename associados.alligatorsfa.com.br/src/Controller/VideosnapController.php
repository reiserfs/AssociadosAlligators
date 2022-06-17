<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Videosnap Controller
 *
 * @property \App\Model\Table\VideosnapTable $Videosnap
 */
class VideosnapController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Video']
        ];
        $videosnap = $this->paginate($this->Videosnap);

        $this->set(compact('videosnap'));
        $this->set('_serialize', ['videosnap']);
    }

    /**
     * View method
     *
     * @param string|null $id Videosnap id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $videosnap = $this->Videosnap->get($id, [
            'contain' => ['Video']
        ]);

        $this->set('videosnap', $videosnap);
        $this->set('_serialize', ['videosnap']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $videosnap = $this->Videosnap->newEntity();
        if ($this->request->is('post')) {
            $videosnap = $this->Videosnap->patchEntity($videosnap, $this->request->data);
            if ($this->Videosnap->save($videosnap)) {
                $this->Flash->success(__('The videosnap has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The videosnap could not be saved. Please, try again.'));
            }
        }
        $video = $this->Videosnap->Video->find('list', ['limit' => 200]);
        $this->set(compact('videosnap', 'video'));
        $this->set('_serialize', ['videosnap']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Videosnap id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $videosnap = $this->Videosnap->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $videosnap = $this->Videosnap->patchEntity($videosnap, $this->request->data);
            if ($this->Videosnap->save($videosnap)) {
                $this->Flash->success(__('The videosnap has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The videosnap could not be saved. Please, try again.'));
            }
        }
        $video = $this->Videosnap->Video->find('list', ['limit' => 200]);
        $this->set(compact('videosnap', 'video'));
        $this->set('_serialize', ['videosnap']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Videosnap id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $videosnap = $this->Videosnap->get($id);
        if ($this->Videosnap->delete($videosnap)) {
            $this->Flash->success(__('The videosnap has been deleted.'));
        } else {
            $this->Flash->error(__('The videosnap could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
