<?php
date_default_timezone_set('America/Lima');
error_reporting(E_ALL);

ini_set('memory_limit', '-1');
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

$fchi=$_GET['ini'];
$fchf=$_GET['fin'];

$fecha_envio=date('Y-m-d H:i:s');

$xls = new PHPExcel();
$xls->setActiveSheetIndex(0)->setTitle("TIPO DE CAMBIO");

$sqlliqui=" SELECT
            TOP 100 PERCENT
            CONVERT(VARCHAR(10),XFECCAM2,112) AS 'NUMM',
            CONVERT(VARCHAR(10),XFECCAM2,103) AS 'FECHA',
            XMEIMP AS 'TPC',
            XMEIMP2 AS 'TPV'
            FROM RSCONCAR..CTCAMB 
            WHERE 
            CONVERT(DATETIME, XFECCAM2, 103) BETWEEN CONVERT(DATETIME,'$fchi',103) AND CONVERT(DATETIME,'$fchf',103) AND
            XCODMON='US'
            ORDER BY CONVERT(VARCHAR(10),XFECCAM2,112)  ASC";

$prliqui = $connection->prepare($sqlliqui, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$prliqui->execute();

$fil=1;
$col=0;

$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, 'FECHA');
$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, 'TPC');
$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, 'TPV');

$xls->getActiveSheet()->getStyle('A'.$fil.':C'.$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(10);

while($datos_muestra=$prliqui->fetch(PDO::FETCH_ASSOC)) {

	$fil=$fil+1;

 //    $xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, $datos_muestra['FECHA']);
 //    $xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $datos_muestra['TPC']);
	// $xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, $datos_muestra['TPV']);

    $xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, $datos_muestra['FECHA']);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+1].$fil, $datos_muestra["TPC"],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+2].$fil, $datos_muestra["TPV"],PHPExcel_Cell_DataType::TYPE_STRING);


}

$date = new DateTime($fecha_envio);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="TIPO DE CAMBIO --- '.$date->format('Y-m-d H.i.s').'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
exit();

?>