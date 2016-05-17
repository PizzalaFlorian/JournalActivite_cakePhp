<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Dispositif Controller
 *
 * @property \App\Model\Table\DispositifTable $Dispositif
 */
class DispositifController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
         $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $dispositif = $this->paginate($this->Dispositif);

        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * View method
     *
     * @param string|null $id Dispositif id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dispositif = $this->Dispositif->get($id, [
            'contain' => []
        ]);

        $this->set('dispositif', $dispositif);
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $dispositif = $this->Dispositif->newEntity();
        if ($this->request->is('post')) {
            //debug($this->request->data);
            $dispositif = $this->Dispositif->patchEntity($dispositif, $this->request->data);
            if ($this->Dispositif->save($dispositif)) {
                $this->Flash->success(__('The dispositif has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dispositif could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dispositif id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $dispositif = $this->Dispositif->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dispositif = $this->Dispositif->patchEntity($dispositif, $this->request->data);
            if ($this->Dispositif->save($dispositif)) {
                $this->Flash->success(__('The dispositif has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dispositif could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dispositif id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $this->request->allowMethod(['post', 'delete']);
        $dispositif = $this->Dispositif->get($id);

        $table = TableRegistry::get('occupation')
            ->find()
            ->where(['CodeDispositif'=>$dispositif->CodeDispositif])
            ->first();

        if(isset($table['CodeDispositif'])){
             $this->Flash->error(__('Ce dispositif a été utilisée par des candidats, veuillez choisir une action.'));
            return $this->redirect(['action' => 'reaffect',$dispositif->CodeDispositif]);
        }

        if ($this->Dispositif->delete($dispositif)) {
            $this->Flash->success(__('The dispositif has been deleted.'));
        } else {
            $this->Flash->error(__('The dispositif could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function reaffect($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $this->viewBuilder()->layout('cherLayout');
        $dispositif = $this->Dispositif->get($id);
        
        $list_dispositif = TableRegistry::get('dispositif')
            ->find()
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation    
                ->update()
                ->set(['CodeDispositif' => $this->request->data['CodeDispositif']])
                ->where(['CodeDispositif' => $dispositif->CodeDispositif])
                ->execute();

            $this->Flash->success(__('Les occupations ont été réaffectées'));
            $this->redirect(['action' => 'index']);
        }
        $this->set('dispositif', $dispositif);
        $this->set('list_dispositif', $list_dispositif);
        $this->set('_serialize', ['dispositif']);    
    }

    public function deleteAll($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
         $dispositif = $this->Dispositif->get($id);

        if ($this->request->is(['patch', 'post', 'put','delete'])) {
           // debug($activite['CodeDispositif']);

            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation
                ->delete()
                ->where(['CodeDispositif' => $dispositif['CodeDispositif']])
                ->execute();

            $target = TableRegistry::get('dispositif')
                ->query();
            $target
                ->delete()
                ->where(['CodeDispositif' => $dispositif['CodeDispositif']])
                ->execute();

            $this->Flash->success(__('le dispositif et les occupations ont été supprimées'));
            $this->redirect(['action' => 'index']);
        }

        $this->set('_serialize', ['dispositif']); 
    }
}
