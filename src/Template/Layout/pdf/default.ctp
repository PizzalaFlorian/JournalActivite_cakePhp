<?php
// inclusion de la librairie TCPDF
    require_once (ROOT . DS . 'vendor/laurentbrieu/tcpdf/src/TCPDF/TCPDF.php');

// Création d'un document TCPDF avec les variables par défaut
    $pdf = new TCPDF('P', 'mm', PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);
// Spécification de certains paramètres de TCPDF (içi on spécifie l'auteur par défaut)
    $pdf->SetCreator(PDF_CREATOR);
 
// On enlève l'entête et le pied de page
    $pdf->setPrintHeader(FALSE);
    $pdf->setPrintFooter(FALSE);
 
// On spécifie la fonte par défaut
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// On définit les marges
    $pdf->SetMargins(15, 15, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(5);
 
// On indique que le dépassement d'une page entraine automatiquement la création d'un saut de page et d'une nouvelle page
    $pdf->SetAutoPageBreak(TRUE, 5);
 
// ---------------------------------------------------------
 
// La fonte et la couleur à utiliser dans la page qui va être créée
    $pdf->SetFont('times', '', 10);
    $pdf->setColor('text', 0, 0, 0);
// On ajoute une page
    $pdf->AddPage();
    $pdf->Image(ROOT.'/webroot/img/logo-uga.png',
    $x = 10,
    $y = 10,
    $w = 30,
    $h = 15,
    $type = '',
    $link = '',
    $align = '',
    $resize = false,
    $dpi = 300,
    $palign = '',
    $ismask = false,
    $imgmask = false,
    $border = 0,
    $fitbox = false,
    $hidden = false,
    $fitonpage = false,
    $alt = false,
    $altimgs = array() 
    );

    $pdf->Image(ROOT.'/webroot/img/logo-LSE.jpg',
    $x = 180,
    $y = 10,
    $w = 20,
    $h = 20,
    $type = '',
    $link = '',
    $align = '',
    $resize = false,
    $dpi = 300,
    $palign = '',
    $ismask = false,
    $imgmask = false,
    $border = 0,
    $fitbox = false,
    $hidden = false,
    $fitonpage = false,
    $alt = false,
    $altimgs = array() 
    );

   
// voilà l'astuce, on récupère la vue HTML créée par CakePHP pour alimenter notre fichier PDF
    $pdf->writeHTML($this->fetch('content'), TRUE, FALSE, TRUE, FALSE, '');

       // set a barcode on the page footer
    // ---------------------------------------------------------

// set a barcode on the page footer
$pdf->setBarcode(date('Y-m-d H:i:s'));

// set font
$pdf->SetFont('helvetica', '', 11);

// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
    'position' => 'center',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 16
);

// PRINT VARIOUS 1D BARCODES

//$pdf->Cell(0, 0, 'CODE 128 AUTO', 0, 1);
$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
$pdf->write1DBarcode($_SESSION['code'], 'C39', '', '', '', 20, 0.4, $style, 'N');

$pdf->Ln();


// on ferme la page
    $pdf->lastPage();
// On indique à TCPDF que le fichier doit être enregistré sur le serveur ($filename étant une variable que vous aurez pris soin de définir dans l'action de votre controller)

    $pdf->Output($filename . '.pdf', 'D');
    
    
?>