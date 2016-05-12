<?php
namespace App\Controller;

use App\Controller\AppController;
use fonctionperso\chercheur\chercheurAccueil;

/**
 * Chercheur Controller
 *
 * @property \App\Model\Table\ChercheurTable $Chercheur
 */
class ChercheurController extends AppController
{



    public function accueil(){
        $this->viewBuilder()->layout('cherLayout');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurAccueil.php");

    }

    public function modif()
    {
        $this->viewBuilder()->layout('cherLayout');
        $chercheur = $this->Chercheur->get($S_SESSION['Auth']['User']['ID'], [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('The chercheur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The chercheur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $chercheur = $this->paginate($this->Chercheur);

        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * View method
     *
     * @param string|null $id Chercheur id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chercheur = $this->Chercheur->get($id, [
            'contain' => []
        ]);

        $this->set('chercheur', $chercheur);
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chercheur = $this->Chercheur->newEntity();
        if ($this->request->is('post')) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('The chercheur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The chercheur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Chercheur id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chercheur = $this->Chercheur->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('The chercheur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The chercheur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Chercheur id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chercheur = $this->Chercheur->get($id);
        if ($this->Chercheur->delete($chercheur)) {
            $this->Flash->success(__('The chercheur has been deleted.'));
        } else {
            $this->Flash->error(__('The chercheur could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
