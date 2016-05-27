<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
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

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            if($this->request->data['password']!=$this->request->data['comfirmez_password']){
                $this->Flash->error(__('Vos mots de passes sont différent.'));
                return $this->redirect(['action' => 'modif']);
            }

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Confirmation de compte")
                    ->send("Bonjour,\nVoici vos identifiant de votre compte : \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\nCordialement\n");
                return $this->redirect(['controller'=>'candidat','action' => 'add']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        $this->viewBuilder()->layout('adminLayout');

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }


    public function modif()
    {
        if($_SESSION['Auth']['User']['typeUser']=='candidat')
            $this->viewBuilder()->layout('candiLayout');
        if($_SESSION['Auth']['User']['typeUser']=='chercheur')
            $this->viewBuilder()->layout('cherLayout');
        if($_SESSION['Auth']['User']['typeUser']=='admin')
            $this->viewBuilder()->layout('adminLayout');
        $user = TableRegistry::get('users')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {

            if(!strcmp($this->request->data['nouveau_password'],$this->request->data['comfirmez_password'])){
                if($this->request->data['nouveau_password']!='' && $this->request->data['comfirmez_password']!=''){
                    $this->request->data['password'] = $this->request->data['nouveau_password'];
                } 
            }
            else {
                $this->Flash->error(__('Vos mots de passes sont différent.'));
                return $this->redirect(['action' => 'modif']);
            }

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Vos informations ont bien été modifiées.'));
                    return $this->redirect(['action' => 'modif']);
            } else {
                $this->Flash->error(__('Vos données sont incompatibles ou incomplètes, veuillez réessayer.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout']);
    }

    public function login()
    {
        $this->viewBuilder()->layout('loginlayout');
        if ($this->request->is('post')) {
            //var_dump($this->request->data);
            $user = $this->Auth->identify();
            //var_dump($user);
            if ($user) {
                $this->Auth->setUser($user);
               
                //return $this->redirect($this->Auth->redirectUrl());
                if($user['typeUser']=='candidat'){
                    debug($user);
                    $candidat = TableRegistry::get('candidat')
                        ->find()
                        ->where(['ID' => $_SESSION['Auth']['User']['ID']])
                        ->first();
                    if(isset($candidat['CodeCandidat'])){
                        return $this->redirect([
                            'controller' => 'candidat',
                            'action' => 'accueil']);
                    }
                    else{
                        return $this->redirect([
                            'controller' => 'candidat',
                            'action' => 'cnil']);
                    }
                }
                if($user['typeUser']=='chercheur'){
                     $chercheur = TableRegistry::get('chercheur')
                        ->find()
                        ->where(['ID' => $_SESSION['Auth']['User']['ID']])
                        ->first();
                    if(isset($chercheur['CodeChercheur'])){
                        return $this->redirect([
                            'controller' => 'chercheur',
                            'action' => 'accueil']);
                    } else {
                         return $this->redirect([
                            'controller' => 'chercheur',
                            'action' => 'add']);
                    }

                }
                if($user['typeUser']=='admin'){
                    return $this->redirect([
                        'controller' => 'administrateur',
                        'action' => 'accueil']);
                }

            }
            $this->Flash->error(__('Erreure, login ou Mot de passe invalide'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function reset(){
        if($this->request->is('post')){

            $char = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ';
            
            $password = str_shuffle($char);
            $password = substr ( $password , 0, 10 );

            $user = TableRegistry::get('users')
                ->find()
                ->where(['email'=>$this->request->data['Email']])
                ->first();

            if(!isset($user)){
                $this->Flash->error(__('Cette adresse email n\'est pas présente dans notre base de donnée.'));
            } 
            else{
                $update_user = TableRegistry::get('users')
                ->query();
                $update_user    
                    ->update()
                    ->set(['password' => (new DefaultPasswordHasher)->hash($password)])
                    ->where(['email' => $this->request->data['Email']])
                    ->execute();

                $this->Flash->success(__('Votre mot de passe a bien été modifié. Veuillez consulter votre adresse email.'));
                $email = new Email('default');
                $email
                    ->to($this->request->data['Email'])
                    ->subject("Confirmation de compte")
                    ->send("Voici vos nouveaux identifiant, veuillez les changer dès votre prochaine connexion"."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte candidat : \nLogin : ".$user['login']."\nMot de passe : ".$password."\n--------------------------------------------------------------------------------\n");
                
                return $this->redirect(['controller'=>'users','action' => 'login']);
            }      
        }
    }

    public function suppressioncompte(){
        $this->viewBuilder()->layout('candiLayout');
        $sideBar = "sidebarCandidat"; 
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->data['published'] == '1'){
                // Chargement des Models
                    $this->loadModel('Occupation');
                    $this->loadModel('Candidat');
                    $this->loadModel('Messages');
                // récupération du candidat
                    $idUser = $_SESSION['Auth']['User']['ID'];
                    $query = $this->Candidat->find('all', ['conditions' => ['Candidat.ID' => $idUser]]);
                    $candidat = $query->first();
                // suppression des occupations
                    // récupération des Occupation de l'utilisateur
                        $occupations = $this->Occupation->find('all', ['conditions' => ['Occupation.CodeCandidat' => $candidat->CodeCandidat]]);
                        //Si une erreur a lieu, passe à true
                        $error = false;     
                        foreach($occupations as $occupation){
                            if($this->Occupation->delete($occupation)){
                            } else {
                                $error = true;
                            }
                        }
                        if($error){ 
                            // Si une erreur est survenue, on renvoie vers le contact de l'administrateur
                            $this->Flash->error(__('Une erreur est survenue, veuillez contacter l\'administrateur'));
                            echo "je stop la";
                        }
                        else{
                            // Si aucune erreur, on passe à la suppression du compte
                            //Suppression des messages
                                $messages = $this->Messages->find('all', ['conditions' => ['Messages.IDExpediteur' => $idUser]]);
                                foreach ($messages as $message) {
                                    $message->IDExpediteur = 0;         // Le messages est considéré comme supprimer
                                    $message->userExpediteur = 4;       // Categorie : Utilisateur Supprimer
                                    $this->Messages->save($message);    // mets a jours les messages
                                }
                                $messages = $this->Messages->find('all', ['conditions' => ['Messages.IDRecepteur' => $idUser]]);
                                foreach ($messages as $message) {
                                    $message->IDRecepteur = 0;          // Le messages est considéré comme supprimer
                                    $message->userRecepteur = 4;        // Categorie : Utilisateur Supprimer
                                    $this->Messages->save($message);    // mets a jours les messages
                                }
                            // suppression du candidat
                                if($this->Candidat->delete($candidat)){
                                    // suppression de l'user
                                        $user = $this->Users->get($idUser);
                                        if($this->Users->delete($user)){
                                            $this->Flash->success(__('Toutes vos données on bien été supprimées'));
                                            $this->Flash->success(__('Votre compte à bien été supprimées'));
                                            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
                                        }
                                        else{
                                            $this->Flash->error(__('Une erreur est survenue, veuillez contacter l\'administrateur'));
                                        }
                                } else {
                                    $this->Flash->error(__('Une erreur est survenue, veuillez contacter l\'administrateur'));
                                }
                        }
            } else{
                echo "vous n'avez pas cocher la case suppression du compte";
            }
        }
        $this->set(compact('sideBar'));
        $this->set('_serialize', ['message']);
    }
}