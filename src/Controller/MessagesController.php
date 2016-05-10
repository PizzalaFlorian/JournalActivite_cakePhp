<?php
namespace App\Controller;

use App\Controller\AppController;
use vendor\fonctionperso\messagerie\messagerie;
use Cake\ORM\TableRegistry;
//*******************************
//
// note : 
//        -   messages pour tout les chercheurs : 1
//        -   messages pour tout les etudiants  : 2
//  
//*******************************

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{
    /**
     * INDEX MESSAGERIE D'UN UTILISATEUR
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        //fonction lié a la messagerie dans messagerie.php
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
        // recupère les messages de l'utilisateur $_SESSION et de sa liste de diffusion 
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'chercheur':       $diffusion = 1;     break;
            case 'Candidat':        $diffusion = 2;     break;
            case 'admin':           $diffusion = 3;     break;
        }
        $actualite = $this->paginate($this->Messages->findAllByIdrecepteur(1));
        $messages = $this->paginate($this->Messages->findAllByIdrecepteur($_SESSION['Auth']['User']['ID']));
        $this->set(compact('messages'));
        $this->set('_serialize', ['messages']);
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);

        $this->set('message', $message);
        $this->set('_serialize', ['message']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The message could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The message could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('Le message à bien été supprimé.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'messagerie']);
    }
//affiche la messagerie d'un utilisateur
	public function messagerie($id = null)
    {
        // A SUPPRIMER AVEC LES FICHIER CONTROLLER ET TEMPLATE
    }
//envoie de message vers un utilisateur
//
//note : 
// tout les etudiants : 1
// tout les chercheurs : 2
//  
    public function nouveau()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            $message->DateEnvoi = "2016-05-08";
            $message->Lu = "0";
            $message->IDExpediteur = $_SESSION['Auth']['User']['ID'];
            //var_dump($message);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Votre message à bien été envoyé.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Echec de l\'envoie. Veuillez réessayer.'));
            }
        }
        $this->set(compact('message'));
        $this->set(compact('users'));
        $this->set('_serialize', ['message']);
    }
}