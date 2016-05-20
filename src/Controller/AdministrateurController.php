<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use fonctionperso\chercheur\chercheurAccueil;
use fonctionperso\chercheur\chercheurDonnees;
use Cake\Mailer\Email;
use Cake\Filesystem\File;

/**
 * Administrateur Controller
 *
 * @property \App\Model\Table\AdministrateurTable $Administrateur
 */
class AdministrateurController extends AppController
{

    public function butExperience(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');
        
        if($this->request->is('post')){
            //debug($this->request->data);
            $file = new File(ROOT.'/webroot/files/but_experience.ctp');
            $file->write($this->request->data['message']);
            $file->close();
            $this->Flash->success(__('le message a été modifier'));
        }

    }

    public function emailCandidat(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');
        
        if($this->request->is('post')){
            //debug($this->request->data);
            $file = new File(ROOT.'/webroot/files/email_auto_candidat.ctp');
            $file->write($this->request->data['message']);
            $file->close();
            $this->Flash->success(__('le message a été modifier'));
        }

    }

    public function emailChercheur(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');
        
        if($this->request->is('post')){
            //debug($this->request->data);
            $file = new File(ROOT.'/webroot/files/email_auto_chercheur.ctp');
            $file->write($this->request->data['message']);
            $file->close();
            $this->Flash->success(__('le message a été modifier'));
        }

    }

    public function siteweb(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');
    }

    public function createChercheur(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');

        $char = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ';
            $password = str_shuffle($char);
            $password = substr ( $password , 0, 7 );

            $login = str_shuffle($char);
            $login = substr ( $login , 0, 7 );
            $test = TableRegistry::get('users')
                ->find()
                ->where(['login'=>$login])
                ->first();
            while(isset($test['email'])){
                $login = str_shuffle($char);
                $login = substr ( $login , 0, 7 );
                $test = TableRegistry::get('users')
                    ->find()
                    ->where(['login'=>$login])
                    ->first();
            }
            

        $user = TableRegistry::get('users')->newEntity();
        
        if($this->request->is('post')){
            $user = TableRegistry::get('users')->patchEntity($user, $this->request->data);
            if (TableRegistry::get('users')->save($user)) {
                $this->Flash->success(__('l\'utilisateur a été inviter'));

                $messageChercheur = file_get_contents(ROOT.'/webroot/files/email_auto_chercheur.ctp');
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Confirmation de compte")
                    ->send($messageChercheur."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte chercheur : \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\n--------------------------------------------------------------------------------\n");
                
                return $this->redirect(['controller'=>'users','action' => 'index']);
            } else {
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set('user',$user);
        $this->set('login',$login);
        $this->set('password',$password);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

    }

    public function createCandidat(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');

        $char = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ';
            $password = str_shuffle($char);
            $password = substr ( $password , 0, 7 );

            $login = str_shuffle($char);
            $login = substr ( $login , 0, 7 );
            $test = TableRegistry::get('users')
                ->find()
                ->where(['login'=>$login])
                ->first();
            while(isset($test['email'])){
                $login = str_shuffle($char);
                $login = substr ( $login , 0, 7 );
                $test = TableRegistry::get('users')
                    ->find()
                    ->where(['login'=>$login])
                    ->first();
            }
            

        $user = TableRegistry::get('users')->newEntity();
        
        if($this->request->is('post')){
            $user = TableRegistry::get('users')->patchEntity($user, $this->request->data);
            if (TableRegistry::get('users')->save($user)) {
                $this->Flash->success(__('l\'utilisateur a été inviter'));
                $messageCandidat = file_get_contents(ROOT.'/webroot/files/email_auto_candidat.ctp');
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Confirmation de compte")
                    ->send($messageCandidat."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte candidat : \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\n--------------------------------------------------------------------------------\n");
                
                return $this->redirect(['controller'=>'users','action' => 'index']);
            } else {
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set('user',$user);
        $this->set('login',$login);
        $this->set('password',$password);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

    }

    public function createCandidatList(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');

        $liste = null;
        if($this->request->is('post')){
            $liste_email = explode (';',$this->request->data['liste_email']);
            foreach ($liste_email as $email) {
                if(!empty($email)){
                    //debug($email);

                    $char = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ';
                    $password = str_shuffle($char);
                    $password = substr ( $password , 0, 7 );

                    $login = str_shuffle($char);
                    $login = substr ( $login , 0, 7 );
                    $test = TableRegistry::get('users')
                        ->find()
                        ->where(['login'=>$login])
                        ->first();
                    while(isset($test['email'])){
                        $login = str_shuffle($char);
                        $login = substr ( $login , 0, 9 );
                        $test = TableRegistry::get('users')
                            ->find()
                            ->where(['login'=>$login])
                            ->first();
                    }
                    
                    $newuser = TableRegistry::get('users')->newEntity();
                    $newuser->password = $password;
                    $newuser->login = $login;
                    $newuser->typeUser = 'candidat';
                    $newuser->email = $email;
                    
                    if (TableRegistry::get('users')->save($newuser)) {
                        //$this->Flash->success(__('l\'utilisateur '.$email.' a été inviter'));
                        $messageCandidat = file_get_contents(ROOT.'/webroot/files/email_auto_candidat.ctp');
                        $message = new Email('default');
                        $message
                            ->to($email)
                            ->subject("Confirmation de compte")
                            ->send($messageCandidat."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte candidat : \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\n--------------------------------------------------------------------------------\n");
                        
                        
                    } else {
                    $this->Flash->error(__('Erreur lors de l\'enregistrement de '.$email.', veuillez réessayer.'));
                    }

                }
            }
            return $this->redirect(['controller'=>'users','action' => 'index']);
        }
            $this->set('liste',$liste);

    }

    public function accueil(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurAccueil.php");

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "actualite" . DS ."actualite.php");
        $this->loadModel('Actualites');
        $actualites = $this->Actualites->find('all');
        $this->set(compact('actualites'));
        $this->set('_serialize', ['actualites']);
    }
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

        $administrateur = $this->paginate($this->Administrateur);

        $this->set(compact('administrateur'));
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * View method
     *
     * @param string|null $id Administrateur id.
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

        $administrateur = $this->Administrateur->get($id, [
            'contain' => []
        ]);

        $this->set('administrateur', $administrateur);
        $this->set('_serialize', ['administrateur']);
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

        $administrateur = $this->Administrateur->newEntity();
        if ($this->request->is('post')) {
            $administrateur = $this->Administrateur->patchEntity($administrateur, $this->request->data);
            if ($this->Administrateur->save($administrateur)) {
                $this->Flash->success(__('The administrateur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The administrateur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('administrateur'));
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Administrateur id.
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

        $administrateur = $this->Administrateur->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $administrateur = $this->Administrateur->patchEntity($administrateur, $this->request->data);
            if ($this->Administrateur->save($administrateur)) {
                $this->Flash->success(__('The administrateur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The administrateur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('administrateur'));
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Administrateur id.
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
        $administrateur = $this->Administrateur->get($id);
        if ($this->Administrateur->delete($administrateur)) {
            $this->Flash->success(__('The administrateur has been deleted.'));
        } else {
            $this->Flash->error(__('The administrateur could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function droitopposition(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');
        
        if($this->request->is('post')){
            //debug($this->request->data);
            $file = new File(ROOT.'/webroot/files/message_suppression_données_utilisateur.ctp');
            $file->write($this->request->data['message']);
            $file->close();
            $this->Flash->success(__('le message a été modifier'));
        }

    }
}
