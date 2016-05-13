<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Categorielieu Controller
 *
 * @property \App\Model\Table\CategorielieuTable $Categorielieu
 */
class CategorielieuController extends AppController
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

        $categorielieu = $this->paginate($this->Categorielieu);

        $this->set(compact('categorielieu'));
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * View method
     *
     * @param string|null $id Categorielieu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categorielieu = $this->Categorielieu->get($id, [
            'contain' => []
        ]);

        $this->set('categorielieu', $categorielieu);
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categorielieu = $this->Categorielieu->newEntity();
        if ($this->request->is('post')) {
            $categorielieu = $this->Categorielieu->patchEntity($categorielieu, $this->request->data);
            if ($this->Categorielieu->save($categorielieu)) {
                $this->Flash->success(__('The categorielieu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The categorielieu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('categorielieu'));
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categorielieu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categorielieu = $this->Categorielieu->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categorielieu = $this->Categorielieu->patchEntity($categorielieu, $this->request->data);
            if ($this->Categorielieu->save($categorielieu)) {
                $this->Flash->success(__('The categorielieu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The categorielieu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('categorielieu'));
        $this->set('_serialize', ['categorielieu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Categorielieu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categorielieu = $this->Categorielieu->get($id);
        if ($this->Categorielieu->delete($categorielieu)) {
            $this->Flash->success(__('The categorielieu has been deleted.'));
        } else {
            $this->Flash->error(__('The categorielieu could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
