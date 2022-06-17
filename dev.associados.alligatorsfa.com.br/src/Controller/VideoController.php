<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Grid\Grid;

/**
 * Video Controller
 *
 * @property \App\Model\Table\VideoTable $Video
 */
class VideoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['OutrotimeCasa','OutrotimeVisitante']
        ];
        $video = $this->paginate($this->Video);

        $this->set(compact('video'));
        $this->set('_serialize', ['video']);
    }

    /**
     * View method
     *
     * @param string|null $id Video id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function snap($id = null)
    {
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
	$grid->addColumn('action', 'D', 'html', NULL, false, 'id');  

	$data = $grid->getPOJO($data);

        $videosnap = $this->Video->Videosnap->newEntity();
        $this->set(compact('video','data','videosnap','times','resultados'));
        $this->set('_serialize', 'data');
    }

    public function view($id = null)
    {
        $video = $this->Video->get($id, [
            'contain' => ['OutrotimeCasa','OutrotimeVisitante', 'Videosnap']
        ]);

        $this->set('video', $video);
        $this->set('_serialize', ['video']);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $video = $this->Video->newEntity();
        if ($this->request->is('post')) {
	    $this->request->data['data'] = Time::createFromFormat('Y-m-d', date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['data']))));
            $video = $this->Video->patchEntity($video, $this->request->data);
            if ($this->Video->save($video)) {
                $this->Flash->success(__('The video has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The video could not be saved. Please, try again.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
        $outrotimecasa = $this->Video->OutrotimeCasa->find('list', ['limit' => 200,'keyField' => 'id','valueField'=>'nome']);
        $outrotimevisitante = $this->Video->OutrotimeVisitante->find('list', ['limit' => 200,'keyField' => 'id','valueField'=>'nome']);
        $this->set(compact('video', 'outrotimecasa','outrotimevisitante'));
        $this->set('_serialize', ['video']);
    }

    public function vadd()
    {
        $snap = $this->Video->Videosnap->newEntity();
        if ($this->request->is('post')) {
            $snap = $this->Video->Videosnap->patchEntity($snap, $this->request->data);
            if ($this->Video->Videosnap->save($snap)) {
	          //  $this->SysAna->logActions($this->name,'vAdicionado',[$mensalidade->associado_id,$mensalidade->vencimento],$this->Auth->user('id'));
		    $return = 'ok';
            } else {
		    $return = $snap->errors();
            }
        }
      $this->set(compact('return'));
      $this->set('_serialize', 'return');
    }

    /**
     * Edit method
     *
     * @param string|null $id Video id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $video = $this->Video->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
	    $this->request->data['data'] = Time::createFromFormat('Y-m-d', date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['data']))));
            $video = $this->Video->patchEntity($video, $this->request->data);
            if ($this->Video->save($video)) {
                $this->Flash->success(__('The video has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The video could not be saved. Please, try again.'));
            }
        }
	$this->set('estados',Configure::read('estados'));
        $outrotimecasa = $this->Video->OutrotimeCasa->find('list', ['limit' => 200,'keyField' => 'id','valueField'=>'nome']);
        $outrotimevisitante = $this->Video->OutrotimeVisitante->find('list', ['limit' => 200,'keyField' => 'id','valueField'=>'nome']);
        $this->set(compact('video', 'outrotimecasa','outrotimevisitante'));
        $this->set('_serialize', ['video']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Video id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $video = $this->Video->get($id);
        if ($this->Video->delete($video)) {
            $this->Flash->success(__('The video has been deleted.'));
	            $this->SysAna->logActions($this->name,'Excluido',[$video->id],$this->Auth->user('id'));
        } else {
            $this->Flash->error(__('The video could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function vdel($aid = null)
    {
        $video = $this->Video->Videosnap->get($this->request->data['id']);
        if ($this->Video->Videosnap->delete($video)) {
	            $this->SysAna->logActions($this->name,'SnapExcluido',[$video->video_id,$video->id],$this->Auth->user('id'));
		    $return = 'ok';
        } else {
		    $return = $video->errors();
        }
        $this->set(compact('return'));
        $this->set('_serialize', 'return');
    }
}
