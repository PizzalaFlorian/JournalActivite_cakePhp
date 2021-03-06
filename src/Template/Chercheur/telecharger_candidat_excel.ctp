<?php
	use Cake\ORM\TableRegistry;

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
            $sheet2->setCellValueByColumnAndRow('0',$i,$data['HeureDebut']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
            $sheet2->setCellValueByColumnAndRow('1',$i,$data['HeureFin']->i18nFormat('yyyy-MM-dd HH:mm:ss'));
            $sheet2->setCellValueByColumnAndRow('2',$i,$data['dure']);
            $sheet2->setCellValueByColumnAndRow('3',$i,$data['CodeActivite']);
            $sheet2->setCellValueByColumnAndRow('4',$i,$data['CodeLieux']);
            $sheet2->setCellValueByColumnAndRow('5',$i,$data['CodeCompagnie']);
            $sheet2->setCellValueByColumnAndRow('6',$i,$data['CodeDispositif']);
            $sheet2->setCellValueByColumnAndRow('7',$i,$data['CodeCandidat']);  
            $i++;
        }
        
        
        $writer = new PHPExcel_Writer_Excel5($workbook);
    
        $path = ROOT .DS. "webroot". DS . "files" . DS .'journal.xls';
        $writer->save($path);
       
        $this->response->header('Location', 'downloadExcel');
?>