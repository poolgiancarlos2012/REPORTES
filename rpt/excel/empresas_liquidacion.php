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

$payi=$_GET['payi'];
$payf=$_GET['payf'];
$crei=$_GET['crei'];
$cref=$_GET['cref'];
$ruc =$_GET['ruc'];

$fecha_envio=date('Y-m-d H:i:s');

$xls = new PHPExcel();
$xls->setActiveSheetIndex(0)->setTitle("LIQUIDACION");



if($payi!=''){
    $pagoini = $payi;
}else{
    $pagoini = NULL;
}
if($payf!=''){
    $pagofin = $payf;
}else{
    $pagofin = NULL;
}
if($crei!=''){
    $creaini = $crei;
}else{
    $creaini = NULL;
}
if($cref!=''){
    $creafin = $cref;
}else{
    $creafin = NULL;
}
if($ruc!=''){
    $cod_cli = $ruc;
}else{
    $cod_cli = NULL;
}

$sqlliqui=" EXECUTE SP_PROCESO_LIQUIDACION '$pagoini','$pagofin','$creaini','$creafin','$cod_cli' ";


$prliqui = $connection->prepare($sqlliqui, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$prliqui->execute();

$fil=1;
$col=0;

$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, 'COD');
$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, 'EMPRESA');
$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, 'NRO_PLANILLA');
$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, 'COD_VEND');
$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, 'FECHA_PAGO');
$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil, 'COD_CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, 'CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, 'TD');
$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, 'DOCUMENTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, 'FECHA_EMISION');
$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, 'FECHA_VCTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, 'MON_DOC');
$xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, 'MON_COBR');
$xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, 'TIPO_COBR');
$xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, 'COBRANZA');
$xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, 'COBRO_SOLES');
$xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, 'COBRO_DOLARES');
$xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, 'BC_BCO');
$xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, 'FECH_REGISTRO_LIQUID');
$xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, 'USU_CREACION');
$xls->getActiveSheet()->SetCellValue($columna[$col+20].$fil, 'FECH_CREACION');

$xls->getActiveSheet()->getStyle('A'.$fil.':U'.$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(30);
$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(5);
$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(16);
$xls->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(16);
$xls->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(16);
$xls->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(40);
$xls->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(16);
$xls->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(16);
$xls->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(30);

while($datos_muestra=$prliqui->fetch(PDO::FETCH_ASSOC)) {

	$fil=$fil+1;

	$xls->getActiveSheet()->setCellValueExplicit($columna[$col+0].$fil, $datos_muestra["COD"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $datos_muestra['EMPRESA']);
	$xls->getActiveSheet()->setCellValueExplicit($columna[$col+2].$fil, $datos_muestra["NRO_PLANILLA"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, $datos_muestra['COD_VEND']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, $datos_muestra['FECHA_PAGO']);
	$xls->getActiveSheet()->setCellValueExplicit($columna[$col+5].$fil, $datos_muestra["COD_CLIENTE"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, $datos_muestra['CLIENTE']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $datos_muestra['TD']);
	$xls->getActiveSheet()->setCellValueExplicit($columna[$col+8].$fil, $datos_muestra["DOCUMENTO"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, $datos_muestra['FECHA_EMISION']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $datos_muestra['FECHA_VCTO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $datos_muestra['MON_DOC']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, $datos_muestra['MON_COBR']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, $datos_muestra['TIPO_COBR']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, $datos_muestra['COBRANZA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, $datos_muestra['COBRO_SOLES']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, $datos_muestra['COBRO_DOLARES']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, $datos_muestra['BC_BCO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, $datos_muestra['FECH_REGISTRO_LIQUID']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, $datos_muestra['USU_CREACION']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+20].$fil, $datos_muestra['FECH_CREACION']);

	$xls->getActiveSheet()->getStyle($columna[$col+15].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$xls->getActiveSheet()->getStyle($columna[$col+16].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

	$xls->getActiveSheet()->getStyle($columna[$col+0].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$xls->getActiveSheet()->getStyle($columna[$col+3].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$xls->getActiveSheet()->getStyle($columna[$col+4].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$xls->getActiveSheet()->getStyle($columna[$col+7].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$xls->getActiveSheet()->getStyle($columna[$col+8].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$xls->getActiveSheet()->getStyle($columna[$col+9].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$xls->getActiveSheet()->getStyle($columna[$col+10].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$xls->getActiveSheet()->getStyle($columna[$col+11].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$xls->getActiveSheet()->getStyle($columna[$col+12].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$xls->getActiveSheet()->getStyle($columna[$col+13].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

}

$date = new DateTime($fecha_envio);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Liquidacion --- '.$date->format('Y-m-d H.i.s').'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
exit();

?>