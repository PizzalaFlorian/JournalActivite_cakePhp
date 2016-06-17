<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Actualites Controller
 *
 * @property \App\Model\Table\ActualitesTable $Actualites
 */
class ActualitesController extends AppController
{

    /**
     * View method
     *
     * @param string|null $id Actualite id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // les chemin d'acces sont different en fonction du type d'user, on les definit ici
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'candidat':    $monController = "candidat";
                                $monAction="accueil";
                                $this->viewBuilder()->layout('candiLayout'); 
                                $sideBar = "sidebarCandidat";      
                break;
            case 'chercheur':   $monController = "chercheur";
                                $monAction="accueil";
                                $this->viewBuilder()->layout('cherLayout');
                                $sideBar = "sidebarChercheur";

                break;
           case 'admin':        $monController = "administrateur";                  
                                $monAction="accueil";
                                $this->viewBuilder()->layout('adminLayout');
                                $sideBar = "sidebarAdmin";       
                break;
        }
        $actualite = $this->Actualites->get($id, [
            'contain' => []
        ]);
        $this->set(compact('sideBar'));
        $this->set(compact('monController'));
        $this->set(compact('monAction'));
        $this->set('actualite', $actualite);
        $this->set('_serialize', ['actualite']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Actualite id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // on verifie que l'utilisateur est de type chercheur ou admin
        if(($_SESSION['Auth']['User']['typeUser'] == 'chercheur') || ($_SESSION['Auth']['User']['typeUser'] =='admin')){

            switch ($_SESSION['Auth']['User']['typeUser']) {
                case 'chercheur':       $monController = "chercheur";                       
                                        $monAction="accueil";
                                        $this->viewBuilder()->layout('cherLayout');      
                                        $sideBar = "sidebarChercheur";   
                    break;
                case 'candidat':        $monController = "";                                
                                        $monAction="";
                                        $this->viewBuilder()->layout('candiLayout');
                                        $sideBar = "sidebarCandidat";             
                    break;
                case 'admin':           $monController = "administrateur";                  
                                        $monAction="accueil";
                                        $this->viewBuilder()->layout('adminLayout');
                                        $sideBar = "sidebarAdmin";       
                    break;
            }
            
            $actualite = $this->Actualites->get($id, ['contain' => [] ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                //modification de la date
                $this->request->data['Date'] = Time::now(); 
                $actualite = $this->Actualites->patchEntity($actualite, $this->request->data);
                if ($this->Actualites->save($actualite)) {
                    $this->Flash->success(__('La modification a été sauvegardée.'));
                    return $this->redirect(['controller' => $monController, 'action' => $monAction]);
                } else {
                    $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer.'));
                }
            }
            $this->set(compact('monController'));
            $this->set(compact('monAction'));
            $this->set(compact('actualite'));
            $this->set(compact('sideBar'));
            $this->set('_serialize', ['actualite']);
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Actualite id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        switch ($_SESSION['Auth']['User']['typeUser']) {
            case 'chercheur':       $monController = "chercheur";                       
                                    $monAction="accueil";       
                                    $sideBar = "sidebarChercheur";   
                break;
            case 'candidat':        $monController = "";                                
                                    $monAction="";
                                    $sideBar = "sidebarCandidat";             
                break;
            case 'admin':           $monController = "administrateur";                  
                                    $monAction="accueil"; 
                                    $sideBar = "sidebarAdmin";       
                break;
        }
        // on verifie que l'utilisateur est de type chercheur ou admin
        if(($_SESSION['Auth']['User']['typeUser'] == 'chercheur') || ($_SESSION['Auth']['User']['typeUser'] =='admin')){
            $this->request->allowMethod(['post', 'delete']);
            $actualite = $this->Actualites->get($id);
            if ($this->Actualites->delete($actualite)) {
                $this->Flash->success(__('La suppression à réussi.'));
            } else {
                $this->Flash->error(__('L\'actualité n\'a pas pu être supprimée. Veuillez réessayer.'));
            }
            return $this->redirect(['controller' => $monController, 'action' => $monAction]);
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }

    }

    /**
     * [nouveau Creer une nouvelle actualitée. Fonction Chercheur & Administrateur]
     * @return [type] [description]
     */
    public function nouveau(){
        if(($_SESSION['Auth']['User']['typeUser'] == 'chercheur') || ($_SESSION['Auth']['User']['typeUser'] =='admin')){
            switch ($_SESSION['Auth']['User']['typeUser']) {
                case 'chercheur':       $monController = "chercheur";                       
                                        $monAction="accueil";
                                        $this->viewBuilder()->layout('cherLayout');      
                                        $sideBar = "sidebarChercheur";   
                    break;
                case 'candidat':        $monController = "";                                
                                        $monAction="";
                                        $this->viewBuilder()->layout('candiLayout');
                                        $sideBar = "sidebarCandidat";             
                    break;
                case 'admin':           $monController = "administrateur";                  
                                        $monAction="accueil";
                                        $this->viewBuilder()->layout('adminLayout');
                                        $sideBar = "sidebarAdmin";       
                    break;
            }
            $actualite = $this->Actualites->newEntity();
            if ($this->request->is('post')) {
                // ajoute de l'heure du post
                $this->request->data['Date'] = Time::now();
                $actualite = $this->Actualites->patchEntity($actualite, $this->request->data);

                if ($this->Actualites->save($actualite)) {
                    $this->Flash->success(__('L\'actualité a été sauvegardée.'));
                    return $this->redirect(['controller' => $monController, 'action' => $monAction]);
                } else {
                    $this->Flash->error(__('Erreur lors de la sauvegarde, Veuillez-réessayer.'));
                }
            }
            $this->set(compact('monController'));
            $this->set(compact('monAction'));
            $this->set(compact('actualite'));
            $this->set(compact('sideBar'));
            $this->set('_serialize', ['actualite']);
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }
    }
}
