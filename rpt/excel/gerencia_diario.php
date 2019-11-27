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
    'color' => array('rgb' => '002060'),
    'size'  => 8,
    'name'  => 'Verdana'
));
$font_percent = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '002060'),
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
    'size'  => 10,
    'name'  => 'Verdana'
));
$font_header_amarillo = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => '504500'),
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
$border_thin_celeste = array(
  'borders' => array(
      'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN ,
          'color' => array('rgb' => '5094D0')
      )
    )
);
$border_thin_amarillo = array(
  'borders' => array(
      'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN ,
          'color' => array('rgb' => 'CAAF00')
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
$fondo_celeste_oscuro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B8DAF7')
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

$font_futura_header = array(
'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => 'CDCFD4'),
    'size'  => 8,
    'name'  => 'Verdana'
));

$font_futura_texto = array(
'font'  => array(
    'bold'  => false,
    'color' => array('rgb' => '002060'),
    'size'  => 8,
    'name'  => 'Verdana'
));

$fondo_azul_oscuro = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '3A2060')
    )
);

$fondo_plomo = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CDCFD4')
    )
);

$fondo_celeste_clarisimo = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'EEF3F7')
    )
);

function is_in_array($array, $key, $key_value){
	$within_array = 'no';
	foreach( $array as $k=>$v ){
		if( is_array($v) ){
		    $within_array = is_in_array($v, $key, $key_value);
		    if( $within_array == 'yes' ){
		        break;
		    }
		} else {
		        if( $v == $key_value && $k == $key ){
		                $within_array = 'yes';
		                break;
		        }
		}
	}
	return $within_array;
}


$fecha_envio=date('Y-m-d H:i:s');

$xls = new PHPExcel();
$xls->setActiveSheetIndex(0)->setTitle("BASE PDT");

$fil=1;
$col=0;

// $xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil , 'COD');
$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil , 'EMPRESA');
$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil , 'CODZONA');
$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil , 'ZONA');
$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil , 'TIENDA_SUNNY');
$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil , 'LOCALIDAD');
$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil , 'OFICINA_ADMINISTRATIVA');
$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil , 'ESTUDIO_EXTERNO');
$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil , 'RESPONSABLE_ZONA');
$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil , 'RTC');
$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, 'SUPERVISOR');
$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, 'TIPO_RIESGO');
$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, 'TIPO_CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, 'COD_CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, 'CLIENTE');
// $xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, 'LOCAL');
$xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, 'TD');
$xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, 'DOCUMENTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, 'FECHA_EMISION');
$xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, 'MES_EMIS');
$xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, 'ANIO_EMIS');
$xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, 'DIAS_PLAZO');
$xls->getActiveSheet()->SetCellValue($columna[$col+20].$fil, 'FECHA_VCTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+21].$fil, 'MES_VCTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+22].$fil, 'ANIO_VCTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+23].$fil, 'FECHA_GERENCIAL');
$xls->getActiveSheet()->SetCellValue($columna[$col+24].$fil, 'DIAS_TRANSC');
$xls->getActiveSheet()->SetCellValue($columna[$col+25].$fil, 'TIPO_OPERACION');
$xls->getActiveSheet()->SetCellValue($columna[$col+26].$fil, 'RANGO_VCTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+27].$fil, 'LINEA_CREDITO');
$xls->getActiveSheet()->SetCellValue($columna[$col+28].$fil, 'IND_VCTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+29].$fil, 'SEMAFORO');
$xls->getActiveSheet()->SetCellValue($columna[$col+30].$fil, 'MO');

$xls->getActiveSheet()->SetCellValue($columna[$col+31].$fil, 'IMPORTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+32].$fil, 'SALDO');
$xls->getActiveSheet()->SetCellValue($columna[$col+33].$fil, 'TIPCAMB');
// $xls->getActiveSheet()->SetCellValue($columna[$col+36].$fil, 'SALDO_MN');
// $xls->getActiveSheet()->SetCellValue($columna[$col+37].$fil, 'SALDO_US');
$xls->getActiveSheet()->SetCellValue($columna[$col+34].$fil, 'SALDO_TOTAL_US');
$xls->getActiveSheet()->SetCellValue($columna[$col+35].$fil, 'SALDO_TOTAL_MN');

$xls->getActiveSheet()->SetCellValue($columna[$col+36].$fil, 'GLOSA');
$xls->getActiveSheet()->SetCellValue($columna[$col+37].$fil, 'ESTADO');
$xls->getActiveSheet()->SetCellValue($columna[$col+38].$fil, 'BANCO');
$xls->getActiveSheet()->SetCellValue($columna[$col+39].$fil, 'NUM_COBRA');
$xls->getActiveSheet()->SetCellValue($columna[$col+40].$fil, 'REFERENCIA');

$xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($fondo_azul_oscuro);
$xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($font_futura_header);

$xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$empr0002= empty($_GET['empr0002']) ? '' : $_GET['empr0002'];
$agen0002= empty($_GET['agen0002']) ? '' : $_GET['agen0002'];
$clie0002= empty($_GET['clie0002']) ? '' : $_GET['clie0002'];
$iemi0002= empty($_GET['iemi0002']) ? '' : $_GET['iemi0002'];
$femi0002= empty($_GET['femi0002']) ? '' : $_GET['femi0002'];
$loca0002= empty($_GET['loca0002']) ? '' : $_GET['loca0002'];
$empr0003= empty($_GET['empr0003']) ? '' : $_GET['empr0003'];
$agen0003= empty($_GET['agen0003']) ? '' : $_GET['agen0003'];
$clie0003= empty($_GET['clie0003']) ? '' : $_GET['clie0003'];
$iemi0003= empty($_GET['iemi0003']) ? '' : $_GET['iemi0003'];
$femi0003= empty($_GET['femi0003']) ? '' : $_GET['femi0003'];
$loca0003= empty($_GET['loca0003']) ? '' : $_GET['loca0003'];
$empr0004= empty($_GET['empr0004']) ? '' : $_GET['empr0004'];
$agen0004= empty($_GET['agen0004']) ? '' : $_GET['agen0004'];
$clie0004= empty($_GET['clie0004']) ? '' : $_GET['clie0004'];
$iemi0004= empty($_GET['iemi0004']) ? '' : $_GET['iemi0004'];
$femi0004= empty($_GET['femi0004']) ? '' : $_GET['femi0004'];
$loca0004= empty($_GET['loca0004']) ? '' : $_GET['loca0004'];
$empr0016= empty($_GET['empr0016']) ? '' : $_GET['empr0016'];
$agen0016= empty($_GET['agen0016']) ? '' : $_GET['agen0016'];
$clie0016= empty($_GET['clie0016']) ? '' : $_GET['clie0016'];
$iemi0016= empty($_GET['iemi0016']) ? '' : $_GET['iemi0016'];
$femi0016= empty($_GET['femi0016']) ? '' : $_GET['femi0016'];
$loca0016= empty($_GET['loca0016']) ? '' : $_GET['loca0016'];

$sql=" 	EXECUTE SP_GERENCIAL
		'$empr0002','$agen0002','$clie0002','$iemi0002','$femi0002','$loca0002',NULL,
		'$empr0003','$agen0003','$clie0003','$iemi0003','$femi0003','$loca0003',NULL,
		'$empr0004','$agen0004','$clie0004','$iemi0004','$femi0004','$loca0004',NULL,
		'$empr0016','$agen0016','$clie0016','$iemi0016','$femi0016','$loca0016',NULL ";

// echo $sql;
// exit();

$pr = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$pr->execute();

$ar_stacol=array();

$backgrouncolor=0;


while($datos_muestra=$pr->fetch(PDO::FETCH_ASSOC)) {

  $backgrouncolor++;

	$fil=$fil+1;

	// $xls->getActiveSheet()->setCellValueExplicit($columna[$col+0].$fil, $datos_muestra["COD"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, $datos_muestra['EMPRESA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $datos_muestra['CODZONA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, $datos_muestra['ZONA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, $datos_muestra['TIENDA_SUNNY']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, $datos_muestra['LOCALIDAD']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil, $datos_muestra['OFICINA_ADMINISTRATIVA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, $datos_muestra['ESTUDIO_EXTERNO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $datos_muestra['RESPONSABLE_ZONA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, $datos_muestra['RTC']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil, $datos_muestra['SUPERVISOR']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $datos_muestra['TIPO_RIESGO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $datos_muestra['TIPO_CLIENTE']);
	$xls->getActiveSheet()->setCellValueExplicit($columna[$col+12].$fil, $datos_muestra["COD_CLIENTE"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, $datos_muestra['CLIENTE']);
	// $xls->getActiveSheet()->setCellValueExplicit($columna[$col+15].$fil, $datos_muestra["LOCAL"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, $datos_muestra['TD']);
	$xls->getActiveSheet()->setCellValueExplicit($columna[$col+15].$fil, $datos_muestra["DOCUMENTO"],PHPExcel_Cell_DataType::TYPE_STRING);
	$xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, $datos_muestra['FECHA_EMISION']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, $datos_muestra['MES_EMIS']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, $datos_muestra['ANIO_EMIS']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, $datos_muestra['DIAS_PLAZO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+20].$fil, $datos_muestra['FECHA_VCTO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+21].$fil, $datos_muestra['MES_VCTO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+22].$fil, $datos_muestra['ANIO_VCTO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+23].$fil, $datos_muestra['FECHA_GERENCIAL']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+24].$fil, $datos_muestra['DIAS_TRANSC']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+25].$fil, $datos_muestra['TIPO_OPERACION']);

  $rango_vcto='';

  if($datos_muestra['RANGO_VCTO']==0){
    $rango_vcto="0 - (01 A 08 DIAS)";
  }else if($datos_muestra['RANGO_VCTO']==1){
    $rango_vcto="1 - (09 A 30 DIAS)";
  }else if($datos_muestra['RANGO_VCTO']==2){
    $rango_vcto="2 - (31 A 60 DIAS)";
  }else if($datos_muestra['RANGO_VCTO']==3){
    $rango_vcto="3 - (61 A 90 DIAS)";
  }else if($datos_muestra['RANGO_VCTO']==4){
    $rango_vcto="4 - (91 A 120 DIAS)";
  }else if($datos_muestra['RANGO_VCTO']==5){
    $rango_vcto="5 - (121 A 360 DIAS)";
  }else if($datos_muestra['RANGO_VCTO']==6){
    $rango_vcto="6 - (MAS DE 360 DIAS)";
  }else if($datos_muestra['RANGO_VCTO']==7){
    $rango_vcto="7 - (COB. JUDICIAL)";
  }else if($datos_muestra['RANGO_VCTO']==8){
    $rango_vcto="8 - (VIGENTE)";
  }else if($datos_muestra['RANGO_VCTO']==9){
    $rango_vcto="9 - (SALDO A FAVOR)";
  }

	$xls->getActiveSheet()->SetCellValue($columna[$col+26].$fil, $rango_vcto);
	$xls->getActiveSheet()->SetCellValue($columna[$col+27].$fil, $datos_muestra['LINEA_CREDITO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+28].$fil, $datos_muestra['IND_VCTO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+29].$fil, $datos_muestra['SEMAFORO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+30].$fil, $datos_muestra['MO']);

  $saldo_tot_us = 0;
  $saldo_tot_mn = 0;

  if($datos_muestra['MO'] == 'US'){
    $saldo_tot_us = $datos_muestra['SALDO'];
    $saldo_tot_mn = $datos_muestra['SALDO']*$datos_muestra['TIPCAMB'];
  }

  if($datos_muestra['MO'] == 'MN'){
    $saldo_tot_us = $datos_muestra['SALDO']/$datos_muestra['TIPCAMB'];
    $saldo_tot_mn = $datos_muestra['SALDO'];
  }

  if($datos_muestra['TD'] == 'NC' || $datos_muestra['TD'] == 'PA'){

    $xls->getActiveSheet()->SetCellValue($columna[$col+31].$fil, -1*$datos_muestra['IMPORTE']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+32].$fil, -1*$datos_muestra['SALDO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+33].$fil, $datos_muestra['TIPCAMB']);
    // $xls->getActiveSheet()->SetCellValue($columna[$col+34].$fil, -1*$datos_muestra['SALDO_TOTAL_US']);
    // $xls->getActiveSheet()->SetCellValue($columna[$col+35].$fil, -1*$datos_muestra['SALDO_TOTAL_MN']);

    $xls->getActiveSheet()->SetCellValue($columna[$col+34].$fil, -1*$saldo_tot_us);
    $xls->getActiveSheet()->SetCellValue($columna[$col+35].$fil, -1*$saldo_tot_mn);

  } else {

    $xls->getActiveSheet()->SetCellValue($columna[$col+31].$fil, $datos_muestra['IMPORTE']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+32].$fil, $datos_muestra['SALDO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+33].$fil, $datos_muestra['TIPCAMB']);
    // $xls->getActiveSheet()->SetCellValue($columna[$col+34].$fil, $datos_muestra['SALDO_TOTAL_US']);
    // $xls->getActiveSheet()->SetCellValue($columna[$col+35].$fil, $datos_muestra['SALDO_TOTAL_MN']);

    $xls->getActiveSheet()->SetCellValue($columna[$col+34].$fil, $saldo_tot_us);
    $xls->getActiveSheet()->SetCellValue($columna[$col+35].$fil, $saldo_tot_mn);

  }

  $xls->getActiveSheet()->getStyle($columna[$col+31].$fil)->getNumberFormat()->setFormatCode('#,##0.00');
  $xls->getActiveSheet()->getStyle($columna[$col+32].$fil)->getNumberFormat()->setFormatCode('#,##0.00');
  $xls->getActiveSheet()->getStyle($columna[$col+33].$fil)->getNumberFormat()->setFormatCode('#,##0.000');
  $xls->getActiveSheet()->getStyle($columna[$col+34].$fil)->getNumberFormat()->setFormatCode('#,##0.00');
  $xls->getActiveSheet()->getStyle($columna[$col+35].$fil)->getNumberFormat()->setFormatCode('#,##0.00');



	$xls->getActiveSheet()->SetCellValue($columna[$col+36].$fil, $datos_muestra['GLOSA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+37].$fil, $datos_muestra['ESTADO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+38].$fil, $datos_muestra['BANCO']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+39].$fil, $datos_muestra['NUM_COBRA']);
	$xls->getActiveSheet()->SetCellValue($columna[$col+40].$fil, str_replace("@"," ",$datos_muestra['REFERENCIA']));

	$xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($border_thin_celeste);

  if($backgrouncolor%2==0){
    $xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($fondo_celeste_clarisimo);
  } else {
    $xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($fondo_plomo);
  }

	$xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($font_futura_texto);



  // $xls->getActiveSheet()->getStyle($columna[$col+0].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // COD
  $xls->getActiveSheet()->getStyle($columna[$col+0].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // EMPRESA
  $xls->getActiveSheet()->getStyle($columna[$col+1].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // CODZONA
  // $xls->getActiveSheet()->getStyle($columna[$col+15].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // LOCAL
  $xls->getActiveSheet()->getStyle($columna[$col+14].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // TD
  $xls->getActiveSheet()->getStyle($columna[$col+15].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // DOCUMENTO
  $xls->getActiveSheet()->getStyle($columna[$col+16].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // FECHA_EMISION
  $xls->getActiveSheet()->getStyle($columna[$col+18].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // ANIO_EMIS
  $xls->getActiveSheet()->getStyle($columna[$col+20].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // FECHA_VCTO
  $xls->getActiveSheet()->getStyle($columna[$col+22].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // ANIO_VCTO
  $xls->getActiveSheet()->getStyle($columna[$col+23].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // FECHA_GERENCIAL








	if(is_in_array($ar_stacol, 'COD_VEN_RTC_JUNIOR', $datos_muestra['COD_VEN_RTC_JUNIOR'])=='yes'){ // YES: SI EXISTE
		for($j=0;$j<=count($ar_stacol)-1;$j++){
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="0" ){
				$ar_stacol[$j]["0"] = $ar_stacol[$j]["0"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="1" ){
				$ar_stacol[$j]["1"] = $ar_stacol[$j]["1"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="2" ){
				$ar_stacol[$j]["2"] = $ar_stacol[$j]["2"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="3" ){
				$ar_stacol[$j]["3"] = $ar_stacol[$j]["3"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="4" ){
				$ar_stacol[$j]["4"] = $ar_stacol[$j]["4"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="5" ){
				$ar_stacol[$j]["5"] = $ar_stacol[$j]["5"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="6" ){
				$ar_stacol[$j]["6"] = $ar_stacol[$j]["6"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="7" ){
				$ar_stacol[$j]["7"] = $ar_stacol[$j]["7"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']=="8" ){
				$ar_stacol[$j]["8"] = $ar_stacol[$j]["8"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']>="0" && $datos_muestra['RANGO_VCTO']<="6"){
				$ar_stacol[$j]["0_6"] = $ar_stacol[$j]["0_6"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']>="0" && $datos_muestra['RANGO_VCTO']<="8"){
				$ar_stacol[$j]["0_8"] = $ar_stacol[$j]["0_8"]+$datos_muestra['SALDO_TOTAL_US'];
			}
			if($ar_stacol[$j]["COD_VEN_RTC_JUNIOR"] == $datos_muestra['COD_VEN_RTC_JUNIOR'] && $datos_muestra['RANGO_VCTO']>="1" && $datos_muestra['RANGO_VCTO']<="6"){
				$ar_stacol[$j]["1_6"] = $ar_stacol[$j]["1_6"]+$datos_muestra['SALDO_TOTAL_US'];
			}
		}
	}else{ // NO: NO EXISTE
		if($datos_muestra['RANGO_VCTO']=="0"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"1"						=> 0,
				"2"      				=> 0,
				"3"      				=> 0,
				"4"      				=> 0,
				"5"      				=> 0,
				"6"      				=> 0,
				"7"      				=> 0,
				"8"      				=> 0,
				"0_6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> 0,
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="1"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"2"      				=> 0,
				"3"      				=> 0,
				"4"      				=> 0,
				"5"      				=> 0,
				"6"      				=> 0,
				"7"      				=> 0,
				"8"      				=> 0,
				"0_6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> $datos_muestra['SALDO_TOTAL_US'],
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="2"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> 0,
				"2"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"3"      				=> 0,
				"4"      				=> 0,
				"5"      				=> 0,
				"6"      				=> 0,
				"7"      				=> 0,
				"8"      				=> 0,
				"0_6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> $datos_muestra['SALDO_TOTAL_US'],
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="3"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> 0,
				"2"      				=> 0,
				"3"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"4"      				=> 0,
				"5"      				=> 0,
				"6"      				=> 0,
				"7"      				=> 0,
				"8"      				=> 0,
				"0_6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> $datos_muestra['SALDO_TOTAL_US'],
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="4"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> 0,
				"2"      				=> 0,
				"3"      				=> 0,
				"4"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"5"      				=> 0,
				"6"      				=> 0,
				"7"      				=> 0,
				"8"      				=> 0,
				"0_6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> $datos_muestra['SALDO_TOTAL_US'],
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="5"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> 0,
				"2"      				=> 0,
				"3"      				=> 0,
				"4"      				=> 0,
				"5"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"6"      				=> 0,
				"7"      				=> 0,
				"8"      				=> 0,
				"0_6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> $datos_muestra['SALDO_TOTAL_US'],
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="6"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> 0,
				"2"      				=> 0,
				"3"      				=> 0,
				"4"      				=> 0,
				"5"      				=> 0,
				"6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"7"      				=> 0,
				"8"      				=> 0,
				"0_6"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> $datos_muestra['SALDO_TOTAL_US'],
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="7"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> 0,
				"2"      				=> 0,
				"3"      				=> 0,
				"4"      				=> 0,
				"5"      				=> 0,
				"6"      				=> 0,
				"7"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"8"      				=> 0,
				"0_6"      				=> 0,
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> 0,
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
		if($datos_muestra['RANGO_VCTO']=="8"){
			array_push($ar_stacol,array(
				"COD_VEN_RTC_JUNIOR" 	=> $datos_muestra['COD_VEN_RTC_JUNIOR'],
				"RTC"					=> utf8_decode($datos_muestra['RTC']),
				"0"						=> 0,
				"1"      				=> 0,
				"2"      				=> 0,
				"3"      				=> 0,
				"4"      				=> 0,
				"5"      				=> 0,
				"6"      				=> 0,
				"7"      				=> 0,
				"8"      				=> $datos_muestra['SALDO_TOTAL_US'],
				"0_6"      				=> 0,
				"0_8"					=> $datos_muestra['SALDO_TOTAL_US'],
				"mora_percent"			=> 0,
				"judicial_percent"		=> 0,
				"vigente_percent"		=> 0,
				"1_6"					=> 0,
				"vigente_1_8"			=> 0,
				"cartera_total"			=> 0,
				"mora_percent_2"		=> 0,
				"judicial_percent_2"	=> 0,
				"vigente_percent_2"		=> 0,
			));
		}
	}
}

$xls->createSheet();
$xls->setActiveSheetIndex(1)->setTitle('STATUS COLOCACIÓN');

$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(30);
$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(15);

$xls->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(1);

$xls->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(15);

$xls->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(1);

$xls->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(15);

$xls->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(1);

$xls->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(15);

$xls->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(1);

$xls->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
$xls->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);

$xls->getActiveSheet()->getStyle('B5:AZ5')->getAlignment()->setWrapText(true);
$xls->getActiveSheet()->getStyle('B5:AZ5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('B5:AZ5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$xfil=5;
$xcol=0;

$xls->getActiveSheet()->SetCellValue($columna[$xcol+0].$xfil , 'CARTERA TOTAL US$');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+1].$xfil , 'CARTERA VIGENTE / AUN NO VENCE');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+2].$xfil , 'COBRANZA JUDICIAL');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+3].$xfil , 'CARTERA ENTRE 1 Y 8 DÍAS DE VENCIDA');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+4].$xfil , 'CARTERA ENTRE 9 Y 30 DÍAS DE VENCIDA');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+5].$xfil , 'CARTERA ENTRE 31 Y 60 DÍAS DE VENCIDA');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+6].$xfil , 'CARTERA ENTRE 61 Y 90 DÍAS DE VENCIDA');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+7].$xfil , 'CARTERA ENTRE 91 Y 120 DÍAS DE VENCIDA');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+8].$xfil , 'CARTERA ENTRE 121 Y 360 DÍAS DE VENCIDA');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+9].$xfil , 'CARTERA CON MÁS DE 360 DÍAS DE VENCIDA');

$xls->getActiveSheet()->SetCellValue($columna[$xcol+11].$xfil , 'CARTERA EN MORA DESDE DÍA 1');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+12].$xfil , 'COBRANZA JUDICIAL');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+13].$xfil , 'CARTERA VIGENTE / AUN NO VENCE');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+14].$xfil , 'CARTERA TOTAL');

$xls->getActiveSheet()->SetCellValue($columna[$xcol+16].$xfil , 'CARTERA EN MORA DESDE DÍA 1');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+17].$xfil , 'COBRANZA JUDICIAL');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+18].$xfil , 'CARTERA VIGENTE / AUN NO VENCE');

$xls->getActiveSheet()->SetCellValue($columna[$xcol+20].$xfil , 'CARTERA EN MORA DESDE DÍA 9');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+21].$xfil , 'COBRANZA JUDICIAL');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+22].$xfil , 'CARTERA VIGENTE / AUN NO VENCE + MORA 1-8');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+23].$xfil , 'CARTERA TOTAL');

$xls->getActiveSheet()->SetCellValue($columna[$xcol+25].$xfil , 'CARTERA EN MORA DESDE DÍA 9');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+26].$xfil , 'COBRANZA JUDICIAL');
$xls->getActiveSheet()->SetCellValue($columna[$xcol+27].$xfil , 'CARTERA VIGENTE / AUN NO VENCE + MORA 1-8');


$xls->getActiveSheet()->getStyle($columna[$xcol+1].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+2].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+3].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+4].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+5].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+6].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+7].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+8].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+9].$xfil)->applyFromArray($border_thin_celeste);

$xls->getActiveSheet()->getStyle($columna[$xcol+11].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+12].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+13].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+14].$xfil)->applyFromArray($border_thin_celeste);

$xls->getActiveSheet()->getStyle($columna[$xcol+16].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+17].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+18].$xfil)->applyFromArray($border_thin_celeste);

$xls->getActiveSheet()->getStyle($columna[$xcol+20].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+21].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+22].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+23].$xfil)->applyFromArray($border_thin_celeste);

$xls->getActiveSheet()->getStyle($columna[$xcol+25].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+26].$xfil)->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle($columna[$xcol+27].$xfil)->applyFromArray($border_thin_celeste);


$xls->getActiveSheet()->getStyle($columna[$xcol+1].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+2].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+3].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+4].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+5].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+6].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+7].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+8].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+9].$xfil)->applyFromArray($fondo_celeste_oscuro);

$xls->getActiveSheet()->getStyle($columna[$xcol+11].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+12].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+13].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+14].$xfil)->applyFromArray($fondo_celeste_oscuro);

$xls->getActiveSheet()->getStyle($columna[$xcol+16].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+17].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+18].$xfil)->applyFromArray($fondo_celeste_oscuro);

$xls->getActiveSheet()->getStyle($columna[$xcol+20].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+21].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+22].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+23].$xfil)->applyFromArray($fondo_celeste_oscuro);

$xls->getActiveSheet()->getStyle($columna[$xcol+25].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+26].$xfil)->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle($columna[$xcol+27].$xfil)->applyFromArray($fondo_celeste_oscuro);





$xls->getActiveSheet()->getStyle($columna[$xcol+1].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+2].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+3].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+4].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+5].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+6].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+7].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+8].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+9].$xfil)->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle($columna[$xcol+11].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+12].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+13].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+14].$xfil)->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle($columna[$xcol+16].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+17].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+18].$xfil)->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle($columna[$xcol+20].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+21].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+22].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+23].$xfil)->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle($columna[$xcol+25].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+26].$xfil)->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle($columna[$xcol+27].$xfil)->applyFromArray($font_header);


for($i=0;$i<=count($ar_stacol)-1;$i++){
	$ar_stacol[$i]['mora_percent']=$ar_stacol[$i]['0_6']/$ar_stacol[$i]['0_8'];
	$ar_stacol[$i]['judicial_percent']=$ar_stacol[$i]['7']/$ar_stacol[$i]['0_8'];
	$ar_stacol[$i]['vigente_percent']=$ar_stacol[$i]['8']/$ar_stacol[$i]['0_8'];
	$ar_stacol[$i]['vigente_1_8']=$ar_stacol[$i]['8']+$ar_stacol[$i]['0'];
	$ar_stacol[$i]['cartera_total']=$ar_stacol[$i]['1_6']+$ar_stacol[$i]['7']+$ar_stacol[$i]['vigente_1_8'];
	$ar_stacol[$i]['mora_percent_2']= $ar_stacol[$i]['1_6']/$ar_stacol[$i]['cartera_total'];
	$ar_stacol[$i]['judicial_percent_2']=$ar_stacol[$i]['7']/$ar_stacol[$i]['cartera_total'];
	$ar_stacol[$i]['vigente_percent_2']=$ar_stacol[$i]['vigente_1_8']/$ar_stacol[$i]['cartera_total'];
}

function custom_sort($a,$b) {
	return $a['mora_percent_2']<$b['mora_percent_2'];
}

usort($ar_stacol, "custom_sort");

$val_ofi_B=0;
$val_ofi_O=0;



for($z=0;$z<=count($ar_stacol)-1;$z++){



	$xfil=$xfil+1;
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+0].$xfil, utf8_encode($ar_stacol[$z]['RTC']));
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+1].$xfil, $ar_stacol[$z]['8']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+2].$xfil, $ar_stacol[$z]['7']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+3].$xfil, $ar_stacol[$z]['0']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+4].$xfil, $ar_stacol[$z]['1']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+5].$xfil, $ar_stacol[$z]['2']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+6].$xfil, $ar_stacol[$z]['3']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+7].$xfil, $ar_stacol[$z]['4']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+8].$xfil, $ar_stacol[$z]['5']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+9].$xfil, $ar_stacol[$z]['6']);

	$xls->getActiveSheet()->SetCellValue($columna[$xcol+11].$xfil, $ar_stacol[$z]['0_6']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+12].$xfil, $ar_stacol[$z]['7']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+13].$xfil, $ar_stacol[$z]['8']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+14].$xfil, $ar_stacol[$z]['0_8']);

	$xls->getActiveSheet()->SetCellValue($columna[$xcol+16].$xfil, $ar_stacol[$z]['mora_percent']     );
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+17].$xfil, $ar_stacol[$z]['judicial_percent'] );
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+18].$xfil, $ar_stacol[$z]['vigente_percent']  );

	$xls->getActiveSheet()->SetCellValue($columna[$xcol+20].$xfil, $ar_stacol[$z]['1_6']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+21].$xfil, $ar_stacol[$z]['7']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+22].$xfil, $ar_stacol[$z]['vigente_1_8']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+23].$xfil, $ar_stacol[$z]['cartera_total']);

	$xls->getActiveSheet()->SetCellValue($columna[$xcol+25].$xfil, $ar_stacol[$z]['mora_percent_2']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+26].$xfil, $ar_stacol[$z]['judicial_percent_2']);
	$xls->getActiveSheet()->SetCellValue($columna[$xcol+27].$xfil, $ar_stacol[$z]['vigente_percent_2']);

	$xls->getActiveSheet()->getStyle($columna[$xcol+16].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
	$xls->getActiveSheet()->getStyle($columna[$xcol+17].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
	$xls->getActiveSheet()->getStyle($columna[$xcol+18].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

	$xls->getActiveSheet()->getStyle($columna[$xcol+25].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
	$xls->getActiveSheet()->getStyle($columna[$xcol+26].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
	$xls->getActiveSheet()->getStyle($columna[$xcol+27].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

	if($ar_stacol[$z]['COD_VEN_RTC_JUNIOR']==301){
		$val_ofi_B=$ar_stacol[$z]['8'];
		$val_ofi_C=$ar_stacol[$z]['7'];
		$val_ofi_D=$ar_stacol[$z]['0'];
		$val_ofi_E=$ar_stacol[$z]['1'];
		$val_ofi_F=$ar_stacol[$z]['2'];
		$val_ofi_G=$ar_stacol[$z]['3'];
		$val_ofi_H=$ar_stacol[$z]['4'];
		$val_ofi_I=$ar_stacol[$z]['5'];
		$val_ofi_J=$ar_stacol[$z]['6'];
		$val_ofi_O=$ar_stacol[$z]['0_8'];
	}

  $xls->getActiveSheet()->getStyle($columna[$xcol+1].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+2].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+3].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+4].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+5].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+6].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+7].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+8].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+9].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

  $xls->getActiveSheet()->getStyle($columna[$xcol+11].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+12].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+13].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+14].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

  $xls->getActiveSheet()->getStyle($columna[$xcol+20].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+21].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+22].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
  $xls->getActiveSheet()->getStyle($columna[$xcol+23].$xfil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

  $xls->getActiveSheet()->getStyle($columna[$xcol+0].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+1].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+2].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+3].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+4].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+5].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+6].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+7].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+8].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+9].$xfil)->applyFromArray($border_thin_celeste);

  $xls->getActiveSheet()->getStyle($columna[$xcol+11].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+12].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+13].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+14].$xfil)->applyFromArray($border_thin_celeste);

  $xls->getActiveSheet()->getStyle($columna[$xcol+16].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+17].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+18].$xfil)->applyFromArray($border_thin_celeste);

  $xls->getActiveSheet()->getStyle($columna[$xcol+20].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+21].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+22].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+23].$xfil)->applyFromArray($border_thin_celeste);

  $xls->getActiveSheet()->getStyle($columna[$xcol+25].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+26].$xfil)->applyFromArray($border_thin_celeste);
  $xls->getActiveSheet()->getStyle($columna[$xcol+27].$xfil)->applyFromArray($border_thin_celeste);



  $xls->getActiveSheet()->getStyle($columna[$xcol+0].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+1].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+2].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+3].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+4].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+5].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+6].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+7].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+8].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+9].$xfil)->applyFromArray($fondo_celeste_clarisimo);

	$xls->getActiveSheet()->getStyle($columna[$xcol+11].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+12].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+13].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+14].$xfil)->applyFromArray($fondo_celeste_clarisimo);

	$xls->getActiveSheet()->getStyle($columna[$xcol+16].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+17].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+18].$xfil)->applyFromArray($fondo_celeste_clarisimo);

	$xls->getActiveSheet()->getStyle($columna[$xcol+20].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+21].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+22].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+23].$xfil)->applyFromArray($fondo_celeste_clarisimo);

	$xls->getActiveSheet()->getStyle($columna[$xcol+25].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+26].$xfil)->applyFromArray($fondo_celeste_clarisimo);
	$xls->getActiveSheet()->getStyle($columna[$xcol+27].$xfil)->applyFromArray($fondo_celeste_clarisimo);



  $xls->getActiveSheet()->getStyle($columna[$xcol+0].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+1].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+2].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+3].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+4].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+5].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+6].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+7].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+8].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+9].$xfil)->applyFromArray($font);

	$xls->getActiveSheet()->getStyle($columna[$xcol+11].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+12].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+13].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+14].$xfil)->applyFromArray($font);

	$xls->getActiveSheet()->getStyle($columna[$xcol+16].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+17].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+18].$xfil)->applyFromArray($font);

	$xls->getActiveSheet()->getStyle($columna[$xcol+20].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+21].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+22].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+23].$xfil)->applyFromArray($font);

	$xls->getActiveSheet()->getStyle($columna[$xcol+25].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+26].$xfil)->applyFromArray($font);
	$xls->getActiveSheet()->getStyle($columna[$xcol+27].$xfil)->applyFromArray($font);


}

$xls->getActiveSheet()->setCellValue('A'.($xfil+1),'TOTAL GENERAL');
$xls->getActiveSheet()->setCellValue('B'.($xfil+1),'=SUM(B6:B'.$xfil.')');
$xls->getActiveSheet()->setCellValue('C'.($xfil+1),'=SUM(C6:C'.$xfil.')');
$xls->getActiveSheet()->setCellValue('D'.($xfil+1),'=SUM(D6:D'.$xfil.')');
$xls->getActiveSheet()->setCellValue('E'.($xfil+1),'=SUM(E6:E'.$xfil.')');
$xls->getActiveSheet()->setCellValue('F'.($xfil+1),'=SUM(F6:F'.$xfil.')');
$xls->getActiveSheet()->setCellValue('G'.($xfil+1),'=SUM(G6:G'.$xfil.')');
$xls->getActiveSheet()->setCellValue('H'.($xfil+1),'=SUM(H6:H'.$xfil.')');
$xls->getActiveSheet()->setCellValue('I'.($xfil+1),'=SUM(I6:I'.$xfil.')');
$xls->getActiveSheet()->setCellValue('J'.($xfil+1),'=SUM(J6:J'.$xfil.')');

$xls->getActiveSheet()->setCellValue('L'.($xfil+1),'=SUM(L6:L'.$xfil.')');
$xls->getActiveSheet()->setCellValue('M'.($xfil+1),'=SUM(M6:M'.$xfil.')');
$xls->getActiveSheet()->setCellValue('N'.($xfil+1),'=SUM(N6:N'.$xfil.')');
$xls->getActiveSheet()->setCellValue('O'.($xfil+1),'=SUM(O6:O'.$xfil.')');

$xls->getActiveSheet()->setCellValue('U'.($xfil+1),'=SUM(U6:U'.$xfil.')');
$xls->getActiveSheet()->setCellValue('V'.($xfil+1),'=SUM(V6:V'.$xfil.')');
$xls->getActiveSheet()->setCellValue('W'.($xfil+1),'=SUM(W6:W'.$xfil.')');
$xls->getActiveSheet()->setCellValue('X'.($xfil+1),'=SUM(X6:X'.$xfil.')');

$xls->getActiveSheet()->getStyle('A'.($xfil+1).':J'.($xfil+1))->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle('A'.($xfil+1).':J'.($xfil+1))->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle('A'.($xfil+1).':J'.($xfil+1))->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle('L'.($xfil+1).':O'.($xfil+1))->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle('L'.($xfil+1).':O'.($xfil+1))->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle('L'.($xfil+1).':O'.($xfil+1))->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle('Q'.($xfil+1).':S'.($xfil+1))->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle('Q'.($xfil+1).':S'.($xfil+1))->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle('Q'.($xfil+1).':S'.($xfil+1))->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle('U'.($xfil+1).':X'.($xfil+1))->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle('U'.($xfil+1).':X'.($xfil+1))->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle('U'.($xfil+1).':X'.($xfil+1))->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle('Z'.($xfil+1).':AB'.($xfil+1))->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle('Z'.($xfil+1).':AB'.($xfil+1))->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle('Z'.($xfil+1).':AB'.($xfil+1))->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle('A'.($xfil+1).':J'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$xls->getActiveSheet()->getStyle('L'.($xfil+1).':O'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$xls->getActiveSheet()->getStyle('Q'.($xfil+1).':S'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$xls->getActiveSheet()->getStyle('U'.($xfil+1).':X'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$xls->getActiveSheet()->getStyle('Z'.($xfil+1).':AB'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);



$val_L = $xls->getActiveSheet()->getCell('L'.($xfil+1))->getCalculatedValue();
$val_M = $xls->getActiveSheet()->getCell('M'.($xfil+1))->getCalculatedValue();
$val_N = $xls->getActiveSheet()->getCell('N'.($xfil+1))->getCalculatedValue();

$val_O = $xls->getActiveSheet()->getCell('O'.($xfil+1))->getCalculatedValue();

$xls->getActiveSheet()->setCellValue('Q'.($xfil+1),'='.$val_L/$val_O);
$xls->getActiveSheet()->setCellValue('R'.($xfil+1),'='.$val_M/$val_O);
$xls->getActiveSheet()->setCellValue('S'.($xfil+1),'='.$val_N/$val_O);

$val_U = $xls->getActiveSheet()->getCell('U'.($xfil+1))->getCalculatedValue();
$val_V = $xls->getActiveSheet()->getCell('V'.($xfil+1))->getCalculatedValue();
$val_W = $xls->getActiveSheet()->getCell('W'.($xfil+1))->getCalculatedValue();
$val_X = $xls->getActiveSheet()->getCell('X'.($xfil+1))->getCalculatedValue();


$xls->getActiveSheet()->setCellValue('Z'.($xfil+1),'='.$val_U/$val_X);
$xls->getActiveSheet()->setCellValue('AA'.($xfil+1),'='.$val_V/$val_X);
$xls->getActiveSheet()->setCellValue('AB'.($xfil+1),'='.$val_W/$val_X);

$xls->getActiveSheet()->mergeCells("A4:A5");
$xls->getActiveSheet()->SetCellValue('A4',"CARTERA TOTAL US$");
$xls->getActiveSheet()->getStyle("A4:A5")->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle("A4:A5")->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle("A4:A5")->applyFromArray($font_header);
$xls->getActiveSheet()->getStyle('A4:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('A4:A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$xls->getActiveSheet()->mergeCells("B4:J4");
$xls->getActiveSheet()->SetCellValue('B4',"CARTERA EN MORA");

$xls->getActiveSheet()->getStyle("B4:J4")->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle("B4:J4")->applyFromArray($fondo_celeste_oscuro);
$xls->getActiveSheet()->getStyle("B4:J4")->applyFromArray($font_header);

$xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('B4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$xls->getActiveSheet()->getStyle('Q'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
$xls->getActiveSheet()->getStyle('R'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
$xls->getActiveSheet()->getStyle('S'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->getStyle('Z'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
$xls->getActiveSheet()->getStyle('AA'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
$xls->getActiveSheet()->getStyle('AB'.($xfil+1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('A2','GERENCIAL %');
$xls->getActiveSheet()->setCellValue('A3','SIN VENTAS OFICINA %');

// $xls->getActiveSheet()->mergeCells("L2:O2");
// $xls->getActiveSheet()->SetCellValue('L2',"GENERAL");
// $xls->getActiveSheet()->getStyle("L2:O2")->applyFromArray($border_thin_amarillo);
// $xls->getActiveSheet()->getStyle("L2:O2")->applyFromArray($fondo_amarillo);
// $xls->getActiveSheet()->getStyle("L2:O2")->applyFromArray($font_header_amarillo);
// $xls->getActiveSheet()->getStyle('L2:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $xls->getActiveSheet()->getStyle('L2:O2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$xls->getActiveSheet()->getStyle("A2")->applyFromArray($border_thin_amarillo);
$xls->getActiveSheet()->getStyle("A2")->applyFromArray($fondo_amarillo);
$xls->getActiveSheet()->getStyle("A2")->applyFromArray($font_header_amarillo);
$xls->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$xls->getActiveSheet()->getStyle("A3")->applyFromArray($border_thin_amarillo);
$xls->getActiveSheet()->getStyle("A3")->applyFromArray($fondo_amarillo);
$xls->getActiveSheet()->getStyle("A3")->applyFromArray($font_header_amarillo);
$xls->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$xls->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$val_B = $xls->getActiveSheet()->getCell('B'.($xfil+1))->getCalculatedValue();
$val_C = $xls->getActiveSheet()->getCell('C'.($xfil+1))->getCalculatedValue();
$val_D = $xls->getActiveSheet()->getCell('D'.($xfil+1))->getCalculatedValue();
$val_E = $xls->getActiveSheet()->getCell('E'.($xfil+1))->getCalculatedValue();
$val_F = $xls->getActiveSheet()->getCell('F'.($xfil+1))->getCalculatedValue();
$val_G = $xls->getActiveSheet()->getCell('G'.($xfil+1))->getCalculatedValue();
$val_H = $xls->getActiveSheet()->getCell('H'.($xfil+1))->getCalculatedValue();
$val_I = $xls->getActiveSheet()->getCell('I'.($xfil+1))->getCalculatedValue();
$val_J = $xls->getActiveSheet()->getCell('J'.($xfil+1))->getCalculatedValue();

$xls->getActiveSheet()->setCellValue('B2',$val_B/$val_O);
$xls->getActiveSheet()->getStyle('B2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('B3',($val_B-$val_ofi_B)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('B3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('C2',($val_C)/($val_O));
$xls->getActiveSheet()->getStyle('C2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('C3',($val_C-$val_ofi_C)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('C3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('D2',($val_D)/($val_O));
$xls->getActiveSheet()->getStyle('D2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('D3',($val_D-$val_ofi_D)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('D3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('E2',($val_E)/($val_O));
$xls->getActiveSheet()->getStyle('E2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('E3',($val_E-$val_ofi_E)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('E3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('F2',($val_F)/($val_O));
$xls->getActiveSheet()->getStyle('F2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('F3',($val_F-$val_ofi_F)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('F3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('G2',($val_G)/($val_O));
$xls->getActiveSheet()->getStyle('G2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('G3',($val_G-$val_ofi_G)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('G3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('H2',($val_H)/($val_O));
$xls->getActiveSheet()->getStyle('H2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('H3',($val_H-$val_ofi_H)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('H3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('I2',($val_I)/($val_O));
$xls->getActiveSheet()->getStyle('I2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('I3',($val_I-$val_ofi_I)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('I3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('J2',($val_J)/($val_O));
$xls->getActiveSheet()->getStyle('J2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->setCellValue('J3',($val_J-$val_ofi_J)/($val_O-$val_ofi_O));
$xls->getActiveSheet()->getStyle('J3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$xls->getActiveSheet()->getStyle("B2:J2")->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle("B2:J2")->applyFromArray($fondo_celeste);
$xls->getActiveSheet()->getStyle("B2:J2")->applyFromArray($font_percent);

$xls->getActiveSheet()->getStyle("B3:J3")->applyFromArray($border_thin_celeste);
$xls->getActiveSheet()->getStyle("B3:J3")->applyFromArray($fondo_celeste);
$xls->getActiveSheet()->getStyle("B3:J3")->applyFromArray($font_percent);

// $xls->getActiveSheet()->mergeCells("L2:O2");
// $xls->getActiveSheet()->SetCellValue('L2',"GENERAL");
// $xls->getActiveSheet()->getStyle("L2:O2")->applyFromArray($border_thin_amarillo);
// $xls->getActiveSheet()->getStyle("L2:O2")->applyFromArray($fondo_amarillo);
// $xls->getActiveSheet()->getStyle("L2:O2")->applyFromArray($font_header_amarillo);
// $xls->getActiveSheet()->getStyle('L2:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $xls->getActiveSheet()->getStyle('L2:O2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// $xls->getActiveSheet()->mergeCells("L3:O3");
// $xls->getActiveSheet()->SetCellValue('L3',"SIN VENTAS OFICINA");
// $xls->getActiveSheet()->getStyle("L3:O3")->applyFromArray($border_thin_amarillo);
// $xls->getActiveSheet()->getStyle("L3:O3")->applyFromArray($fondo_amarillo);
// $xls->getActiveSheet()->getStyle("L3:O3")->applyFromArray($font_header_amarillo);
// $xls->getActiveSheet()->getStyle('L3:O3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// $xls->getActiveSheet()->getStyle('L3:O3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$xls->getActiveSheet()->getRowDimension(1)->setRowHeight(0);


# FIN

$date = new DateTime($fecha_envio);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="GERENCIAL PENDIENTES '.$date->format('Y-m-d H.i.s').' Grupo Andina.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
exit();

?>
