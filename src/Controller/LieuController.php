<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Lieu Controller
 *
 * @property \App\Model\Table\LieuTable $Lieu
 */
class LieuController extends AppController
{

    public function recupNomLieu($id=null){
         $lieu = $this->Lieu->get($id, [
            'contain' => []
        ]);
         echo $lieu->NomLieux;
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

        $lieu = $this->paginate($this->Lieu);

        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * View method
     *
     * @param string|null $id Lieu id.
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
        $lieu = $this->Lieu->get($id, [
            'contain' => []
        ]);

        $this->set('lieu', $lieu);
        $this->set('_serialize', ['lieu']);
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
         //debug($this->request);
        $lieu = $this->Lieu->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->data);
            $lieu = $this->Lieu->patchEntity($lieu, $this->request->data);
            if ($this->Lieu->save($lieu)) {
                $this->Flash->success(__('Le lieu as été ajouté.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de l\'ajout.'));
            }
        }
        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lieu id.
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
        $lieu = $this->Lieu->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lieu = $this->Lieu->patchEntity($lieu, $this->request->data);
            if ($this->Lieu->save($lieu)) {
                $this->Flash->success(__('Le lieu as été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification.'));
            }
        }
        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lieu id.
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
        $lieu = $this->Lieu->get($id);

        $table = TableRegistry::get('occupation')
            ->find()
            ->where(['CodeLieux'=>$lieu->CodeLieux])
            ->first();

        if(isset($table['CodeLieux'])){
             $this->Flash->error(__('Ce lieu a été utilisée par des candidats, veuillez choisir une action.'));
            return $this->redirect(['action' => 'reaffect',$lieu->CodeLieux]);
        }

        if ($this->Lieu->delete($lieu)) {
            $this->Flash->success(__('Le lieu as été supprimée.'));
        } else {
            $this->Flash->error(__('Erreur lors de la suppression.'));
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
        $lieu = $this->Lieu->get($id);

        $list_lieux = TableRegistry::get('lieu')
            ->find()
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->data);
            //debug($activite);

            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation    
                ->update()
                ->set(['CodeLieux' => $this->request->data['CodeLieux']])
                ->where(['CodeLieux' => $lieu->CodeLieux])
                ->execute();

            $this->Flash->success(__('Les occupations ont été réaffectées'));
            $this->redirect(['action' => 'index']);
        }
        $this->set('lieu', $lieu);
        $this->set('list_lieux', $list_lieux);
        $this->set('_serialize', ['lieu']);    
    }

    public function deleteAll($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
         $lieu = $this->Lieu->get($id);

        if ($this->request->is(['patch', 'post', 'put','delete'])) {
           // debug($activite['CodeActivite']);

            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation
                ->delete()
                ->where(['CodeLieux' => $lieu['CodeLieux']])
                ->execute();

            $target = TableRegistry::get('lieu')
                ->query();
            $target
                ->delete()
                ->where(['CodeLieux' => $lieu['CodeLieux']])
                ->execute();

            $this->Flash->success(__('l\'activitée Les occupations ont été supprimées'));
            $this->redirect(['action' => 'index']);
        }

        $this->set('_serialize', ['lieu']);  
    }

    public function request(){
        $id = $this->request->data['value'];
        $lieux = $this->Lieu->find('all', ['conditions' => ['CodeCategorieLieux' => $id]]);
        $this->set(compact('lieux'));
        $this->set('_serialize', ['lieux']); 

    }
}
