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
    /**
     * [gestionDonnees page de gestion des données. Propose a l'administrateur de pouvoir vider la base des candidats,
     * et celle des occupations.]
     * @accès Administrateur
     * @return [aucun]
     */
	public function gestionDonnees(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		
        $this->viewBuilder()->layout('adminLayout');
    }
	
    /**
     * [butExperience Page d'edition d'un fichier texte expliquant le but de l'expérience.]
     * @accès Administrateur
     * @file [webroot/files/but_experience.ctp]
     * @return [aucun]
     */
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
            $this->Flash->success(__('le message a été modifié.'));
        }

    }

    /**
     * [emailCandidat Page de modification du corp de l'email envoyer a un étudiant lors de son 
     * inscription sur le site .]
     * @Accès Administrateur
     * @file [/webroot/files/email_auto_candidat.ctp]
     * @return [aucun]
     */
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
            $this->Flash->success(__('Le message a été modifié.'));
        }

    }


    /**
     * [emailChercheur Page de modification du corp du message afficher dans l'email envoyer au chercheur lors
     * de son inscription sur le site web. ATTENTION seul un administrateur peu réalisé cette inscription.]
     * @accès Administrateur
     * @file [webroot/files/email_auto_chercheur.ctp]
     * @return [aucun]
     */
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
            $this->Flash->success(__('Le message a été modifié.'));
        }

    }

    /**
     * [siteweb Page regroupant les liens vers toutes les fonctions permettant de personnaliser les différents écrans
     * et messages délivrés par le site web. Fonction administrateur]
     * @accès Administrateur
     * @return [aucun]
     */
    public function siteweb(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');
    }


    /**
     * [createChercheur Creer un user de type chercheur, creer un login et mot de passe par défault de manière aléatoire,
     * et envoie ces information par email au chercheur.
     * Cette page demande un email valide pour fonctionner. Le chercheur a sa première connection complètera son profil en remplissant et créant son profil chercheur.]
     * @accès Administrateur
     * @return [redirection] [Redirection sur users index]
     */
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
                $this->Flash->success(__('l\'utilisateur a été invité'));

                $messageChercheur = file_get_contents(ROOT.'/webroot/files/email_auto_chercheur.ctp');
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Création de votre compte")
                    ->send($messageChercheur."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte chercheur : \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\n--------------------------------------------------------------------------------\n");
                
                return $this->redirect(['controller'=>'users','action' => 'index']);
            } else {
            $this->Flash->error(__('Erreur lors de l\'enregistrement de l\'utilisateur, veuillez réessayer.'));
            }
        }
        $this->set('user',$user);
        $this->set('login',$login);
        $this->set('password',$password);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

    }

    /**
     * [createCandidat page de creation d'un compte user de type candidat. Invitation et envoie des logins et mot de
     * passe généré aléatoirement par email.]
     * @accès Administrateur
     * @return [aucun]
     */
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
                $this->Flash->success(__('l\'utilisateur a été invité'));
                $messageCandidat = file_get_contents(ROOT.'/webroot/files/email_auto_candidat.ctp');
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Confirmation de compte")
                    ->send($messageCandidat."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte candidat : \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\n--------------------------------------------------------------------------------\n");
                
                return $this->redirect(['controller'=>'users','action' => 'index']);
            } else {
            $this->Flash->error(__('Erreur lors de l\'enregistrement, veuillez réessayer.'));
            }
        }
        $this->set('user',$user);
        $this->set('login',$login);
        $this->set('password',$password);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

    }

    /**
     * [createCandidatList Page permettant la création et l'invitation d'une liste de candidat. La fonction demande de poster un ensemble d'adresse email séparer par des points virgule. A chaque adresse un compte utilisateur de type 
     * candidat sera creer et une invitation sera envoyer a l'email du candidat, contenant son login et mot de passe.]
     * @accès Administrateur
     * @return [Redirection] [redirection vers user index]
     */
    public function createCandidatList(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        $this->viewBuilder()->layout('adminLayout');

        $liste = null;
        if($this->request->is('post')){
            //si un fichier est passé en paramèrtre
            if(!empty($this->request['data']['file']['name'])){

                //var_dump($this->request['data']['file']);

                //echo "tmp/name : ".$this->request['data']['file']['tmp_name']."<br/>";
                //echo "name : ".$this->request['data']['file']['name']."<br/>";

                // on le copie dans tmp/tmp/listecandidat
                if($uploadfile =  move_uploaded_file ($this->request['data']['file']['tmp_name'], 'tmp/tmp/listeCandidat'))
                {
                    //echo "ok";
                    // on ouvre le fichier listeCandidat
                    $fp = fopen("tmp/tmp/listeCandidat","r"); //lecture
                    $app = "";
                    // on le lit
                    while(($ligne = fgets($fp,255)) != false)
                    {
                        $app = $app.$ligne;
                    }
                    fclose($fp);
                    $app = str_replace("\n", "", $app);
                    $app = str_replace("\t", "", $app);
                    $app = str_replace(" ", "", $app);
                    $liste_email = explode (';',$app);
                }
                else{
                    //echo "error";
                }
            }
            else{
                $liste_email = explode (';',$this->request->data['liste_email']);
            }
            // var_dump($liste_email);
            // var_dump($liste_email);
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
                            ->send($messageCandidat."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte candidat : \nLogin : ".$login."\nMot de passe : ".$password."\n--------------------------------------------------------------------------------\n");
                        
                        
                    } else {
                    $this->Flash->error(__('Erreur lors de l\'enregistrement de '.$email.', veuillez réessayer.'));
                    }

                }
            }
            return $this->redirect(['controller'=>'users','action' => 'index']);
        }
            $this->set('liste',$liste);

    }


    /**
     * [accueil Page d'acceil des administrateur]
     * @accès Administrateur
     * @return [Aucun]
     */
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
     * Index method [liste des admin du site]
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
     * Add method [invite un adminsitrateur en creer un user de type administrateur et l'administrateur liée.
     * Les identifiants sont envoyer a l'email renseigné]
     * @accès Administrateur
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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
                $this->Flash->success(__('l\'utilisateur a été invité'));

                //$messageChercheur = file_get_contents(ROOT.'/webroot/files/email_auto_chercheur.ctp');
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Confirmation de compte")
                    ->send('Voici vos identifiant administrateur de l\'application'."\n--------------------------------------------------------------------------------\nVoici vos identifiant de votre compte: \nLogin : ".$this->request->data['login']."\nMot de passe : ".$this->request->data['password']."\n--------------------------------------------------------------------------------\n");
                
                $administrateur = $this->Administrateur->newEntity();
                //if ($this->request->is('post')) {
                //$administrateur = $this->Administrateur->patchEntity($administrateur, $this->request->data);
                $administrateur->ID = $user->ID;
                //$administrateur->CodeAdmin = $count['max']+1;
                if ($this->Administrateur->save($administrateur)) {
                    $this->Flash->success(__('L\'administrateur a bien été ajouté.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Erreur lors de l\'enregistrement de l\'administrateur, veuillez réessayer.'));
                }
                

                //return $this->redirect(['controller'=>'users','action' => 'index']);
            } else {
            $this->Flash->error(__('L\'utilisateur n\'a pas été enregistré, veuillez réessayer.'));
            }
        }
        $this->set('user',$user);
        $this->set('login',$login);
        $this->set('password',$password);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        $this->set(compact('administrateur'));
        $this->set('_serialize', ['administrateur']);
    }

    /**
     * Delete method
     * @accès Administrateur
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
        $save_id = $administrateur->ID;
        
        if ($this->Administrateur->delete($administrateur)) {
            $this->Flash->success(__('L\'administrateur as été supprimé.'));
            $ad = TableRegistry::get('administrateur')
                        ->query();
            $ad
                ->delete()
                ->where(['ID' => $save_id])
                ->execute();
        } else {
            $this->Flash->error(__('Erreur lors de la suppression de l\'administrateur.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    /**
     * [droitopposition Page de modification du message récapitulant les droits d'opposition du candidat]
     * @accès Administrateur
     * @file [webroot/files/message_suppression_données_utilisateur.ctp]
     * @return [Aucun]
     */
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
            $this->Flash->success(__('le message a été modifié'));
        }

    }


    /**
     * [droitAcces Page de modification du message récapitulant les droits d'accès a l'information du candidat]
     * @accès Administrateur
     * @file [webroot/files/message_collecte_données_utilisateur.ctp]
     * @return [Aucun]
     */
    public function droitAcces(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

         $this->viewBuilder()->layout('adminLayout');
        
        if($this->request->is('post')){
            //debug($this->request->data);
            $file = new File(ROOT.'/webroot/files/message_collecte_données_utilisateur.ctp');
            $file->write($this->request->data['message']);
            $file->close();
            $this->Flash->success(__('le message a été modifié'));
        }

    }


    /**
     * [supprOccupation Fonction permettant de supprimer l'intégralitée des occupations de la base de donnée]
     * @accès Administrateur
     * @warning [long a s'executer] 
     * @return [Redirection] [redirection administrateur gestionDonnee]
     */
	public function supprOccupation(){
            if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
            if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
                $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

			$this->loadModel('Occupation');
			$occupations = $this->Occupation->find('all');
			$error = false;
			foreach($occupations as $occupation){
				if(!($this->Occupation->delete($occupation))){
					$this->Flash->error(__('Une erreur est survenue lors de la suppression de l\'occupation n°'.$occupation->CodeOccupation));
					$error = true;
				}
			}
			if(!$error){
				$this->Flash->success(__('Toutes les occupations ont bien été supprimées'));
				$this->redirect(['controller'=>'administrateur','action' => 'gestionDonnees']);
			}
	}
	

    /**
     * [supprCandidat Fonction permettant de supprimer tout les candidats présent dans la base de donnée]
     * @accès Administrateur
     * @warning [long a s'executer] 
     * @return [Redirection] [redirection administrateur gestionDonnee]
     */
	public function supprCandidat(){
         if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
		$this->loadModel('Occupation');
		$this->loadModel('Candidat');
		$this->loadModel('Messages');
		$this->loadModel('Users');
		$occupations = $this->Occupation->find('all');
		$error = false;
		foreach($occupations as $occupation){
			if(!($this->Occupation->delete($occupation))){
				$this->Flash->error(__('Une erreur est survenue lors de la suppression de l\'occupation n°'.$occupation->CodeOccupation));
				$error = true;
			}
		}
		if(!$error){
			$this->Flash->success(__('Toutes les Occupations ont bien été supprimées'));
			$messages = $this->Messages->find('all');
			foreach($messages as $message){
				if(!($this->Messages->delete($message))){
					$this->Flash->error(__('Une erreur est survenue lors de la suppression du message n°'.$message->IDMessage));
					$error = true;
				}
			}
			if(!$error){
				$this->Flash->success(__('Tous les Messages ont bien été supprimées'));
				$candidats = $this->Candidat->find('all');
				foreach($candidats as $candidat){
					if(!($this->Candidat->delete($candidat))){
						$this->Flash->error(__('Une erreur est survenue lors de la suppression du Candidat n°'.$candidat->CodeCandidat));
						$error = true;	
					}
				}
				if(!$error){
					$users = $this->Users->find('all', ['conditions' => ['Users.typeUser' => 'candidat']]);
					foreach($users as $user){
						if(!($this->Users->delete($user))){
							$this->Flash->error(__('Une erreur est survenue lors de la suppression de l\'user n°'.$user->ID));
							$error = true;	
						}
					}
					if(!$error){
						$this->Flash->success(__('Tous les Candidats ont bien été supprimées'));
					}
				} 
				else {
					$this->Flash->error(__('Arrêt de la procédure de suppression.'));
				}
			}
			else{
				$this->Flash->error(__('Arrêt de la procédure de suppression.'));
			}
		}
		else{
			$this->Flash->error(__('Arrêt de la procédure de suppression.'));
		}
		$this->redirect(['controller'=>'administrateur','action' => 'gestionDonnees']);
	}


    /**
     * [aide Page d'aide en ligne sur l'utilisation du site web pour l'administrateur]
     * @accès Administrateur
     * @return [type] [description]
     */
    public function aide()
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
        $this->viewBuilder()->layout('adminLayout');
    }

    public function messagerie(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
       
        if($this->request->is('post')){
            //Récupération des données a enregistrer
            $port       = $this->request->data['port'];
            $username   = $this->request->data['username'];
            $password   = $this->request->data['password'];
            $host       = $this->request->data['host'];
            $name_email = $this->request->data['name_email'];
            $secure     = $this->request->data['secure'];

            $fp = fopen("config/app.php","r"); //lecture
            $app = "";

            // ======= Ecriture dans le fichier APP.PHP ======= //
            while(($ligne = fgets($fp,255)) != false)
            {
                $app = $app.$ligne;
                if($ligne == "            'appli' => [\n"){
                    $app = $app.fgets($fp,255);
                    fgets($fp,255);                 // saut de la lecture de host
                    fgets($fp,255);                 // saut de la lecture de port
                    fgets($fp,255);                 // saut de la lecture de username
                    fgets($fp,255);                 // saut de la lecture de password
                    if($secure == 'ssl'){
                        $host = 'ssl://'.$host;
                    }
                    $app = $app."\t\t\t\t'host' => '$host',\n";
                    $app = $app."\t\t\t\t'port' => $port,\n";
                    $app = $app."\t\t\t\t'username' => '$username',\n";
                    $app = $app."\t\t\t\t'password' => '$password',\n";
                    $app = $app.fgets($fp,255); 
                    $app = $app.fgets($fp,255); 
                    fgets($fp,255);                 // saut de la lecture de tls
                    if($secure == 'tls'){
                        $app = $app."\t\t\t\t'tls'=> true,\n";
                    }
                    else {
                        $app = $app."\t\t\t\t'tls'=> null,\n";
                    }
                }
                if($ligne == "        'Email' => [\n"){
                    $app = $app.fgets($fp,255);
                    $app = $app.fgets($fp,255);
                    $app = $app."\t\t\t\t'from' => '$name_email',\n";
                    fgets($fp,255);                 // saut de la lecture du nom de l'email
                }
            }
            //var_dump($this->request->data);
            fclose($fp);
            // ouverture de config/app en ecriture
            $fp = fopen("config/app.php","w");
            fwrite($fp, $app);
            fclose($fp);
            $this->redirect(['controller'=>'administrateur','action' => 'messagerie']);
        }

        // ======= Lecture de APP.PHP ======= //
        $fp = fopen("config/app.php","r"); //lecture
        //parcourt su fichier app.php afin de trouver la partie "SMTP"
        while((($ligne = fgets($fp,255)) != "            'appli' => [\n") && ($ligne  != false))
        {}
        // récupération des données concernant le serveur smtp
        fgets($fp,255);
        //fgets($fp,255);

        $host       = fgets($fp, 255);
        $port       = fgets($fp, 255);
        $username   = fgets($fp, 255);
        $password   = fgets($fp, 255);
        fgets($fp, 255);                // Saut de la ligne TimeOut
        fgets($fp, 255);                // Saut de la ligne client
        $secure     = fgets($fp, 255);

        // $host       = substr(fgets($fp, 255), 0, -3);
        // $port       = substr(fgets($fp, 255), 0, -1);
        // $username   = substr(fgets($fp, 255), 0, -3);
        // $password   = substr(fgets($fp, 255), 0, -3);

        // recherche du nom de l'email :
        while((($ligne = fgets($fp,255)) != "        'Email' => [\n") && ($ligne  != false))
        {}
        fgets($fp,255);
        fgets($fp,255);
        $name_email = substr(fgets($fp, 255), 0, -3);
        fclose($fp);

        // echo "<br/>host : ".$host;
        // echo "<br/>port : ".$port;
        // echo "<br/>username : ".$username;
        // echo "<br/>password : ".$password;
        // echo "<br/>name_email : ".$name_email;
        // echo "<br/>secure : ".$secure;

        // secure = true/false en fonction de la valeur de tls
        $secure = explode('=>',$secure);
        $secure = $secure[1];
        $secure = str_replace(" ", "", $secure);
        $secure = substr($secure, 0, -2);
        if($secure == "true"){
            $secure = 'tls';
        }
        else {
            $secure = 'none';                       // par defaut à aucune (le test du SSL a lieux dans l'host)
        }

        //mise en forme des données
        $host = explode('=>',$host);
        $host = $host[1];
        $host = str_replace(" '", "", $host);
        $host = substr($host, 0, -3);
        // Si utilisation d'une securité SSL (l'affichage se fait dans l'host de la forme suivante : 'ssl://smtp.gmail.com')
        if(substr($host, 0, 6) == 'ssl://'){
            $secure = 'ssl';                        // mise a jour de ssl
            $host = substr($host, 6);               // on retire 'ssl://' du nom de l'host
        }

        $port = explode('=>',$port);
        $port = $port[1];
        $port = str_replace(" ", "", $port);  
        $port = substr($port, 0, -2);  

        $username = explode('=>',$username);
        $username = $username[1];
        $username = str_replace(" '", "", $username);  
        $username = substr($username, 0, -3);

        $password = explode('=>',$password);
        $password = $password[1];
        $password = str_replace(" '", "", $password);  
        $password = substr($password, 0, -3);

        // var_dump($name_email);
        $name_email = explode('=>',$name_email);
        $name_email = $name_email[1];
        $name_email = str_replace(" '", "", $name_email);  

        // echo "fin lecture";
        // echo "<br/>host : ".$host;
        // echo "<br/>port : ".$port;
        // echo "<br/>username : ".$username;
        // echo "<br/>password : ".$password;
        // echo "<br/>name_email : ".$name_email;
        // echo "<br/>secure : ".$secure;
        
        $this->viewBuilder()->layout('adminLayout');
        //$id = $_SESSION['Auth']['User']['email'];
        $this->set(compact('host'));
        $this->set(compact('port'));
        $this->set(compact('username'));
        $this->set(compact('password'));
        $this->set(compact('name_email'));
        $this->set(compact('secure'));
    }
}
