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
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $occupation = $this->paginate($this->Occupation);

        $this->set(compact('occupation'));
        $this->set('_serialize', ['occupation']);
    }
    /**
     * View method
     *
     * @param string|null $id Occupation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   
        $this->loadModel('Lieu');
        $this->loadModel('Activite');
        $this->loadModel('Compagnie');
        $this->loadModel('Dispositif');

        $occupation = $this->Occupation->get($id, ['contain' => []]);

        $monLieu        = $this->Lieu->get($occupation->CodeLieux);
        $monActivite    = $this->Activite->get($occupation->CodeActivite);
        $monCompagnie   = $this->Compagnie->get($occupation->CodeCompagnie);
        $monDispositif  = $this->Dispositif->get($occupation->CodeDispositif);
        
        $this->set(compact('monLieu'));
        $this->set(compact('monActivite'));
        $this->set(compact('monCompagnie'));
        $this->set(compact('monDispositif'));

        $this->set('occupation', $occupation);
        $this->set('_serialize', ['occupation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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
                    //$this->Flash->success(__('The occupation has been saved.'));
                } else {
                    $this->Flash->error(__('The occupation could not be saved. Please, try again.'));
                }
            }
            else{ 
                $occupation = $this->Occupation->patchEntity($occupation, $this->request->data);
            
                if ($this->Occupation->save($occupation)) {
                    $this->Flash->success(__('The occupation has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The occupation could not be saved. Please, try again.'));
                }
            }
        }
        $this->set(compact('occupation'));
        $this->set('_serialize', ['occupation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Occupation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
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
            // if ($this->Occupation->save($occupation)) {
            //     $this->autoRender = false;
            //     echo $occupation->CodeOccupation;
            //     $this->Flash->success(__('The occupation has been saved.'));
            //     //return $this->redirect(['action' => 'index']);
            // } else {
            //     $this->Flash->error(__('The occupation could not be saved. Please, try again.'));
            //     //return $this->redirect(['action' => 'index']);
            // } 
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
        $this->request->allowMethod(['post', 'delete']);
        $occupation = $this->Occupation->get($id);
        if ($this->Occupation->delete($occupation)) {
            //$this->Flash->success(__('The occupation has been deleted.'));
        } else {
            $this->Flash->error(__('The occupation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
