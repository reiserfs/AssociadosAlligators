<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Equipamentos Controller
 *
 * @property \App\Model\Table\EquipamentosTable $Equipamentos
 */
class EquipamentosController extends AppController
{
    public $helpers = array('Farbtastic');
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
	$conditions = null;

	if(isset($this->request->query['filtro'])){
        	$conditions =  	'Equipamentos.tipo LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Equipamentos.marca LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Equipamentos.modelo LIKE "%'.$this->request->query['filtro'].'%"';
		$this->set('filtro',$this->request->query['filtro']);
	}
        $this->paginate = ['conditions' => $conditions];	
        $equipamentos = $this->paginate($this->Equipamentos);

        $this->set(compact('equipamentos'));
        $this->set('_serialize', ['equipamentos']);
    }

    /**
     * View method
     *
     * @param string|null $id Equipamento id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
	if ($id == 0) return $this->redirect(['action' => 'index']);
        $equipamento = $this->Equipamentos->get($id, [
            'contain' => []
        ]);

        $this->set('equipamento', $equipamento);
        $this->set('_serialize', ['equipamento']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipamento = $this->Equipamentos->newEntity();
        if ($this->request->is('post')) {
            $equipamento = $this->Equipamentos->patchEntity($equipamento, $this->request->data);

	    $teste_foto = $this->tratarup($equipamento->foto);
            if($teste_foto[0])
            {
                $equipamento->foto = $teste_foto[0];
                $equipamento->foto_size = $teste_foto[2];
                $equipamento->foto_type = $teste_foto[3];
            }
            else
                unset($equipamento->foto);

	    if ($this->Equipamentos->save($equipamento)) {
                $this->Flash->success(__('The equipamento has been saved.'));
	        $this->SysAna->logActions($this->name,'Adicionado',[$equipamento->tipo,$equipamento->marca,$equipamento->modelo],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipamento could not be saved. Please, try again.'));
            }
        }
	$this->set('slots',Configure::read('slots'));
        $this->set(compact('equipamento'));
        $this->set('_serialize', ['equipamento']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipamento id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipamento = $this->Equipamentos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipamento = $this->Equipamentos->patchEntity($equipamento, $this->request->data);

	    $teste_foto = $this->tratarup($equipamento->foto);
            if($teste_foto[0])
            {
                $equipamento->foto = $teste_foto[0];
                $equipamento->foto_size = $teste_foto[2];
                $equipamento->foto_type = $teste_foto[3];
            }
            else
                unset($equipamento->foto);

            if ($this->Equipamentos->save($equipamento)) {
                $this->Flash->success(__('The equipamento has been saved.'));
	        $this->SysAna->logActions($this->name,'Editado',[$id,$equipamento->tipo,$equipamento->marca,$equipamento->modelo],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipamento could not be saved. Please, try again.'));
            }
        }
	$this->set('slots',Configure::read('slots'));
        $this->set(compact('equipamento'));
        $this->set('_serialize', ['equipamento']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipamento id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipamento = $this->Equipamentos->get($id);
        if ($this->Equipamentos->delete($equipamento)) {
	        $this->SysAna->logActions($this->name,'Excluido',[$id,$equipamento->tipo,$equipamento->marca,$equipamento->modelo],$this->Auth->user('id'));
            $this->Flash->success(__('The equipamento has been deleted.'));
        } else {
            $this->Flash->error(__('The equipamento could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    // TRATAR UPLOAD 
    public function tratarup($foto = null)
    {
            if(is_uploaded_file($foto['tmp_name'])) 
	    {
		if ($foto['size']>10 && $foto['size'] < 16777215)
		{
		    if (exif_imagetype($foto['tmp_name']))
		    {
                	$filedata = fread(fopen($foto['tmp_name'], "r"),$foto['size']);
			return array($filedata,'The equipamento has been saved.',$foto['size'],$foto['type']);
		    }
	            else
		       return array(false,'O arquivo enviado nao e uma imagem valida, imagem nao salva!');
                }
		else
		    return array(false,'A imagem precisa ser menor que 64kb, imagem nao salva!');
            }
	    return array(false,'The equipamento has been saved.');
    } 

    // GET IMG
    public function imgfoto($id = null)
    {
        $this->request->allowMethod(['get', 'img_foto']);
        if($id) $equipamento = $this->Equipamentos->get($id);
	if($id && $equipamento['foto_size'] > 10) {
    		header('Content-type: ' . $equipamento['foto_type']);
    		header('Content-length: ' . $equipamento['foto_size']);
    		header('Content-Disposition: inline; filename='.$equipamento['marca'] . '.'.$equipamento['foto_type']);
		while (!feof($equipamento['foto'])) {
    			echo fread($equipamento['foto'], $equipamento['foto_size']);
		}
	}
	else {
		$image = file_get_contents(__DIR__ . '/../../webroot/img/noitem.png');
		header('Content-type: image/png');
		echo $image;
	}
	
    	exit();
    }
}
