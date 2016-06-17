<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Occupation Controller
 *
 * @property \App\Model\Table\OccupationTable $Occupation
 */
class OccupationController extends AppController
{

    /**
     * Add method
     * @Accès Candidat
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        $occupation = $this->Occupation->newEntity();
        if ($this->request->is('post')) {
            if(is_string($this->request->data['HeureDebut'])){
                $sep_date_time = explode(' ', $this->request->data['HeureDebut']);

                $date   = explode('-',$sep_date_time[0]);
                $year   = $date[0];
                $month  = $date[1];
                $day    = $date[2];

                $time   = explode(':',$sep_date_time[1]);
                $hour   = $time[0];
                $minute = $time[1];

                $HeureDebut = [
                    'year'  => $year,
                    'month' => $month,
                    'day'   => $day,
                    'hour'  => $hour,
                    'minute'=> $minute
                ];

                $sep_date_timefin = explode(' ', $this->request->data['HeureFin']);

                $datefin   = explode('-',$sep_date_timefin[0]);
                $yearfin   = $datefin[0];
                $monthfin  = $datefin[1];
                $dayfin    = $datefin[2];

                $timefin   = explode(':',$sep_date_timefin[1]);
                $hourfin   = $timefin[0];
                $minutefin = $timefin[1];

                $HeureFin = [
                    'year'  => $yearfin,
                    'month' => $monthfin,
                    'day'   => $dayfin,
                    'hour'  => $hourfin,
                    'minute'=> $minutefin
                ];

                $res = TableRegistry::get('candidat')
                    ->find()
                    ->where(['ID'=>$_SESSION['Auth']['User']['ID']])
                    ->first();

                $newData = [
                'HeureDebut' => $HeureDebut,
                'HeureFin' => $HeureFin,
                'CodeCandidat' => $res['CodeCandidat'],
                'CodeLieux' => $this->request->data['CodeLieux'],
                'CodeActivite' => $this->request->data['CodeActivite'],
                'CodeCompagnie' => $this->request->data['CodeCompagnie'],
                'CodeDispositif' => $this->request->data['CodeDispositif']
                ];
                                
                $occupation = $this->Occupation->patchEntity($occupation, $newData);

                if ($this->Occupation->save($occupation)) {
                    echo $occupation->CodeOccupation;
                } else {
                    $this->Flash->error(__('Erreur lors de l\'ajout de l\'occupation. Veuillez réessayer.'));
                }
            }
            else{ 
                $occupation = $this->Occupation->patchEntity($occupation, $this->request->data);
            
                if ($this->Occupation->save($occupation)) {
                    $this->Flash->success(__('L\'occupation a été ajoutée.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Erreur lors de l\'ajout de l\'occupation. Veuillez réessayer.'));
                }
            }
        }
        $this->set(compact('occupation'));
        $this->set('_serialize', ['occupation']);
    }

    /**
     * [copier Creer une copie d'une occupation dont les paramatres sont passé dans $POST]
     * @accès Candidat
     * @return [Aucun]
     */
    public function copier()
    {

        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        $occupation = $this->Occupation->newEntity();
        if ($this->request->is('post')) {
            //debug($this->request->data);
            $old = TableRegistry::get('occupation')
                    ->find()
                    ->where(['CodeOccupation'=>$this->request->data['CodeOccupation']])
                    ->first();

            if(is_string($this->request->data['HeureDebut'])){
                $sep_date_time = explode(' ', $this->request->data['HeureDebut']);

                $date   = explode('-',$sep_date_time[0]);
                $year   = $date[0];
                $month  = $date[1];
                $day    = $date[2];

                $time   = explode(':',$sep_date_time[1]);
                $hour   = $time[0];
                $minute = $time[1];

                $HeureDebut = [
                    'year'  => $year,
                    'month' => $month,
                    'day'   => $day,
                    'hour'  => $hour,
                    'minute'=> $minute
                ];

                $sep_date_timefin = explode(' ', $this->request->data['HeureFin']);

                $datefin   = explode('-',$sep_date_timefin[0]);
                $yearfin   = $datefin[0];
                $monthfin  = $datefin[1];
                $dayfin    = $datefin[2];

                $timefin   = explode(':',$sep_date_timefin[1]);
                $hourfin   = $timefin[0];
                $minutefin = $timefin[1];

                $HeureFin = [
                    'year'  => $yearfin,
                    'month' => $monthfin,
                    'day'   => $dayfin,
                    'hour'  => $hourfin,
                    'minute'=> $minutefin
                ];

                $res = TableRegistry::get('candidat')
                    ->find()
                    ->where(['ID'=>$_SESSION['Auth']['User']['ID']])
                    ->first();

                $newData = [
                'HeureDebut' => $HeureDebut,
                'HeureFin' => $HeureFin,
                'CodeCandidat' => $res['CodeCandidat'],
                'CodeLieux' => $old['CodeLieux'],
                'CodeActivite' => $old['CodeActivite'],
                'CodeCompagnie' => $old['CodeCompagnie'],
                'CodeDispositif' => $old['CodeDispositif']
                ];
                                
                $occupation = $this->Occupation->patchEntity($occupation, $newData);

                if ($this->Occupation->save($occupation)) {
                    echo $occupation->CodeOccupation;
                } else {
                    $this->Flash->error(__('Erreur lors de la copie. Veuillez réessayer.'));
                }
            }
            else{ 
                $occupation = $this->Occupation->patchEntity($occupation, $this->request->data);
            
                if ($this->Occupation->save($occupation)) {
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Erreur lors de la copie. Veuillez réessayer.'));
                }
            }
        }
        $this->set(compact('occupation'));
        $this->set('_serialize', ['occupation']);
    }

    /**
     * [editHeure Modifie l'heure d'une occupation dont le code est passé en $POST]
     * accès Candidat
     * @return [Aucun]
     */
    public function editHeure($id = null)
    {

        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        //accès candidat
        $this->autoRender = false;
         if ($this->request->is(['patch', 'post', 'put'])) {
            $occupation_update = TableRegistry::get('occupation')
                ->query();
            $occupation_update    
                ->update()
                ->set([
                    'HeureDebut' => $this->request->data['HeureDebut'],
                    'HeureFin' => $this->request->data['HeureFin'],
                    ])
                ->where(['CodeOccupation' => $this->request->data['CodeOccupation']])
                ->execute();
         }
    }


    /**
     * [editHeureFin Modifie l'heure de fin d'une occupation dont les infos sont passé en $POST]
     * @accès Candidat
     * @return [Aucun]
     */
    public function editHeureFin($id = null)
    {

        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        //accès candidat
        $this->autoRender = false;
         if ($this->request->is(['patch', 'post', 'put'])) {
            $occupation_update = TableRegistry::get('occupation')
                ->query();
            $occupation_update    
                ->update()
                ->set([
                    'HeureFin' => $this->request->data['HeureFin']
                    ])
                ->where(['CodeOccupation' => $this->request->data['CodeOccupation']])
                ->execute();
         }
    }
    /**
     * Edit method
     * @accès Candidat
     * @param string|null $id Occupation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);

        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "occupation" . DS ."occupation.php");
        
        $this->loadModel('Lieu');
        $this->loadModel('Categorielieu');
        $this->loadModel('Activite');
        $this->loadModel('Categorieactivite');
        $this->loadModel('Compagnie');
        $this->loadModel('Dispositif');

        $occupation = $this->Occupation->get($id, [
            'contain' => []
        ]);


        // ENREGISTREMENT //
        if ($this->request->is(['patch', 'post', 'put'])) {
                
            //debug($this->request->data);

            $occupation_update = TableRegistry::get('occupation')
                ->query();
            $occupation_update    
                ->update()
                ->set([
                    'HeureDebut' => $this->request->data['HeureDebut'],
                    'HeureFin' => $this->request->data['HeureFin'],
                    'CodeLieux' => $this->request->data['CodeLieux'],
                    'CodeActivite' => $this->request->data['CodeActivite'],
                    'CodeCompagnie' => $this->request->data['CodeCompagnie'],
                    'CodeDispositif' => $this->request->data['CodeDispositif']
                    ])
                ->where(['CodeOccupation' => $this->request->data['CodeOccupation']])
                ->execute();

            $this->autoRender = false;
            echo $occupation->CodeOccupation;
        }
        if ($this->request->is(['get'])){
            // TRAITEMENT POUR TEMPLATE //
            $maCategorielieu        = $this->Categorielieu->find('all');
            $maCategorieactivite    = $this->Categorieactivite->find('all');

            //contient la categorieactivité/lieu de l'activité /lieux inscrite dans l'occupation($id)
            $CatActiviteOccupation  = $this->Categorieactivite->get($this->Activite->get($occupation->CodeActivite)->CodeCategorie);
            $CatLieuxOccupation     = $this->Categorielieu->get($this->Lieu->get($occupation->CodeLieux)->CodeCategorieLieux);

            $monLieu        = $this->Lieu->find('all', ['conditions' => ['CodeCategorieLieux' => $CatLieuxOccupation->CodeCategorieLieux] ]);
            $monActivite    = $this->Activite->find('all', ['conditions' => ['CodeCategorie' => $CatActiviteOccupation->CodeCategorieActivite] ]);
            $monCompagnie   = $this->Compagnie->find('all');
            $monDispositif  = $this->Dispositif->find('all');

            $this->set(compact('maCategorielieu'));
            $this->set(compact('maCategorieactivite'));
            $this->set(compact('CatActiviteOccupation'));
            $this->set(compact('CatLieuxOccupation'));
            $this->set(compact('monLieu'));
            $this->set(compact('monActivite'));
            $this->set(compact('monCompagnie'));
            $this->set(compact('monDispositif'));

            // $this->set(compact('occupation'));
            // $this->set('_serialize', ['occupation']);
        }
            $this->set('occupation',$occupation);
            $this->set(compact('occupation'));
            $this->set('_serialize', ['occupation']);
    }
    
    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id Occupation id.
    //  * @return \Cake\Network\Response|null Redirects to index.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    public function delete($id = null)
    {
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
        
        $this->request->allowMethod(['post', 'delete']);
        $occupation = $this->Occupation->get($id);
        if ($this->Occupation->delete($occupation)) {
        } else {
            $this->Flash->error(__('Erreur lors de la suppression. Veuillez réessayer.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function precedente(){
        if($_SESSION['Auth']['User']['typeUser'] == 'admin')
            $this->redirect(['controller'=>'administrateur','action' => 'accueil']);
        if($_SESSION['Auth']['User']['typeUser'] == 'chercheur')
            $this->redirect(['controller'=>'chercheur','action' => 'accueil']);
        
        $candidat = TableRegistry::get('candidat')
            ->find()
            ->where(['ID' => $_SESSION['Auth']['User']['ID']])
            ->first();
       //debug($candidat);
        $this->autoRender = false;
         if ($this->request->is(['post'])) {
            //debug($this->request->data);
            //debug($id);
            $last_occupation = TableRegistry::get('occupation')
            ->find()
            ->select(array(
             'last'=>'max(HeureFin)'
             ))
            ->where(['CodeCandidat' => $candidat['CodeCandidat'],'HeureFin LIKE' => $this->request->data['jour_deb'].'%'])
            ->order(['HeureFin' => 'DESC'])
            ->toArray();
            // var_dump($last_occupation);
            if(isset($last_occupation[0]['last'])){
                echo $last_occupation[0]['last'];
            }
            else {
                echo 'none';
            }
         }
    }
}
