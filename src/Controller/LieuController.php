<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lieu Controller
 *
 * @property \App\Model\Table\LieuTable $Lieu
 */
class LieuController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $lieu = $this->paginate($this->Lieu);

        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * View method
     *
     * @param string|null $id Lieu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lieu = $this->Lieu->get($id, [
            'contain' => []
        ]);

        $this->set('lieu', $lieu);
        $this->set('_serialize', ['lieu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lieu = $this->Lieu->newEntity();
        if ($this->request->is('post')) {
            $lieu = $this->Lieu->patchEntity($lieu, $this->request->data);
            if ($this->Lieu->save($lieu)) {
                $this->Flash->success(__('The lieu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lieu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lieu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lieu = $this->Lieu->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lieu = $this->Lieu->patchEntity($lieu, $this->request->data);
            if ($this->Lieu->save($lieu)) {
                $this->Flash->success(__('The lieu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lieu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lieu'));
        $this->set('_serialize', ['lieu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lieu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lieu = $this->Lieu->get($id);
        if ($this->Lieu->delete($lieu)) {
            $this->Flash->success(__('The lieu has been deleted.'));
        } else {
            $this->Flash->error(__('The lieu could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}