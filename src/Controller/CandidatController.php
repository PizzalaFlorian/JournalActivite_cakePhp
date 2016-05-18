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

    public function certificat(){
        $this->viewBuilder()->layout('pdf/default');
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
                'fin'=>'max(HeureDebut)'
                ))
            ->where(['CodeCandidat' => $candidat['CodeCandidat']])
            ->group('CodeCandidat')
            ->first();

        $this->set('filename',$filename);
        $this->set('candidat',$candidat);
        $this->set('debut',$stats_occupation['debut']);
        $this->set('fin',$stats_occupation['fin']);
        $this->set('count',$stats_occupation['count']);
        
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
                $this->Flash->success(__('The candidat has been saved.'));
                return $this->redirect(['action' => 'modif']);
            } else {
                $this->Flash->error(__('The candidat could not be saved. Please, try again.'));
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
                $this->Flash->success(__('The candidat has been saved.'));
                return $this->redirect(['action' => 'accueil']);
            } else {
                $this->Flash->error(__('The candidat could not be saved. Please, try again.'));
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

        $candidat = $this->Candidat->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidat = $this->Candidat->patchEntity($candidat, $this->request->data);
            if ($this->Candidat->save($candidat)) {
                $this->Flash->success(__('The candidat has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The candidat could not be saved. Please, try again.'));
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
        $this->request->allowMethod(['post', 'delete']);
        $candidat = $this->Candidat->get($id);
        if ($this->Candidat->delete($candidat)) {
            $this->Flash->success(__('The candidat has been deleted.'));
        } else {
            $this->Flash->error(__('The candidat could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
