<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Grid\Grid;
use Cake\I18n\Time;



/**
 * Mensalidade Controller
 *
 * @property \App\Model\Table\MensalidadeTable $Mensalidade
 */
class MensalidadeController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function lista()
    {
	$this->Associados = TableRegistry::get('Associados');
	$conditions = null;
	$whitelist = array(
		'id',
		'nome',
		'sobrenome',
		'email',
		'apelido',
		'Time.nome',
		'Plano.nome_plano',
	);
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Associados.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.email LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Associados.cpf LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Plano.nome_plano LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Time.nome LIKE "%'.$this->request->query['filtro'].'%"';		       
		$this->set('filtro',$this->request->query['filtro']);
	}
        $this->paginate = ['contain' => ['Time','Mensalidade','Plano'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $associados = $this->paginate($this->Associados);
        $planoM = $this->Mensalidade->Plano->find('list', ['keyField' => 'id', 'valueField' => 'meses', 'limit' => 200]);
        $this->set(compact('associados','planoM'));
        $this->set('_serialize', ['associados']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
	$this->Associados = TableRegistry::get('Associados');
	$conditions = null;
	$whitelist = array(
		'id',
		'nome',
		'sobrenome',
		'email',
		'apelido',
		'Time.nome',
		'Plano.nome_plano',
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
        $this->paginate = ['limit' => $limite, 'contain' => ['Time','Plano','Login','Mensalidade'],'sortWhitelist'=>$whitelist, 'conditions' => $conditions];	
        $times = $this->Associados->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $planos = $this->Associados->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $associados = $this->paginate($this->Associados);
        $this->set(compact('associados','limite','ativo','planos','times','plano','time'));
        $this->set('_serialize', ['associados']);
    }


    public function mens()
    {
        $pagamentosL = $this->Mensalidade->Pagamentos->find('list', ['keyField' => 'id', 'valueField' => 'tipo', 'limit' => 200]);
        $planoL = $this->Mensalidade->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $associadosL = $this->Mensalidade->Associados->find('list', [
                                'keyField' => 'id',
                                'valueField' => function($row) { return $row['nome'] . ' ' . $row['sobrenome'] . ' (' . $row['apelido'] . ') '  ; },
                                'limit' => 400
        ]);

	$fields = ['*','date_format(vencimento, "%d/%m/%Y") as vencimento'];
	$contain = ['Associados', 'Pagamentos']; 

	$data = $this->Mensalidade->find('all');
	$vencimento = $data->func()->date_format([
		'vencimento' => 'literal',
		"'%d/%m/%y'" => 'literal'
		]);
	$pago = $data->func()->date_format([
		'pago' => 'literal',
		"'%d/%m/%y'" => 'literal'
		]);
	$data->select([
		'id','associado_id','desconto','acressimo','valor_base','valor_pago','pagamento_id','plano_id','observacoes',
		'novovencimento' => $vencimento,
		'novopago' => $pago
		]);


	require_once(ROOT .DS. "vendor" . DS  . "grid" . DS . "Grid.php");
	$grid = new Grid();
	$grid->addColumn('id', 'ID', 'integer', NULL, false); 
	$grid->addColumn('associado_id', 'Associado', 'string', $associadosL->toArray());  
	$grid->addColumn('novovencimento', 'Vencimento', 'date');
	$grid->addColumn('novopago', 'Pagamento', 'date');  
	$grid->addColumn('valor_base', 'Valor', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('desconto', 'Desconto', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('acressimo', 'Acrescimo', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('valor_pago', 'Pago', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('pagamento_id', 'Forma', 'string', $pagamentosL->toArray());  
	$grid->addColumn('plano_id', 'Plano', 'string', $planoL->toArray());  
	$grid->addColumn('action', 'A', 'html', NULL, false, 'id');  

	$data = $grid->getPOJO($data);

        $mensalidade = $this->Mensalidade->newEntity();
        $this->set(compact('data','mensalidade','pagamentosL','associadosL','planoL'));
        $this->set('_serialize', 'data');
    }

    public function view($id = null)
    {
	$this->Associados = TableRegistry::get('Associados');
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

	$fields = ['*','date_format(vencimento, "%d/%m/%Y") as vencimento'];
	$contain = ['Associados', 'Pagamentos']; 
	$conditions = ['Mensalidade.associado_id' => $id];

	$data = $this->Mensalidade->find('all', ['conditions' => $conditions]);
	$vencimento = $data->func()->date_format([
		'vencimento' => 'literal',
		"'%d/%m/%y'" => 'literal'
		]);
	$pago = $data->func()->date_format([
		'pago' => 'literal',
		"'%d/%m/%y'" => 'literal'
		]);
	$data->select([
		'id','associado_id','desconto','acressimo','valor_base','valor_pago','pagamento_id','plano_id','observacoes',
		'novovencimento' => $vencimento,
		'novopago' => $pago
		]);


	require_once(ROOT .DS. "vendor" . DS  . "grid" . DS . "Grid.php");
	$grid = new Grid();
	$grid->addColumn('id', 'ID', 'integer', NULL, false); 
//	$grid->addColumn('associado_id', 'Associado', 'string', $associadosL->toArray());  
	$grid->addColumn('novovencimento', 'Vencimento', 'date');
	$grid->addColumn('novopago', 'Pagamento', 'date');  
	$grid->addColumn('valor_base', 'Valor', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('desconto', 'Desconto', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('acressimo', 'Acrescimo', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('valor_pago', 'Pago', 'double(R$,2,comma,dot,1)');  
	$grid->addColumn('pagamento_id', 'Forma', 'string', $pagamentosL->toArray());  
	$grid->addColumn('plano_id', 'Plano', 'string', $planoL->toArray());  
	$grid->addColumn('action', 'A', 'html', NULL, false, 'id');  

	$data = $grid->getPOJO($data);

        $mensalidade = $this->Mensalidade->newEntity();
        $this->set(compact('associado','data','mensalidade','pagamentosL','planoM'));
        $this->set('_serialize', 'data');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mensalidade = $this->Mensalidade->newEntity();
        if ($this->request->is('post')) {
            $mensalidade = $this->Mensalidade->patchEntity($mensalidade, $this->request->data);
            if ($this->Mensalidade->save($mensalidade)) {
                $this->Flash->success(__('The mensalidade has been saved.'));
	        $this->SysAna->logActions($this->name,'Adicionado',[$mensalidade->associado_id,$mensalidade->vencimento],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
		    die(debug($mensalidade->errors()));
                $this->Flash->error(__('The mensalidade could not be saved. Please, try again.'));
            }
        }
        $pagamentos = $this->Mensalidade->Pagamentos->find('list', ['keyField' => 'id', 'valueField' => 'tipo', 'limit' => 200]);
        $planos = $this->Mensalidade->Plano->find('list', ['keyField' => 'id', 'valueField' => 'nome_plano', 'limit' => 200]);
        $associados = $this->Mensalidade->Associados->find('list', [
                                'keyField' => 'id',
                                'valueField' => function($row) { return $row['nome'] . ' ' . $row['sobrenome'] . ' (' . $row['apelido'] . ') '  ; },
                                'limit' => 400
        ]);
        $this->set(compact('mensalidade', 'associados', 'pagamentos','planos'));
        $this->set('_serialize', ['mensalidade']);
    }

    public function vadd()
    {
        $mensalidade = $this->Mensalidade->newEntity();
        if ($this->request->is('post')) {
          $this->request->data['vencimento'] = Time::parseDate($this->request->data['vencimento']);
            $mensalidade = $this->Mensalidade->patchEntity($mensalidade, $this->request->data);
            if ($this->Mensalidade->save($mensalidade)) {
	            $this->SysAna->logActions($this->name,'vAdicionado',[$mensalidade->associado_id,$mensalidade->vencimento],$this->Auth->user('id'));
		    $return = 'ok';
            } else {
		    $return = $mensalidade->errors();
            }
        }
      $this->set(compact('return'));
      $this->set('_serialize', 'return');
    }

    /**
     * Edit method
     *
     * @param string|null $id Mensalidade id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mensalidade = $this->Mensalidade->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mensalidade = $this->Mensalidade->patchEntity($mensalidade, $this->request->data);
            if ($this->Mensalidade->save($mensalidade)) {
                $this->Flash->success(__('The mensalidade has been saved.'));
	            $this->SysAna->logActions($this->name,'Editado',[$mensalidade->associado_id,$mensalidade->vencimento],$this->Auth->user('id'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mensalidade could not be saved. Please, try again.'));
            }
        }
        $associados = $this->Mensalidade->Associados->find('list', ['limit' => 200]);
        $pagamentos = $this->Mensalidade->Pagamentos->find('list', ['limit' => 200]);
        $this->set(compact('mensalidade', 'associados', 'pagamentos'));
        $this->set('_serialize', ['mensalidade']);
    }

    public function vedit($aid = null)
    {
	$mensalidade = $this->request->data;
	if(in_array($mensalidade['colname'],array('novovencimento','novopago'))) $mensalidade['newvalue'] = date('Y-m-d', strtotime(str_replace('/','-',$mensalidade['newvalue'])));
	$mensalidade['colname'] = str_replace('novo','',$mensalidade['colname']);
		$mUp = $this->Mensalidade->query();
		$mUp->update()
			->set([$mensalidade['colname']=>$mensalidade['newvalue']])
			->where(['id' => $mensalidade['id']])
			->execute();
	$this->SysAna->logActions($this->name,'vEditado',[$mensalidade['id'],$mensalidade['colname'],$mensalidade['newvalue']],$this->Auth->user('id'));
	$return = 'ok';
        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }
    /**
     * Delete method
     *
     * @param string|null $id Mensalidade id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mensalidade = $this->Mensalidade->get($id);
        if ($this->Mensalidade->delete($mensalidade)) {
	            $this->SysAna->logActions($this->name,'Excluido',[$mensalidade->associado_id,$mensalidade->vencimento,$id],$this->Auth->user('id'));
            $this->Flash->success(__('The mensalidade has been deleted.'));
        } else {
            $this->Flash->error(__('The mensalidade could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function vdel($aid = null)
    {
        $mensalidade = $this->Mensalidade->get($this->request->data['id']);
        if ($this->Mensalidade->delete($mensalidade)) {
	            $this->SysAna->logActions($this->name,'vExcluido',[$mensalidade->associado_id,$mensalidade->vencimento,$this->request->data['id']],$this->Auth->user('id'));
		    $return = 'ok';
        } else {
		    $return = $mensalidade->errors();
        }
        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }

    public function gera()
    {
	$this->Time = TableRegistry::get('Time');
        $timeL = $this->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $time = $this->Time->find('all');

        if ($this->request->is(['patch', 'post', 'put'])) {
		$this->Associados = TableRegistry::get('Associados');
		$this->Mensalidade = TableRegistry::get('Mensalidade');
		if(isset($this->request->data['time_id']) && isset($this->request->data['vencimento'])){
			$Aconditions = "Time.id IN (".implode(",",$this->request->data['time_id']).") AND Associados.ativo = 1";
			$vencimento = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['vencimento'])));

        		$mensalidade = $this->Mensalidade->newEntity();
			$associados = $this->Associados->find('all',['contain'=>['Time','Plano','Mensalidade'],'conditions'=>$Aconditions]);
			$gerar = $associados->toArray();
			$gerado['vencimento'] = $vencimento;

			foreach($gerar as $gkey => $gvalue){
 				$meses_plano = $gvalue['plano']['meses'];
				if(isset($gvalue['mensalidade'])) {
					foreach($gvalue['mensalidade'] as $gvmens){
						$inicio_vencimento = $gvmens['vencimento']->i18nFormat('yyyy-MM-dd');
						$fim_vencimento = date('Y-m-d', strtotime('+'.$meses_plano.' months',strtotime($inicio_vencimento)));
						if (($vencimento >= $inicio_vencimento) && ($vencimento < $fim_vencimento)) 
							$gerado['blacklist'][$gvalue['id']] = ['vencimento' => $inicio_vencimento, 'valor_base' => $gvmens['valor_base'], 'plano_id' => $gvalue['plano_id']];
					}
				}
				if((!isset($gerado['blacklist'][$gvalue['id']])) && ($gvalue['plano']['valor_base'] > 0))
					$gerado['whitelist'][$gvalue['id']] = ['vencimento' => $vencimento, 'valor_base' => $gvalue['plano']['valor_base'], 'plano_id' => $gvalue['plano_id']];
			}
		}
		if(isset($this->request->data['Mensalidade'])) {
		    $created = $this->Mensalidade->newEntities($this->request->data['Mensalidade']);
		    foreach ($created as $create) $this->Mensalidade->save($create);
		    if (!$create->errors()) {
	                $this->SysAna->logActions($this->name,'Geradas',[$this->request->data['Mensalidade'][0]['vencimento']],$this->Auth->user('id'));
            		$this->Flash->success(__('Mensalidades criadas.'));
			return $this->redirect(array('action' => 'gera'));                 
		    } else {
            		 $this->Flash->error(__('Mensalidades nao foram criadas.'));
		    }		    
		}
        }
        $this->set(compact('time','timeL','associados','gerado','mensalidade'));
        $this->set('_serialize', ['time']);
    }

    public function reper()
    {
	$this->Time = TableRegistry::get('Time');
        $timeL = $this->Time->find('list', ['keyField' => 'id', 'valueField' => 'nome', 'limit' => 200]);
        $time = $this->Time->find('all');

        if ($this->request->is(['patch', 'post', 'put'])) {

		$this->Associados = TableRegistry::get('Associados');
		if($this->request->data['time_id'] && $this->request->data['inicio'] && $this->request->data['fim']){
			$Aconditions = "Time.id IN (".implode(",",$this->request->data['time_id']).")";
			$inicio = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['inicio'])));
			$fim = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['fim'])));

			$associados = $this->Associados->find('all',['contain'=>['Time','Plano','Mensalidade'],'conditions'=>$Aconditions]);
			$gerar = $associados->toArray();
			$gerado['inicio'] = $inicio;
			$gerado['fim'] = $fim;
			$gerado['dados'] = array();

			foreach($gerar as $gkey => $gvalue){
				if(isset($gvalue['mensalidade']) && isset($gvalue['time']['id'])) {
					foreach($gvalue['mensalidade'] as $gvmens){
						$vencimento = $gvmens['vencimento']->i18nFormat('yyyy-MM-dd');
						if (($vencimento >= $inicio) && ($vencimento <= $fim)) { 
							$gvmens['associado'] = [$gvalue['nome'],$gvalue['sobrenome'],$gvalue['apelido']];
							if(!isset($gerado['dados'][$gvalue['time']['id']])) $gerado['dados'][$gvalue['time']['id']] = array();
							if(!isset($gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')])) {
								$gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')] = ['mensalidades'=>0,'naopago'=>0,'valor'=>0,'pago'=>0];
						        	$gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')]['associado'] = array(); 
							}
							if(!($gvmens['valor_base'] == $gvmens['valor_pago']))
						        $gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')]['associado'][] = $gvmens; 
					        	$gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')]['mensalidades']++;
							if (!$gvmens['pago']) $gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')]['naopago']++;
					        	$gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')]['valor'] += $gvmens['valor_base'];
					        	$gerado['dados'][$gvalue['time']['id']][$gvmens['vencimento']->i18nFormat('MM')]['pago'] += $gvmens['valor_pago'];
						}
					}
				}
			}
		}
        }
        $this->set(compact('time','timeL','associados','gerado','mensalidade'));
        $this->set('_serialize', ['time']);
    }

    public function reass()
    {
	$this->Associados = TableRegistry::get('Associados');
	$conditions = null;
	if (isset($this->request->query['ativo'])) {
		switch($this->request->query['ativo']) {
			case 'a':
				$query_ativo = ' AND Associados.ativo = 1';
				break;
			case 'i':
				$query_ativo = ' AND Associados.ativo = 0';
				break;
			default:
				$query_ativo = ' ';
		}
		$this->set('ativo',$this->request->query['ativo']);
	}
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'( Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Associados.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.email LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Associados.cpf LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Plano.nome_plano LIKE "%'.$this->request->query['filtro'].
				'%" OR Time.nome LIKE "%'.$this->request->query['filtro'].'%" )'.
				$query_ativo;		       
		$this->set('filtro',$this->request->query['filtro']);
	}

	$associados = $this->Associados->find('all',['contain'=>['Time','Plano','Mensalidade'],'conditions' => $conditions]);
	$gerar = $associados->toArray();
	foreach($gerar as $gkey => $gvalue){
		$tmp_associado = ['mensalidade'=>0,'naopago'=>0,'valor'=>0,'pago'=>0];
		if(isset($gvalue['mensalidade'])) {
			foreach($gvalue['mensalidade'] as $gvmens){
				$tmp_associado['mensalidade']++;
				$tmp_associado['valor']+=$gvmens['valor_base'];
				$tmp_associado['pago']+=$gvmens['valor_pago'];
				if(!($gvmens['valor_pago'] >= $gvmens['valor_base']) && ($gvmens['vencimento'] < Time::now())) {
					$tmp_associado['naopago']++;
				}
			}
		}
		if($tmp_associado['naopago'] > 0) {
			$gerado[] = [
				'id' => $gvalue['id'],
				'ativo' => $gvalue['ativo'],
				'nome' => $gvalue['nome'] .' ('. $gvalue['apelido'] .') ' . $gvalue['sobrenome'],
				'timeplano' => $gvalue['time']['nome'] .' - '. $gvalue['plano']['nome_plano'],
				'mensalidade' => $tmp_associado,
				];
		}
	}
        $this->set(compact('gerado'));
        $this->set('_serialize', ['time']);
    }

    public function adass()
    {
	$this->Associados = TableRegistry::get('Associados');
	$conditions = null;
	if (isset($this->request->query['ativo'])) {
		switch($this->request->query['ativo']) {
			case 'a':
				$query_ativo = ' AND Associados.ativo = 1';
				break;
			case 'i':
				$query_ativo = ' AND Associados.ativo = 0';
				break;
			default:
				$query_ativo = ' ';
		}
		$this->set('ativo',$this->request->query['ativo']);
	}
	if(isset($this->request->query['filtro'])){
        	$conditions =  	'( Associados.nome LIKE "%'.$this->request->query['filtro'].
		       		'%" OR Associados.sobrenome LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.email LIKE "%'.$this->request->query['filtro'].
                              	'%" OR Associados.apelido LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Associados.cpf LIKE "%'.$this->request->query['filtro'].
                       		'%" OR Plano.nome_plano LIKE "%'.$this->request->query['filtro'].
				'%" OR Time.nome LIKE "%'.$this->request->query['filtro'].'%" )'.
				$query_ativo;		       
		$this->set('filtro',$this->request->query['filtro']);
	}

	$associados = $this->Associados->find('all',['contain'=>['Time','Plano','Mensalidade'],'conditions' => $conditions]);
	$gerar = $associados->toArray();
	foreach($gerar as $gkey => $gvalue){
		$tmp_associado = ['mensalidade'=>0,'naopago'=>0,'valor'=>0,'pago'=>0];
		if(isset($gvalue['mensalidade'])) {
			foreach($gvalue['mensalidade'] as $gvmens){
				$tmp_associado['mensalidade']++;
				$tmp_associado['valor']+=$gvmens['valor_base'];
				$tmp_associado['pago']+=$gvmens['valor_pago'];
				if(!($gvmens['valor_pago'] >= $gvmens['valor_base']) && ($gvmens['vencimento'] < Time::now())) {
					$tmp_associado['naopago']++;
				}
			}
		}
		if($tmp_associado['naopago'] == 0) {
			$gerado[] = [
				'id' => $gvalue['id'],
				'ativo' => $gvalue['ativo'],
				'nome' => $gvalue['nome'] .' ('. $gvalue['apelido'] .') ' . $gvalue['sobrenome'],
				'timeplano' => $gvalue['time']['nome'] .' - '. $gvalue['plano']['nome_plano'],
				'mensalidade' => $tmp_associado,
				];
		}
	}
        $this->set(compact('gerado'));
        $this->set('_serialize', ['time']);
    }


}
