<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
    
/**
 * Activite Controller
 *
 * @property \App\Model\Table\ActiviteTable $Activite
 */
class ActiviteController extends AppController
{

    public function recupNomActivite($id=null){
         $activite = $this->Activite->get($id, [
            'contain' => []
        ]);
         echo $activite->NomActivite;
    }
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

        $activite = $this->paginate($this->Activite);

        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
    }

    /**
     * View method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);


        $activite = $this->Activite->get($id, [
            'contain' => []
        ]);

        $this->set('activite', $activite);
        $this->set('_serialize', ['activite']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('cherLayout');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."categorieactivite.php");
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $activite = $this->Activite->newEntity();
        if ($this->request->is('post')) {
           // debug($this->request->data);
            $activite = $this->Activite->patchEntity($activite, $this->request->data);
            if ($this->Activite->save($activite)) {
                $this->Flash->success(__('The activite has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The activite could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Activite id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('cherLayout');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."categorieactivite.php");
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);


        $activite = $this->Activite->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activite = $this->Activite->patchEntity($activite, $this->request->data);
            if ($this->Activite->save($activite)) {
                $this->Flash->success(__('The activite has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The activite could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Activite id.
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
        $activite = $this->Activite->get($id);


        $table = TableRegistry::get('occupation')
            ->find()
            ->where(['CodeActivite'=>$activite->CodeActivite])
            ->first();

        if(isset($table['CodeActivite'])){
             $this->Flash->error(__('Cette activitée a été utilisée par des candidats, veuillez choisir une action.'));
            return $this->redirect(['action' => 'reaffect',$activite->CodeActivite]);
        }   
      
        if ($this->Activite->delete($activite)) {
            $this->Flash->success(__('The activite has been deleted.'));
        } else {
            $this->Flash->error(__('The activite could not be deleted. Please, try again.'));
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
        $activite = $this->Activite->get($id);
        $list_activite = TableRegistry::get('activite')
            ->find()
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->data);
            //debug($activite);

            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation    
                ->update()
                ->set(['CodeActivite' => $this->request->data['CodeActivite']])
                ->where(['CodeActivite' => $activite->CodeActivite])
                ->execute();

            $this->Flash->success(__('Les occupations ont été réaffectées'));
            $this->redirect(['action' => 'index']);
        }
        $this->set('activite', $activite);
        $this->set('list_activite', $list_activite);
        $this->set('_serialize', ['activite']);    
    }

    public function deleteAll($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        $activite = $this->Activite->get($id);

        if ($this->request->is(['patch', 'post', 'put','delete'])) {
           // debug($activite['CodeActivite']);

            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation
                ->delete()
                ->where(['CodeActivite' => $activite['CodeActivite']])
                ->execute();

            $target = TableRegistry::get('activite')
                ->query();
            $target
                ->delete()
                ->where(['CodeActivite' => $activite['CodeActivite']])
                ->execute();

            $this->Flash->success(__('l\'activitée Les occupations ont été supprimées'));
            $this->redirect(['action' => 'index']);
        }

        $this->set('activite', $activite);
        $this->set('_serialize', ['activite']); 
    }
    
    public function request(){
        $id = $this->request->data['value'];
        $activites = $this->Activite->find('all', ['conditions' => ['CodeCategorie' => $id]]);
        $this->set(compact('activites'));
        $this->set('_serialize', ['activites']); 
    }
}
