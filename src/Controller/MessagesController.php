<?php
namespace App\Controller;

use App\Controller\AppController;
use vendor\fonctionperso\messagerie\messagerie;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\Time;
//use Cake\Network\Email\Email;
////*******************************
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
            case 'chercheur':       $monController = "chercheur";        
                                    $monAction="accueil";       
                                    $this->viewBuilder()->layout('cherLayout');
                                    $sideBar = "sidebarChercheur";          
                                break;
            case 'candidat':        $monController = "candidat";         
                                    $monAction="accueil";       
                                    $this->viewBuilder()->layout('candiLayout');
                                    $sideBar = "sidebarCandidat";           
                                break;
            case 'admin':      $monController = "administrateur";                 
                                    $monAction="accueil";          
                                    $this->viewBuilder()->layout('adminLayout');
                                    $sideBar = "sidebarAdmin"; 									
                                break;
        }

        //$this->set(compact('actualites'));
        //$this->set('_serialize', ['actualites']);

    // ==== MESSAGERIE ==== //
        //fonction lié a la messagerie dans messagerie.php
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
        // on assigne un id pour les messageries
        switch ($_SESSION['Auth']['User']['typeUser']) {
            // les messages des chercheurs ont l'id 1
            case 'chercheur':       $monID = 1;                                                			 	break;
            // les messages des utilisateurs ont leur propre id
            case 'candidat':        $monID = $_SESSION['Auth']['User']['ID'];                   	break;
            // les messages de admin auront l'id 0
            case 'admin':           $monID = 2;                                                 				break;
        }
        // recuperation des messages en fonction de l'id
        //$messages = $this->paginate($this->Messages->findAllByIdrecepteur("$monID" ,array( 'order' => array('DateEnvoi DESC') )));
        $messages = $this->paginate($this->Messages->find('all', ['conditions' => ['Idrecepteur' => $monID], 'order' => array('DateEnvoi DESC') ]));

        $this->set(compact('monController'));
        $this->set(compact('monAction'));
        $this->set(compact('sideBar'));
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
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'candidat':    $monID = $_SESSION['Auth']['User']['ID'];  
                                $this->viewBuilder()->layout('candiLayout'); 
                                $sideBar = "sidebarCandidat";      
                            break;
            case 'chercheur':   $monID = '1';                              
                                $this->viewBuilder()->layout('cherLayout');
                                $sideBar = "sidebarChercheur";

                            break;
            case 'admin':       $monID = '2';
                                $this->viewBuilder()->layout('adminLayout');
                                $sideBar = "sidebarAdmin";			
                            break;
        }
        $message = $this->Messages->get($id, ['contain' => [] ]);
        if(($message->IDExpediteur == $monID) || ($message->IDRecepteur == $monID)){
            if(($message->IDRecepteur == $monID)&&($message->recepteurLu == 0)){
                $message->recepteurLu = 1;
                $this->Messages->save($message);
            }
            $this->set('message', $message);
            $this->set(compact('sideBar'));
            $this->set('_serialize', ['message']);    
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }
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
            case 'candidat':    $monID = $_SESSION['Auth']['User']['ID'];     
                            break;
            case 'chercheur':   $monID = '1';                                 
                            break;
            case 'admin':       $monID = '2';                                   
                            break;
        }
        if($monID == $message->IDExpediteur){
            $operationInterdite = "false";
            $message->IDExpediteur = 0;
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Le message à bien été supprimé.'));
                //return $this->redirect(['action' => '']);
            } else {
                $this->Flash->error(__('Erreur: Le message n\'a pas pu être supprimé, veuillez réessayer.'));
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
                $this->Flash->error(__('Erreur: Le message n\'a pas pu être supprimé, veuillez réessayer.'));
            }
        }
        // si plus aucun expediteur / recepteur, alors on supprimer le message de la base de données.
        if(($message->IDExpediteur == 0)&&($message->IDRecepteur == 0)){
            $this->Messages->delete($message);
        }
        if($operationInterdite == "true"){
            // Si le message affiché n'appartient pas a l'utilisateur connecté, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        } else {
            if(isset($this->request->query['page'])){
                return $this->redirect(['action' => $this->request->query('page')]);
            }else{
                return $this->redirect(['action' => $page]);
            }
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
// tout les etudiants  : 1
// tout les chercheurs : 2
//  
    public function nouveau()
    {
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'candidat':    $this->viewBuilder()->layout('candiLayout');
                                $sideBar = "sidebarCandidat";      
                            break;
            case 'chercheur':   $this->viewBuilder()->layout('cherLayout');
                                $sideBar = "sidebarChercheur";    
                            break;
            case 'admin':      $monID = '2';               
									$this->viewBuilder()->layout('adminLayout');
									$sideBar = "sidebarAdmin";			
                            break;
        }
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            $message->DateEnvoi = Time::now(); 
            $message->recepteurLu = "0";
            $message->expediteurLu = "0";
            $message->IDExpediteur = $_SESSION['Auth']['User']['ID'];
            $message->userExpediteur = $message->IDExpediteur;
            $message->userRecepteur = $message->IDRecepteur;
            if ($this->Messages->save($message)) {
                if($message->IDRecepteur == 1){
// ========================== Modif mail =============================//
                    //ce morceau marche mais pour des raison remplissage de mail je le coupe x)
                    $this->loadModel('Users');

                    require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
                    $chercheurs = $this->paginate($this->Users->find('all', ['conditions' => ['typeUser' => 'chercheur'] ]));
                    foreach($chercheurs as $chercheur){
                        $email = new Email('default');
                        $email
                            ->to($chercheur->email)
                            ->subject($message->Sujet)
                            ->send(message($message->ContenuMessage,$message->IDExpediteur));
                    }
                }
// ========================== Modif mail =============================//
                $this->Flash->success(__('Votre message à bien été envoyé.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Echec de l\'envoie. Veuillez réessayer.'));
            }
        }
        $this->set(compact('message'));
        $this->set(compact('users'));
        $this->set(compact('sideBar'));
        $this->set('_serialize', ['message']);
    }

// fonction pour répondre a un message envoyé
    public function repondre($id = null)
    {
        // on verifie que l'utilisateur accède bien a un message dont il est le destinataire ou le recepteur

        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'candidat':    $monID = $_SESSION['Auth']['User']['ID'];   
                                $sideBar = "sidebarCandidat";
                                $this->viewBuilder()->layout('candiLayout');     
                            break;
            case 'chercheur':   $monID = '1';                               
                                $this->viewBuilder()->layout('cherLayout');
                                $sideBar = "sidebarChercheur";    
                            break;
            case 'admin':       $monID = '2';
									$this->viewBuilder()->layout('adminLayout');
									$sideBar = "sidebarAdmin";				
                            break;
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
                $newMessage->DateEnvoi = Time::now(); 
                $newMessage->recepteurLu = "0";
                $newMessage->expediteurLu = "0";
                $newMessage->IDExpediteur = $monID;
                $newMessage->userExpediteur = $newMessage->IDExpediteur;
                $newMessage->userRecepteur = $newMessage->IDRecepteur;
                if ($this->Messages->save($newMessage)) {
                    if($newMessage->IDRecepteur == 1){
    // ========================== Modif mail =============================//
                        //ce morceau marche mais pour des raison remplissage de mail je le coupe x)
                        $this->loadModel('Users');

                        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
                        $chercheurs = $this->paginate($this->Users->find('all', ['conditions' => ['typeUser' => 'chercheur'] ]));
                        foreach($chercheurs as $chercheur){
                            $email = new Email('default');
                            $email
                                ->to($chercheur->email)
                                ->subject($newMessage->Sujet)
                                ->send(message($newMessage->ContenuMessage,$newMessage->IDExpediteur));
                        }
                    }
    // ========================== Modif mail =============================//

                    $this->Flash->success(__('Votre message à bien été envoyé.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Echec de l\'envoie. Veuillez réessayer.'));
                    //return $this->redirect(['action' => 'index']);
                }
            }
            //recupère le pseudo de l'expediteur
            $this->loadModel('Users');
            //echo $message->IDExpediteur;
            $users = $this->Users->get($message->userExpediteur, ['contain' => [] ]);
            switch ($users->typeUser) {
                case 'candidat':    $pseudo = "Candidat ".$users->ID;  $pseudoID = $users->ID;           break;
                case 'chercheur':   $pseudo = "Chercheur";             $pseudoID = '1';                  break;
                case 'admin':       $pseudo = "Administrateur";        $pseudoID = '2';                  break;
            }
            // met a jours "lu / non lu" 
            if(($message->IDRecepteur == $monID)&&($message->recepteurLu == 0)){
                $message->recepteurLu = 1;
                $this->Messages->save($message);
            }
            //prépare les variables pour le template
            $this->set(compact('pseudo'));
            $this->set(compact('pseudoID'));
            $this->set(compact('sideBar'));
            $this->set(compact('message'));
            $this->set('_serialize', ['message']);
        } else {
            // Si le message affiché n'appartient pas a l'utilisateur connecté, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }
    }

// fonction : gestion des messages envoyé
    public function envoie()
    {
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'chercheur':       $monController = "chercheur";        
                                    $monAction="accueil";  
                                    $this->viewBuilder()->layout('cherLayout');
                                    $sideBar = "sidebarChercheur";              
                                break;
            case 'candidat':        $monController = "candidat";         
                                    $monAction="accueil";           
                                    $this->viewBuilder()->layout('candiLayout');
                                    $sideBar = "sidebarCandidat";               
                                break;
            case 'admin':           $monController = "administrateur";                 
                                    $monAction="accueil";   
									$this->viewBuilder()->layout('adminLayout');
									$sideBar = "sidebarAdmin";										
                                break;
        }

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'chercheur':       $monID = 1;                                                 break;
            case 'candidat':        $monID = $_SESSION['Auth']['User']['ID'];                   break;
            case 'admin':           $monID = 2;                                                 break;
        }
        // recuperation des messages en fonction de l'id
        $messages = $this->paginate($this->Messages->find('all', ['conditions' => ['Idexpediteur' => $monID], 'order' => array('DateEnvoi DESC') ]));

        $this->set(compact('monController'));
        $this->set(compact('monAction'));
        $this->set(compact('sideBar'));
        $this->set(compact('messages'));
        $this->set('_serialize', ['messages']);
    }

// fonction : envoie d'un message de contact
	public function contact(){
		$this->viewBuilder()->layout('candiLayout'); 
		$sideBar = "sidebarCandidat";      
		$message = $this->Messages->newEntity();
		if(!isset($_SESSION['Auth']['User']['ID'])){
			$email = "<div class=input text required\">\n<label for=\"email\">Adresse e-mail</label>\n<input id=\"email\" type=\"text\" maxlength=\"250\" required=\"required\" name=\"email\">\n</div>";
		}
		else{
			$email = "";
		}
		if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
			$messageContact = $this->Messages->newEntity();
			
			$messageContact->Sujet = $message->Sujet;
			$messageContact->ContenuMessage = $message->ContenuMessage;
            $messageContact->DateEnvoi = Time::now(); 
            $messageContact->recepteurLu = "0";
            $messageContact->expediteurLu = "0";
			$messageContact->userRecepteur = "2";
			$messageContact->IDRecepteur = "2";
			$messageContact->userExpediteur = $message->IDExpediteur;
			
			if(isset($_SESSION['Auth']['User']['ID'])){
				$messageContact->IDExpediteur = $_SESSION['Auth']['User']['ID'];
				$messageContact->userExpediteur = $_SESSION['Auth']['User']['ID'];
			}
			else{
				$messageContact->IDExpediteur = $message->email;
				$messageContact->userExpediteur = $message->email;
			}
			//var_dump($messageContact);
           if ($this->Messages->save($messageContact)) {
                if($message->IDRecepteur == 1){
// ========================== Modif mail =============================//
                    //ce morceau marche mais pour des raison remplissage de mail je le coupe x)
					$this->loadModel('Users');
					
					require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");
					
					$chercheurs = $this->paginate($this->Users->find('all', ['conditions' => ['typeUser' => 'chercheur'] ]));
					foreach($chercheurs as $chercheur){
						$email = new Email('default');
						$email
							->to($chercheur->email)
							->subject($message->Sujet)
							->send(message($message->ContenuMessage,$message->IDExpediteur));
					}
                }


// ========================== Modif mail =============================//
                $this->Flash->success(__('Votre message à bien été envoyé.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Echec de l\'envoie. Veuillez réessayer.'));
            }
        }
		
		$this->set(compact('sideBar'));
		$this->set(compact('email'));
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
	}
}