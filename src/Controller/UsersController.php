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
     * @accès Admin
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
     * @Accès Admin
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
     * @accès Everyone (accèsible depuis l'exterieur pour s'inscrire)
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

            if($user->typeUser == "chercheur" || $user->typeUser == "admin"){
                $this->Flash->error(__('Les insertions SQL c\'est mal.'));
                $this->redirect(['controller'=>'users','action' => 'login']);
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('L\'utilisateur a bien été ajouté.'));
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Confirmation de compte")
                    ->send("Bonjour,\n\nVoici les identifiants de votre compte : \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\n\nCordialement\nL'équipe du LSE");
                return $this->redirect(['controller'=>'candidat','action' => 'add']);
            } else {
                $this->Flash->error(__('Erreur lors de l\'ajout.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     * @accès Admin
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
                $this->Flash->success(__('L\'utilisateur a bien été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * [modif Page de modification des information de users (login, mot de passe, adresse email)]
     * @accès Tout les users
     * @return [Aucun]
     */
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
                $this->Flash->error(__('Vos données sont incompatibles ou incomplètes. Veuillez réessayer.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    /**
     * Delete method
     * @accès Administrateur
     * @param string|null $id User id.
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
        $user = $this->Users->get($id);

        $candidat = TableRegistry::get('candidat')
            ->find()
            ->where(['ID' => $user->ID])
            ->first();
        if(isset($candidat)){
            $occupation = TableRegistry::get('occupation')
                ->query();
            $occupation
                ->delete()
                ->where(['CodeCandidat' => $candidat['CodeCandidat']])
                ->execute();

            $candi = TableRegistry::get('candidat')
                ->query();
            $candi
                ->delete()
                ->where(['ID' => $user->ID])
                ->execute();
        }
        else {
            $chercheur = TableRegistry::get('chercheur')
                ->find()
                ->where(['ID' => $user->ID])
                ->first();
            if(isset($chercheur)){
                $cdb = TableRegistry::get('carnetdebord')
                    ->query();
                $cdb
                    ->update()
                    ->set(['CodeChercheur' => 1])
                    ->where(['CodeChercheur' => $chercheur['CodeChercheur']])
                    ->execute();

                $cher = TableRegistry::get('chercheur')
                    ->query();
                $cher
                    ->delete()
                    ->where(['ID' => $user->ID])
                    ->execute();
            }
            else{
                $admin = TableRegistry::get('administrateur')
                    ->find()
                    ->where(['ID' => $user->ID])
                    ->first();
                if(isset($admin)){
                    $ad = TableRegistry::get('administrateur')
                        ->query();
                    $ad
                        ->delete()
                        ->where(['ID' => $user->ID])
                        ->execute();
                }
            }
        }
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('L\'utilisateur a été supprimé.'));
            //suppression des messages de l'utilisateur
            $this->loadModel('Messages');
            $messages = $this->Messages->find('all', ['conditions' => ['Messages.IDExpediteur' => $user->ID]]);
            foreach ($messages as $message) {
                $message->IDExpediteur = 0;             // Le messages est considéré comme supprimer
                $message->userExpediteur = 4;           // Categorie : Utilisateur Supprimer
                if($message->IDRecepteur == 0 ){
                    $this->Messages->delete($message);  // Supprime le message si il faut le supprimer
                }
                else{
                    $this->Messages->save($message);    // mets a jours les messages
                }
            }
            $messages = $this->Messages->find('all', ['conditions' => ['Messages.IDRecepteur' => $user->ID]]);
            foreach ($messages as $message) {
                $message->IDRecepteur = 0;              // Le messages est considéré comme supprimer
                $message->userRecepteur = 4;            // Categorie : Utilisateur Supprimer
                if($message->IDExpediteur == 0 ){
                    $this->Messages->delete($message);  // Supprime le message si il faut le supprimer
                }
                else{
                    $this->Messages->save($message);    // mets a jours les messages
                }
            }



        } else {
            $this->Flash->error(__('Erreur lors de la suppression.'));
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
            $this->Flash->error(__('Erreur, login ou mot de passe invalide'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * [reset Change le mot de passe d'un utilisateur et le lui envoie par email]
     * @return [email] [Nouveau mot de passe]
     */
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
                $this->Flash->error(__('Cette adresse e-mail n\'est pas présente dans notre base de données.'));
            } 
            else{
                $update_user = TableRegistry::get('users')
                ->query();
                $update_user    
                    ->update()
                    ->set(['password' => (new DefaultPasswordHasher)->hash($password)])
                    ->where(['email' => $this->request->data['Email']])
                    ->execute();
                $adresseServer = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].str_replace('webroot/index.php','users/login',$_SERVER['PHP_SELF']);

                $this->Flash->success(__('Votre mot de passe a bien été modifié. Veuillez consulter votre adresse e-mail.'));
                $email = new Email('default');
                $email
                    ->to($this->request->data['Email'])
                    ->subject("Nouveau Mot de passe")
                    ->send("Voici vos nouveaux identifiants, veuillez les changer dès votre prochaine connexion"."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte : \nLogin : ".$user['login']."\nMot de passe : ".$password."\nveuillez vous connecter à l'adresse suivante :".$adresseServer."\n--------------------------------------------------------------------------------\n");
                
                return $this->redirect(['controller'=>'users','action' => 'login']);
            }      
        }
    }

    public function suppressioncompte(){

        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

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
                            //echo "je stop la";
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
                                            $this->Flash->success(__('Toutes vos données ont bien été supprimées'));
                                            $this->Flash->success(__('Votre compte à bien été supprimé'));
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
                echo "vous n'avez pas coché la case suppression du compte";
            }
        }
        $this->set(compact('sideBar'));
        $this->set('_serialize', ['message']);
    }

    public function resetMDP(){
        if($this->request->is('post')){

            $char = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ';
            
            $password = str_shuffle($char);
            $password = substr ( $password , 0, 10 );

            $user = TableRegistry::get('users')
                ->find()
                ->where(['email'=>$this->request->query['Email']])
                ->first();

            if(!isset($user)){
                $this->Flash->error(__('Cette adresse e-mail n\'est pas présente dans notre base de données.'));
            } 
            else{
                $update_user = TableRegistry::get('users')
                ->query();
                $update_user    
                    ->update()
                    ->set(['password' => (new DefaultPasswordHasher)->hash($password)])
                    ->where(['email' => $this->request->query['Email']])
                    ->execute();

                $this->Flash->success(__('Le mot de passe de l\'utilisateur "'.$this->request->query['Email'].'"a bien été modifié.'));
                $email = new Email('default');
                $email
                    ->to($this->request->query['Email'])
                    ->subject("Nouveau Mot de passe")
                    ->send("Voici vos nouveaux identifiants, veuillez les changer dès votre prochaine connexion"."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte : \nLogin : ".$user['login']."\nMot de passe : ".$password."\n--------------------------------------------------------------------------------\n");
                
                return $this->redirect(['controller'=>'users','action' => 'index']);
            }      
        }
    }
}