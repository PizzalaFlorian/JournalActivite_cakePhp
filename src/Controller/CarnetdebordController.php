<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Carnetdebord Controller
 *
 * @property \App\Model\Table\CarnetdebordTable $Carnetdebord
 */
class CarnetdebordController extends AppController
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

        $carnetdebord = $this->paginate($this->Carnetdebord);

        $this->set(compact('carnetdebord'));
        $this->set('_serialize', ['carnetdebord']);
    }

    /**
     * View method
     *
     * @param string|null $id Carnetdebord id.
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

        $carnetdebord = $this->Carnetdebord->get($id, [
            'contain' => []
        ]);

        $this->set('carnetdebord', $carnetdebord);
        $this->set('_serialize', ['carnetdebord']);
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
       
        $chercheur = TableRegistry::get('chercheur')
            ->find()
            ->where(['ID'=>$_SESSION['Auth']['User']['ID']])
            ->first();

        $carnetdebord = $this->Carnetdebord->newEntity();
        if ($this->request->is('post')) {
            debug($this->request->data);
            $carnetdebord = $this->Carnetdebord->patchEntity($carnetdebord, $this->request->data);
            if ($this->Carnetdebord->save($carnetdebord)) {
                $this->Flash->success(__('L\'entrée du carnet de bord a été sauvegardée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la sauvegarde, veuillez réessayer.'));
            }
        }
        $this->set('chercheur',$chercheur);
        $this->set(compact('carnetdebord'));
        $this->set('_serialize', ['carnetdebord']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Carnetdebord id.
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

        $carnetdebord = $this->Carnetdebord->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carnetdebord = $this->Carnetdebord->patchEntity($carnetdebord, $this->request->data);
            if ($this->Carnetdebord->save($carnetdebord)) {
                $this->Flash->success(__('La modification a été effectuée.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification.'));
            }
        }
        $this->set(compact('carnetdebord'));
        $this->set('_serialize', ['carnetdebord']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Carnetdebord id.
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
        $carnetdebord = $this->Carnetdebord->get($id);
        if ($this->Carnetdebord->delete($carnetdebord)) {
            $this->Flash->success(__('L\'entrée as été supprimée.'));
        } else {
            $this->Flash->error(__('Echec de la suppression.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
