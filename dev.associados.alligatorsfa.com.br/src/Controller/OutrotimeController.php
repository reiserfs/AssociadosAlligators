<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Outrotime Controller
 *
 * @property \App\Model\Table\OutrotimeTable $Outrotime
 */
class OutrotimeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $outrotime = $this->paginate($this->Outrotime);

        $this->set(compact('outrotime'));
        $this->set('_serialize', ['outrotime']);
    }

    /**
     * View method
     *
     * @param string|null $id Outrotime id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $outrotime = $this->Outrotime->get($id, [
            'contain' => []
        ]);

        $this->set('outrotime', $outrotime);
        $this->set('_serialize', ['outrotime']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $outrotime = $this->Outrotime->newEntity();
        if ($this->request->is('post')) {
            $outrotime = $this->Outrotime->patchEntity($outrotime, $this->request->data);

            $teste_logo = $this->tratarup($outrotime->logo);
            if($teste_logo[0])
            {
                $outrotime->logo = $teste_logo[0];
                $outrotime->logo_size = $teste_logo[2];
                $outrotime->logo_type = $teste_logo[3];
            }
            else
                unset($outrotime->logo);

            if ($this->Outrotime->save($outrotime)) {
                $this->Flash->success(__($teste_logo[1]));
                return $this->redirect(['action' => 'index']);
            } else {
		    die(debug($outrotime->errors()));
                $this->Flash->error(__('The outrotime could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('outrotime'));
        $this->set('_serialize', ['outrotime']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Outrotime id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $outrotime = $this->Outrotime->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $outrotime = $this->Outrotime->patchEntity($outrotime, $this->request->data);
            $teste_logo = $this->tratarup($outrotime->logo);
            if($teste_logo[0])
            {
                $outrotime->logo = $teste_logo[0];
                $outrotime->logo_size = $teste_logo[2];
                $outrotime->logo_type = $teste_logo[3];
            }
            else
                unset($outrotime->logo);
            if ($this->Outrotime->save($outrotime)) {
                $this->Flash->success(__($teste_logo[1]));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The outrotime could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('outrotime'));
        $this->set('_serialize', ['outrotime']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Outrotime id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $outrotime = $this->Outrotime->get($id);
        if ($this->Outrotime->delete($outrotime)) {
            $this->Flash->success(__('The outrotime has been deleted.'));
        } else {
            $this->Flash->error(__('The outrotime could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    // TRATAR UPLOAD 
    public function tratarup($logo = null)
    {
            if(is_uploaded_file($logo['tmp_name'])) 
	    {
		if ($logo['size']>10 && $logo['size'] < 150500)
		{
		    if (exif_imagetype($logo['tmp_name']))
		    {
                	$filedata = fread(fopen($logo['tmp_name'], "r"),$logo['size']);
			return array($filedata,'The outrotime has been saved.',$logo['size'],$logo['type']);
		    }
	            else
		       return array(false,'O arquivo enviado nao e uma imagem valida, imagem nao salva!');
                }
		else
		    return array(false,'A imagem precisa ser menor que 150kb, imagem nao salva!');
            }
	    return array(false,'The outrotime has been saved.');
    } 

    // GET IMG
    public function imgfoto($id = null)
    {
        $this->request->allowMethod(['get', 'img_logo']);
        $outrotime = $this->Outrotime->get($id);
	if($outrotime['logo_size'] > 10) {
    		header('Content-type: ' . $outrotime['logo_type']);
    		header('Content-length: ' . $outrotime['logo_size']);
    		header('Content-Disposition: inline; filename='.$outrotime['nome'] . '.'.$outrotime['logo_type']);
		while (!feof($outrotime['logo'])) {
    			echo fread($outrotime['logo'], $outrotime['logo_size']);
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
