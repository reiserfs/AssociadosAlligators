<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Squad Controller
 *
 * @property \App\Model\Table\SquadTable $Squad
 */
class SquadController extends AppController
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
		'Associados.nome',
		'modalidade',
		'id',
		'nome',
		'data',
	);
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Associados.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Squad.nome LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Squad.data LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Squad.id LIKE "%'.$this->request->query['filtro'].'%"';		       
		$this->set('filtro',$this->request->query['filtro']);
	}
        $this->paginate = ['contain' => ['Associados','SquadAssociado'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $squad = $this->paginate($this->Squad);

        $this->set(compact('squad'));
        $this->set('_serialize', ['squad']);

    }

    /**
     * View method
     *
     * @param string|null $id Squad id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $squad = $this->Squad->get($id, [
            'contain' => ['SquadAssociado']
        ]);

        $this->set('squad', $squad);
        $this->set('_serialize', ['squad']);
    }

    public function play($id = null)
    {
        $squad = $this->Squad->get($id, [
            'contain' => ['Associados']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
/*
		$this->Login->Permissoes->deleteAll(['Permissoes.squad_id' => $id ]);
		$permArray = array();
		$permArray[] = ['controller'=>'Perfil','action'=>'index','login_id'=>$id];
		foreach($this->request->data as $key => $value) 
			if(($value) && !($value=='none'))
				$permArray[] = ['controller'=>$key,'action'=>$value,'login_id'=>$id];

		    $created = $this->Login->Permissoes->newEntities($permArray);
		    foreach ($created as $create) $this->Login->Permissoes->save($create);
		    if (!$create->errors()) {
	        	$this->SysAna->logActions($this->name,'Permissoes',[$id,$login->user,$login->associado->nome],$this->Auth->user('id'));
            		$this->Flash->success(__('Permissoes atualizadas.'));
			return $this->redirect(array('action' => 'perm',$id));                 
		    } else {
            		 $this->Flash->error(__('Erro ao gravar permissoes.'));
		    }	


 */
            $this->Squad->SquadAssociado->deleteAll(['SquadAssociado.squad_id' => $id ]);
	    $squadassociadoArray = array();
	    foreach($this->request->data as $key => $value) {
	    	if(is_array($value))
			foreach($value as $k => $v)
				$squadassociadoArray[] = ['squad_id' => $this->request->data['id'], 'posicao_id' => explode(',',preg_replace('/[^A-Za-z0-9\-,]/', '', $v))];
	    }
	    debug($this->request->data);
	    debug($squadassociadoArray);
	    die();
        }

        $posicaos = $this->Squad->SquadAssociado->Posicao->find('list', [
				'keyField' => 'id', 
				'valueField' => function($row) { return ' (' . $row['sigla'] . ') ' . $row['nome']; }, 
				'limit' => 200
	]);
        $associados = $this->Squad->Associados->find('list', [
				'keyField' => 'id', 
				'valueField' => function($row) { return '#' . $row['numero'] . ' ' . $row['nome'] . ' (' . $row['apelido'] . ') ' . $row['sobrenome'] ; }, 
				'limit' => 200
	]);
        $squadassociado = $this->Squad->SquadAssociado->find('all', ['conditions' => ['squad_id' => $id],'contain'=>['Posicao']]);
	$squadassociado = $squadassociado->toArray(); 
	if(is_array($squadassociado)){
		foreach($squadassociado as $asc ) {
			$squadarray[$asc->posicao->time][] = $asc;
		}
	}
	$this->set('timesposicoes',Configure::read('timesposicoes'));
        $this->set(compact('squad', 'posicaos', 'associados','squadassociado','squadarray'));
        $this->set('_serialize', ['squad']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $squad = $this->Squad->newEntity();
        if ($this->request->is('post')) {
            $squad = $this->Squad->patchEntity($squad, $this->request->data);
            if ($this->Squad->save($squad)) {
                $this->Flash->success(__('The squad has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The squad could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('squad'));
        $this->set('_serialize', ['squad']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Squad id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $squad = $this->Squad->get($id, [
            'contain' => ['Associados']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $squad = $this->Squad->patchEntity($squad, $this->request->data);
            if ($this->Squad->save($squad)) {
                $this->Flash->success(__('The squad has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The squad could not be saved. Please, try again.'));
            }
        }
        $associado = $this->Squad->Associados->find('list', [
                                'keyField' => 'id',
                                'valueField' => function($row) { return $row['nome'] . ' (' . $row['apelido'] . ') ' . $row['sobrenome']; },
                                'limit' => 200
        ]);
        $this->set(compact('squad','associado'));
        $this->set('_serialize', ['squad']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Squad id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $squad = $this->Squad->get($id);
        if ($this->Squad->delete($squad)) {
            $this->Flash->success(__('The squad has been deleted.'));
        } else {
            $this->Flash->error(__('The squad could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
