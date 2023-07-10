<?php
require 'PHPExcel-1.8/Classes/PHPExcel.php';
$objPHPExcel = PHPExcel_IOFactory::load("OneDrive-Institución Universitaria Antonio Jose Camacho-BASE DE DATOS REDES EXTERNAS 2023.xls");
$hoja = $objPHPExcel->getActiveSheet();
$valor = $hoja->getCellByColumnAndRow(0, 1)->getValue();
echo $valor;
?>