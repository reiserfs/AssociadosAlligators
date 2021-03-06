<?php
namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class SysAnaComponent extends Component
{
	public function globalconfig($var,$table=null) {
		$this->Configuracao = TableRegistry::get('Configuracao');
        	$configuracao = $this->Configuracao->find('all',[ 'conditions' => ['variavel'=>$var]]);
		$config = $configuracao->first();
		if($table) {
			$this->Tabela = TableRegistry::get($config['tabela']);
        		$tabela = $this->Tabela->find('all',[ 'conditions' => [$config['campo']=>$config['valor']]]);
			return $tabela->first();
		}
		return $config['valor'];
	}

    	public function multiimplode($glue, $array) {
	    	$ret = '';
	    	foreach ($array as $item) {
		        if (is_array($item)) {
			                $ret .= $this->multiimplode($glue, $item) . $glue;
		        } else {
				$ret .= $item . $glue;
			}
		}
    		$ret = substr($ret, 0, 0-strlen($glue));
    		return $ret;
    	}

// LOG ACTIONS NO BANCO DE DADOS
    public function logActions($modulo,$acao,$info,$user)
    {
    	    $info = (is_array($info)) ? $this->multiimplode("::",$info) : $info;
	    $log_data = array(
		   'login_id' => $user,
		   'controller' => $modulo,
		   'action'	=> $acao,
		   'info'	=> $info
	    );
	    $this->Logs = TableRegistry::get('Log');
	    $log = $this->Logs->newEntity($log_data);
	    if ($info) 
		    if (!$this->Logs->save($log))
			debug($log->errors());
    }
}
