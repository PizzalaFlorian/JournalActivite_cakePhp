<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Activite Controller
 *
 * @property \App\Model\Table\ActiviteTable $Activite
 */
class ActiviteController extends AppController
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
        if ($this->Activite->delete($activite)) {
            $this->Flash->success(__('The activite has been deleted.'));
        } else {
            $this->Flash->error(__('The activite could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
