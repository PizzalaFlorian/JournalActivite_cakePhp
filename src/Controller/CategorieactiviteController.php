<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Categorieactivite Controller
 *
 * @property \App\Model\Table\CategorieactiviteTable $Categorieactivite
 */
class CategorieactiviteController extends AppController
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
        $categorieactivite = $this->paginate($this->Categorieactivite);

        $this->set(compact('categorieactivite'));
        $this->set('_serialize', ['categorieactivite']);
    }

    /**
     * View method
     *
     * @param string|null $id Categorieactivite id.
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
        $categorieactivite = $this->Categorieactivite->get($id, [
            'contain' => []
        ]);

        $this->set('categorieactivite', $categorieactivite);
        $this->set('_serialize', ['categorieactivite']);
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
        $categorieactivite = $this->Categorieactivite->newEntity();
        if ($this->request->is('post')) {
            $categorieactivite = $this->Categorieactivite->patchEntity($categorieactivite, $this->request->data);
            if ($this->Categorieactivite->save($categorieactivite)) {
                $this->Flash->success(__('The categorieactivite has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The categorieactivite could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('categorieactivite'));
        $this->set('_serialize', ['categorieactivite']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categorieactivite id.
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
        $categorieactivite = $this->Categorieactivite->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categorieactivite = $this->Categorieactivite->patchEntity($categorieactivite, $this->request->data);
            if ($this->Categorieactivite->save($categorieactivite)) {
                $this->Flash->success(__('The categorieactivite has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The categorieactivite could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('categorieactivite'));
        $this->set('_serialize', ['categorieactivite']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Categorieactivite id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        $this->request->allowMethod(['post', 'delete']);
        $categorieactivite = $this->Categorieactivite->get($id);
        if ($this->Categorieactivite->delete($categorieactivite)) {
            $this->Flash->success(__('The categorieactivite has been deleted.'));
        } else {
            $this->Flash->error(__('The categorieactivite could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
