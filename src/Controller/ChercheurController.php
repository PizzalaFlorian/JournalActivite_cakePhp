<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

use fonctionperso\chercheur\chercheurAccueil;
use fonctionperso\chercheur\chercheurDonnees;
use fonctionperso\activite\activite;
use fonctionperso\lieu\lieux;
use fonctionperso\dispositif\dispositif;
use fonctionperso\compagnie\compagnie;
use fonctionperso\PHPExcel;
use fonctionperso\PHPExcel\Writer\Excel5;

/**
 * Chercheur Controller
 *
 * @property \App\Model\Table\ChercheurTable $Chercheur
 */
class ChercheurController extends AppController
{



    public function accueil(){
        $this->viewBuilder()->layout('cherLayout');
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurAccueil.php");

    }
    public function aide(){
         $this->viewBuilder()->layout('cherLayout');
    }
    public function carnetDeBord(){
         $this->viewBuilder()->layout('cherLayout');
    }
    public function tables(){
         $this->viewBuilder()->layout('cherLayout');
    }
    public function donnees(){
         $this->viewBuilder()->layout('cherLayout');
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurAccueil.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "chercheur" . DS ."chercheurDonnees.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "activite" . DS ."activite.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "lieu" . DS ."lieux.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "dispositif" . DS ."dispositif.php");
         require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "compagnie" . DS ."compagnie.php");
    }

    public function telechargerCandidat(){
        /*générer un fichier csv avec les données de la table candidat*/
        //créer un fichier

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

    public function testExcel(){
        //$this->autoLayout = false;
    }

    public function telechargerCandidatExel(){
        // include '../class/PHPExcel.php';
        // include '../class/PHPExcel/Writer/Excel5.php';
        
        //App::classname('PHPExcel');
        //require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "PHPExcel" . DS ."Writer" . DS ."Excel5.php");
        
        App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));

        $workbook = new PHPExcel;

        $sheet = $workbook->getActiveSheet();

        $sheet->setTitle('Candidat');
        
        $sheet->setCellValueByColumnAndRow('0','1','Code Candidat');
        $sheet->setCellValueByColumnAndRow('1','1','Age');
        $sheet->setCellValueByColumnAndRow('2','1','Genre Candidat');
        $sheet->setCellValueByColumnAndRow('3','1',"Lieu d'étude");
        $sheet->setCellValueByColumnAndRow('4','1',"Niveau d'étude");
        $sheet->setCellValueByColumnAndRow('5','1','Diplome préparé');
        $sheet->setCellValueByColumnAndRow('6','1','Etat civil');
        $sheet->setCellValueByColumnAndRow('7','1',"Nombre d'enfant");
        
        $i = 2;
        $Candidats = TableRegistry::get('candidat')
            ->find()
            ->toArray();
        foreach ($Candidats as $data){
            $sheet->setCellValueByColumnAndRow('0',$i,$data['CodeCandidat']);
            $sheet->setCellValueByColumnAndRow('1',$i,$data['Age']);
            $sheet->setCellValueByColumnAndRow('2',$i,$data['GenreCandidat']);
            $sheet->setCellValueByColumnAndRow('3',$i,$data['LieuxEtude']);
            $sheet->setCellValueByColumnAndRow('4',$i,$data['NiveauEtude']);
            $sheet->setCellValueByColumnAndRow('5',$i,$data['DiplomePrep']);
            $sheet->setCellValueByColumnAndRow('6',$i,$data['EtatCivil']);
            $sheet->setCellValueByColumnAndRow('7',$i,$data['NombreEnfant']);   
            $i++;
        }
        
        //création de la feuille activités  
        $sheet2 = $workbook->createSheet();
        $sheet2->setTitle('Occupation');

        $sheet2->setCellValueByColumnAndRow('0','1','Début');
        $sheet2->setCellValueByColumnAndRow('1','1','Fin');
        $sheet2->setCellValueByColumnAndRow('2','1','Durée');
        $sheet2->setCellValueByColumnAndRow('3','1',"Code Activité");
        $sheet2->setCellValueByColumnAndRow('4','1',"Code Lieu");
        $sheet2->setCellValueByColumnAndRow('5','1','Code Compagnie');
        $sheet2->setCellValueByColumnAndRow('6','1','Code Dispositif');
        $sheet2->setCellValueByColumnAndRow('7','1',"Code Candidat");
        
        $i = 2;
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
            $sheet2->setCellValueByColumnAndRow('0',$i,$data['HeureDebut']);
            $sheet2->setCellValueByColumnAndRow('1',$i,$data['HeureFin']);
            $sheet2->setCellValueByColumnAndRow('2',$i,$data['dure']);
            $sheet2->setCellValueByColumnAndRow('3',$i,$data['CodeActivite']);
            $sheet2->setCellValueByColumnAndRow('4',$i,$data['CodeLieux']);
            $sheet2->setCellValueByColumnAndRow('5',$i,$data['CodeCompagnie']);
            $sheet2->setCellValueByColumnAndRow('6',$i,$data['CodeDispositif']);
            $sheet2->setCellValueByColumnAndRow('7',$i,$data['CodeCandidat']);  
            $i++;
        }
        
        
        //$writer = new PHPExcel_Writer_Excel5($workbook);
        $writer = PHPExcel_IOFactory::createWriter($workbook, "Excel5");

        $records = './journal.xls';
        $path = ROOT .DS. "webroot". DS . "files" . DS .'.journal.xls';
        //$writer->save($records);
        $writer->save($path);

        
        $this->response->file($path, array(
            'download' => true,
            'name' => 'journal.xls',
        ));
        return $this->response;
    }

    public function telechargerDonnees(){
        
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

    public function telechargerLegende(){
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
        $path = ROOT .DS. "webroot". DS . "files" . DS .'journal.xls';
        $this->response->file($path, array(
            'download' => true,
            'name' => 'journal.xls',
        ));
        return $this->response;

    }

    public function modif()
    {
        $this->viewBuilder()->layout('cherLayout');
        $chercheur = TableRegistry::get('chercheur')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('The chercheur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The chercheur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $chercheur = $this->paginate($this->Chercheur);

        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * View method
     *
     * @param string|null $id Chercheur id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chercheur = $this->Chercheur->get($id, [
            'contain' => []
        ]);

        $this->set('chercheur', $chercheur);
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chercheur = $this->Chercheur->newEntity();
        if ($this->request->is('post')) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('The chercheur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The chercheur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Chercheur id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chercheur = $this->Chercheur->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chercheur = $this->Chercheur->patchEntity($chercheur, $this->request->data);
            if ($this->Chercheur->save($chercheur)) {
                $this->Flash->success(__('The chercheur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The chercheur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('chercheur'));
        $this->set('_serialize', ['chercheur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Chercheur id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chercheur = $this->Chercheur->get($id);
        if ($this->Chercheur->delete($chercheur)) {
            $this->Flash->success(__('The chercheur has been deleted.'));
        } else {
            $this->Flash->error(__('The chercheur could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
