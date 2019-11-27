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



$fecha_envio=date('Y-m-d H:i:s');

$xls = new PHPExcel();
$xls->setActiveSheetIndex(0)->setTitle("DIRECCION CLIENTE");

$fil=1;
$col=0;

$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil, 'COD');
$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, 'EMPRESA');
$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil, 'COD_CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, 'CLIENTE');
$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, 'DEPARTAMENTO');
$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil, 'PROVINCIA');
$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, 'DISTRITO');
$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, 'DIRECCION');
$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, 'ESTADO');

$xls->getActiveSheet()->getStyle('A'.$fil.':I'.$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);

$sql = "    SELECT
            COD,
            EMPRESA,
            COD_CLIENTE,
            CLIENTE,
            CASE COD
                            WHEN '0002' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0002CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0005' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0005CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0003' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0003CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0006' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0006CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0004' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0004CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0007' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0007CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0009' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0009CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0016' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0016CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                            WHEN '0017' THEN (SELECT LTRIM(RTRIM(CL_CDEPT)) FROM RSFACCAR..FT0017CLIE WHERE CL_CCODCLI = COD_CLIENTE)
            ELSE ''
            END AS 'DEPARTAMENTO',
            CASE COD
                        WHEN '0002' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0002CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0005' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0005CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0003' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0003CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0006' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0006CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0004' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0004CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0007' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0007CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0009' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0009CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0016' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0016CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0017' THEN (SELECT LTRIM(RTRIM(CL_CPROV)) FROM RSFACCAR..FT0017CLIE WHERE CL_CCODCLI = COD_CLIENTE)

            ELSE ''
            END AS 'PROVINCIA',
            CASE COD
                            WHEN '0002' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0002TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0005' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0005TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0003' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0003TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0006' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0006TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0004' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0004TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0007' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0007TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0009' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0009TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0016' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0016TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
                            WHEN '0017' THEN ((SELECT LTRIM(RTRIM(TG_CDESCRI)) FROM RSFACCAR..AL0017TABL WHERE TG_CCOD='A2' AND TG_CCLAVE=CL_CUBIGEO))
            ELSE ''
            END AS 'DISTRITO',
            CASE COD
                        WHEN '0002' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0002CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0005' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0005CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0003' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0003CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0006' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0006CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0004' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0004CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0007' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0007CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0009' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0009CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0016' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0016CLIE WHERE CL_CCODCLI = COD_CLIENTE)
                        WHEN '0017' THEN (SELECT LTRIM(RTRIM(CL_CDIRCLI)) FROM RSFACCAR..FT0017CLIE WHERE CL_CCODCLI = COD_CLIENTE)
            ELSE ''
            END AS 'DIRECCION',
            ESTADO
            FROM VIEW_ALL_CLIENT_ACTIVE WHERE COD IN ('0002','0003','0004','0016')";

// // echo $sqlliqui;

$pr = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$pr->execute();

while($datos_muestra=$pr->fetch(PDO::FETCH_ASSOC)) {

	$fil=$fil+1;

    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+0].$fil, $datos_muestra['COD'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil, $datos_muestra['EMPRESA']);
    $xls->getActiveSheet()->setCellValueExplicit($columna[$col+2].$fil, $datos_muestra['COD_CLIENTE'],PHPExcel_Cell_DataType::TYPE_STRING);
    $xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil, $datos_muestra['CLIENTE']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil, $datos_muestra['DEPARTAMENTO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil, $datos_muestra['PROVINCIA']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil, $datos_muestra['DISTRITO']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil, $datos_muestra['DIRECCION']);
    $xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil, $datos_muestra['ESTADO']);

}

$date = new DateTime($fecha_envio);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Direccion Cliente --- '.$date->format('Y-m-d H.i.s').'.xlsx"');
// header('Content-Disposition: attachment;filename="Historico Detalle Documento.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
exit();

?>