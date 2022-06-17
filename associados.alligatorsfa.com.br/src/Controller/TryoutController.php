<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;


/**
 * Tryout Controller
 *
 * @property \App\Model\Table\TryoutTable $Associados
 */
class TryoutController extends AppController
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
		'Time.nome',
		'id',
		'nome',
		'sobrenome',
		'email',
		'apelido'
	);
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'Tryout.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Tryout.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Tryout.email LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Tryout.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Tryout.cpf LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Time.nome LIKE "%'.$this->request->query['filtro'].'%"';		       
		$this->set('filtro',$this->request->query['filtro']);
	}
        $this->paginate = ['contain' => ['Time'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $associados = $this->paginate($this->Tryout);
        $this->set(compact('associados'));
        $this->set('_serialize', ['associados']);
    }

    /**
     * View method
     *
     * @param string|null $id Tryout id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tryout = $this->Tryout->get($id, [
            'contain' => ['Time', 'Inventario']
        ]);

	$equipamentos = $this->Tryout->Inventario->Equipamentos->find('all',['limit'=>200]);

        $this->set('equipamentos', $equipamentos);
        $this->set('tryout', $tryout);
        $this->set('_serialize', ['tryout']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $associado = $this->Tryout->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['nascimento'] = Time::parseDate($this->request->data['nascimento']);
            $this->request->data['data_acesso'] = Time::parseDate($this->request->data['data_acesso']);
            $this->request->data['data_formacao'] = Time::parseDate($this->request->data['data_formacao']);
            $associado = $this->Tryout->patchEntity($associado, $this->request->data);

            $teste_foto = $this->tratarup($associado->foto);
            if($teste_foto[0])
            {
                $associado->foto = $teste_foto[0];
                $associado->foto_size = $teste_foto[2];
                $associado->foto_type = $teste_foto[3];
            }
            else
                unset($associado->foto);

            if ($this->Tryout->save($associado)) {
                $this->Flash->success(__($teste_foto[1]));
	        $this->SysAna->logActions($this->name,'Adicionado',[$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The associado could not be saved. Please, try again.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
	$this->set('bairros',Configure::read('bairros'));
        $time = $this->Tryout->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $plano = $this->Tryout->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $this->set(compact('associado', 'time','plano'));
        $this->set('_serialize', ['associado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tryout id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $associado = $this->Tryout->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['nascimento'] = Time::parseDate($this->request->data['nascimento']);
            $this->request->data['data_acesso'] = Time::parseDate($this->request->data['data_acesso']);
            $this->request->data['data_formacao'] = Time::parseDate($this->request->data['data_formacao']);
            $associado = $this->Tryout->patchEntity($associado, $this->request->data);

            $teste_foto = $this->tratarup($associado->foto);
	    if($teste_foto[0]) 
	    {
	    	$associado->foto = $teste_foto[0];
		$associado->foto_size = $teste_foto[2];
		$associado->foto_type = $teste_foto[3];
	    }
	    else
		unset($associado->foto);

            if ($this->Tryout->save($associado)) {
                $this->Flash->success(__($teste_foto[1]));
	    $this->SysAna->logActions($this->name,'Editado',[$id,$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The associado could not be saved. Please, try again.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
	$this->set('bairros',Configure::read('bairros'));
        $time = $this->Tryout->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $plano = $this->Tryout->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $this->set(compact('associado', 'time','plano'));
        $this->set('_serialize', ['associado']);
    }

    public function aprova($id = null)
    {

	$this->Associado = TableRegistry::get('Associados');
        $associado = $this->Tryout->newEntity();
        $tryout = $this->Tryout->get($id);
	$tryoutarray = $tryout->toArray();
	$tryoutarray['id']  = NULL;
        $associado = $this->Tryout->patchEntity($associado, $tryoutarray);

	if ($this->Associado->save($associado)) {
		$this->Tryout->delete($tryout);
		$this->Flash->success(__("Candidato migrado para Associado com sucesso!"));
	        $this->SysAna->logActions($this->name,'Aprovado',[$id,$tryout->nome,$tryout->sobrenome,$tryout->apelido,$tryout->email],$this->Auth->user('id'));
		return $this->redirect(['action' => 'index']);
	} else {
		$this->Flash->error(__('The candidato could not be migrated. Please, try again.'));
	}
        return $this->redirect(['action' => 'index']);
    }

    public function update($id = null, $up = null)
    {
	$this->Associados = TableRegistry::get('Associados');
	if($up) {
        	$tryass = $this->Tryout->get($id);
		$tryassarray = $tryass->toArray();
        	$newass = $this->Associados->get($up);
            	$newass = $this->Associados->patchEntity($newass, $tryassarray);
		if ($this->Associados->save($newass)) {
			$this->Tryout->delete($tryass);
			$this->Flash->success(__("Dados de Associado atualizados com sucesso!"));
	                $this->SysAna->logActions($this->name,'Atualizado',[$id,$up,$tryass->nome,$tryass->sobrenome,$tryass->apelido,$tryass->email],$this->Auth->user('id'));
			return $this->redirect(['action' => 'index']);
		} else {
			$this->Flash->error(__('Dados nao atualizados do Associado.'));
		}
        	return $this->redirect(['action' => 'index']);
	}
	$conditions = null;
	$whitelist = array(
		'Time.nome',
		'id',
		'nome',
		'sobrenome',
		'email',
		'apelido'
	);
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Associados.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.email LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Associados.cpf LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Time.nome LIKE "%'.$this->request->query['filtro'].'%"';		       
		$this->set('filtro',$this->request->query['filtro']);
	}
        $this->paginate = ['contain' => ['Time'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $associados = $this->paginate($this->Associados);
        $this->set(compact('associados','id'));
        $this->set('_serialize', ['associados','id']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tryout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $associado = $this->Tryout->get($id);
        if ($this->Tryout->delete($associado)) {
            $this->Flash->success(__('The associado has been deleted.'));
	    $this->SysAna->logActions($this->name,'Excluido',[$id,$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
        } else {
            $this->Flash->error(__('The associado could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    // TRATAR UPLOAD 
    public function tratarup($foto = null)
    {
            if(is_uploaded_file($foto['tmp_name'])) 
	    {
		if ($foto['size']>10 && $foto['size'] < 63500)
		{
		    if (exif_imagetype($foto['tmp_name']))
		    {
                	$filedata = fread(fopen($foto['tmp_name'], "r"),$foto['size']);
			return array($filedata,'The associado has been saved.',$foto['size'],$foto['type']);
		    }
	            else
		       return array(false,'O arquivo enviado nao e uma imagem valida, imagem nao salva!');
                }
		else
		    return array(false,'A imagem precisa ser menor que 64kb, imagem nao salva!');
            }
	    return array(false,'The associado has been saved.');
    } 

    // GET IMG
    public function imgfoto($id = null)
    {
        $this->request->allowMethod(['get', 'img_foto']);
        $associado = $this->Tryout->get($id);
	if($associado['foto_size'] > 10) {
    		header('Content-type: ' . $associado['foto_type']);
    		header('Content-length: ' . $associado['foto_size']);
    		header('Content-Disposition: inline; filename='.$associado['nome'] . '.'.$associado['foto_type']);
		while (!feof($associado['foto'])) {
    			echo fread($associado['foto'], $associado['foto_size']);
		}
	}
	else {
		$image = file_get_contents(__DIR__ . '/../../webroot/img/gatorboy.jpg');
		header('Content-type: image/jpeg');
		echo $image;
	}
	
    	exit();
    }

}
