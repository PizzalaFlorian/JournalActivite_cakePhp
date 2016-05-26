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
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    // public function index()
    // {
		// if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            // $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        // if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            // $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
		// $this->viewBuilder()->layout('adminLayout');
		// $sideBar = "sidebarAdmin"; 

        // require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "contacts" . DS ."contacts.php");		

        // $contacts = $this->paginate($this->Contacts);

		// $this->set(compact('sideBar'));
        // $this->set(compact('contacts'));
        // $this->set('_serialize', ['contacts']);
    // }

    // /**
     // * View method
     // *
     // * @param string|null $id Contact id.
     // * @return \Cake\Network\Response|null
     // * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     // */
    // public function view($id = null)
    // {
		// if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            // $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        // if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            // $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
		// $this->viewBuilder()->layout('adminLayout');
		// $sideBar = "sidebarAdmin";		
		
        // $contact = $this->Contacts->get($id, [
            // 'contain' => []
        // ]);
		
		// if($contact->lu == 0){
			// $contact->lu = 1;
			// $this->Contacts->save($contact);
		// }
		// $this->set(compact('sideBar'));
        // $this->set('contact', $contact);
        // $this->set('_serialize', ['contact']);
    // }

    // /**
     // * Add method
     // *
     // * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     // */
    // public function add()
    // {
		// if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            // $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        // if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            // $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
        // $contact = $this->Contacts->newEntity();
        // if ($this->request->is('post')) {
            // $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            // if ($this->Contacts->save($contact)) {
                // $this->Flash->success(__('The contact has been saved.'));
                // return $this->redirect(['action' => 'index']);
            // } else {
                // $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            // }
        // }
        // $this->set(compact('contact'));
        // $this->set('_serialize', ['contact']);
    // }

    // /**
     // * Edit method
     // *
     // * @param string|null $id Contact id.
     // * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     // * @throws \Cake\Network\Exception\NotFoundException When record not found.
     // */
    // public function edit($id = null)
    // {
		// if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            // $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        // if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            // $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
        // $contact = $this->Contacts->get($id, [
            // 'contain' => []
        // ]);
        // if ($this->request->is(['patch', 'post', 'put'])) {
            // $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            // if ($this->Contacts->save($contact)) {
                // $this->Flash->success(__('The contact has been saved.'));
                // return $this->redirect(['action' => 'index']);
            // } else {
                // $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            // }
        // }
        // $this->set(compact('contact'));
        // $this->set('_serialize', ['contact']);
    // }

    // /**
     // * Delete method
     // *
     // * @param string|null $id Contact id.
     // * @return \Cake\Network\Response|null Redirects to index.
     // * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     // */
    // public function delete($id = null)
    // {
		// if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            // $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        // if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            // $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
        // $this->request->allowMethod(['post', 'delete']);
        // $contact = $this->Contacts->get($id);
        // if ($this->Contacts->delete($contact)) {
            // $this->Flash->success(__('Le message à bien été supprimé.'));
        // } else {
            // $this->Flash->error(__('Erreur: Le message n\'a pas pu être supprimer, veuillez réessayer.'));
        // }
        // return $this->redirect(['action' => 'index']);
    // }


	public function contact()
    {   
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
			// $newContact->lu = 0; 
			if(isset($_SESSION['Auth']['User']['ID'])){
				$contact->expediteur = $_SESSION['Auth']['User']['email'];
			}
			if(isset($this->request->data['email'])){
				$contact->expediteur = $this->request->data['email'];
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