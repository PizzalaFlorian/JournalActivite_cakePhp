<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Compagnie Controller
 *
 * @property \App\Model\Table\CompagnieTable $Compagnie
 */
class CompagnieController extends AppController
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

        $compagnie = $this->paginate($this->Compagnie);

        $this->set(compact('compagnie'));
        $this->set('_serialize', ['compagnie']);
    }

    /**
     * View method
     *
     * @param string|null $id Compagnie id.
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

        $compagnie = $this->Compagnie->get($id, [
            'contain' => []
        ]);

        $this->set('compagnie', $compagnie);
        $this->set('_serialize', ['compagnie']);
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

        $compagnie = $this->Compagnie->newEntity();
        if ($this->request->is('post')) {
            $compagnie = $this->Compagnie->patchEntity($compagnie, $this->request->data);
            if ($this->Compagnie->save($compagnie)) {
                $this->Flash->success(__('The compagnie has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The compagnie could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('compagnie'));
        $this->set('_serialize', ['compagnie']);
    }

    /**
     * Edit method
     *
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
                $this->Flash->success(__('The compagnie has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The compagnie could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('compagnie'));
        $this->set('_serialize', ['compagnie']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Compagnie id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $compagnie = $this->Compagnie->get($id);
        if ($this->Compagnie->delete($compagnie)) {
            $this->Flash->success(__('The compagnie has been deleted.'));
        } else {
            $this->Flash->error(__('The compagnie could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
