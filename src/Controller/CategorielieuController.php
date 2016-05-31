<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Categorielieu Controller
 *
 * @property \App\Model\Table\CategorielieuTable $Categorielieu
 */
class CategorielieuController extends AppController
{

    /**
     * Index method
     * @Accès chercheur
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
         $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $categorielieu = $this->paginate($this->Categorielieu);

        $this->set(compact('categorielieu'));
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * View method
     * @Accès chercheur
     * @param string|null $id Categorielieu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        
        $categorielieu = $this->Categorielieu->get($id, [
            'contain' => []
        ]);

        $this->set('categorielieu', $categorielieu);
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * Add method
     * @Accès chercheur
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $categorielieu = $this->Categorielieu->newEntity();
        if ($this->request->is('post')) {
            $categorielieu = $this->Categorielieu->patchEntity($categorielieu, $this->request->data);
            if ($this->Categorielieu->save($categorielieu)) {
                $this->Flash->success(__('La catégorie as été sauvegardée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la sauvegarde.'));
            }
        }
        $this->set(compact('categorielieu'));
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * Edit method
     * @Accès chercheur
     * @param string|null $id Categorielieu id.
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

        $categorielieu = $this->Categorielieu->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categorielieu = $this->Categorielieu->patchEntity($categorielieu, $this->request->data);
            if ($this->Categorielieu->save($categorielieu)) {
                $this->Flash->success(__('La catégorie as bien été modifiée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification.'));
            }
        }
        $this->set(compact('categorielieu'));
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * Delete method
     * @Accès chercheur
     * @param string|null $id Categorielieu id.
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
        $categorielieu = $this->Categorielieu->get($id);

        $table = TableRegistry::get('lieu')
            ->find()
            ->where(['CodeCategorieLieux'=>$categorielieu->CodeCategorieLieux])
            ->first();

        if(isset($table['CodeCategorieLieux'])){
             $this->Flash->error(__('Cette categorire contient des lieu, veuillez choisir une action.'));
            return $this->redirect(['action' => 'reaffect',$categorielieu->CodeCategorieLieux]);
        }

        if ($this->Categorielieu->delete($categorielieu)) {
            $this->Flash->success(__('La catégorie as bien été supprimée.'));
        } else {
            $this->Flash->error(__('Erreur lors de la suppression.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    
    /**
     * [reaffect Reaffectation des lieu appartenant a la catatégorie de lieu passer en $id vers la catégorie passer
     * en $POST]
     * @Accès Chercheur
     * @param  [int] $id [Ancienne catégorie]
     * @post [int] $this->request->data['CodeCategorieLieux'] [Nouvelle catégorie]
     * @return [Redirection]     [Redirection vers catégorieLieu Index]
     */
    public function reaffect($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $this->viewBuilder()->layout('cherLayout');
        $categorielieu = $this->Categorielieu->get($id);

        $list_categorie = TableRegistry::get('categorielieu')
            ->find()
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $lieux = TableRegistry::get('lieu')
                ->query();
            $lieux    
                ->update()
                ->set(['CodeCategorieLieux' => $this->request->data['CodeCategorieLieux']])
                ->where(['CodeCategorieLieux' => $categorielieu->CodeCategorieLieux])
                ->execute();

            $this->Flash->success(__('Les occupations ont été réaffectées'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set('categorielieu', $categorielieu);
        $this->set('list_categorie', $list_categorie);
        $this->set('_serialize', ['categorielieu']);    
    }


    /**
     * [deleteAll Supprime toutes les lieux et les occupation utilisant ces lieux, qui sont liée a la catégorie d'activitée passer en $POST ]
     * @Accès Chercheur
     * @param  [int] $id [Inutiliser]
     * @post [int] $this->request->data['CodeCategorieLieux'] [catégorie a supprimer]
     * @return [Redirection]     [Redirection vers catégorieLieu Index]
     */
    public function deleteAll($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        $categorielieu = $this->Categorielieu->get($id);

        if ($this->request->is(['patch', 'post', 'put','delete'])) {
           // debug($activite['CodeActivite']);

            $lieu = TableRegistry::get('lieu')
                ->query();
            $lieu
                ->delete()
                ->where(['CodeCategorieLieux' => $categorielieu['CodeCategorieLieux']])
                ->execute();

            $target = TableRegistry::get('categorielieu')
                ->query();
            $target
                ->delete()
                ->where(['CodeCategorieLieux' => $categorielieu['CodeCategorieLieux']])
                ->execute();

            $this->Flash->success(__('la catégorie et Les activitées ont été supprimées'));
            $this->redirect(['action' => 'index']);
        }

        $this->set('categorielieu', $categorielieu);
        $this->set('_serialize', ['categorielieu']);  
    }
}
