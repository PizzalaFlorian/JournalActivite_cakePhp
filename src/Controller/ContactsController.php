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
    public function index()
    {
		if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
		$this->viewBuilder()->layout('adminLayout');
		$sideBar = "sidebarAdmin"; 

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "contacts" . DS ."contacts.php");		

        $contacts = $this->paginate($this->Contacts);

		$this->set(compact('sideBar'));
        $this->set(compact('contacts'));
        $this->set('_serialize', ['contacts']);
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
		$this->viewBuilder()->layout('adminLayout');
		$sideBar = "sidebarAdmin";		
		
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);
		
		if($contact->lu == 0){
			$contact->lu = 1;
			$this->Contacts->save($contact);
		}
		$this->set(compact('sideBar'));
        $this->set('contact', $contact);
        $this->set('_serialize', ['contact']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('Le message à bien été supprimé.'));
        } else {
            $this->Flash->error(__('Erreur: Le message n\'a pas pu être supprimer, veuillez réessayer.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	public function contact()
    {   
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
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
			$newContact = $this->Contacts->newEntity();
			$newContact->sujet =  $contact->sujet;
			$newContact->contenue =  $contact->contenue;
			$newContact->dateEnvoie = Time::now(); 
			$newContact->lu = 0; 
			if(isset($_SESSION['Auth']['User']['ID'])){
				$newContact->expediteur = $_SESSION['Auth']['User']['email'];
			}
            if ($this->Contacts->save($newContact)) {
                $this->Flash->success(__('Votre message à bien été envoyé.'));
				
				// ========================== Modif mail =============================//
                    //ce morceau marche mais pour des raison remplissage de mail je le coupe x)
					require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "messagerie" . DS ."messagerie.php");

					$email = new Email('default');
					$email
						->to('pierre.garnesson@gmail.com')
						->subject($newContact->sujet)
						->send(message($newContact->contenue,$newContact->expediteur));

				// ========================== Modif mail =============================//

                return $this->redirect(['action' => 'contact']);
            } else {
                $this->Flash->error(__('Echec de l\'envoie. Veuillez réessayer.'));
            }
        }
		$this->set(compact('sideBar'));
		$this->set(compact('monEmail'));
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }
}
