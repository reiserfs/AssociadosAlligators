<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Grid\Grid;
use Cake\I18n\Time;

/**
 * Associados Controller
 *
 * @property \App\Model\Table\AssociadosTable $Associados
 */
class PerfilController extends AppController
{

    public function video($id = null)
    {
	$this->Video = TableRegistry::get('Video');
	if($id) {
		$video = $this->Video->get($id, [
		    'contain' => ['OutrotimeCasa','OutrotimeVisitante', 'Videosnap']
		]);

		$conditions = ['Videosnap.video_id' => $id];

		$data = $this->Video->Videosnap->find('all', ['conditions' => $conditions]);
		$data->select(['id','inicio','fim','casa','visitante','resultado','descricao']);

		$times = ['OF'=>'Ataque','DF'=>'Defesa','ST'=>'Special Teams','SK'=>'Kickoff','SR'=>'Return','SP'=>'Punt','FG'=>'Field Goal'];
		$resultados = ['TD'=>'Touch Down','FD'=>'First Down','FB'=>'Fumble','IT'=>'Interception','TO'=>'Turn Over','SP'=>'Six Pick','CO'=>'Complete','IN'=>'Incomplete'];
		require_once(ROOT .DS. "vendor" . DS  . "grid" . DS . "Grid.php");
		$grid = new Grid();
		$grid->addColumn('id', 'P', 'html', NULL, false,'id'); 
		$grid->addColumn('inicio', 'Inicio', 'string');  
		$grid->addColumn('fim', 'Fim', 'string');  
		$grid->addColumn('casa', 'Casa', 'string',$times);  
		$grid->addColumn('visitante', 'Visitante', 'string',$times);  
		$grid->addColumn('resultado', 'Resultado', 'string',$resultados);  
		$grid->addColumn('descricao', 'Obs', 'string');  

		$data = $grid->getPOJO($data);
		$this->set(compact('video','data','videosnap','times','resultados'));
		$this->set('_serialize', 'data');
	}
	else {
		$this->paginate = [
		    'contain' => ['OutrotimeCasa','OutrotimeVisitante']
		];
		$video = $this->paginate($this->Video);

		$this->set(compact('video'));
		$this->set('_serialize', ['video']);
	}
    }
    
    public function lista()
    {
	$this->Associados = TableRegistry::get('Associados');
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
        $this->set(compact('associados'));
        $this->set('_serialize', ['associados']);
    }

    /**
     * View method
     *
     * @param string|null $id Associado id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
	$this->Associados = TableRegistry::get('Associados');
        $associado = $this->Associados->get($id, [
            'contain' => ['Time', 'Inventario']
        ]);

	$equipamentos = $this->Associados->Inventario->Equipamentos->find('all',['limit'=>200]);
			//	['keyField' => 'id', 'valueField' => function($row) { return $row['tipo'] . ': ' . $row['marca'] . ' ' . $row['modelo']; },       
			//	'limit' => 200]);

        $this->set('equipamentos', $equipamentos);
        $this->set('associado', $associado);
        $this->set('_serialize', ['associado']);
    }

    public function index()
    {
	$this->Associados = TableRegistry::get('Associados');
	$id = $this->Auth->user('associado_id');
        $associado = $this->Associados->get($id, [
            'contain' => ['Time', 'Inventario','Plano']
        ]);

	$equipamentos = $this->Associados->Inventario->Equipamentos->find('all',['limit'=>200]);
			//	['keyField' => 'id', 'valueField' => function($row) { return $row['tipo'] . ': ' . $row['marca'] . ' ' . $row['modelo']; },       
			//	'limit' => 200]);

        $this->set('equipamentos', $equipamentos);
        $this->set('associado', $associado);
        $this->set('_serialize', ['associado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Associado id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
	$this->Associados = TableRegistry::get('Associados');
	$id = $this->Auth->user('associado_id');
	$associado = $this->Associados->get($id, [
            'contain' => ['Plano','Time']
        ]);
	$this->set('success',false);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['nascimento'] = Time::parseDate($this->request->data['nascimento']);
            $this->request->data['data_acesso'] = Time::parseDate($this->request->data['data_acesso']);
            $this->request->data['data_formacao'] = Time::parseDate($this->request->data['data_formacao']);
            $associado = $this->Associados->patchEntity($associado, $this->request->data);

            $teste_foto = $this->tratarup($associado->foto);
	    if($teste_foto[0]) 
	    {
	    	$associado->foto = $teste_foto[0];
		$associado->foto_size = $teste_foto[2];
		$associado->foto_type = $teste_foto[3];
	    }
	    else
		unset($associado->foto);

            if ($this->Associados->save($associado)) {
//		$this->log(debug($this->request), 'debug');
                $this->Flash->success(__($teste_foto[1]));
	        $this->SysAna->logActions($this->name,'Editado',[$id,$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
		if (!$this->request->is('json')) return $this->redirect(['action' => 'index']); 
		else $this->set('success',true);
            } else {
		$this->log(debug($associado->errors()), 'debug');
                $this->Flash->error(__('The associado could not be saved. Please, try again.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
	$this->set('bairros',Configure::read('bairros'));
	$time = [$associado->time_id=>$associado->time->nome]; 
	$plano = [$associado->plano_id=>$associado->plano->nome_plano];
        $this->set(compact('associado', 'time','plano'));
        $this->set('_serialize', ['success','associado']);
    }

    public function vequip($id = null)
    {
	if ($id == 0) return $this->redirect(['action' => 'index']);
	$this->Equipamentos = TableRegistry::get('Equipamentos');
        $equipamento = $this->Equipamentos->get($id, [
            'contain' => []
        ]);

        $this->set('equipamento', $equipamento);
        $this->set('_serialize', ['equipamento']);
    }

    public function equip()
    {
	$this->Inventario = TableRegistry::get('Inventario');
	$id = $this->Auth->user('associado_id');
	$conditions = null;
	$whitelist = array(
		'Equipamentos.tipo',
		'id',
		'Equipamentos.marca',
		'Associados.nome',
		'tamanho',
	);
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'(Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Equipamentos.tipo LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Equipamentos.marca LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Equipamentos.modelo LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Inventario.tamanho LIKE "%'.$this->request->query['filtro'].'%"'.		       
				') AND Associados.id = '.$id;
		$this->set('filtro',$this->request->query['filtro']);
	}
	else $conditions = ['Associados.id' => $id];
        $this->paginate = ['contain' => ['Time'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $this->paginate = [
            'contain' => ['Equipamentos', 'Associados'],
	    'sortWhitelist'=>$whitelist, 'conditions' => $conditions
        ];
        $inventario = $this->paginate($this->Inventario);

	// ADD PART
	$inventarioAdd = $this->Inventario->newEntity();
        if ($this->request->is('post')) {
	    $this->request->data['associado_id'] = $id;
            $inventarioAdd = $this->Inventario->patchEntity($inventarioAdd, $this->request->data);
            if ($this->Inventario->save($inventarioAdd)) {
                $this->Flash->success(__('The inventario has been saved.'));
                return $this->redirect(['action' => 'equip']);
            } else {
                $this->Flash->error(__('The inventario could not be saved. Please, try again.'));
            }
        }
	$equipamentos = $this->Inventario->Equipamentos->find('list',[
		                        'keyField' => 'id',
					'valueField' => function($row) { return $row['tipo'] . ': ' . $row['marca'] . ' ' . $row['modelo']; },
					'limit' => 200
			]);

        $this->set(compact('inventario', 'inventarioAdd', 'equipamentos'));
        $this->set('_serialize', ['inventario']);
    }

    public function inve()
    {
	$this->Inventario = TableRegistry::get('Inventario');
	$id = $this->Auth->user('associado_id');

	if ($this->request->is(['patch', 'post', 'put'])) {
		foreach($this->request->data as $key => $value) $itens[]=$value;
		
		$inventarioUp = $this->Inventario->query();
		
		$inventarioUp->update()
			->set(['equipado'=>false])
			->where(['associado_id' => $id])
			->execute();

		$inventarioUp->update()
			->set(['equipado'=>true])
			->where(['associado_id' => $id, 'id IN' => $itens])
			->execute();

                $this->Flash->success(__('The inventario has been saved.'));
                return $this->redirect(['action' => 'inve']);
        }

	$inventario = $this->Inventario->find('all')
		    	->where([
			    	'Inventario.associado_id'	=>	$id])
			->contain([
				'Equipamentos'])
			->limit(300);

        $this->set('inventario', $inventario);
        $this->set('_serialize', ['inventario']);
    }

    public function equipdelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
	$this->Inventario = TableRegistry::get('Inventario');
	$idu = $this->Auth->user('associado_id');
        $inventario = $this->Inventario->get($id);
        if ($this->Inventario->deleteAll(['Inventario.id'=>$inventario['id'],'Inventario.associado_id'=>$idu])) {
            $this->Flash->success(__('The inventario has been deleted.'));
        } else {
            $this->Flash->error(__('The inventario could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'equip']);
    }

    // TRATAR UPLOAD 
    public function tratarup($foto = null)
    {
	    if(isset($foto['tmp_name']))
	    {
		    if(is_uploaded_file($foto['tmp_name'])) 
		    {
			if ($foto['size']>10 && $foto['size'] < 635000)
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
			    return array(false,'A imagem precisa ser menor que 640kb, imagem nao salva!');
		    }
		    return array(false,'The associado has been saved.');
	    }
	    return array(false,'Sem foto');
    } 

    public function senha()
    {
	$id = $this->Auth->user('id');
	$this->Login= TableRegistry::get('Login');
	$login = $this->Login->get($id);
	
        if ($this->request->is(['patch', 'post', 'put']))  {
	    $this->request->data['password'] = $this->request->data['senha'];
            $login = $this->Login->patchEntity($login, $this->request->data);
            if ($this->Login->save($login)) {
                $this->Flash->success(__('The login has been saved.'));
	        $this->SysAna->logActions($this->name,'MudouSenha',[$id,$login->user],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A senha could not be saved. Please, try again.'));
            }
        }
//	else $this->Flash->error(__('As senhas nao coincidem!'));

        $this->set(compact('login'));
        $this->set('_serialize', ['login']);
    }

    public function esug()
    {
	$this->Equipamentos = TableRegistry::get('Equipatemp');
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
                $this->Flash->success(__('Sugestao de equipamento salva.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Sugestao nao salva, favor verifique os dados e o tamanho da imagem.'));
            }
        }
	$this->set('slots',Configure::read('slots'));
        $this->set(compact('equipamento'));
        $this->set('_serialize', ['equipamento']);
    }

    public function mens()
    {
	$id = $this->Auth->user('associado_id');
	$this->Associados = TableRegistry::get('Associados');
	$this->Mensalidade = TableRegistry::get('Mensalidade');
        $associado = $this->Associados->get($id, [
            'contain' => ['Time','Plano']
        ]);

        $pagamentosL = $this->Mensalidade->Pagamentos->find('list', ['keyField' => 'id', 'valueField' => 'tipo', 'limit' => 200]);
        $planoL = $this->Mensalidade->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $planoM = $this->Mensalidade->Plano->find('list', ['keyField' => 'id', 'valueField' => 'meses', 'limit' => 200]);
        $associadosL = $this->Mensalidade->Associados->find('list', [
                                'keyField' => 'id',
                                'valueField' => function($row) { return $row['nome'] . ' ' . $row['sobrenome'] . ' (' . $row['apelido'] . ') '  ; },
                                'limit' => 400
        ]);

	$conditions = ['Mensalidade.associado_id' => $id];

        $this->paginate = ['contain' => ['Pagamentos','Plano'], 'conditions' => $conditions];	
        $data = $this->paginate($this->Mensalidade);

        $this->set(compact('associado','data','pagamentosL','planoM'));
        $this->set('_serialize', 'data');

    }

    public function paga()
    {
	$id = $this->Auth->user('associado_id');
        return $this->redirect(['controller' => 'Pages','action' => 'display','noauth']);
    }

    public function party()
    {
	$id = $this->Auth->user('associado_id');
        return $this->redirect(['controller' => 'Pages','action' => 'display','noauth']);
    }


    public function trei()
    {
	$id = $this->Auth->user('associado_id');
        return $this->redirect(['controller' => 'Pages','action' => 'display','noauth']);
    }


    public function jogo()
    {
	$id = $this->Auth->user('associado_id');
        return $this->redirect(['controller' => 'Pages','action' => 'display','noauth']);
    }


    public function assi()
    {
	$id = $this->Auth->user('associado_id');
        return $this->redirect(['controller' => 'Pages','action' => 'display','noauth']);
    }


    public function book()
    {
	$id = $this->Auth->user('associado_id');
        return $this->redirect(['controller' => 'Pages','action' => 'display','noauth']);
    }


    public function curs()
    {
	$id = $this->Auth->user('associado_id');
        return $this->redirect(['controller' => 'Pages','action' => 'display','noauth']);
    }


}
