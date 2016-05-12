<?php
	namespace App\Controller;
	
	App::import('Vendor', 'PHPExcel', array('file' => 'Excel/PHPExcel.php'));
 
	$phpExcel = new PHPExcel();
	$phpExcel->getActiveSheet()->setTitle("My Sheet");
	 
	$phpExcel->setActiveSheetIndex(0);
	$phpExcel->getActiveSheet()->setCellValue('A1', 'Hello World!');
	 
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"filename.xls\"");
	 
	$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
	$objWriter->save("php://output");
	exit;
?>