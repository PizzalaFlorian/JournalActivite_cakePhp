<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Mailer\Email;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController
{
	
	/**
	 * [contact Fonction permettant d'envoyer un mail a un administrateur]
	 * @return [Aucun]
	 */
	public function contact()
    {   
		session_start();
		//var_dump($this->request->session());
		if(isset($_SESSION['Auth']['User']['ID'])){
			$monEmail = false;
			$this->viewBuilder()->layout('candiLayout'); 
			$sideBar = "sidebarCandidat";   
		} 
		else{
			$sideBar = "";  
			$monEmail = true;
		}
		
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
			echo "hello";
			var_dump($this->request->data);
            $contact->sujet = $this->request->data['sujet'];
			$contact->contenu = $this->request->data['contenu'];
			// $newContact = $this->Contacts->newEntity();
			// $newContact->sujet =  $contact->sujet;
			// $newContact->contenue =  $contact->contenue;
			$contact->dateEnvoie = Time::now(); 
			$contact->expediteur = $this->request->data['expediteur'];
			// $newContact->lu = 0; 
			if(isset($_SESSION['Auth']['User']['ID'])){
				$contact->expediteur = $_SESSION['Auth']['User']['email'];
			}
			if(!empty($contact->expediteur)){
				// ========================== Envoie mail =============================//
					$this->loadModel('Users');
					require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "contacts" . DS ."contacts.php");
					
					$administrateurs = $this->paginate($this->Users->find('all', ['conditions' => ['typeUser' => 'admin'] ]));
					foreach($administrateurs as $admin){

						$email = new Email('default');
						$email
							->to($admin->email)
							->subject($contact->sujet)
							->send(message($contact));
					}
					$this->Flash->success(__('Votre message à bien été envoyé.'));
			}
				// ========================== Envoie mail =============================//
                return $this->redirect(['action' => 'contact']);
        }
		$this->set(compact('sideBar'));
		$this->set(compact('monEmail'));
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }
}