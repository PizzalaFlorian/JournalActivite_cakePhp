<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

use fonctionperso\chercheur\chercheurAccueil;
use fonctionperso\chercheur\chercheurDonnees;
use fonctionperso\chercheur\chercheurTable;
use fonctionperso\activite\activite;
use fonctionperso\lieu\lieux;
use fonctionperso\dispositif\dispositif;
use fonctionperso\compagnie\compagnie;
use phpoffice\phpexcel\Classes\PHPExcel;
use Cake\Mailer\Email;

/**
 * Chercheur Controller
 *
 * @property \App\Model\Table\ChercheurTable $Chercheur
 */
class ChercheurController extends AppController
{


    /**
     * [accueil Page d'accueil des chercheur]
     * @accès chercheur
     * @return [aucun]
     */
    public function accueil(){

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $this->viewBuilder()->layout('cherLayout');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurAccueil.php");

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "actualite" . DS ."actualite.php");
        $this->loadModel('Actualites');
        $actualites = $this->Actualites->find('all' ,array( 'order' => array('Date DESC') ));
        $this->set(compact('actualites'));
        $this->set('_serialize', ['actualites']);
    }

    /**
     * [aide Page d'aide en ligne pour les chercheur]
     * @return [aucun]
     */
    public function aide(){

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

         $this->viewBuilder()->layout('cherLayout');
    }


    /**
     * [donnees Page de visualisation et de téléchargement des données]
     * @Accès Chercheur
     * @return [aucun]
     */
    public function donnees(){

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

         $this->viewBuilder()->layout('cherLayout');
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurAccueil.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurDonnees.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."activite.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "lieu" . DS ."lieux.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "dispositif" . DS ."dispositif.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "compagnie" . DS ."compagnie.php");
    }


    /**
     * [telechargerCandidat Fonction de création et de téléchargement d'un fichier csv reprenant les information
     * anonymisée des candidats]
     * @Accès chercheur
     * @return [candidat.csv] [Fichier csv des candidat]
     */
    public function telechargerCandidat(){
        /*générer un fichier csv avec les données de la table candidat*/
        //créer un fichier
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $fichierCSV = fopen(ROOT .DS. "webroot". DS . "files" . DS .'candidat.csv', 'a');

        ftruncate($fichierCSV,0);
        $delimiter = ";";


        $entete = array( "Code Candidat" , "Age" , "Genre Candidat", "Lieu d'étude" , "Niveau d'étude" , "Diplome préparé" , "Etat civil" , "Nombre d'enfant"); 
        fputcsv($fichierCSV,$entete,$delimiter);
        $table = TableRegistry::get('candidat')
            ->find()
            ->toArray();
        foreach ($table as $data) {
            $res = array($data['CodeCandidat'] , $data['Age'] , $data['GenreCandidat'], $data['LieuxEtude'], $data['NiveauEtude'], $data['DiplomePrep'], $data['EtatCivil'], $data['NombreEnfant']);
            fputcsv($fichierCSV,$res,$delimiter);
        }

        fclose($fichierCSV);
        //download fichier
        $path = ROOT .DS. "webroot". DS . "files" . DS .'candidat.csv';
        $this->response->file($path, array(
            'download' => true,
            'name' => 'candidat.csv',
        ));
        return $this->response;        
    }

    /**
     * [telechargerCandidatExcel Création d'un fichier candidat et des occupation sous
     * format excel. Génération dans la template via un pluggin excel]
     * @accès chercheur
     * @return [journal.xls] [Fichier Excel des candidat et des occupations]
     */
    public function telechargerCandidatExcel(){
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
       
    }

    /**
     * [downloadExcel Télécharge le fichier Excel générer précédement]
     * @accès chercheur
     * @return [journal.xls] [Fichier Excel des candidat et des occupations]
     */
    public function downloadExcel(){

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $path = ROOT .DS. "webroot". DS . "files" . DS .'journal.xls';
        $this->response->file($path, array(
            'download' => true,
            'name' => 'journal.xls',
        ));
        return $this->response;
    }


    /**
     * [telechargerDonnees Création et téléchargment d'un fichier CSV contenant les occupations]
     * @accès Chercheur
     * @return [donnees.csv] [Fichier csv des occupations]
     */
    public function telechargerDonnees(){

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        
        $fichierCSV = fopen(ROOT .DS. "webroot". DS . "files" . DS .'donnees.csv', 'a');
        ftruncate($fichierCSV,0);
        $delimiter = ";";
        $entete = array( "Début" , "Fin" , "Durée", "Code Activité" , "Code Lieu" , "Code Compagnie" , "Code Dispositif" , "Code Candidat"); 
        fputcsv($fichierCSV,$entete,$delimiter);
        $Occupations = TableRegistry::get('occupation')
            ->find()
            ->select(array(
                    'dure'=>'TIMEDIFF(HeureFin,HeureDebut)',
                    'CodeCandidat',
                    'CodeLieux',
                    'CodeCompagnie',
                    'CodeActivite',
                    'CodeDispositif',
                    'CodeOccupation',
                    'HeureDebut',
                    'HeureFin'
                    )
                )
            ->toArray();
        foreach ($Occupations as $data) {
            $res = array($data['HeureDebut']->i18nFormat('yyyy-MM-dd HH:mm:ss') , $data['HeureFin']->i18nFormat('yyyy-MM-dd HH:mm:ss'), $data['dure'], $data['CodeActivite'], $data['CodeLieux'] , $data['CodeCompagnie'] , $data['CodeDispositif'] , $data['CodeCandidat']);
            fputcsv($fichierCSV,$res,$delimiter);
        }
        
        // 3 : quand on a fini de l'utiliser, on ferme le fichier
        fclose($fichierCSV);
        $path = ROOT .DS. "webroot". DS . "files" . DS .'donnees.csv';
        $this->response->file($path, array(
            'download' => true,
            'name' => 'donnees.csv',
        ));
        return $this->response;
    }


    /**
     * [telechargerLegende Création et téléchargement d'un fichier txt contenant la liste des codes et les leurs despcription (codes activités, codes lieux ...)]
     * @Accès chercheur
     * @return [legende.txt] [Fichier Legende]
     */
    public function telechargerLegende(){

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."activite.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "lieu" . DS ."lieux.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "dispositif" . DS ."dispositif.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "compagnie" . DS ."compagnie.php");

        $fichierLegende = fopen(ROOT .DS. "webroot". DS . "files" . DS .'legende.txt', 'a');
        ftruncate($fichierLegende,0);
        fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
        $date = date("Y-m-d H:i");
        fputs($fichierLegende,"\nLes codes correspondant aux noms dans la base de données au $date\n");
        fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
        fputs($fichierLegende,"Les codes des activités :\n");
        fputs($fichierLegende,listeActivite());
        fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
        fputs($fichierLegende,"Les codes des lieux :\n");
        fputs($fichierLegende,listeLieu());
        fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
        fputs($fichierLegende,"Les codes des compagnies :\n");
        fputs($fichierLegende,listeCompagnie());
        fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
        fputs($fichierLegende,"Les codes des dispositifs :\n");
        fputs($fichierLegende,listeDispositif());
        fputs($fichierLegende,"\n-----------------------------------------------------------------------------\n");
        fputs($fichierLegende,"Les codes candidats : ce sont les codes des candidats, leur noms n'est pas communiqué aux chercheurs à cause de la confidentialité, si vous vous rendez compte qu'un candidat rentre des mauvaises données signalez le à l'administrateur qui se chargera de supprimer le candidat.\n");

        // 3 : quand on a fini de l'utiliser, on ferme le fichier
        fclose($fichierLegende);
        //header('Location: legende.txt');
        $path = ROOT .DS. "webroot". DS . "files" . DS .'legende.txt';
        $this->response->file($path, array(
            'download' => true,
            'name' => 'legende.txt',
        ));
        return $this->response;

    }

     public function telechargerLegendeCSV(){

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        
        $fichierLegende = fopen(ROOT .DS. "webroot". DS . "files" . DS .'legende.csv', 'a');
        ftruncate($fichierLegende,0);
        $delimiter = ";";
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."activite.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "lieu" . DS ."lieux.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "dispositif" . DS ."dispositif.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "compagnie" . DS ."compagnie.php");

        fputcsv($fichierLegende,array( "CodeActivite" , "Descriptif"),$delimiter);
        putListeActiviteCSV($fichierLegende,$delimiter);
        fputcsv($fichierLegende,array( "CodeLieux" , "Descriptif"),$delimiter);
        putListeLieuCSV($fichierLegende,$delimiter);
        fputcsv($fichierLegende,array( "CodeCompagnie" , "Descriptif"),$delimiter);
        putListeCompagnieCSV($fichierLegende,$delimiter);
        fputcsv($fichierLegende,array( "CodeDispositif" , "Descriptif"),$delimiter);
        putListeDispositifCSV($fichierLegende,$delimiter);


        // 3 : quand on a fini de l'utiliser, on ferme le fichier
        fclose($fichierLegende);

        $path = ROOT .DS. "webroot". DS . "files" . DS .'legende.csv';
        $this->response->file($path, array(
            'download' => true,
            'name' => 'legende.csv',
        ));
        return $this->response;
    }


    /**
     * [modif Page permettant au chercheur de modifier ses infos, ici nom et prénom]
     * @Accès chercheur
     * @return [Redirection acceuil]
     */
    public function modif()
    {

        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $this->viewBuilder()->layout('cherLayout');
        $chercheur = TableRegistry::get('chercheur')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('Vos informations personnelles ont bien été modifiées.'));
                return $this->redirect(['action' => 'accueil']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification des informations personnelles.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }
    /**
     * Index method
     * @Accès Administrateur
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        $this->viewBuilder()->layout('adminLayout');
        $chercheur = $this->paginate($this->Chercheur);

        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * View method
     * @Accès Administrateur
     * @param string|null $id Chercheur id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        $chercheur = $this->Chercheur->get($id, [
            'contain' => []
        ]);

        $this->set('chercheur', $chercheur);
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Add method
     * @Accès Administrateur
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'candidat')
            $this->redirect(['controller'=>'candidat','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);

        $chercheur = $this->Chercheur->newEntity();
        if ($this->request->is('post')) {

            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('Vos informations ont bien été enregistrées.'));
                return $this->redirect(['action' => 'accueil']);
            } else {
                $this->Flash->error(__('Erreur lors de l\'enregistrement de vos informations.'));
            }
            
        }
        
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Edit method
     * @Accès Administrateur
     * @param string|null $id Chercheur id.
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

        $chercheur = $this->Chercheur->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('Le chercheur as bien été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification du chercheur.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Delete method
     * @Accès Administrateur
     * @param string|null $id Chercheur id.
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
        $chercheur = $this->Chercheur->get($id);
        $save_id = $chercheur->ID;
        $save_code = $chercheur->CodeChercheur;
            
        if ($this->Chercheur->delete($chercheur)) {
            $this->Flash->success(__('Le chercheur as été supprimé.'));
            $cdb = TableRegistry::get('carnetdebord')
                    ->query();
                $cbd
                    ->update()
                    ->set(['CodeChercheur' => 1])
                    ->where(['CodeChercheur' => $save_code])
                    ->execute();

            $this->loadModel('Messages');
            $messages = $this->Messages->find('all', ['conditions' => ['Messages.IDExpediteur' => $save_id]]);
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
            $messages = $this->Messages->find('all', ['conditions' => ['Messages.IDRecepteur' => $save_id]]);
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
            $user = TableRegistry::get('users')
                ->query();
            $user
                ->delete()
                ->where(['ID' => $save_id])
                ->execute();
        } else {
            $this->Flash->error(__('Erreur lors de la suppression.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
