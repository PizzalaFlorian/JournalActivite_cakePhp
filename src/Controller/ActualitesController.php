<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Actualites Controller
 *
 * @property \App\Model\Table\ActualitesTable $Actualites
 */
class ActualitesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        //fonction lié au actualité dans actualité.php
        require_once(ROOT .DS. "vendor" . DS  . "functionperso" . DS . "actualite" . DS ."actualite.php");
        $actualites = $this->paginate($this->Actualites);

        $this->set(compact('actualites'));
        $this->set('_serialize', ['actualites']);
    }

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
            case 'chercheur':       $monController = "chercheur";        $monAction="accueil";                 break;
            case 'candidat':        $monController = "candidat";         $monAction="accueil";                 break;
            case 'admin':           $monController = "";                 $monAction="";                 break;
        }
        $actualite = $this->Actualites->get($id, [
            'contain' => []
        ]);
        $this->set(compact('monController'));
        $this->set(compact('monAction'));
        $this->set('actualite', $actualite);
        $this->set('_serialize', ['actualite']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // ============== //
        // A suppr : on utilise nouveau pour creer des actualité
        // ============== //
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
                case 'chercheur':       $monController = "chercheur";        $monAction="accueil";                 break;
                case 'candidat':        $monController = "candidat";         $monAction="accueil";                 break;
                case 'admin':           $monController = "";                 $monAction="";                        break;
            }
            $actualite = $this->Actualites->get($id, ['contain' => [] ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $actualite = $this->Actualites->patchEntity($actualite, $this->request->data);
                if ($this->Actualites->save($actualite)) {
                    $this->Flash->success(__('La modification a été sauvegardé.'));
                    return $this->redirect(['controller' => $monController, 'action' => $monAction]);
                } else {
                    $this->Flash->error(__('Une erreur est survenue. Veuillez réessayer.'));
                }
            }
            $this->set(compact('monController'));
            $this->set(compact('monAction'));
            $this->set(compact('actualite'));
            $this->set('_serialize', ['actualite']);
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'Authentification est survenue.'));
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
            case 'chercheur':       $monController = "chercheur";        $monAction="accueil";                 break;
            case 'candidat':        $monController = "candidat";         $monAction="accueil";                 break;
            case 'admin':           $monController = "";                 $monAction="";                        break;
        }
        // on verifie que l'utilisateur est de type chercheur ou admin
        if(($_SESSION['Auth']['User']['typeUser'] == 'chercheur') || ($_SESSION['Auth']['User']['typeUser'] =='admin')){
            $this->request->allowMethod(['post', 'delete']);
            $actualite = $this->Actualites->get($id);
            if ($this->Actualites->delete($actualite)) {
                $this->Flash->success(__('La suppression à réussi.'));
            } else {
                $this->Flash->error(__('L\'actualité n\'a pas pu être supprimer. Veuillez réessayer.'));
            }
            return $this->redirect(['controller' => $monController, 'action' => $monAction]);
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'Authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }

    }
    public function nouveau(){
        if(($_SESSION['Auth']['User']['typeUser'] == 'chercheur') || ($_SESSION['Auth']['User']['typeUser'] =='admin')){
            switch ($_SESSION['Auth']['User']['typeUser']) {
                case 'chercheur':       $monController = "chercheur";        $monAction="accueil";                 break;
                case 'candidat':        $monController = "candidat";         $monAction="accueil";                 break;
                case 'admin':           $monController = "";                 $monAction="";                        break;
            }
            $actualite = $this->Actualites->newEntity();
            if ($this->request->is('post')) {
                $actualite = $this->Actualites->patchEntity($actualite, $this->request->data);
                if ($this->Actualites->save($actualite)) {
                    $this->Flash->success(__('The actualite has been saved.'));
                    return $this->redirect(['controller' => $monController, 'action' => $monAction]);
                } else {
                    $this->Flash->error(__('The actualite could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('monController'));
            $this->set(compact('monAction'));
            $this->set(compact('actualite'));
            $this->set('_serialize', ['actualite']);
        } else {
            // Si la page demandé n'est pas disponible pour l'utilisateur, on demande une nouvel authentification
            $this->Flash->error(__('Une erreur d\'Authentification est survenue.'));
            $this->Flash->error(__('Veuillez vous reconnecter.'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout']);
        }
    }
}
