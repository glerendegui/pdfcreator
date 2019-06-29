<?php 
require __DIR__.'/../vendor/autoload.php';

use PdfCreator\PdfCreator;

$pdf = PdfCreator::createPdfDocumentFromTemplate("files/factura.csv");
$pdf->changeElementText('Numero','0001-0000001');
$pdf->render();
$pdf->saveToFile('example.pdf');

