<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dispositif Controller
 *
 * @property \App\Model\Table\DispositifTable $Dispositif
 */
class DispositifController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $dispositif = $this->paginate($this->Dispositif);

        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * View method
     *
     * @param string|null $id Dispositif id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dispositif = $this->Dispositif->get($id, [
            'contain' => []
        ]);

        $this->set('dispositif', $dispositif);
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dispositif = $this->Dispositif->newEntity();
        if ($this->request->is('post')) {
            $dispositif = $this->Dispositif->patchEntity($dispositif, $this->request->data);
            if ($this->Dispositif->save($dispositif)) {
                $this->Flash->success(__('The dispositif has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dispositif could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dispositif id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dispositif = $this->Dispositif->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dispositif = $this->Dispositif->patchEntity($dispositif, $this->request->data);
            if ($this->Dispositif->save($dispositif)) {
                $this->Flash->success(__('The dispositif has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dispositif could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dispositif'));
        $this->set('_serialize', ['dispositif']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dispositif id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dispositif = $this->Dispositif->get($id);
        if ($this->Dispositif->delete($dispositif)) {
            $this->Flash->success(__('The dispositif has been deleted.'));
        } else {
            $this->Flash->error(__('The dispositif could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}