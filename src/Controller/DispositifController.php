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
     * [recupNomDispositif Renvoie le nom du dispositif dont le code est passer en $id]
     * @accès Candidat
     * @param  [int] $id [CodeDispositif]
     * @return [html]     [NomDispositif]
     */
    public function recupNomDispositif($id=null){
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        //accès candidat
         $dispositif = $this->Dispositif->get($id, [
            'contain' => []
        ]);
         echo $dispositif->NomDispositif;
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

        $dispositif = $this->paginate($this->Dispositif);

        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * View method
     * @Accès Chercheur
     * @param string|null $id Dispositif id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        
        $dispositif = $this->Dispositif->get($id, [
            'contain' => []
        ]);

        $this->set('dispositif', $dispositif);
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Add method
     * @Accès Chercheur
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
                $this->Flash->success(__('Le dispositif as bien été ajouter.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de l\'ajout du dispositif.'));
            }
        }
        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Edit method
     * @Accès Chercheur
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
                $this->Flash->success(__('Le dispositif as été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification.'));
            }
        }
        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Delete method
     * @Accès Chercheur
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
            $this->Flash->success(__('Le dispositif as été supprimée.'));
        } else {
            $this->Flash->error(__('Erreur lors de la suppression.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * [reaffect Réaafectation des occupation utilisant le dispositif de code $id vers le dispositif passé en $POST]
     * @accès chercheur
     * @param  [int] $id [Ancien dispositif]
     * @post [int] $this->request->data['CodeDispositif'] [Nouveau Dispositif]
     * @return [redirection]     [Dispositif Index]
     */
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
            return $this->redirect(['action' => 'index']);
        }
        $this->set('dispositif', $dispositif);
        $this->set('list_dispositif', $list_dispositif);
        $this->set('_serialize', ['dispositif']);    
    }

    /**
     * [deleteAll Suppression du dispositif et de toutes les occuptions l'utilisant]
     * @accès chercheur
     * @return [Redirection]     [Dispositif index]
     */
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
            return $this->redirect(['action' => 'index']);
        }

        $this->set('_serialize', ['dispositif']); 
    }
}
