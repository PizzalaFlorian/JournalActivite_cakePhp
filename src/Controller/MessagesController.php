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
            $message->DateEnvoi = date('Y-m-d');
            $message->recepteurLu = "0";
            $message->expediteurLu = "0";
            $message->IDExpediteur = $_SESSION['Auth']['User']['ID'];
            $message->userExpediteur = $message->IDExpediteur;
            $message->userRecepteur = $message->IDRecepteur;
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

    public function repondre($id = null)
    {
        // on verifie que l'utilisateur accède bien a un message dont il est le destinataire ou le recepteur
        $monID = $_SESSION['Auth']['User']['ID'];
        $message = $this->Messages->get($id, ['contain' => [] ]);
        if(($message->IDExpediteur == $monID) || ($message->IDRecepteur == $monID)){
            //cherche la fonction afficheContenu de messagerie
            require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
            //si post, on enregistre
            if ($this->request->is(['patch', 'post', 'put'])) {
                //selectionne l'id de l'expediteur
                switch ($_SESSION['Auth']['User']['typeUser']) {
                    case 'candidat':    $monID = $_SESSION['Auth']['User']['ID'];       break;
                    case 'chercheur':   $monID = '1';                                   break;
                    case 'admin':       $monID = '0';                                   break;
                }
                $newMessage = $this->Messages->newEntity();
                $newMessage = $this->Messages->patchEntity($newMessage, $this->request->data);
                $newMessage->DateEnvoi = date('Y-m-d');
                $newMessage->recepteurLu = "0";
                $newMessage->expediteurLu = "0";
                $newMessage->IDExpediteur = $monID;
                $newMessage->userExpediteur = $newMessage->IDExpediteur;
                $newMessage->userRecepteur = $newMessage->IDRecepteur;
                if ($this->Messages->save($newMessage)) {
                    $this->Flash->success(__('Votre message à bien été envoyé.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Echec de l\'envoie. Veuillez réessayer.'));
                    //return $this->redirect(['action' => 'index']);
                }
            }
            //recupère le pseudo de l'expediteur
            $this->loadModel('Users');
            $users = $this->Users->get($message->IDExpediteur, ['contain' => [] ]);
            switch ($users->typeUser) {
                case 'candidat':    $pseudo = "Candidat ".$users->ID;  $pseudoID = $users->ID;           break;
                case 'chercheur':   $pseudo = "Chercheur";             $pseudoID = '1';                  break;
                case 'admin':       $pseudo = "Administrateur";        $pseudoID = '0';                  break;
            }
            //prépare les variables pour le template
            $this->set(compact('pseudo'));
            $this->set(compact('pseudoID'));
            //$this->set('_serialize', ['pseudo']);
            $this->set(compact('message'));
            $this->set('_serialize', ['message']);
        } else {
            // Si le message affiché n'appartient pas a l'utilisateur connecté, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'Authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }
    }
}