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

$inicio=$_GET['ini'];
$fin=$_GET['fin'];
$empresa=$_GET['empresa'];
$tipdoc=$_GET['tipdoc'];

$where="";
if($empresa!=""){
    $where.=" AND COD='$empresa'";
}

if($tipdoc!=""){
    $where.=" AND TD='$tipdoc'";
}

$fecha_envio=date('Y-m-d H:i:s');

$xls = new PHPExcel();
$xls->setActiveSheetIndex(0)->setTitle("HISTORICO DOCUMENTO");

$sqlliqui="SELECT COD,EMPRESA,ZONA,COD_VEN,VENDEDOR,COD_CLIENTE,CLIENTE,TD,DOCUMENTO,FECHA_EMISION,FECHA_VENCIMIENTO,FECHA_CANCELADO,MON,TIPCAM,IMPORTE,SALDO,ESTADO,BANCO,NUM_COBRA,REFERENCIA FROM FN_HISTORICO_DEUDA('$inicio','$fin') WHERE 1=1 $where";
// echo $sqlliqui;
// exit();
$prliqui = $connection->prepare($sqlliqui, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$prliqui->execute();

$fil=1;
$col=0;

$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, 'COD');
$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, 'EMPRESA');
$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, 'ZONA');
$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, 'COD_VEN');
$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, 'VENDEDOR');
$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil, 'COD_CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, 'CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, 'TD');
$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, 'DOCUMENTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, 'FECHA_EMISION');
$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, 'FECHA_VENCIMIENTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, 'FECHA_CANCELADO');
$xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, 'MON');
$xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, 'TIPCAM');
$xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, 'IMPORTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, 'SALDO');
$xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, 'ESTADO');
$xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, 'BANCO');
$xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, 'NUM_COBRA');
$xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, 'REFERENCIA');


$xls->getActiveSheet()->getStyle('A'.$fil.':T'.$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(7);
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
$xls->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(13);
$xls->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(16);
$xls->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(16);

$acudiltros="";

while($datos_muestra=$prliqui->fetch(PDO::FETCH_ASSOC)) {

    $fil=$fil+1;
    
    $acudiltros .= $datos_muestra['COD'].','.$datos_muestra['COD_CLIENTE'].$datos_muestra['TD'].$datos_muestra['DOCUMENTO'].'@';

	$xls->getActiveSheet()->setCellValueExplicit($columna[$col+0].$fil, $datos_muestra['COD'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $datos_muestra['EMPRESA']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, $datos_muestra['ZONA']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, $datos_muestra['COD_VEN']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, $datos_muestra['VENDEDOR']);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+5].$fil, $datos_muestra['COD_CLIENTE'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, $datos_muestra['CLIENTE']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $datos_muestra['TD']);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+8].$fil, $datos_muestra['DOCUMENTO'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, $datos_muestra['FECHA_EMISION']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $datos_muestra['FECHA_VENCIMIENTO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $datos_muestra['FECHA_CANCELADO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, $datos_muestra['MON']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, $datos_muestra['TIPCAM']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, $datos_muestra['IMPORTE']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, $datos_muestra['SALDO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, $datos_muestra['ESTADO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, $datos_muestra['BANCO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, $datos_muestra['NUM_COBRA']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, $datos_muestra['REFERENCIA']);
    
    $xls->getActiveSheet()->getStyle($columna[$col+0].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+1].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+2].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+3].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+5].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+7].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+8].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+9].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+10].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+11].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+12].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+13].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$xls->getActiveSheet()->getStyle($columna[$col+14].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
	$xls->getActiveSheet()->getStyle($columna[$col+15].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

}

// echo $acudiltros;

$xls->createSheet();
$xls->setActiveSheetIndex(1)->setTitle('PAGOS');

$Xfil=1;
$Xcol=0;

$xls->getActiveSheet()->SetCellValue($columna[$Xcol+0].$Xfil , 'EMPRESA');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+1].$Xfil , 'TD');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+2].$Xfil , 'DOCUMENTO');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+3].$Xfil , 'NROLIQ');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+4].$Xfil , 'MON');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+5].$Xfil , 'IMPORT');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+6].$Xfil , 'TIPCAMB');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+7].$Xfil , 'FORPAG');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+8].$Xfil , 'DESPAG');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+9].$Xfil , 'NROCHE');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+10].$Xfil, 'CODBAN');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+11].$Xfil, 'FECHEB');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+12].$Xfil, 'AGENCIA');
$xls->getActiveSheet()->SetCellValue($columna[$Xcol+13].$Xfil, 'CLIENTE');

$sqlpago=" EXECUTE SP_PAGOS '".substr($acudiltros,0,-1)."'";

  //echo $sqlpago;
  //exit();

$prpago = $connection->prepare($sqlpago, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$prpago->execute();

// echo "<pre>";
// print_r($prpago->fetchAll(PDO::FETCH_ASSOC));
// echo "</pre>";
$row = $prpago->fetchAll(PDO::FETCH_ASSOC);


 for($i=0;$i<=count($row)-1;$i++){
//echo count($prpago->fetchAll(PDO::FETCH_ASSOC));
    $Xfil=$Xfil+1;
    //echo $row[$i]['TE_COD']."\n";
    $emp = "";
    if($row[$i]['TE_COD']=="0002"){
        $emp = "CAISAC";
    } 
    
    if($row[$i]['TE_COD']=="0003"){
        $emp = "ANDEX";
    } 
    
    if($row[$i]['TE_COD']=="0004"){
        $emp = "SEMILLAS";        
    } 
    
    if($row[$i]['TE_COD']=="0016"){
        $emp = "SUNNY";        
    }

    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+0].$Xfil , $emp);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+1].$Xfil , $row[$i]['TE_TIPDOC']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+2].$Xfil , $row[$i]['TE_NRODOC']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+3].$Xfil , $row[$i]['TE_NROLIQ']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+4].$Xfil , $row[$i]['TE_TIPMON']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+5].$Xfil , $row[$i]['TE_IMPORT']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+6].$Xfil , $row[$i]['TE_TIPCAM']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+7].$Xfil , $row[$i]['TE_FORPAG']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+8].$Xfil , $row[$i]['TE_DESPAG']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+9].$Xfil , $row[$i]['TE_NROCHE']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+10].$Xfil, $row[$i]['TE_CODBAN']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+11].$Xfil, $row[$i]['TE_FECHEB']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+12].$Xfil, $row[$i]['TE_LOCEMI']);
    $xls->getActiveSheet()->SetCellValue($columna[$Xcol+13].$Xfil, $row[$i]['TE_CODCLI']);

 }

$date = new DateTime($fecha_envio);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Historico Documento --- '.$date->format('Y-m-d H.i.s').'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
exit();

?>