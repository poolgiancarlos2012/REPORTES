<?php
date_default_timezone_set('America/Lima');
error_reporting(E_ALL);


ini_set('include_path', ini_get('include_path').';E:/Proyectos/REPORTES/phpincludes/phpexcel/Classes/');
require_once 'E:/Proyectos/REPORTES/phpincludes/phpexcel/Classes/PHPExcel.php';/** PHPExcel_Writer_Excel2007 */
require_once 'E:/Proyectos/REPORTES/phpincludes/phpexcel/Classes/PHPExcel/Writer/Excel2007.php';
require_once 'E:/Proyectos/REPORTES/phpincludes/phpexcel/Classes/PHPExcel/IOFactory.php';

require_once 'E:/Proyectos/REPORTES/conexion/config.php';
require_once 'E:/Proyectos/REPORTES/conexion/MSSQLConnectionPDO.php';
require_once 'E:/Proyectos/REPORTES/factory/FactoryConnection.php';
require_once 'E:/Proyectos/REPORTES/includes/class.phpmailer.php';
require_once 'E:/Proyectos/REPORTES/includes/class.smtp.php';

$factoryConnection = FactoryConnection::create('mssql');
$connection = $factoryConnection->getConnection();


// QUITA LOS ACENTOS Y EÑES

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

$columna=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ");

$font = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '000000'),
    'size'  => 8,
    'name'  => 'Verdana'
));
$title = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '000000'),
    'size'  => 13,
    'name'  => 'Verdana'
));
$font_cabe_blue = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '002060'),
    'size'  => 10,
    'name'  => 'Verdana'
));
$font_header = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '002060'),
    'size'  => 8,
    'name'  => 'Verdana'
));
$font_empresa_blue = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '1F4E78'),
    'size'  => 10,
    'name'  => 'Verdana'
));
$font_subtotal = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '000000'),
    'size'  => 10,
    'name'  => 'Verdana'
));
$border_mefium = array(
  'borders' => array(
      'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM
      )
));
$border_thin = array(
  'borders' => array(
      'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
      )
    )
);

$fondo_amarillo = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFF00')
    )
);

$fondo_celeste = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'C1EFFF')
    )
);
$fondo_morado_claro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'D9E1F2')
    )
);
$fondo_claro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'F0F4FF')
    )
);
$fondo_celeste_claro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'DDEBF7')
    )
);

$fondo_rojo_claro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFE1E1')
    )
);

$fondo_verde_claro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'D4FDCF')
    )
);

$mes=$_GET['mes'];
$anio=$_GET['anio'];

$fecha_envio=date('Y-m-d H:i:s');

$xls = new PHPExcel();
$xls->setActiveSheetIndex(0)->setTitle("CONCEPTOS");
$xls->getActiveSheet()->mergeCells("A3:M3");
$xls->getActiveSheet()->getStyle('A3:M3')->applyFromArray($font);
$xls->getActiveSheet()->getStyle('A3:M3')->applyFromArray($border_mefium);
$xls->getActiveSheet()->getStyle('A3:M3')->applyFromArray($fondo_amarillo);
$xls->getActiveSheet()->SetCellValue('A3',"FACTURAS DE OBSEQUIO, BONIFICACIÓN Y MUESTRAS MENSUALES");
$xls->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$fil=5;
$col=0;

$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, "PRODUCTO");
$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, "FECHA");
$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, "TD");
$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, "SERIE");
$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, "DOCUMENTO");
$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil, "VD");
$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, "COD_CLIENTE");
$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, "CLIENTE");
$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, "CANTIDAD");
$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, "VALOR_ME");
$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, "TC");
$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, "VALOR_MN");
$xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, "CONCEPTO");

$xls->getActiveSheet()->getStyle('A5:M5')->applyFromArray($font);
$xls->getActiveSheet()->getStyle('A5:M5')->applyFromArray($border_thin);
$xls->getActiveSheet()->getStyle('A5:M5')->applyFromArray($fondo_celeste_claro);
$xls->getActiveSheet()->getStyle('A5:M5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(40);
$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(11);
$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(5);
$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(7);
$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(7);
$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(40);
$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(7);
$xls->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(15);

$xls->getActiveSheet()->getStyle('B:B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('C:C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('D:D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('E:E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('F:F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('G:G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('M:M')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sql_concepto=" SELECT
                RTRIM(LTRIM(COD)) AS 'COD',
                RTRIM(LTRIM(EMPRESA)) AS 'EMPRESA',
                RTRIM(LTRIM(AGE)) AS 'AGE',
                RTRIM(LTRIM(CTD)) AS 'CTD',
                RTRIM(LTRIM(NUMSER)) AS 'NUMSER',
                RTRIM(LTRIM(NUMDOC)) AS 'NUMDOC',
                RTRIM(LTRIM(REPRE_VENTAS)) AS 'REPRE_VENTAS',
                RTRIM(LTRIM(FECH_EMI)) AS 'FECH_EMI',
                RTRIM(LTRIM(RAZON_SOCIAL)) AS 'RAZON_SOCIAL',
                RTRIM(LTRIM(COD_CLIENTE)) AS 'COD_CLIENTE',
                RTRIM(LTRIM(RUC)) AS 'RUC',
                RTRIM(LTRIM(ITEM)) AS 'ITEM',
                RTRIM(LTRIM(CANT)) AS 'CANT',
                RTRIM(LTRIM(COD_PROD)) AS 'COD_PROD',
                RTRIM(LTRIM(UM)) AS 'UM',
                RTRIM(LTRIM(PROD)) AS 'PROD',
                RTRIM(LTRIM(PRICE)) AS 'PRICE',
                RTRIM(LTRIM(PRECIO)) AS 'PRECIO',
                RTRIM(LTRIM(PRECIO_I)) AS 'PRECIO_I',
                RTRIM(LTRIM(VALOR_ME)) AS 'VALOR_ME',
                RTRIM(LTRIM(TC)) AS 'TC',
                RTRIM(LTRIM(VALOR_MN)) AS 'VALOR_MN'
                FROM
                FN_CONCEPTO($mes,$anio)";

$prconcepto = $connection->prepare($sql_concepto, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$prconcepto->execute();


$arbonif= [];
$armuest= [];
$arobseq= [];

while($concepto=$prconcepto->fetch(PDO::FETCH_ASSOC)) {
    if (strpos(strtolower(normaliza($concepto["PROD"])), 'bonificacion') !== false) {
        array_push($arbonif, "'".$concepto["COD"]."@".$concepto["CTD"]."@".$concepto["NUMSER"]."@".$concepto["NUMDOC"]."'");
        // echo $concepto["COD"]."@".$concepto["CTD"]."@".$concepto["NUMSER"]."@".$concepto["NUMDOC"]."<br>";
    }
    if (strpos(strtolower(normaliza($concepto["PROD"])), 'muestra') !== false) {
        array_push($armuest, "'".$concepto["COD"]."@".$concepto["CTD"]."@".$concepto["NUMSER"]."@".$concepto["NUMDOC"]."'");
        // echo $concepto["COD"]."@".$concepto["CTD"]."@".$concepto["NUMSER"]."@".$concepto["NUMDOC"]."<br>";
    }
    if (strpos(strtolower(normaliza($concepto["PROD"])), 'obsequio') !== false) {
        // echo $concepto["COD"]."@".$concepto["CTD"]."@".$concepto["NUMSER"]."@".$concepto["NUMDOC"]."<br>";
        array_push($arobseq, "'".$concepto["COD"]."@".$concepto["CTD"]."@".$concepto["NUMSER"]."@".$concepto["NUMDOC"]."'");
    }
}

$dpbonif= array_values(array_unique($arbonif));
$dpmuest= array_values(array_unique($armuest));
$dpobseq= array_values(array_unique($arobseq));


// echo count($arobseq);
// exit();

if(count($dpbonif)>0){

    $sqlbonif= "    SELECT
                    RTRIM(LTRIM(COD)) AS 'COD',
                    RTRIM(LTRIM(EMPRESA)) AS 'EMPRESA',
                    RTRIM(LTRIM(AGE)) AS 'AGE',
                    RTRIM(LTRIM(CTD)) AS 'CTD',
                    RTRIM(LTRIM(NUMSER)) AS 'NUMSER',
                    RTRIM(LTRIM(NUMDOC)) AS 'NUMDOC',
                    RTRIM(LTRIM(REPRE_VENTAS)) AS 'REPRE_VENTAS',
                    RTRIM(LTRIM(FECH_EMI)) AS 'FECH_EMI',
                    RTRIM(LTRIM(RAZON_SOCIAL)) AS 'RAZON_SOCIAL',
                    RTRIM(LTRIM(COD_CLIENTE)) AS 'COD_CLIENTE',
                    RTRIM(LTRIM(RUC)) AS 'RUC',
                    RTRIM(LTRIM(ITEM)) AS 'ITEM',
                    RTRIM(LTRIM(CANT)) AS 'CANT',
                    RTRIM(LTRIM(COD_PROD)) AS 'COD_PROD',
                    RTRIM(LTRIM(UM)) AS 'UM',
                    RTRIM(LTRIM(PROD)) AS 'PROD',
                    RTRIM(LTRIM(PRICE)) AS 'PRICE',
                    RTRIM(LTRIM(PRECIO)) AS 'PRECIO',
                    RTRIM(LTRIM(PRECIO_I)) AS 'PRECIO_I',
                    RTRIM(LTRIM(VALOR_ME)) AS 'VALOR_ME',
                    RTRIM(LTRIM(TC)) AS 'TC',
                    RTRIM(LTRIM(VALOR_MN)) AS 'VALOR_MN'
                    FROM
                    FN_CONCEPTO($mes,$anio)
                    WHERE
                    RTRIM(LTRIM(COD_PROD)) NOT IN ('TXT') AND
                    PRICE=0 AND
                    RTRIM(LTRIM(COD))+'@'+RTRIM(LTRIM(CTD))+'@'+RTRIM(LTRIM(NUMSER))+'@'+RTRIM(LTRIM(NUMDOC)) IN (".implode(",", $dpbonif).")
                    ORDER BY EMPRESA,AGE,CTD,NUMSER,NUMDOC,ITEM
                    ";

    // echo $sqlbonif;
    // exit();

    $prbonif = $connection->prepare($sqlbonif, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $prbonif->execute();
    while($bonificacion=$prbonif->fetch(PDO::FETCH_ASSOC)) {
        $fil++;
        $xls->getActiveSheet()->SetCellValue($columna[$col].$fil, $bonificacion["COD_PROD"]." ".$bonificacion["PROD"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $bonificacion["FECH_EMI"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, $bonificacion["CTD"]);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+3].$fil, $bonificacion["NUMSER"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+4].$fil, $bonificacion["NUMDOC"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+5].$fil, $bonificacion["REPRE_VENTAS"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+6].$fil, $bonificacion["COD_CLIENTE"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $bonificacion["RAZON_SOCIAL"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, $bonificacion["CANT"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, $bonificacion["VALOR_ME"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $bonificacion["TC"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $bonificacion["VALOR_MN"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, "BONIFICACION");
    }

    $fil=$fil+4;

}

if(count($dpmuest)>0){

    $sqlmuest= "    SELECT
                    RTRIM(LTRIM(COD)) AS 'COD',
                    RTRIM(LTRIM(EMPRESA)) AS 'EMPRESA',
                    RTRIM(LTRIM(AGE)) AS 'AGE',
                    RTRIM(LTRIM(CTD)) AS 'CTD',
                    RTRIM(LTRIM(NUMSER)) AS 'NUMSER',
                    RTRIM(LTRIM(NUMDOC)) AS 'NUMDOC',
                    RTRIM(LTRIM(REPRE_VENTAS)) AS 'REPRE_VENTAS',
                    RTRIM(LTRIM(FECH_EMI)) AS 'FECH_EMI',
                    RTRIM(LTRIM(RAZON_SOCIAL)) AS 'RAZON_SOCIAL',
                    RTRIM(LTRIM(COD_CLIENTE)) AS 'COD_CLIENTE',
                    RTRIM(LTRIM(RUC)) AS 'RUC',
                    RTRIM(LTRIM(ITEM)) AS 'ITEM',
                    RTRIM(LTRIM(CANT)) AS 'CANT',
                    RTRIM(LTRIM(COD_PROD)) AS 'COD_PROD',
                    RTRIM(LTRIM(UM)) AS 'UM',
                    RTRIM(LTRIM(PROD)) AS 'PROD',
                    RTRIM(LTRIM(PRICE)) AS 'PRICE',
                    RTRIM(LTRIM(PRECIO)) AS 'PRECIO',
                    RTRIM(LTRIM(PRECIO_I)) AS 'PRECIO_I',
                    RTRIM(LTRIM(VALOR_ME)) AS 'VALOR_ME',
                    RTRIM(LTRIM(TC)) AS 'TC',
                    RTRIM(LTRIM(VALOR_MN)) AS 'VALOR_MN'
                    FROM
                    FN_CONCEPTO($mes,$anio)
                    WHERE
                    RTRIM(LTRIM(COD_PROD)) NOT IN ('TXT') AND
                    RTRIM(LTRIM(COD))+'@'+RTRIM(LTRIM(CTD))+'@'+RTRIM(LTRIM(NUMSER))+'@'+RTRIM(LTRIM(NUMDOC))  IN(".implode(",", $dpmuest).")
                    ORDER BY EMPRESA,AGE,CTD,NUMSER,NUMDOC,ITEM";

    // echo $sqlmuest;
    // exit();

    $prmuest = $connection->prepare($sqlmuest, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $prmuest->execute();
    while($muestra=$prmuest->fetch(PDO::FETCH_ASSOC)) {
        $fil++;
        $xls->getActiveSheet()->SetCellValue($columna[$col].$fil, $muestra["COD_PROD"]." ".$muestra["PROD"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $muestra["FECH_EMI"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, $muestra["CTD"]);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+3].$fil, $muestra["NUMSER"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+4].$fil, $muestra["NUMDOC"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+5].$fil, $muestra["REPRE_VENTAS"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+6].$fil, $muestra["COD_CLIENTE"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $muestra["RAZON_SOCIAL"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, $muestra["CANT"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, $muestra["VALOR_ME"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $muestra["TC"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $muestra["VALOR_MN"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, "MUESTRA");
    }

    $fil=$fil+4;

}

if(count($dpobseq)>0){

    $sqlobseq= "    SELECT
                    RTRIM(LTRIM(COD)) AS 'COD',
                    RTRIM(LTRIM(EMPRESA)) AS 'EMPRESA',
                    RTRIM(LTRIM(AGE)) AS 'AGE',
                    RTRIM(LTRIM(CTD)) AS 'CTD',
                    RTRIM(LTRIM(NUMSER)) AS 'NUMSER',
                    RTRIM(LTRIM(NUMDOC)) AS 'NUMDOC',
                    RTRIM(LTRIM(REPRE_VENTAS)) AS 'REPRE_VENTAS',
                    RTRIM(LTRIM(FECH_EMI)) AS 'FECH_EMI',
                    RTRIM(LTRIM(RAZON_SOCIAL)) AS 'RAZON_SOCIAL',
                    RTRIM(LTRIM(COD_CLIENTE)) AS 'COD_CLIENTE',
                    RTRIM(LTRIM(RUC)) AS 'RUC',
                    RTRIM(LTRIM(ITEM)) AS 'ITEM',
                    RTRIM(LTRIM(CANT)) AS 'CANT',
                    RTRIM(LTRIM(COD_PROD)) AS 'COD_PROD',
                    RTRIM(LTRIM(UM)) AS 'UM',
                    RTRIM(LTRIM(PROD)) AS 'PROD',
                    RTRIM(LTRIM(PRICE)) AS 'PRICE',
                    RTRIM(LTRIM(PRECIO)) AS 'PRECIO',
                    RTRIM(LTRIM(PRECIO_I)) AS 'PRECIO_I',
                    RTRIM(LTRIM(VALOR_ME)) AS 'VALOR_ME',
                    RTRIM(LTRIM(TC)) AS 'TC',
                    RTRIM(LTRIM(VALOR_MN)) AS 'VALOR_MN'
                    FROM
                    FN_CONCEPTO($mes,$anio)
                    WHERE
                    RTRIM(LTRIM(COD_PROD)) NOT IN ('TXT') AND
                    RTRIM(LTRIM(COD))+'@'+RTRIM(LTRIM(CTD))+'@'+RTRIM(LTRIM(NUMSER))+'@'+RTRIM(LTRIM(NUMDOC))  IN (".implode(",", $dpobseq).")
                    ORDER BY EMPRESA,AGE,CTD,NUMSER,NUMDOC,ITEM";

    // echo $sqlobseq;
    // exit();

    $probseq = $connection->prepare($sqlobseq, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $probseq->execute();
    while($obsequio=$probseq->fetch(PDO::FETCH_ASSOC)) {
        $fil++;
        $xls->getActiveSheet()->SetCellValue($columna[$col].$fil, $obsequio["COD_PROD"]." ".$obsequio["PROD"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $obsequio["FECH_EMI"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, $obsequio["CTD"]);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+3].$fil, $obsequio["NUMSER"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+4].$fil, $obsequio["NUMDOC"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+5].$fil, $obsequio["REPRE_VENTAS"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->setCellValueExplicit($columna[$col+6].$fil, $obsequio["COD_CLIENTE"],PHPExcel_Cell_DataType::TYPE_STRING);
        $xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $obsequio["RAZON_SOCIAL"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, $obsequio["CANT"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, $obsequio["VALOR_ME"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $obsequio["TC"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $obsequio["VALOR_MN"]);
        $xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, "OBSEQUIO");
    }

}


$date = new DateTime($fecha_envio);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Concepto --- '.$date->format('Y-m-d H.i.s').'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
exit();

?>
