<?php

use Cake\ORM\TableRegistry;

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

?>