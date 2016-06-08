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

    /**
     * [recupNomLieu Renvoie le nom du lieu dont le code est passé en $id]
     * @accès Candidat
     * @param  [int] $id [CodeLieux]
     * @return [html]     [NomLieu]
     */
    public function recupNomLieu($id=null){
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
         $lieu = $this->Lieu->get($id, [
            'contain' => []
        ]);
         echo $lieu->NomLieux;
    }
    /**
     * Index method
     * @accès chercheur
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
     * Add method
     * @accès chercheur
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
                $this->Flash->success(__('Le lieu a été ajouté.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de l\'ajout. Veuillez réessayer.'));
            }
        }
        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * Edit method
     * @accès chercheur
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
                $this->Flash->success(__('Le lieu a été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification. Veuillez réessayer.'));
            }
        }
        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * Delete method
     * @accès chercheur
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
             $this->Flash->error(__('Ce lieu a été utilisé par des candidats, veuillez choisir une action.'));
            return $this->redirect(['action' => 'reaffect',$lieu->CodeLieux]);
        }

        if ($this->Lieu->delete($lieu)) {
            $this->Flash->success(__('Le lieu a été supprimé.'));
        } else {
            $this->Flash->error(__('Erreur lors de la suppression. Veuillez réessayer.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * [reaffect Réafectation des occupation ayant lieu dans le lieu de code $id vers le lieu passé dans $POST]
     * @accès Chercheur
     * @param  [int] $id [Ancien CodeLieu]
     * @post [int] $this->request->data['CodeLieux'] [nouvau code lieu]
     * @return [Redirection]     [Redirection Lieu Index]
     */
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
            return $this->redirect(['action' => 'index']);
        }
        $this->set('lieu', $lieu);
        $this->set('list_lieux', $list_lieux);
        $this->set('_serialize', ['lieu']);    
    }

    /**
     * [deleteAll Supprime le lieu et toutes les occupation liée]
     * @accès Chercheur
     * @return [type]     [description]
     */
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

            $this->Flash->success(__('le lieu et les occupations liées ont été supprimés'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('_serialize', ['lieu']);  
    }

    /**
     * [request Renvoie la liste des lieu liée a la catégorie]
     * @accès Candidat
     * @return [Html] [liste de lieu]
     */
    public function request(){
        $id = $this->request->data['value'];
        $lieux = $this->Lieu->find('all', ['conditions' => ['CodeCategorieLieux' => $id]]);
        $this->set(compact('lieux'));
        $this->set('_serialize', ['lieux']); 

    }
}
