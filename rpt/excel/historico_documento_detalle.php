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
    'bold'  => false,
    'color' => array('rgb' => '000000'),
    'size'  => 8,
    'name'  => 'Verdana'
));
$font_amarrillo = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => 'FFFF17'),
    'size'  => 8,
    'name'  => 'Verdana'
));
$font_verde = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '92D050'),
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
    'color' => array('rgb' => 'E8E8EA'),
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

$fondo_oscuro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '303238')
    )
);

$inicio     = empty($_GET['ini'])     ? '' : $_GET['ini'];
$fin        = empty($_GET['fin'])     ? '' : $_GET['fin'];
$empresa    = empty($_GET['empresa']) ? '' : $_GET['empresa'];
$tipdoc     = empty($_GET['tipdoc'])  ? '' : $_GET['tipdoc'];
$codcli     = empty($_GET['codclie'])  ? '' : $_GET['codclie'];

$empr0002 = "";
$empr0003 = "";
$empr0004 = "";
$empr0016 = "";

if($empresa == "0002" ){
    $empr0002 = $empresa;
}
if($empresa == "0003" ){
    $empr0003 = $empresa;
}
if($empresa == "0004" ){
    $empr0004 = $empresa;
}
if($empresa == "0016" ){
    $empr0016 = $empresa;
}
if($empresa == "" ){
    $empr0002 = "0002";
    $empr0003 = "0003";
    $empr0004 = "0004";
    $empr0016 = "0016";
}

$fecha_envio=date('Y-m-d H:i:s');

$xls = new PHPExcel();
$xls->setActiveSheetIndex(0)->setTitle("HISTORICO DOCUMENTO DET.");

$fil=1;
$col=0;

$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, 'COD');
$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, 'EMPRESA'); // 1

$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, 'ZONA');

$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, 'COD_VEN'); // 2
$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, 'VENDEDOR');
$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil, 'COD_CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, 'CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, 'TD');
$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, 'DOCUMENTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, 'FECHA_EMISION');
$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, 'FECHA_VENCIMIENTO');

$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, 'MES_EMI');
$xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, 'ANIO_EMI');


$xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, 'DIAS_PLAZO');
$xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, 'MON');
$xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, 'TIPCAMV');
$xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, 'TIPCAMC');
$xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, 'IMPORTEDOC');
$xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, 'CODAGE');
$xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, 'AGENCIA');
$xls->getActiveSheet()->SetCellValue($columna[$col+20].$fil, 'ITEM');

$xls->getActiveSheet()->SetCellValue($columna[$col+21].$fil, 'PRODUCTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+22].$fil, 'PRESENTACION');
$xls->getActiveSheet()->SetCellValue($columna[$col+23].$fil, 'UNID_KG/LT');
$xls->getActiveSheet()->SetCellValue($columna[$col+24].$fil, 'TOT_VOLUMEN');

$xls->getActiveSheet()->SetCellValue($columna[$col+25].$fil, 'CODIGO');
$xls->getActiveSheet()->SetCellValue($columna[$col+26].$fil, 'DESCRI');
$xls->getActiveSheet()->SetCellValue($columna[$col+27].$fil, 'CANTI');
$xls->getActiveSheet()->SetCellValue($columna[$col+28].$fil, 'PRECIO');
$xls->getActiveSheet()->SetCellValue($columna[$col+29].$fil, 'UNID');
$xls->getActiveSheet()->SetCellValue($columna[$col+30].$fil, 'VALORVTA');
$xls->getActiveSheet()->SetCellValue($columna[$col+31].$fil, 'IGV');
$xls->getActiveSheet()->SetCellValue($columna[$col+32].$fil, 'PRECIOVTA');
$xls->getActiveSheet()->SetCellValue($columna[$col+33].$fil, 'VALORVTA_US');
$xls->getActiveSheet()->SetCellValue($columna[$col+34].$fil, 'VALORVTA_MN');
$xls->getActiveSheet()->SetCellValue($columna[$col+35].$fil, 'PRECIOVTA_US');
$xls->getActiveSheet()->SetCellValue($columna[$col+36].$fil, 'PRECIOVTA_MN');

$xls->getActiveSheet()->getStyle('A'.$fil.':AK'.$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('A'.$fil.':AK'.$fil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle('A'.$fil.':AK'.$fil)->applyFromArray($fondo_oscuro);

$xls->getActiveSheet()->getStyle('AE'.$fil.':AE'.$fil)->applyFromArray($font_amarrillo);
$xls->getActiveSheet()->getStyle('AH'.$fil.':AH'.$fil)->applyFromArray($font_amarrillo);
$xls->getActiveSheet()->getStyle('AI'.$fil.':AI'.$fil)->applyFromArray($font_amarrillo);

$xls->getActiveSheet()->getStyle('AG'.$fil.':AG'.$fil)->applyFromArray($font_verde);
$xls->getActiveSheet()->getStyle('AJ'.$fil.':AJ'.$fil)->applyFromArray($font_verde);
$xls->getActiveSheet()->getStyle('AK'.$fil.':AK'.$fil)->applyFromArray($font_verde);

$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(10);

$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(10);

$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);



$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(19);


$xls->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(10);

$xls->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(20);

$xls->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(20);
$xls->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(18);
$xls->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(18);
$xls->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(18);
$xls->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(18);


$sqlliqui = "	EXECUTE SP_HISTORICO_DEUDA_DETALLE
			'$inicio','$fin','$codcli','$tipdoc',
			'$empr0002',
			'$empr0003',
			'$empr0004',
			'$empr0016'
                ";
// // echo $sqlliqui;

$prliqui = $connection->prepare($sqlliqui, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$prliqui->execute();

while($datos_muestra=$prliqui->fetch(PDO::FETCH_ASSOC)) {

    $agencia = "";

    if($datos_muestra['COD']=="0002" || $datos_muestra['COD']=="0003" || $datos_muestra['COD']=="0004"){
        if($datos_muestra["CODAGE"]=='0001'){
            $agencia = "LIMA";
        }
    }
    if($datos_muestra['COD']=="0016"){
        if($datos_muestra["CODAGE"]=='0000'){
            $agencia = "LIMA";
        }
        if($datos_muestra["CODAGE"]=='0001'){
            $agencia = "BARRANCA";
        }
        if($datos_muestra["CODAGE"]=='0002'){
            $agencia = "TRUJILLO";
        }
        if($datos_muestra["CODAGE"]=='0003'){
            $agencia = "HUARAL";
        }
        if($datos_muestra["CODAGE"]=='0004'){
            $agencia = "SANTA ROSA";
        }
        if($datos_muestra["CODAGE"]=='0005'){
            $agencia = "CHAO";
        }
        if($datos_muestra["CODAGE"]=='0006'){
            $agencia = "HUAURA";
        }
        if($datos_muestra["CODAGE"]=='0008'){
            $agencia = "CHIMBOTE";
        }
        if($datos_muestra["CODAGE"]=='0009'){
            $agencia = "TRAPICHE";
        }
        if($datos_muestra["CODAGE"]=='0011'){
            $agencia = "CASTILLA";
        }
        if($datos_muestra["CODAGE"]=='0012'){
            $agencia = "CHEPEN";
        }
        if($datos_muestra["CODAGE"]=='0013'){
            $agencia = "PIURA";
        }
        if($datos_muestra["CODAGE"]=='0014'){
            $agencia = "CHICLAYO";
        }
    }

	$fil=$fil+1;

    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+0].$fil, $datos_muestra['COD'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $datos_muestra['EMPRESA']); // 1

    $xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, $datos_muestra['ZONA']);

    $xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, $datos_muestra['COD_VEN']); // 2
    $xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, $datos_muestra['VENDEDOR']);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+5].$fil, $datos_muestra['COD_CLIENTE'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, $datos_muestra['CLIENTE']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $datos_muestra['TD']);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+8].$fil, $datos_muestra['DOCUMENTO'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, $datos_muestra['FECHA_EMISION']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $datos_muestra['FECHA_VENCIMIENTO']);

    $xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $datos_muestra['MES_EMI']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, $datos_muestra['ANIO_EMI']);


    $xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, $datos_muestra['DIAS_PLAZO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, $datos_muestra['MON']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, $datos_muestra['TIPCAMV']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, $datos_muestra['TIPCAMC']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, $datos_muestra['IMPORTEDOC']);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+18].$fil, $datos_muestra['CODAGE'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, $agencia);
    $xls->getActiveSheet()->SetCellValue($columna[$col+20].$fil, $datos_muestra['ITEM']);

    $xls->getActiveSheet()->SetCellValue($columna[$col+21].$fil, $datos_muestra['PRODUCTO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+22].$fil, $datos_muestra['PRESENTACION']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+23].$fil, $datos_muestra['UNID_KG_LT']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+24].$fil, $datos_muestra['PRESENTACION']*$datos_muestra['CANTI']);

    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+25].$fil, $datos_muestra['CODIGO'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+26].$fil, $datos_muestra['DESCRI']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+27].$fil, $datos_muestra['CANTI']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+28].$fil, $datos_muestra['PRECIO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+29].$fil, $datos_muestra['UNID']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+30].$fil, $datos_muestra['VALORVTA']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+31].$fil, $datos_muestra['IGV']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+32].$fil, $datos_muestra['PRECIOVTA']);

    $valvta_us = 0;
    $valvta_mn = 0;
    $prevta_us = 0;
    $prevta_mn = 0;


    if($datos_muestra['MON'] == 'US'){
        $valvta_us = $datos_muestra['VALORVTA'];
        $valvta_mn = $datos_muestra['VALORVTA']*$datos_muestra['TIPCAMV'];
    }
    if($datos_muestra['MON'] == 'MN'){
        $valvta_us = $datos_muestra['VALORVTA']/$datos_muestra['TIPCAMV'];
        $valvta_mn = $datos_muestra['VALORVTA'];
    }
    if($datos_muestra['MON'] == 'US'){
        $prevta_us = $datos_muestra['PRECIOVTA'];
        $prevta_mn = $datos_muestra['PRECIOVTA']*$datos_muestra['TIPCAMV'];
    }
    if($datos_muestra['MON'] == 'MN'){
        $prevta_us = $datos_muestra['PRECIOVTA']/$datos_muestra['TIPCAMV'];
        $prevta_mn = $datos_muestra['PRECIOVTA'];
    }

    $xls->getActiveSheet()->SetCellValue($columna[$col+33].$fil, $valvta_us);
    $xls->getActiveSheet()->SetCellValue($columna[$col+34].$fil, $valvta_mn);
    $xls->getActiveSheet()->SetCellValue($columna[$col+35].$fil, $prevta_us);
    $xls->getActiveSheet()->SetCellValue($columna[$col+36].$fil, $prevta_mn);

    $xls->getActiveSheet()->getStyle($columna[$col+17].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+28].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+30].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+31].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+32].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+33].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+34].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+35].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $xls->getActiveSheet()->getStyle($columna[$col+36].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

    $xls->getActiveSheet()->getStyle($columna[$col+0].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+1].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $xls->getActiveSheet()->getStyle($columna[$col+2].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

    $xls->getActiveSheet()->getStyle($columna[$col+3].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $xls->getActiveSheet()->getStyle($columna[$col+4].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $xls->getActiveSheet()->getStyle($columna[$col+7].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+9].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+10].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+13].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+16].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $xls->getActiveSheet()->getStyle($columna[$col+18].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $xls->getActiveSheet()->getStyle($columna[$col+22].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $xls->getActiveSheet()->getStyle($columna[$col+23].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $xls->getActiveSheet()->getStyle($columna[$col+27].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $xls->getActiveSheet()->getStyle('A'.$fil.':AK'.$fil)->applyFromArray($font);

}

$date = new DateTime($fecha_envio);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Historico Detalle Documento --- '.$date->format('Y-m-d H.i.s').'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
exit();

?>
