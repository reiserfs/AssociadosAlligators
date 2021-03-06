<?php
namespace App\Controller;

require_once(ROOT . DS . 'vendor' . DS  . 'phpqrcode' . DS . 'qrlib.php');
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\Time;
use QRcode;


/**
 * Associados Controller
 *
 * @property \App\Model\Table\AssociadosTable $Associados
 */
class AssociadosController extends AppController
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
		'Plano.nome_plano',
		'id',
		'nome',
		'sobrenome',
		'email',
		'apelido'
	);
	if (isset($this->request->query['ativo'])) {
		$ativo = $this->request->query['ativo']; 
		switch($ativo) {
			case 'a':
				$query_ativo = ' AND Associados.ativo = 1';
				break;
			case 'i':
				$query_ativo = ' AND Associados.ativo = 0';
				break;
			default:
				$query_ativo = ' ';
		}
	}
        $query_plano = (!empty($this->request->query['plano'])) ? ' AND Associados.plano_id = "'.$this->request->query['plano'].'" ' : '';
        $query_time = (!empty($this->request->query['time'])) ? ' AND Associados.time_id = "'.$this->request->query['time'].'" ' : '';

	if(isset($this->request->query['filtro'])){
        	$conditions =  	'( Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Associados.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.email LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Associados.cpf LIKE "%'.$this->request->query['filtro'].'")'.
				$query_plano .
				$query_time .
				$query_ativo;		       
		$this->set('filtro',$this->request->query['filtro']);
	}
	$limite = (isset($this->request->query['limite'])) ? $this->request->query['limite'] : '25'; 
	$plano = (isset($this->request->query['plano'])) ? $this->request->query['plano'] : ''; 
	$time = (isset($this->request->query['time'])) ? $this->request->query['time'] : ''; 
        $this->paginate = ['limit' => $limite, 'contain' => ['Time','Plano','Login'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $times = $this->Associados->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $planos = $this->Associados->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $associados = $this->paginate($this->Associados);
        $this->set(compact('associados','limite','ativo','planos','times','plano','time'));
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
        $associado = $this->Associados->get($id, [
            'contain' => ['Time', 'Plano', 'Inventario','Login','Notas']
        ]);

	$equipamentos = $this->Associados->Inventario->Equipamentos->find('all',['limit'=>200]);
			//	['keyField' => 'id', 'valueField' => function($row) { return $row['tipo'] . ': ' . $row['marca'] . ' ' . $row['modelo']; },       
			//	'limit' => 200]);

        $this->set('equipamentos', $equipamentos);
        $this->set('associado', $associado);
        $this->set('_serialize', ['associado']);
    }

    public function myself()
    {
	$id = $this->Auth->user('associado_id');
        $associado = $this->Associados->get($id, [
            'contain' => ['Time']
        ]);

        $this->set('associado', $associado);
        $this->set('_serialize', ['associado']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $associado = $this->Associados->newEntity();
        if ($this->request->is('post')) {
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
                $this->Flash->success(__($teste_foto[1]));
	        $this->SysAna->logActions($this->name,'Adicionado',[$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The associado could not be saved. Please, try again.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
	$this->set('bairros',Configure::read('bairros'));
        $time = $this->Associados->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $plano = $this->Associados->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $this->set(compact('associado', 'time','plano'));
        $this->set('_serialize', ['associado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Associado id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $associado = $this->Associados->get($id, [
            'contain' => []
        ]);
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
                $this->Flash->success(__($teste_foto[1]));
	        $this->SysAna->logActions($this->name,'Editado',[$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The associado could not be saved. Please, try again.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
	$this->set('bairros',Configure::read('bairros'));
        $time = $this->Associados->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $plano = $this->Associados->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $this->set(compact('associado', 'time','plano'));
        $this->set('_serialize', ['associado']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Associado id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $associado = $this->Associados->get($id);
        if ($this->Associados->delete($associado)) {
	    $this->SysAna->logActions($this->name,'Excluido',[$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
            $this->Flash->success(__('The associado has been deleted.'));
        } else {
            $this->Flash->error(__('The associado could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function ativa()
    {
        $this->request->allowMethod(['get', 'ativa']);
        $associado = $this->Associados->get($this->request->query['id'],['contain'=>['Login']]);
	foreach($this->request->query as $key => $value) 
		if ($key <> 'id') $parametros[$key] = $value;
	//debug($parametros);
	//die(debug($this->request->query));
        (isset($associado->login->id)) ? $associadoLogin = $this->Associados->Login->get($associado->login->id) : $associadoLogin = false;
	($associado->ativo) ? 
		(list($associado->ativo, $associado->plano_id, $associado->time_id, $Login, $log) = 
			array (
				0,
				(isset($this->request->query['plano']) ? $this->SysAna->globalconfig('PLANO_INATIVO') : $associado->plano_id), 
				(isset($this->request->query['time']) ? $this->SysAna->globalconfig('TIME_INATIVO') : $associado->time_id),
				((isset($this->request->query['login']) && $associadoLogin) ? 0 : 1),
				'Desativado'
			)
		) 
		:
		(list($associado->ativo, $associado->plano_id, $associado->time_id, $Login, $log) = 
			array (
				1,
				(isset($this->request->query['plano']) ? $this->SysAna->globalconfig('PLANO_ATIVO') : $associado->plano_id), 
				(isset($this->request->query['time']) ? $this->SysAna->globalconfig('TIME_ATIVO') : $associado->time_id),
				((isset($this->request->query['login']) && $associadoLogin) ? 1 : 0),
				'Ativado'
			)
		); 
	($associadoLogin) ? $associadoLogin->ativo = $Login : '';
        if (($this->Associados->save($associado)) && (($associadoLogin) ? $this->Associados->Login->save($associadoLogin) : true)) {
            $this->Flash->success(__('Associado foi '.$log .' com sucesso.'));
	    $this->SysAna->logActions($this->name,$log,[$associado->nome,$associado->sobrenome,$associado->apelido,$associado->email],$this->Auth->user('id'));
        } else {
            $this->Flash->error(__('The associado could not be ative/deactive. Please, try again.'));
        }
        return $this->redirect(['action' => 'index',"?"=>$parametros]);
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
        $associado = $this->Associados->get($id);
	$retorno = null;
	if($associado['foto_size'] > 10) {
    		header('Content-type: ' . $associado['foto_type']);
    		header('Content-length: ' . $associado['foto_size']);
    		header('Content-Disposition: inline; filename='.$associado['nome'] . '.'.$associado['foto_type']);
		while (!feof($associado['foto'])) {
    			$retorno .= fread($associado['foto'], $associado['foto_size']);
			flush();
		}
	}
	else {
		$retorno = file_get_contents(__DIR__ . '/../../webroot/img/gatorboy.jpg');
	}
	$this->response->type('png');
	$this->viewBuilder()->layout(false);
	$this->response->body($retorno);
	$this->autoRender = false;
    }

    public function carteirinha($id = null)
    {
        $this->request->allowMethod(['get', 'carteirinha']);
        $associado = $this->Associados->get($id,['contain'=>['Time','Plano']]);
	$foto = null;
	header('Content-type: image/png');
	if($associado['foto_size'] > 10) {
		while (!feof($associado['foto'])) {
			$foto .= fread($associado['foto'], $associado['foto_size']);
			flush();
		}
		$foto = imagecreatefromstring($foto);
	}
	else
		$foto = imagecreatefromjpeg(__DIR__ . '/../../webroot/img/gatorboy.jpg');

	$carteira = imagecreatefrompng(__DIR__ . '/../../webroot/img/carteirinha.png');
	$qrcode = imagecreatefrompng(__DIR__ . '/../../webroot/img/qrcode.png');
	QRcode::png('http://dev.parceiros.alligatorsfa.com.br/parceiros/check/'.$associado->carteira,'../tmp/'.$associado['id'].'.png',QR_ECLEVEL_M);
	$qrcode = imagecreatefrompng('../tmp/'.$associado['id'].'.png');
	unlink('../tmp/'.$associado['id'].'.png');
	imagecopyresized($carteira,$foto,7,77,0,0,89,107,imagesx($foto),imagesy($foto));
	imagecopyresized($carteira,$qrcode,354,1,0,0,100,100,imagesx($qrcode),imagesy($qrcode));
	$black = ImageColorAllocate($carteira, 0, 0, 0);
	$dados = [
			'nome' => [115,93,$associado->nome . ' (' . $associado->apelido . ') ' . $associado->sobrenome,8],
			'time' => [115,119,$associado->time->nome,8],
			'plano' => [115,145,$associado->plano->nome_plano,8],
			'carteira' => [115,171,$associado->carteira,8],
			'sangue' => [455,171,'Tipo sanguineo: ' . $associado->sangue,8],
			'numero' => [490,70,"#".(isset($associado->numero) ? $associado->numero : 00),60],
	];
	foreach($dados as $key=>$value)
		imagettftext($carteira, $value[3], 0, $value[0], $value[1], $black, '/usr/share/fonts/TTF/verdana.ttf', $value[2]);
	$this->response->type('png');
	$this->viewBuilder()->layout(false);
	$this->response->body(imagepng($carteira));
	$this->autoRender = false;
    }
}
