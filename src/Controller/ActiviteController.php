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
    /**
     * [recupNomActivite renvoie le nom de l'activite en fonction de son code.
     *  Fonction utilisée par le candidat lors d'opérations sur le remplissage de ses activitées]
     * @param  [int] $id [code de l'activité]
     * @return [string]     [nom de l'activité, affiché dans le template lié]
     */
    public function recupNomActivite($id=null){
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

         $activite = $this->Activite->get($id, [
            'contain' => []
        ]);
         echo $activite->NomActivite;
    }
    /**
     * [index affiche la liste des activiée. Fonction du chercheur]
     * @return [none]
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
     * [add ajoute une activité a la base de donnée. Fonction Chercheur.]
     * @post [objet] [objet activitée fournis par le formulaire, contient un code, un nom,
     *                une description,un code categorie]
     * @return   [redirection sur index si réussite]
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
                $this->Flash->success(__('L\'activité a bien été sauvegardée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer.'));
            }
        }
        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
    }

    /**
     * Edit method [modifie une activité, Fonction chercheur]
     *
     * @param string|null $id Activite id.
     * @return \Cake\Network\Response|void Redirects on successful index, renders view otherwise.
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
                $this->Flash->success(__('L\'activité a bien été sauvegardée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Une erreur a eu lieu lors de la sauvegarde. Veuillez réessayer.'));
            }
        }
        $this->set(compact('activite'));
        $this->set('_serialize', ['activite']);
    }

    /**
     * Delete method [Supprime une activité, Fonction chercheur]
     *
     * Warning ! [le code effectue une vérification qu'il n'y as pas d'occupation liée a cette activitée, 
     * si l'utilisateur comfirme la suppression, alors ces activiées sont aussi supprimées de la base de 
     * données.]
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
             $this->Flash->error(__('Cette activité a été utilisée par des candidats, veuillez choisir une action.'));
            return $this->redirect(['action' => 'reaffect',$activite->CodeActivite]);
        }   
      
        if ($this->Activite->delete($activite)) {
            $this->Flash->success(__('L\'activité a bien été supprimée.'));
        } else {
            $this->Flash->error(__('Une erreur a eu lieu lors de la suppression, veuillez réessayer.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * [reaffect Remplace le code activitée des occupation dont le code activitée est égal au $id, par un nouveau
     * code occupation donnée en POST. Fonction chercheur]
     * @param  [int] $id [Ancien code Activitée]
     * @post [int] $this->request->data['CodeActivite'] [Nouveau code Activité]
     * @return [redirection]     [Redirection vers l'index si réussite, sinon affiche un message d'erreur]
     */
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

    /**
     * [deleteAll Supprime toutes les occupations comportant un code activité égale a celui fourni en $id.
     Fonction chercheur]
     * @param  [int] $id [Code Activité]
     * @return [redirection]     [Renvoie a l'index]
     */
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

            $this->Flash->success(__('l\'activité et les occupations ont été supprimées'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('activite', $activite);
        $this->set('_serialize', ['activite']); 
    }
    
    /**
     * [request Renvoie la liste des activités liée a une catégorie. Fonction candidat]
     * @return [html] [renvoie une liste des activitée liée a une catégorie]
     */
    public function request(){
        $id = $this->request->data['value'];
        $activites = $this->Activite->find('all', ['conditions' => ['CodeCategorie' => $id]]);
        $this->set(compact('activites'));
        $this->set('_serialize', ['activites']); 
    }
}
