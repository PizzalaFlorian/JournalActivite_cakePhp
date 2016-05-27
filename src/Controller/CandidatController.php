<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

use fonctionperso\calendar\functiondate;
use fonctionperso\calendar\affichageactivite;
use fonctionperso\candidat\toolboxcandidat;
use fonctionperso\candidat\candidatHistorique;
use fonctionperso\activite\activite;
use fonctionperso\activite\categorieactivite;
use fonctionperso\lieu\lieux;
use fonctionperso\lieu\categorielieu;
use fonctionperso\compagnie\compagnie;
use fonctionperso\dispositif\dispositif;

/**
 * Candidat Controller
 *
 * @property \App\Model\Table\CandidatTable $Candidat
 */
class CandidatController extends AppController
{
    public function cnil(){
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['published'])){
                return $this->redirect([
                            'controller' => 'candidat',
                            'action' => 'add']);
            }
            else{
                $this->Flash->error(__('Veuillez cocher la case "J\'ai pris connaissances de mes droits, et autorise les chercheurs a utilisés mes données" pour pouvoir poursuivre.'));
            }
        }
    }

    public function generate(){
        $this->viewBuilder()->layout('candiLayout');

        if ($this->request->is(['patch', 'post', 'put'])) {
            return $this->redirect(['action' => 'certificat/'.$this->request->data['Code_Etudiant']]);
        }

    }

    public function certificat($id=null){
        $this->viewBuilder()->layout('pdf/default');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "CodeBarre" . DS ."codebarre.inc.php");
        $filename = 'certificat';

        $candidat = TableRegistry::get('candidat')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();

        $stats_occupation = TableRegistry::get('occupation')
            ->find()
            ->select(array(
                'count'=>'Count(*)',
                'debut'=>'min(HeureDebut)',
                'fin'=>'max(HeureFin)'
                ))
            ->where(['CodeCandidat' => $candidat['CodeCandidat']])
            ->group('CodeCandidat')
            ->first();

        $stats_occupation2 = TableRegistry::get('occupation')
            ->find()
            ->select(array(
                'nbjour'=>'count(distinct(HeureDebut))'
                ))
            ->where(['CodeCandidat' => $candidat['CodeCandidat']])
            ->group('HeureDebut')
            ->first();
        if(isset($stats_occupation2['nbjour']))
            $nbjour = $stats_occupation2['nbjour'];
        else
            $nbjour = '0';
        if(isset($stats_occupation['debut']))
            $debut = $stats_occupation['debut'];
        else
            $debut = 'jamais';
        if(isset($stats_occupation['fin']))
            $fin = $stats_occupation['fin'];
        else
            $fin = 'jamais';
        if(isset($stats_occupation['count']))
            $count = $stats_occupation['count'];
        else
            $count = '0';

        $char = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ';
        $code = str_shuffle($char);
        $code = substr ( $code , 0, 12 );

        $codeEtu = explode('.', $id);

        $this->set('codeEtu',$codeEtu[0]);
        $this->set('filename',$filename);
        $this->set('candidat',$candidat);
        $this->set('debut',$debut);
        $this->set('fin',$fin);
        $this->set('count',$count);
        $this->set('nbjour',$nbjour);
        $this->set('annee',date('j/m/Y'));
        $this->set('code',$code);
        
        //$this->redirect(['controller'=>'candidat','action' => 'accueil']);     
    }
    public function accueil()
    {

        $this->viewBuilder()->layout('candiLayout');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "candidat" . DS ."toolboxcandidat.php");

        // ==== ACTUALITES ==== //
            //fonction lié au actualité dans actualité.php
            require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "actualite" . DS ."actualite.php");
            $this->loadModel('Actualites');
            $actualites = $this->Actualites->find('all' ,array( 'order' => array('Date DESC') ));
            //envoie des actualites au template
            $this->set(compact('actualites'));
            $this->set('_serialize', ['actualites']);
    }

    public function butExperience()
    {
        $this->viewBuilder()->layout('candiLayout');
    }

    public function compte()
    {
        $this->viewBuilder()->layout('candiLayout');
    }

    public function modif()
    {
        $this->viewBuilder()->layout('candiLayout');
        $candidat = TableRegistry::get('candidat')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidat = $this->Candidat->patchEntity($candidat, $this->request->data);
            if ($this->Candidat->save($candidat)) {
                $this->Flash->success(__('Vos informations personnelles ont bien été modifié.'));
                return $this->redirect(['action' => 'modif']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification de vos informations personnelles, Veuillez réessayer.'));
            }
        }
        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);
    }
    public function historique()
    {
        $this->viewBuilder()->layout('candiLayout');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "candidat" . DS ."candidatHistorique.php");
    }

    public function aide()
    {
        $this->viewBuilder()->layout('candiLayout');
    }



    public function activite()
    {
        $this->viewBuilder()->layout('candiLayout');

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "calendar" . DS ."affichageactivite.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "calendar" . DS ."fonctionsdate.php"); 

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."activite.php"); 
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."categorieactivite.php"); 

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "lieu" . DS ."lieux.php");
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "lieu" . DS ."categorielieu.php"); 

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "compagnie" . DS ."compagnie.php"); 

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "dispositif" . DS ."dispositif.php"); 
    }

    public function request()
    {
        //NE SURTOUT PAS SUPPRIMER LA TEMPLATE ASSOCIER
        if ($this->request->is('post')) {
            if($this->request->data['categorie'] == "lieu"){
                $liste_Lieu = TableRegistry::get('lieu')
                    ->find()
                    ->where(['CodeCategorieLieux'=>$this->request->data['codeCategorie']])
                    ->toArray();

                foreach($liste_Lieu as $lieu){
                    echo '<option id="'.$lieu['CodeLieux'].'">'.$lieu['NomLieux'].'</option>';
                }
            }
            if($this->request->data['categorie'] == "activite"){
                $liste_activite = TableRegistry::get('activite')
                    ->find()
                    ->where(['CodeCategorie'=>$this->request->data['codeCategorie']])
                    ->toArray();
                
                foreach($liste_activite as $activite){
                    echo'<option id="'.$activite['CodeActivite'].'">'.$activite['NomActivite'].'</option>';
                }
            }
        }   
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

        $candidat = $this->paginate($this->Candidat);

        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);
    }

    /**
     * View method
     *
     * @param string|null $id Candidat id.
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

        $candidat = $this->Candidat->get($id, [
            'contain' => []
        ]);

        $this->set('candidat', $candidat);
        $this->set('_serialize', ['candidat']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidat = $this->Candidat->newEntity();
        if ($this->request->is('post')) {
            $candidat = $this->Candidat->patchEntity($candidat, $this->request->data);
            if ($this->Candidat->save($candidat)) {
                $this->Flash->success(__('Le candidat a été ajouté.'));
                return $this->redirect(['action' => 'accueil']);
            } else {
                $this->Flash->error(__('Erreur lors de l\'ajout du candidat.'));
            }
        }
        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidat id.
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
        
        $candidat = $this->Candidat->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidat = $this->Candidat->patchEntity($candidat, $this->request->data);
            if ($this->Candidat->save($candidat)) {
                $this->Flash->success(__('Le candidat as bien été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erreur lors de la modification du candidat.'));
            }
        }
        $this->set(compact('candidat'));
        $this->set('_serialize', ['candidat']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidat id.
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
        $candidat = $this->Candidat->get($id);
        $occupation = TableRegistry::get('occupation')
            ->query();
        $occupation
            ->delete()
            ->where(['CodeCandidat' => $candidat['CodeCandidat']])
            ->execute();
        $save_id = $candidat->ID;
        if ($this->Candidat->delete($candidat)) {
            $this->Flash->success(__('Le candidat as été supprimé.'));
             $candi = TableRegistry::get('users')
            ->query();
            $candi
                ->delete()
                ->where(['ID' => $save_id])
                ->execute();
        } else {
            $this->Flash->error(__('Erreur lors de la suppression du candidat.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
