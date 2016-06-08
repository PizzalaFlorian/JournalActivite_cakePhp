<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Compagnie Controller
 *
 * @property \App\Model\Table\CompagnieTable $Compagnie
 */
class CompagnieController extends AppController
{

    /**
     * [recupNomCompagnie Renvoie le nom de la compagnie dont le code est passé en $id]
     * @Accès Candidat
     * @param  [int] $id [CodeCompagnie]
     * @return [html]     [NomCompagnie]
     */
    public function recupNomCompagnie($id=null){
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        //accès candidat
         $compagnie = $this->Compagnie->get($id, [
            'contain' => []
        ]);
         echo $compagnie->NomCompagnie;
    }
    /**
     * Index method
     * @Accès Chercheur
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $compagnie = $this->paginate($this->Compagnie);

        $this->set(compact('compagnie'));
        $this->set('_serialize', ['compagnie']);
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

        $compagnie = $this->Compagnie->newEntity();
        if ($this->request->is('post')) {
            $compagnie = $this->Compagnie->patchEntity($compagnie, $this->request->data);
            if ($this->Compagnie->save($compagnie)) {
                $this->Flash->success(__('La comapgnie a bien été ajoutée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de l\'ajout de la compagnie. Veuillez réessayer.'));
            }
        }
        $this->set(compact('compagnie'));
        $this->set('_serialize', ['compagnie']);
    }

    /**
     * Edit method
     * @Accès chercheur
     * @param string|null $id Compagnie id.
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

        $compagnie = $this->Compagnie->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compagnie = $this->Compagnie->patchEntity($compagnie, $this->request->data);
            if ($this->Compagnie->save($compagnie)) {
                $this->Flash->success(__('La compagnie a bien été modifiée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification. Veuillez réessayer.'));
            }
        }
        $this->set(compact('compagnie'));
        $this->set('_serialize', ['compagnie']);
    }

    /**
     * Delete method
     * @Accès chercheur
     * @param string|null $id Compagnie id.
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
        $compagnie = $this->Compagnie->get($id);

        $table = TableRegistry::get('occupation')
            ->find()
            ->where(['CodeCompagnie'=>$compagnie->CodeCompagnie])
            ->first();

        if(isset($table['CodeCompagnie'])){
             $this->Flash->error(__('Cette compagnie a été utilisée par des candidats, veuillez choisir une action.'));
            return $this->redirect(['action' => 'reaffect',$compagnie->CodeCompagnie]);
        }  

        if ($this->Compagnie->delete($compagnie)) {
            $this->Flash->success(__('La compagnie a bien été supprimée.'));
        } else {
            $this->Flash->error(__('Erreur lors de la suppression. Veuillez réessayer.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    /**
     * [reaffect Réaffectation des occupation présantant le code compagnie $id vers la compagnie passer en $POST]
     * @accès chercheur
     * @param  [int] $id [Ancienne compagnie]
     * @post [int] $this->request->data['CodeCompagnie'] [Nouvelle compagnie]
     * @return [Redirection]     [Compagnie Index]
     */
    public function reaffect($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $this->viewBuilder()->layout('cherLayout');
        $compagnie = $this->Compagnie->get($id);

        $list_compagnie = TableRegistry::get('compagnie')
            ->find()
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation    
                ->update()
                ->set(['CodeCompagnie' => $this->request->data['CodeCompagnie']])
                ->where(['CodeCompagnie' => $compagnie->CodeCompagnie])
                ->execute();

            $this->Flash->success(__('Les occupations ont été réaffectées'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set('compagnie', $compagnie);
        $this->set('list_compagnie', $list_compagnie);
        $this->set('_serialize', ['dispositif']);    
    }


    /**
     * [deleteAll Suppression de la compagnie et de toutes les activités utilisant la compagnie passer en argument]
     * @Accès chercheur
     * @param  [int] $id [CodeCompagnie]
     * @return [Redirection]     [Compagnie index]
     */
    public function deleteAll($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $compagnie = $this->Compagnie->get($id);

        if ($this->request->is(['patch', 'post', 'put','delete'])) {
           // debug($activite['CodeDispositif']);

            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation
                ->delete()
                ->where(['CodeCompagnie' => $compagnie['CodeCompagnie']])
                ->execute();

            $target = TableRegistry::get('compagnie')
                ->query();
            $target
                ->delete()
                ->where(['CodeCompagnie' => $compagnie['CodeCompagnie']])
                ->execute();

            $this->Flash->success(__('la compagnie et les occupations ont été supprimées'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('_serialize', ['compagnie']); 
    }
}
