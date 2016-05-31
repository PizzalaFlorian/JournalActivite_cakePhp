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
            $this->Flash->success(__('le message a été modifier'));
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
            $this->Flash->success(__('le message a été modifier'));
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
            $this->Flash->success(__('le message a été modifier'));
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
                $this->Flash->success(__('l\'utilisateur a été inviter'));

                $messageChercheur = file_get_contents(ROOT.'/webroot/files/email_auto_chercheur.ctp');
                $email = new Email('default');
                $email
                    ->to($this->request->data['email'])
                    ->subject("Confirmation de compte")
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
                $this->Flash->success(__('l\'utilisateur a été inviter'));
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
                $this->Flash->success(__('l\'utilisateur a été inviter'));

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
            $this->Flash->success(__('le message a été modifier'));
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
            $this->Flash->success(__('le message a été modifier'));
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
        //$ligne = fgets($fp,255);
        /*while(($ligne = fgets($fp,255)) != false){
            
            if($ligne == "'appli' => [\n"){
                echo "<br/>hi";
            }
            //(fgets($fp,255) != "                'appli' => [")&&(
        }*/   
        if($this->request->is('post')){
            
            //var_dump($this->request->data);
            //Récupération des données a enregistrer
            $port       = $this->request->data['port'];
            $username   = $this->request->data['username'];
            $password   = $this->request->data['password'];
            $host       = $this->request->data['host'];
            if($this->request->data['secure'] = "tls"){
                $tls = "true";
            }
            else{
                $tls = "false";
            }

            $fp = fopen("config/app.php","r"); //lecture
            $app = "";
            while(($ligne = fgets($fp,255)) != false)
            {
                $app = $app.$ligne;
                if($ligne == "'appli' => [\n"){
                    $app = $app.fgets($fp,255);
                    fgets($fp,255);                 // saut de la lecture de host
                    fgets($fp,255);                 // saut de la lecture de port
                    fgets($fp,255);                 // saut de la lecture de username
                    fgets($fp,255);                 // saut de la lecture de password
                    $app = $app."\t\t\t\t'host'\t\t=> '$host',\n";
                    $app = $app."\t\t\t\t'port'\t\t=> $port,\n";
                    $app = $app."\t\t\t\t'username'\t=> '$username',\n";
                    $app = $app."\t\t\t\t'password'\t=> '$password',\n";
                    $app = $app.fgets($fp,255);
                    $app = $app.fgets($fp,255); 
                    fgets($fp,255);                 // saut de la lecture de tls
                    $app = $app."\t\t\t\t'tls'\t\t=> '$tls',\n";
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


        $fp = fopen("config/app.php","r"); //lecture
        //parcourt su fichier app.php afin de trouver la partie "SMTP"
        while((($ligne = fgets($fp,255)) != "'appli' => [\n") && ($ligne  != false))
        {}
        // récupération des données concernant le serveur smtp
        fgets($fp,255);
        $host       = substr(fgets($fp, 255), 0, -3);
        //echo fgets($fp, 255);
        $port       = substr(fgets($fp, 255), 0, -2);
        $username   = substr(fgets($fp, 255), 0, -3);
        $password   = substr(fgets($fp, 255), 0, -3);
        fclose($fp);
        //mise en forme des données
        $host = explode('=>',$host);
        $host = $host[1];
        $host = str_replace(" '", "", $host);

        $port = explode('=>',$port);
        $port = $port[1];
        $port = str_replace("  ", "", $port);       

        $username = explode('=>',$username);
        $username = $username[1];
        $username = str_replace(" '", "", $username);  

        $password = explode('=>',$password);
        $password = $password[1];
        $password = str_replace(" '", "", $password);  
        // echo "fin lecture";
        // echo "<br/>host : ".$host;
        // echo "<br/>port : ".$port;
        // echo "<br/>username : ".$username;
        // echo "<br/>password : ".$password;

        $this->viewBuilder()->layout('adminLayout');
        //$id = $_SESSION['Auth']['User']['email'];
        $this->set(compact('host'));
        $this->set(compact('port'));
        $this->set(compact('username'));
        $this->set(compact('password'));
    }
}
