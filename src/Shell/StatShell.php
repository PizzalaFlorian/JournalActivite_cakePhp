<?php
namespace App\Shell;

use Cake\ORM\TableRegistry;
use Cake\Console\Shell;

class StatShell extends Shell
{
    public function main()
    {
        
        set_time_limit(0);
        
        
        function aucune_activite(){
        $data = TableRegistry::get('occupation')
            ->find()
            ->select(array('dure' => 'COUNT(*)'))
            ->group(['CodeCandidat'])
            ->first();
        return isset($data);    
        }

        
        
        //fonction pour calculer la moyenne
        function calcul_moyenne($dure, $dure_total)
        {
            $dure*=24*60*60/$dure_total;
            $heure = (int)($dure/(60*60));
            if($heure < 10)
                $heure = "0".$heure;
            $min = (int)(($dure%(60*60))/60);
            if($min < 10)
                $min= "0".$min;
            $sec = $dure%60;
            if($sec < 10)
                $sec= "0".$sec;
            return "\n$heure:$min:$sec";    
        }
        
        while(1)
        {
            $contenu = "On n'a pas suffisament d'étudiants ayant renseigné des activités, revenez demain.";
            if (aucune_activite()){
                //contenu du fichier
                $contenu = "Les activités:";
                
                //la durée totale
                $data = TableRegistry::get('occupation')
                    ->find()
                    ->select(array('dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(HeureFin,HeureDebut)))'))
                    ->first();
                $dureTotal = $data['dure'];
                
                //la moyenne des activités
                $table = TableRegistry::get('occupation')
                    ->find()
                    ->select(array(
                        'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
                        'NomActivite'=>'a.NomActivite'
                        )
                    )
                     ->join([
                        'a' => [
                            'table' => 'activite',
                            'type' => 'INNER',
                            'conditions' => 'a.CodeActivite = occupation.CodeActivite',
                        ]
                    ])
                    ->group('occupation.CodeActivite')
                    ->order(['dure'=>'DESC'])
                    ->toArray();
                foreach ($table as $data) {
                    $contenu.= "<br/>".calcul_moyenne($data['dure'],$dureTotal)." ". $data['NomActivite'];
                }
                
                $contenu.= "\n<br/><br/> Les compagnies: ";
                
                //la moyenne des compagnies
                $table = TableRegistry::get('occupation')
                    ->find()
                    ->select(array(
                        'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
                        'NomCompagnie'=>'c.NomCompagnie'
                        )
                    )
                     ->join([
                        'c' => [
                            'table' => 'compagnie',
                            'type' => 'INNER',
                            'conditions' => 'c.CodeCompagnie = occupation.CodeCompagnie',
                        ]
                    ])
                    ->group('occupation.CodeCompagnie')
                    ->order(['dure'=>'DESC'])
                    ->toArray();
                foreach ($table as $data) {
                    $contenu.= "<br/>".calcul_moyenne($data['dure'],$dureTotal)." ". $data['NomCompagnie'];
                }
                
                $contenu.= "\n<br/><br/> Les lieux: ";
                
                //moyenne des leiux
                $table = TableRegistry::get('occupation')
                    ->find()
                    ->select(array(
                        'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
                        'NomLieux'=>'c.NomLieux',
                        )
                    )
                     ->join([
                        'c' => [
                            'table' => 'lieu',
                            'type' => 'INNER',
                            'conditions' => 'c.CodeLieux = occupation.CodeLieux',
                        ]
                    ])
                    ->group('occupation.CodeLieux')
                    ->order(['dure'=>'DESC'])
                    ->toArray();
                foreach ($table as $data) {
                    $contenu.= "<br/>".calcul_moyenne($data['dure'],$dureTotal)." ". $data['NomLieux'];
                }
                
                $contenu.= "\n<br/><br/> Les dispositifs utilisés: ";
                //la moyenne des dispositifs
                $table = TableRegistry::get('occupation')
                    ->find()
                    ->select(array(
                        'dure' => 'SUM(TIME_TO_SEC(TIMEDIFF(occupation.HeureFin,occupation.HeureDebut)))',
                        'NomDispositif'=>'c.NomDispositif'
                        )
                    )
                     ->join([
                        'c' => [
                            'table' => 'dispositif',
                            'type' => 'INNER',
                            'conditions' => 'c.CodeDispositif = occupation.CodeDispositif',
                        ]
                    ])
                    ->group('occupation.CodeDispositif')
                    ->order(['dure'=>'DESC'])
                    ->toArray();
                    
                    
                foreach ($table as $data) {
                    $contenu.= "<br/>".calcul_moyenne($data['dure'],$dureTotal)." ". $data['NomDispositif'];
                }
            }
            
            $this->interactive = false;
            Shell::createFile("../src/Template/Element/stat.ctp", $contenu);
            $this->out("Fin de la création des statistiques moyennes le ". date("Y-m-d H:i:s"));
            
            sleep(60*60*24);
        }
    }
}
?>
