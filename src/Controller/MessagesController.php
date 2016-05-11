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
    // ==== ACTUALITES ==== //
        $this->loadModel('Actualites');
        $actualites = $this->Actualites->find('all');
        //$actualites = $this->paginate($this->Actualites);

        //$this->set(compact('actualites'));
        //$this->set('_serialize', ['actualites']);

    // ==== MESSAGERIE ==== //
        //fonction lié a la messagerie dans messagerie.php
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
        // on assigne un id pour les messageries
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'chercheur':       $monID = 1;                                                 break;
            case 'candidat':        $monID = $_SESSION['Auth']['User']['ID'];                   break;
            case 'admin':           $monID = 3;                                                 break;
        }
        // recuperation des messages
        $messages = $this->paginate($this->Messages->findAllByIdrecepteur($monID));
        $this->set(compact('messages'));
        $this->set(compact('actualites'));
        $this->set('_serialize', ['messages']);
        $this->set('_serialize', ['actualites']);
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
    public function delete($id = 0)
    {
        // si l'utilisateur est l'expediteur
        $message = $this->Messages->get($id, ['contain' => [] ]);
        if($_SESSION['Auth']['User']['ID'] == $message->IDExpediteur){
            $message->IDExpediteur = 0;
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Le message à bien été supprimé.'));
                //return $this->redirect(['action' => '']);
            } else {
                $this->Flash->error(__('Erreur: Le message n\'a pas pu être supprimer, veuillez réessayer.'));
            }
        }
        // si l'utilisateur est le recepteur
        if($_SESSION['Auth']['User']['ID'] == $message->IDRecepteur){
            $message->IDRecepteur = 0;
            if ($this->Messages->save($message)) {
               $this->Flash->success(__('Le message à bien été supprimé.'));
                //return $this->redirect(['action' => '']);
            } else {
                $this->Flash->error(__('Erreur: Le message n\'a pas pu être supprimer, veuillez réessayer.'));
            }
        }
        // si plus aucun expediteur / recepteur, alors on supprimer le message de la base de données.
        if(($message->IDExpediteur == 0)&&($message->IDRecepteur == 0)){
            $this->Messages->delete($message);
        }
        return $this->redirect(['action' => 'index']);
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
            $message->recepteurLu = "0";
            $message->expediteurLu = "0";
            $message->IDExpediteur = $_SESSION['Auth']['User']['ID'];
            $message->userExpediteur = $message->IDExpediteur;
            $message->userRecepteur = $message->IDRecepteur;
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