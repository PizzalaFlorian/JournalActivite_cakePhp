<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Candidat Controller
 *
 * @property \App\Model\Table\CandidatTable $Candidat
 */
class CandidatController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $candidat = $this->paginate($this->Candidat);

        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);
    }

    /**
     * View method
     *
     * @param string|null $id Candidat id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidat = $this->Candidat->get($id, [
            'contain' => []
        ]);

        $this->set('candidat', $candidat);
        $this->set('_serialize', ['candidat']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidat = $this->Candidat->newEntity();
        if ($this->request->is('post')) {
            $candidat = $this->Candidat->patchEntity($candidat, $this->request->data);
            if ($this->Candidat->save($candidat)) {
                $this->Flash->success(__('The candidat has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The candidat could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidat id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidat = $this->Candidat->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidat = $this->Candidat->patchEntity($candidat, $this->request->data);
            if ($this->Candidat->save($candidat)) {
                $this->Flash->success(__('The candidat has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The candidat could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidat id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidat = $this->Candidat->get($id);
        if ($this->Candidat->delete($candidat)) {
            $this->Flash->success(__('The candidat has been deleted.'));
        } else {
            $this->Flash->error(__('The candidat could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
