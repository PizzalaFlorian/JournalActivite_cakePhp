<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Utilisateur Controller
 *
 * @property \App\Model\Table\UtilisateurTable $Utilisateur
 */
class UtilisateurController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $utilisateur = $this->paginate($this->Utilisateur);

        $this->set(compact('utilisateur'));
        $this->set('_serialize', ['utilisateur']);
    }

    /**
     * View method
     *
     * @param string|null $id Utilisateur id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $utilisateur = $this->Utilisateur->get($id, [
            'contain' => []
        ]);

        $this->set('utilisateur', $utilisateur);
        $this->set('_serialize', ['utilisateur']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $utilisateur = $this->Utilisateur->newEntity();
        if ($this->request->is('post')) {
            $utilisateur = $this->Utilisateur->patchEntity($utilisateur, $this->request->data);
            if ($this->Utilisateur->save($utilisateur)) {
                $this->Flash->success(__('The utilisateur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The utilisateur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('utilisateur'));
        $this->set('_serialize', ['utilisateur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Utilisateur id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $utilisateur = $this->Utilisateur->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $utilisateur = $this->Utilisateur->patchEntity($utilisateur, $this->request->data);
            if ($this->Utilisateur->save($utilisateur)) {
                $this->Flash->success(__('The utilisateur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The utilisateur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('utilisateur'));
        $this->set('_serialize', ['utilisateur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Utilisateur id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $utilisateur = $this->Utilisateur->get($id);
        if ($this->Utilisateur->delete($utilisateur)) {
            $this->Flash->success(__('The utilisateur has been deleted.'));
        } else {
            $this->Flash->error(__('The utilisateur could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $utilisateur = $this->Auth->identify();
            if ($utilisateur) {
                $this->Auth->setUser($utilisateur);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre username ou mot de passe est incorrect.');
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout','add']);
    }

    public function logout() 
    {
        $this->Flash->success('Vous êtes maintenant déconnecté.');
        return $this->redirect($this->Auth->logout());
    }
}
