<?php
namespace App\Controller;

use App\Controller\AppController;
use fonctionperso\chercheur\chercheurAccueil;
use fonctionperso\chercheur\chercheurDonnees;

/**
 * Administrateur Controller
 *
 * @property \App\Model\Table\AdministrateurTable $Administrateur
 */
class AdministrateurController extends AppController
{
    public function accueil(){
        $this->viewBuilder()->layout('adminLayout');

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurAccueil.php");

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "actualite" . DS ."actualite.php");
        $this->loadModel('Actualites');
        $actualites = $this->Actualites->find('all');
        $this->set(compact('actualites'));
        $this->set('_serialize', ['actualites']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $administrateur = $this->paginate($this->Administrateur);

        $this->set(compact('administrateur'));
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * View method
     *
     * @param string|null $id Administrateur id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $administrateur = $this->Administrateur->get($id, [
            'contain' => []
        ]);

        $this->set('administrateur', $administrateur);
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $administrateur = $this->Administrateur->newEntity();
        if ($this->request->is('post')) {
            $administrateur = $this->Administrateur->patchEntity($administrateur, $this->request->data);
            if ($this->Administrateur->save($administrateur)) {
                $this->Flash->success(__('The administrateur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The administrateur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('administrateur'));
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Administrateur id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $administrateur = $this->Administrateur->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $administrateur = $this->Administrateur->patchEntity($administrateur, $this->request->data);
            if ($this->Administrateur->save($administrateur)) {
                $this->Flash->success(__('The administrateur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The administrateur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('administrateur'));
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Administrateur id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $administrateur = $this->Administrateur->get($id);
        if ($this->Administrateur->delete($administrateur)) {
            $this->Flash->success(__('The administrateur has been deleted.'));
        } else {
            $this->Flash->error(__('The administrateur could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
