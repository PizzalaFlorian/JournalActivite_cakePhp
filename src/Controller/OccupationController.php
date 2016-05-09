<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $occupation = $this->Occupation->get($id, [
            'contain' => []
        ]);

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
            debug($this->request->data);
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

                $datefin   = explode('-',$sep_date_time[0]);
                $yearfin   = $date[0];
                $monthfin  = $date[1];
                $dayfin    = $date[2];

                $timefin   = explode(':',$sep_date_time[1]);
                $hourfin   = $time[0];
                $minutefin = $time[1];

                $HeureFin = [
                    'year'  => $year,
                    'month' => $month,
                    'day'   => $day,
                    'hour'  => $hour,
                    'minute'=> $minute
                ];

                $newData = [
                'HeureDebut' => $HeureDebut,
                'HeureFin' => $HeureFin,
                'CodeCandidat' => $this->request->data['CodeCandidat'],
                'CodeLieux' => $this->request->data['CodeLieux'],
                'CodeActivite' => $this->request->data['CodeActivite'],
                'CodeCompagnie' => $this->request->data['CodeCompagnie'],
                'CodeDispositif' => $this->request->data['CodeDispositif']
                ];

                $occupation = $this->Occupation->patchEntity($occupation, $newData);
            }
            else{ 
                $occupation = $this->Occupation->patchEntity($occupation, $this->request->data);
            }
            if ($this->Occupation->save($occupation)) {
                $this->Flash->success(__('The occupation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The occupation could not be saved. Please, try again.'));
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
        $occupation = $this->Occupation->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $occupation = $this->Occupation->patchEntity($occupation, $this->request->data);
            if ($this->Occupation->save($occupation)) {
                $this->Flash->success(__('The occupation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The occupation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('occupation'));
        $this->set('_serialize', ['occupation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Occupation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $occupation = $this->Occupation->get($id);
        if ($this->Occupation->delete($occupation)) {
            $this->Flash->success(__('The occupation has been deleted.'));
        } else {
            $this->Flash->error(__('The occupation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
