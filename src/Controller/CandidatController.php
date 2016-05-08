<?php
namespace App\Controller;

use App\Controller\AppController;
use fonctionperso\functionDate;
use fonctionperso\affichageActivite;

/**
 * Candidat Controller
 *
 * @property \App\Model\Table\CandidatTable $Candidat
 */
class CandidatController extends AppController
{

    public function activite()
    {
        $this->viewBuilder()->layout('candiLayout');

        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "calendar" . DS ."fonctions.affichage.activite.php");
        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "calendar" . DS ."fonctions.date.php"); 

        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "activite" . DS ."activite.php"); 
        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "activite" . DS ."categorie.activite.php"); 

        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "lieu" . DS ."lieux.php");
        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "lieu" . DS ."categorie.lieu.php"); 

        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "compagnie" . DS ."compagnie.php"); 

        require_once(ROOT .DS. "Vendor" . DS  . "functionperso" . DS . "dispositif" . DS ."dispositif.php"); 

        // Classes requise
        // require '../class/activite.class.php';
        // require '../class/lieu.class.php';
        // require '../class/categorieActivite.class.php';
        // require '../class/categorieLieu.class.php';
        // require '../class/compagnie.class.php';
        // require '../class/dispositif.class.php';

        // // Modele requis
        // require '../modele/activite.modele.php';
        // require '../modele/lieux.modele.php';
        // require '../modele/categorieActivite.modele.php';
        // require '../modele/categorieLieu.modele.php';
        // require '../modele/compagnie.modele.php';
        // require '../modele/dispositif.modele.php';
    }
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
