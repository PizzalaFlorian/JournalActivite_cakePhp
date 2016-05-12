<?php
namespace App\Controller;

use App\Controller\AppController;
use vendor\fonctionperso\messagerie\messagerie;
use Cake\ORM\TableRegistry;
//*******************************
//
// note : 
//        -   messages pour tout les chercheurs : 1
//        -   messages pour tout les etudiants  : annulé
//        -   messages pour les administrateur  : 0
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
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'chercheur':       $monController = "chercheur";        $monAction="accueil";                 break;
            case 'candidat':        $monController = "candidat";         $monAction="accueil";                 break;
            case 'admin':           $monController = "";                 $monAction="";                 break;
        }

        //$this->set(compact('actualites'));
        //$this->set('_serialize', ['actualites']);

    // ==== MESSAGERIE ==== //
        //fonction lié a la messagerie dans messagerie.php
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
        // on assigne un id pour les messageries
        switch ($_SESSION['Auth']['User']['typeUser']) {
            // les messages des chercheurs ont l'id 1
            case 'chercheur':       $monID = 1;                                                 break;
            // les messages des utilisateurs ont leur propre id
            case 'candidat':        $monID = $_SESSION['Auth']['User']['ID'];                   break;
            // les messages de admin auront l'id 0
            case 'admin':           $monID = 0;                                                 break;
        }
        // recuperation des messages en fonction de l'id
        $messages = $this->paginate($this->Messages->findAllByIdrecepteur($monID));
        $this->set(compact('monController'));
        $this->set(compact('monAction'));
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
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'candidat':    $monID = $_SESSION['Auth']['User']['ID'];       break;
            case 'chercheur':   $monID = '1';                                   break;
            case 'admin':       $monID = '0';                                   break;
        }
        $message = $this->Messages->get($id, ['contain' => [] ]);
        if(($message->IDExpediteur == $monID) || ($message->IDRecepteur == $monID)){
            $this->set('message', $message);
            $this->set('_serialize', ['message']);    
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'Authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // ============== //
        // A suppr : on utilise nouveau pour creer des message
        // ============== //
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
        // ============== //
        // A suppr : on edite pas son message
        // ============== //
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
        $operationInterdite = "true";
        $message = $this->Messages->get($id, ['contain' => [] ]);
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'candidat':    $monID = $_SESSION['Auth']['User']['ID'];       break;
            case 'chercheur':   $monID = '1';                                   break;
            case 'admin':       $monID = '0';                                   break;
        }
        if($monID == $message->IDExpediteur){
            $operationInterdite = "false";
            $message->IDExpediteur = 0;
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Le message à bien été supprimé.'));
                //return $this->redirect(['action' => '']);
            } else {
                $this->Flash->error(__('Erreur: Le message n\'a pas pu être supprimer, veuillez réessayer.'));
            }
        }
        // si l'utilisateur est le recepteur
        if($monID == $message->IDRecepteur){
            $operationInterdite = "false";
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
        if($operationInterdite == "true"){
            // Si le message affiché n'appartient pas a l'utilisateur connecté, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'Authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        } else {
            return $this->redirect(['action' => 'index']);  
        }
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

        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'candidat':    $monID = $_SESSION['Auth']['User']['ID'];       break;
            case 'chercheur':   $monID = '1';                                   break;
            case 'admin':       $monID = '0';                                   break;
        }
        $message = $this->Messages->get($id, ['contain' => [] ]);

        if(($message->IDExpediteur == $monID) || ($message->IDRecepteur == $monID)){
            //cherche la fonction afficheContenu de messagerie
            require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
            //si post, on enregistre
            if ($this->request->is(['patch', 'post', 'put'])) {
                //selectionne l'id de l'expediteur
                
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