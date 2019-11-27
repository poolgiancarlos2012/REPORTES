<?PHP

ini_set('include_path', ini_get('include_path') . ';E:/Proyectos/REPORTES/phpincludes/phpexcel/Classes/');
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

$columna = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ");

$font = array(
	'font' => array(
		'bold' => true,
		'color' => array('rgb' => '000000'),
		'size' => 8,
		'name' => 'Verdana'
		));
$title = array(
	'font' => array(
		'bold' => true,
		'color' => array('rgb' => '000000'),
		'size' => 13,
		'name' => 'Verdana'
		));
$font_cabe_blue = array(
	'font' => array(
		'bold' => true,
		'color' => array('rgb' => '002060'),
		'size' => 10,
		'name' => 'Verdana'
		));
$font_header = array(
	'font' => array(
		'bold' => true,
		'color' => array('rgb' => '002060'),
		'size' => 8,
		'name' => 'Verdana'
		));
$font_empresa_blue = array(
	'font' => array(
		'bold' => true,
		'color' => array('rgb' => '1F4E78'),
		'size' => 10,
		'name' => 'Verdana'
		));
$font_subtotal = array(
	'font' => array(
		'bold' => true,
		'color' => array('rgb' => '000000'),
		'size' => 10,
		'name' => 'Verdana'
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

// CORREO_ENVIO ESTADO
// 1 ENVIADO
// 2 ERROR AL ENVIAR
// 3 NO SE ENVIO SE REBAJO ANTES DE ENVIAR

// $fecha_envio = date('Y-m-d H:i:s');

$sqldatenow = "	SELECT CONVERT(VARCHAR(19), GETDATE(), 120) AS FECHA_ENVIO ";
$prdatenow = $connection->prepare($sqldatenow);
$prdatenow->execute();
$ar_datenow = $prdatenow->fetchAll(PDO::FETCH_ASSOC);

$fecha_envio = $ar_datenow[0]['FECHA_ENVIO'];

// echo $fecha_envio;

$sqlasunto = "	SELECT
			IDCORREO_ASUNTO,
			ASUNTO,
			CUERPO,
			CONVERT(DATE, FECHA_PROGRAMADO) AS FECHA_PROGRAMADO,
			CASE ESTADO
			WHEN 1 THEN 'ACTIVO'
			ELSE 'INACTIVO'
			END AS  ESTADO
			FROM
			CORREO_ASUNTO
			WHERE ESTADO=1 AND
			CONVERT(DATE, FECHA_PROGRAMADO) >= CONVERT(DATE, GETDATE())";
$prasunto = $connection->prepare($sqlasunto);
$prasunto->execute();
$dataasunto = $prasunto->fetchAll(PDO::FETCH_ASSOC);




if (!empty($dataasunto) AND count($dataasunto) == 1) {

	$cuerpo = $dataasunto[0]['CUERPO'];

	$sqlCli = " SELECT TOP 10 CODIGO_CLIENTE,CORREO FROM CORREO_ENVIO WHERE FECHA_ENVIO IS NULL  ORDER BY CODIGO_CLIENTE ASC ";
	$prCli = $connection->prepare($sqlCli);
	$prCli->execute();
	$ar_Cli = $prCli->fetchAll(PDO::FETCH_ASSOC);

	if (count($ar_Cli) > 0) {

		for ($i = 0; $i <= count($ar_Cli) - 1; $i++) {

			$cliExistDeu = $ar_Cli[$i]['CODIGO_CLIENTE'];
			$cliExistCorr = $ar_Cli[$i]['CORREO'];

			$sqlexistDeuda = "	SP_ACCOUNT_STATUS
							'0002'  ,
							'0003'  ,
							'0004'  ,
							'0005'  ,
							'0006'  ,
							'0007'  ,
							'0016'  ,
							'0017'  ,
							'$cliExistDeu' ,
							1";

			$prexistDeuda = $connection->prepare($sqlexistDeuda);
			$prexistDeuda->execute();
			$ar_existDeuda = $prexistDeuda->fetchAll(PDO::FETCH_ASSOC);

			if (count($ar_existDeuda) > 0) {

				$xls = new PHPExcel();
				$xls->setActiveSheetIndex(0)->setTitle("ESTADO_CUENTA");
				$xls->getActiveSheet()->mergeCells("C2:I2");
				$xls->getActiveSheet()->SetCellValue("C2", "DOCUMENTOS PENDIENTES POR CLIENTE");
				$xls->getActiveSheet()->getStyle('C2')->applyFromArray($title);
				$xls->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$xls->getActiveSheet()->SetCellValue("J2", $fecha_envio);
				$xls->getActiveSheet()->mergeCells("J2:K2");
				$xls->getActiveSheet()->getStyle('J2')->applyFromArray($font);
				$xls->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


				$datoscli = "	SELECT
							COD_CLIENTE,
							CLIENTE,
							COD_VEND,
							VENDEDOR
							FROM
							VIEW_ALL_CLIENT_ACTIVE
							WHERE
							COD IN ('0002','0003','0004','0016') AND
							COD_CLIENTE = '$cliExistDeu' AND
							CLIENTE <> '' AND
							COD_VEND <> '' AND
							VENDEDOR <> ''
							GROUP BY COD_CLIENTE, CLIENTE, COD_VEND, VENDEDOR ";
				$prdatoscli = $connection->prepare($datoscli);
				$prdatoscli->execute();
				$ar_datoscli = $prdatoscli->fetchAll(PDO::FETCH_ASSOC);

				$contvend = 4;
				for ($j = 0; $j <= count($ar_datoscli) - 1; $j++) {
					$xls->getActiveSheet()->SetCellValue("A4", "CLIENTE: " . $ar_datoscli[$j]['CLIENTE']);
					$xls->getActiveSheet()->SetCellValue("A5", "NRO DOCUMENTO: " . $ar_datoscli[$j]['COD_CLIENTE']);
					$xls->getActiveSheet()->getStyle('A4')->applyFromArray($font_cabe_blue);
					$xls->getActiveSheet()->getStyle('A5')->applyFromArray($font_cabe_blue);
					$xls->getActiveSheet()->SetCellValue("I" . $contvend, "RESPONSABLE: " . $ar_datoscli[$j]['COD_VEND'] . " - " . $ar_datoscli[$j]['VENDEDOR']);
					$xls->getActiveSheet()->getStyle('I' . $contvend)->applyFromArray($font_cabe_blue);
					$contvend++;
				}


				$fil = 8;
				$col = 0;

				$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
				$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(15);
				$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(13);
				$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(13);
				$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(5);
				$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(16);
				$xls->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(16);
				$xls->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(13);
				$xls->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(13);

				$sqldocumentos = "	SP_ACCOUNT_STATUS
								'0002'  ,
								'0003'  ,
								'0004'  ,
								'0005'  ,
								'0006'  ,
								'0007'  ,
								'0016'  ,
								'0017'  ,
								'$cliExistDeu' ,
								1 ";
				$prdocumentos = $connection->prepare($sqldocumentos, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$prdocumentos->execute();

				$cod="";
				$nroreg=0;

				/**************DEUDAS****************/

				$totaldolares=0;
				$totalsoles=0;

				$caisacsoles=0;$caisacdolares=0;$cantcaisac=0; // 0002 COMERCIAL ANDINA INDUSTRIAL SAC
				$andexsoles=0;$andexdolares=0;$cantandex=0; // 0003 GRUPO ANDEX
				$semillassoles=0;$semillasdolares=0;$cantsemillas=0; // 0004 FERTILIZANTES Y SEMILLAS ANDINA
				$sunnysoles=0;$sunnydolares=0;$cantsunny=0; // 0016 SUNNY VALLEY S.A.C.

				$caisac2soles=0;$caisac2dolares=0;$cantcaisac2=0; // 0005 CAISAC II
				$andex2soles=0;$andex2dolares=0;$cantandex2=0; // 0006 ANDEX II
				$semillas2soles=0;$semillas2dolares=0;$cantsemillas2=0; // 0007 SEMILLAS II
				$sunny2soles=0;$sunny2dolares=0;$cantsunny2=0; // 0016 SUNNY VALLEY S.A.C. II

				$gasoles=0;$gadolares=0;$cantga=0; // 0009 GRUPO ANDINA SAC
				$sa_ga_soles = 0; $sa_ga_dolares = 0;

				/**************CASTIGADOS****************/

				$sa_totalsoles = 0;
				$sa_totaldolares = 0;

				$sa_caisac_soles = 0; $sa_caisac_dolares = 0;
				$sa_andex_soles = 0; $sa_andex_dolares = 0;
				$sa_semillas_soles = 0; $sa_semillas_dolares = 0;
				$sa_sunny_soles = 0; $sa_sunny_dolares = 0;

				$sa_caisac2_soles = 0; $sa_caisac2_dolares = 0;
				$sa_andex2_soles = 0; $sa_andex2_dolares = 0;
				$sa_semillas2_soles = 0; $sa_semillas2_dolares = 0;
				$sa_sunny2_soles = 0; $sa_sunny2_dolares = 0;

				$total_sa_general_soles = 0;
				$total_sa_general_dolares = 0;


//				$cantreg=$prdocumentos->rowCount();
				$cantreg=count($ar_existDeuda);

				while ($datos_muestra = $prdocumentos->fetch(PDO::FETCH_ASSOC)) {
					$fil++;
					$nroreg++;
					if ($datos_muestra['CODIGO_EMPRESA'] == '0002') {
						$cantcaisac++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$caisacdolares = $caisacdolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$caisacsoles = $caisacsoles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_caisac_dolares = $sa_caisac_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_caisac_soles = $sa_caisac_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0003') {
						$cantandex++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$andexdolares = $andexdolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$andexsoles = $andexsoles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_andex_dolares = $sa_andex_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_andex_soles = $sa_andex_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0004') {
						$cantsemillas++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$semillasdolares = $semillasdolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$semillassoles = $semillassoles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_semillas_dolares = $sa_semillas_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_semillas_soles = $sa_semillas_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0005') {
						$cantcaisac2++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$caisac2dolares = $caisac2dolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$caisac2soles = $caisac2soles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_caisac2_dolares = $sa_caisac2_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_caisac2_soles = $sa_caisac2_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0006') {
						$cantandex2++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$andex2dolares = $andex2dolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$andex2soles = $andex2soles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_andex2_dolares = $sa_andex2_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_andex2_soles = $sa_andex2_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0007') {
						$cantsemillas2++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$semillas2dolares = $semillas2dolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$semillas2soles = $semillas2soles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_semillas2_dolares = $sa_semillas2_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_semillas2_soles = $sa_semillas2_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0009') {
						$cantga++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$gadolares = $gadolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$gasoles = $gasoles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_ga_dolares = $sa_ga_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_ga_soles = $sa_ga_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0016') {
						$cantsunny++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$sunnydolares = $sunnydolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sunnysoles = $sunnysoles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_sunny_dolares = $sa_sunny_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_sunny_soles = $sa_sunny_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($datos_muestra['CODIGO_EMPRESA'] == '0017') {
						$cantsunny++;
						if ($datos_muestra["TD"] == 'FT' || $datos_muestra["TD"] == 'BV' || $datos_muestra["TD"] == 'ND' || $datos_muestra["TD"] == 'LT' || $datos_muestra["TD"] == 'TK') {
							if ($datos_muestra["MONEDA"] == 'US') {
								$sunny2dolares = $sunny2dolares + $datos_muestra["SALDO"];
								$totaldolares = $totaldolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sunny2soles = $sunny2soles + $datos_muestra["SALDO"];
								$totalsoles = $totalsoles + $datos_muestra["SALDO"];
							}
						}
						if($datos_muestra["TD"] == 'PA' ){
							if ($datos_muestra["MONEDA"] == 'US') {
								$sa_sunny2_dolares = $sa_sunny2_dolares + $datos_muestra["SALDO"];
								$total_sa_general_dolares = $total_sa_general_dolares + $datos_muestra["SALDO"];
							} else if ($datos_muestra["MONEDA"] == 'MN') {
								$sa_sunny2_soles = $sa_sunny2_soles + $datos_muestra["SALDO"];
								$total_sa_general_soles = $total_sa_general_soles + $datos_muestra["SALDO"];
							}
						}
					}
					if ($cod != $datos_muestra['CODIGO_EMPRESA']) {
						if ($fil == 9) {
							$fil = $fil + 1;
							$emp = $datos_muestra['CODIGO_EMPRESA'];
							$sqlempresa = " SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
							$prempresa = $connection->prepare($sqlempresa);
							$prempresa->execute();
							$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil - 1), $empresa[0]['NOMBRE']);
							$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil - 1))->applyFromArray($font_empresa_blue);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
							$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
							$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
							$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
							$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
							$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
							$fil = $fil + 1;
						} else {
							if ($cod == '0002') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisacdolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisacsoles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE ANDEX */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = " SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0003') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andexdolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andexsoles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0004') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillasdolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillassoles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0005') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisac2dolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisac2soles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0006') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andex2dolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andex2soles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0007') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillas2dolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillas2soles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0009') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $gadolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $gasoles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0016') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunnydolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunnysoles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							} else if ($cod == '0017') {
								$fil = $fil + 1;
								$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
								$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
								$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunny2dolares);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								$fil = $fil + 1;
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunny2soles);
								$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
								/* NOMBRE DE SEMILLAS */
								$fil = $fil + 2;
								$emp = $datos_muestra['CODIGO_EMPRESA'];
								$sqlempresa = "SELECT RTRIM(LTRIM(AC_CNOMCIA)) AS NOMBRE FROM RSFACCAR..ALCIAS WHERE RTRIM(LTRIM(AC_CCIA))='$emp'";
								$prempresa = $connection->prepare($sqlempresa);
								$prempresa->execute();
								$empresa = $prempresa->fetchAll(PDO::FETCH_ASSOC);
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . ($fil), $empresa[0]['NOMBRE']);
								$xls->getActiveSheet()->getStyle($columna[$col + 0] . ($fil))->applyFromArray($font_empresa_blue);
								$fil = $fil + 1;
								$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, "TD");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 1] . $fil, "DOCUMENTO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, "FEC.EMISION");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, "FEC.VENCI.");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, "TRANSC");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, "MO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, "IMPORTE");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, "SALDO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, "ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, "DET.ESTADO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, "BANCO");
								$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, "NUM.COBRA.");
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_morado_claro);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($font_header);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								$fil = $fil + 0;
							}
							$fil = $fil + 1;
						}
					}

					$xls->getActiveSheet()->SetCellValue($columna[$col + 0] . $fil, $datos_muestra["TD"]);
					$xls->getActiveSheet()->setCellValueExplicit($columna[$col + 1] . $fil, $datos_muestra["DOCUMENTO"], PHPExcel_Cell_DataType::TYPE_STRING);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 2] . $fil, $datos_muestra["FEC_EMISION"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 3] . $fil, $datos_muestra["FEC_VENCI"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, $datos_muestra["TRANSC"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 5] . $fil, $datos_muestra["MONEDA"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 6] . $fil, $datos_muestra["IMPORTE"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 7] . $fil, $datos_muestra["SALDO"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 8] . $fil, $datos_muestra["ESTADO"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $datos_muestra["DET_ESTADO"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 10] . $fil, $datos_muestra["BANCO"]);
					$xls->getActiveSheet()->SetCellValue($columna[$col + 11] . $fil, $datos_muestra["NUM_COBRA"]);
					$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($fondo_claro);
					$xls->getActiveSheet()->getStyle('A' . $fil . ':L' . $fil)->applyFromArray($border_thin);
					$xls->getActiveSheet()->getStyle($columna[$col + 0] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$xls->getActiveSheet()->getStyle($columna[$col + 5] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
					$xls->getActiveSheet()->getStyle($columna[$col + 6] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

					$cod = $datos_muestra['CODIGO_EMPRESA'];


					if ($nroreg == $cantreg) {

						if ($cod == '0002') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisacdolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisacsoles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0003') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andexdolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andexsoles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0004') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillasdolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillassoles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0005') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisac2dolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $caisac2soles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0006') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andex2dolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $andex2soles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0007') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillas2dolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $semillas2soles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0009') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $gadolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $gasoles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0016') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunnydolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunnysoles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						if ($cod == '0017') {
							$fil = $fil + 2;
							$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
							$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL POR EMPRESA");
							$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunny2dolares);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
							$fil = $fil + 1;
							$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
							$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$xls->getActiveSheet()->getStyle($columna[$col + 9])->applyFromArray($font_subtotal);
							$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $sunny2soles);
							$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						}
						$fil = $fil + 3;
						$xls->getActiveSheet()->mergeCells("A" . $fil . ":C" . $fil);
						$xls->getActiveSheet()->getStyle('A' . $fil)->applyFromArray($font_subtotal);
						$xls->getActiveSheet()->SetCellValue('A' . $fil, "TOTAL GENERAL");
						$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
						$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'US');
						$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($border_mefium);
						$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
						$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $totaldolares);
						$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
						$fil = $fil + 1;
						$xls->getActiveSheet()->getStyle($columna[$col + 4])->applyFromArray($font_subtotal);
						$xls->getActiveSheet()->SetCellValue($columna[$col + 4] . $fil, 'MN');
						$xls->getActiveSheet()->getStyle($columna[$col + 4] . $fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($border_mefium);
						$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->applyFromArray($font_subtotal);
						$xls->getActiveSheet()->SetCellValue($columna[$col + 9] . $fil, $totalsoles);
						$xls->getActiveSheet()->getStyle($columna[$col + 9] . $fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
					}
				}

//				$date = new DateTime($fecha_envio);
//				header('Content-Type: application/vnd.ms-excel');
//				header('Content-Disposition: attachment;filename="Estado de Cuenta '.$cliExistDeu.' --- ' . $date->format('Y-m-d H.i.s') . '.xlsx"');
//				header('Cache-Control: max-age=0');
//				$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
//				$objWriter->save('php://output');
//				exit();

				$date = new DateTime($fecha_envio);
				$xls->setActiveSheetIndex(0);
				$objWriter = new PHPExcel_Writer_Excel2007($xls);
				$namefile = 'Estado-Cuenta - '.$cliExistDeu.' '.$date->format('Y-m-d H.i.s').'.xlsx';
				$objWriter->save('E:/Proyectos/REPORTES/documento/correo_masivo/'.$namefile);

				// SE GUARDA EXCEL

				// CORREO

				$totalsoles    = $caisacsoles+$andexsoles+$semillassoles+$sunnysoles;
				$totaldolares = $caisacdolares+$andexdolares+$semillasdolares+$sunnydolares;

				$sa_totalsoles    = $sa_caisac_soles+$sa_andex_soles+$sa_semillas_soles+$sa_sunny_soles;
				$sa_totaldolares = $sa_caisac_dolares+$sa_andex_dolares+$sa_semillas_dolares+$sa_sunny_dolares;

				$CAISAC_DEUDA_Y_CASTIGADOS_SOLES			= 0;
				$ANDEX_DEUDA_Y_CASTIGADOS_SOLES			= 0;
				$SEMILLAS_DEUDA_Y_CASTIGADOS_SOLES		= 0;
				$SUNNY_DEUDA_Y_CASTIGADOS_SOLES			= 0;

				$CAISAC_DEUDA_Y_CASTIGADOS_DOLARES		= 0;
				$ANDEX_DEUDA_Y_CASTIGADOS_DOLARES		= 0;
				$SEMILLAS_DEUDA_Y_CASTIGADOS_DOLARES		= 0;
				$SUNNY_DEUDA_Y_CASTIGADOS_DOLARES		= 0;

				$TOTAL_DEUDA_Y_CASTIGADOS_SOLES = 0;
				$TOTAL_DEUDA_Y_CASTIGADOS_DOLARES = 0;

				$CAISAC_DEUDA_Y_CASTIGADOS_SOLES		= $caisacsoles+$caisac2soles;
				$ANDEX_DEUDA_Y_CASTIGADOS_SOLES		= $andexsoles+$andex2soles;
				$SEMILLAS_DEUDA_Y_CASTIGADOS_SOLES	= $semillassoles+$semillas2soles;
				$SUNNY_DEUDA_Y_CASTIGADOS_SOLES		= $sunnysoles+$sunny2soles;

				$CAISAC_DEUDA_Y_CASTIGADOS_DOLARES	= $caisacdolares+$caisac2dolares;
				$ANDEX_DEUDA_Y_CASTIGADOS_DOLARES	= $andexdolares+$andex2dolares;
				$SEMILLAS_DEUDA_Y_CASTIGADOS_DOLARES	= $semillasdolares+$semillas2dolares;
				$SUNNY_DEUDA_Y_CASTIGADOS_DOLARES	= $sunnydolares+$sunny2dolares;

				$CAISAC_DEUDA_Y_CASTIGADOS_SA_SOLES		= $sa_caisac_soles+$sa_caisac2_soles;
				$ANDEX_DEUDA_Y_CASTIGADOS_SA_SOLES		= $sa_andex_soles+$sa_andex2_soles;
				$SEMILLAS_DEUDA_Y_CASTIGADOS_SA_SOLES		= $sa_semillas_soles+$sa_semillas2_soles;
				$SUNNY_DEUDA_Y_CASTIGADOS_SA_SOLES		= $sa_sunny_soles+$sa_sunny2_soles;

				$CAISAC_DEUDA_Y_CASTIGADOS_SA_DOLARES	= $sa_caisac_dolares+$sa_caisac2_dolares;
				$ANDEX_DEUDA_Y_CASTIGADOS_SA_DOLARES		= $sa_andex_dolares+$sa_andex2_dolares;
				$SEMILLAS_DEUDA_Y_CASTIGADOS_SA_DOLARES	= $sa_semillas_dolares+$sa_semillas2_dolares;
				$SUNNY_DEUDA_Y_CASTIGADOS_SA_DOLARES		= $sa_sunny_dolares+$sa_sunny2_dolares;

				$TOTAL_DEUDA_Y_CASTIGADOS_SOLES = $CAISAC_DEUDA_Y_CASTIGADOS_SOLES+$ANDEX_DEUDA_Y_CASTIGADOS_SOLES+$SEMILLAS_DEUDA_Y_CASTIGADOS_SOLES+$SUNNY_DEUDA_Y_CASTIGADOS_SOLES;
				$TOTAL_DEUDA_Y_CASTIGADOS_DOLARES = $CAISAC_DEUDA_Y_CASTIGADOS_DOLARES+$ANDEX_DEUDA_Y_CASTIGADOS_DOLARES+$SEMILLAS_DEUDA_Y_CASTIGADOS_DOLARES+$SUNNY_DEUDA_Y_CASTIGADOS_DOLARES;

				$TOTAL_DEUDA_Y_CASTIGADOS_SA_SOLES = $CAISAC_DEUDA_Y_CASTIGADOS_SA_SOLES+$ANDEX_DEUDA_Y_CASTIGADOS_SA_SOLES+$SEMILLAS_DEUDA_Y_CASTIGADOS_SA_SOLES+$SUNNY_DEUDA_Y_CASTIGADOS_SA_SOLES;
				$TOTAL_DEUDA_Y_CASTIGADOS_SA_DOLARES = $CAISAC_DEUDA_Y_CASTIGADOS_SA_DOLARES+$ANDEX_DEUDA_Y_CASTIGADOS_SA_DOLARES+$SEMILLAS_DEUDA_Y_CASTIGADOS_SA_DOLARES+$SUNNY_DEUDA_Y_CASTIGADOS_SA_DOLARES;

				$resumensaldo = '	<!-- [if gte mso 9]><xml>
								<o:shapedefaults v:ext="edit" spidmax="1026" />
								</xml><![endif]--><!-- [if gte mso 9]><xml>
								<o:shapelayout v:ext="edit">
								<o:idmap v:ext="edit" data="1" />
								</o:shapelayout></xml><![endif]-->
								<div class="WordSection1">
								<table class="MsoNormalTable" align="center" style="margin: 0 auto;width: 450.0pt; border-collapse: collapse;" border="0" width="429" cellspacing="0" cellpadding="0">
								<tbody>

									<tr style="height: 16.5pt;">
										<td style="width: 60.0pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 16.5pt;" valign="bottom" nowrap="nowrap" width="80">&nbsp;</td>
										<td style="width: 262.0pt; border: solid #9BC2E6 1.0pt; background: #5B9BD5; padding: 0cm 3.5pt 0cm 3.5pt; height: 16.5pt;" colspan="5" width="349">
											<p class="MsoNormal" style="text-align: center;margin:3px;" align="center"><strong><span style="font-size: 12.0pt; font-family: Arial,sans-serif; color: white; mso-fareast-language: ES-PE;">RESUMEN DEUDA</span></strong></p>
										</td>
									</tr>

									<tr style="height: 15.75pt;">
									<td style="width: 60.0pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" valign="bottom" nowrap="nowrap" width="80">&nbsp;</td>
									<td style="width: 88.0pt; border-top: none; border-left: solid #9BC2E6 1.0pt; border-bottom: solid #9BC2E6 1.0pt; border-right: none; background: #9BC4EA; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;width: 86px;margin:0;" align="center"><strong><span style="font-size: 8pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">COMERCIAL<br>ANDINA<br>SAC</span></strong></p>
									</td>
									<td style="width: 88.0pt; border-top: none; border-left: solid #9BC2E6 1.0pt; border-bottom: solid #9BC2E6 1.0pt; border-right: none; background: #9BC4EA; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;width: 86px;margin:0;" align="center"><strong><span style="font-size: 8pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">GRUPO<br>ANDEX<br>SAC</span></strong></p>
									</td>
									<td style="width: 88.0pt; border-top: none; border-left: solid #9BC2E6 1.0pt; border-bottom: solid #9BC2E6 1.0pt; border-right: none; background:#9BC4EA; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;width: 86px;margin:0;" align="center"><strong><span style="font-size: 8pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">FERTILIZANTES Y SEMILLAS ANDINAS SAC</span></strong></p>
									</td>
									<td style="width: 88.0pt; border-top: none; border-left: solid #9BC2E6 1.0pt; border-bottom: solid #9BC2E6 1.0pt; border-right: none; background:#9BC4EA; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;width: 86px;margin:0;" align="center"><strong><span style="font-size: 8pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">SUNNY<br>VALLEY<br>SAC</span></strong></p>
									</td>
									<td style="width: 88pt; border-top: none; border-left: solid #9BC2E6 1.0pt; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #9BC4EA; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="109">
									<p class="MsoNormal" style="text-align: center;width: 86px;margin:0;" align="center"><strong><span style="font-size: 8pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">TOTAL</span></strong></p>
									</td>
									</tr>

									<tr style="height: 15.75pt;">
									<td style="width: 130pt; border: solid #9BC2E6 1.0pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: left;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">DEUDA S/.</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($CAISAC_DEUDA_Y_CASTIGADOS_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($ANDEX_DEUDA_Y_CASTIGADOS_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SEMILLAS_DEUDA_Y_CASTIGADOS_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SUNNY_DEUDA_Y_CASTIGADOS_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 82.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="109">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($TOTAL_DEUDA_Y_CASTIGADOS_SOLES,2,'.',','). '</span></strong></p>
									</td>
									</tr>

									<tr style="height: 15.75pt;">
									<td style="width: 170pt; border: solid #9BC2E6 1.0pt; border-top: none; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: left;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">DEUDA $</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($CAISAC_DEUDA_Y_CASTIGADOS_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($ANDEX_DEUDA_Y_CASTIGADOS_DOLARES,2,'.',','). '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SEMILLAS_DEUDA_Y_CASTIGADOS_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SUNNY_DEUDA_Y_CASTIGADOS_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 82.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="109">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($TOTAL_DEUDA_Y_CASTIGADOS_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									</tr>

									<tr style="height: 15.75pt;">
									<td style="width: 170pt; border: solid #9BC2E6 1.0pt; border-top: none; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: left;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">A FAVOR S/.</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($CAISAC_DEUDA_Y_CASTIGADOS_SA_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($ANDEX_DEUDA_Y_CASTIGADOS_SA_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SEMILLAS_DEUDA_Y_CASTIGADOS_SA_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SUNNY_DEUDA_Y_CASTIGADOS_SA_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 82.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="109">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($TOTAL_DEUDA_Y_CASTIGADOS_SA_SOLES,2,'.',',') . '</span></strong></p>
									</td>
									</tr>

									<tr style="height: 15.75pt;">
									<td style="width: 170pt; border: solid #9BC2E6 1.0pt; border-top: none; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: left;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">A FAVOR $</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($CAISAC_DEUDA_Y_CASTIGADOS_SA_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($ANDEX_DEUDA_Y_CASTIGADOS_SA_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SEMILLAS_DEUDA_Y_CASTIGADOS_SA_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 60.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; background: #CDE7FF; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="80">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($SUNNY_DEUDA_Y_CASTIGADOS_SA_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									<td style="width: 82.0pt; border-top: none; border-left: none; border-bottom: solid #9BC2E6 1.0pt; border-right: solid #9BC2E6 1.0pt; padding: 0cm 3.5pt 0cm 3.5pt; height: 15.75pt;" width="109">
									<p class="MsoNormal" style="text-align: center;margin:0;" align="center"><strong><span style="font-size: 9.0pt; font-family: Arial,sans-serif; color: black; mso-fareast-language: ES-PE;">' . number_format($TOTAL_DEUDA_Y_CASTIGADOS_SA_DOLARES,2,'.',',') . '</span></strong></p>
									</td>
									</tr>

								</tbody>
								</table>
								</div>';

				$sql_correo = "	SELECT
							CORREO,
							CLIENTE,
							(SELECT TOP 1 COD_ZONA FROM VIEW_ALL_CLIENT_ACTIVE WHERE COD IN ('0002','0003','0004','0016') AND COD_CLIENTE = '$cliExistDeu' AND CLIENTE <> '' AND COD_VEND <> '' AND VENDEDOR <> '' GROUP BY COD_ZONA) AS COD_ZONA
							FROM
							CORREO_ENVIO
							WHERE
							IDCORREO_ASUNTO = 1 AND
							FECHA_ENVIO IS NULL AND
							CODIGO_CLIENTE = '$cliExistDeu'  AND CORREO = '$cliExistCorr' ";

				$prcorreo = $connection->prepare($sql_correo);
				$prcorreo -> execute();
				$ar_correo = $prcorreo->fetchAll(PDO::FETCH_ASSOC);
				for($k=0; $k<= count($ar_correo)-1; $k++ ){

					$correo     = $ar_correo[0]['CORREO'];
					$cliente     = $ar_correo[0]['CLIENTE'];
					$cod_zona = $ar_correo[0]['COD_ZONA'];

					$body_vendedor = "";
					$body_telefono1 = "";
					$body_telefono2 = "";
					$body_correo = "";
					$datogestor = "";

					// SUPUESTAMNETE LOS VENDEDORES CREADOS EN CAISAC SE REPLICAN EN LA DEMAS EMPRESAS

					if($cod_zona == '306' || $cod_zona == '30601'){

						$sqlcod_vend = " SELECT TOP 1 COD_VEND FROM VIEW_ALL_CLIENT_ACTIVE WHERE COD_CLIENTE = '$cliExistDeu' GROUP BY COD_VEND ";
						$prcod_vend = $connection->prepare($sqlcod_vend);
						$prcod_vend->execute();
						$arr_cod_vend=$prcod_vend->fetchAll(PDO::FETCH_ASSOC);

						$codigo_vendedor = $arr_cod_vend[0]['COD_VEND'];

						// SUPUESTAMNETE LOS VENDEDORES CREADOS EN CAISAC SE REPLICAN EN LA DEMAS EMPRESAS

						$sqlVendedor = "	SELECT
										VE_DATOS AS VENDEDOR,
										VE_CELULAR1 AS CELL1,
										VE_CELULAR2 AS CELL2,
										VE_CEMAIL AS CORREO
										FROM
										FT0002VEND WHERE VE_CCODIGO = '$codigo_vendedor' ";

						$prVendedor = $connection->prepare($sqlVendedor);
						$prVendedor->execute();
						$datos_vendor=$prVendedor->fetchAll(PDO::FETCH_ASSOC);

						$body_vendedor = isset($datos_vendor[0]['VENDEDOR']) ? $datos_vendor[0]['VENDEDOR'] : '';
						$body_telefono1 = isset($datos_vendor[0]['CELL1']) ? $datos_vendor[0]['CELL1'] : '';
						$body_telefono2 = isset($datos_vendor[0]['CELL2']) ? ' - '.$datos_vendor[0]['CELL2'] : '';
						$body_correo      = $datos_vendor[0]['CORREO'];

						$datogestor =$body_vendedor.', al Tel�fono: (51) (1) 253-6444, al movil(es): '.$body_telefono1.$body_telefono2.', al correo: '.$body_correo;


					}else{

						$sqlVendedor = "	SELECT
										RTRIM(LTRIM(RTC.VEND)) AS VENDEDOR,
										LTRIM(RTRIM(CELL1)) AS CELL1,
										LTRIM(RTRIM(CELL2)) AS CELL2,
										RTRIM(LTRIM(RTC.CORREO)) AS CORREO
										FROM
										FT0002ZONV ZON
										LEFT JOIN (SELECT ZU.COD_ZONA,USU.VE_DATOS AS 'VEND',USU.VE_CCODIGO AS 'COD_VEN',USU.VE_CEMAIL AS CORREO, VE_CELULAR1 AS CELL1, VE_CELULAR2 AS CELL2 FROM FT0002VEND USU INNER JOIN USUARIO_PERFIL UPER ON USU.VE_DNI=UPER.DNI INNER JOIN ZONA_USUARIO ZU ON ZU.IDUSUARIO_PERFIL=UPER.IDUSUARIO_PERFIL WHERE UPER.IDTIPO_USUARIO=8 AND USU.VE_CTIPVEN='V' AND UPER.ESTADO=1 AND ZU.ESTADO=1) AS RTC ON ZON.ZV_CCODZON=RTC.COD_ZONA
										LEFT JOIN (SELECT ZU.COD_ZONA,PER.DATOS AS 'PROMOTOR' FROM PERSONAL PER INNER JOIN USUARIO_PERFIL UPER ON PER.DNI=UPER.DNI INNER JOIN ZONA_USUARIO ZU ON ZU.IDUSUARIO_PERFIL=UPER.IDUSUARIO_PERFIL WHERE UPER.IDTIPO_USUARIO=9 AND PER.ESTADO=1 AND ZU.ESTADO=1) AS PRO ON PRO.COD_ZONA=RTC.COD_ZONA
										WHERE
										ZON.ZV_CESTADO=1 AND
										RTRIM(LTRIM(ZON.ZV_CCODZON)) = '$cod_zona'
										GROUP BY RTRIM(LTRIM(RTC.VEND)),LTRIM(RTRIM(CELL1)),LTRIM(RTRIM(CELL2)),RTRIM(LTRIM(RTC.CORREO)) "; //HAY ZONAS QUE TIENEN MAS DE 1 VENDEDOR POR ESO SE ELE AGRUPA SI VIENEN REPETIDOS EN EL CASO DE 2 PROMOTORES PARA LA ZONA 319 , 306

						$prVendedor = $connection->prepare($sqlVendedor);
						$prVendedor->execute();
						$datos_vendor=$prVendedor->fetchAll(PDO::FETCH_ASSOC);

						$body_vendedor = isset($datos_vendor[0]['VENDEDOR']) ? $datos_vendor[0]['VENDEDOR'] : '';
						$body_telefono1 = isset($datos_vendor[0]['CELL1']) ? $datos_vendor[0]['CELL1'] : '';
						$body_telefono2 = isset($datos_vendor[0]['CELL2']) ? ' - '.$datos_vendor[0]['CELL2'] : '';
						$body_correo      = $datos_vendor[0]['CORREO'];

//						if($cod_zona == '300'){
//							$datogestor =' al Tel�fono: (51) (1) 253-6444, al movil(es): '.$body_telefono1.$body_telefono2.', al correo: '.$body_correo;
//						}else{
//							$datogestor =$body_vendedor.', al Tel�fono: (51) (1) 253-6444, al movil(es): '.$body_telefono1.$body_telefono2.', al correo: '.$body_correo;
//						}

						$datogestor =$body_vendedor.', al Tel&eacute;fono: (51) (1) 253-6444, al movil(es): '.$body_telefono1.$body_telefono2.', al correo: '.$body_correo;

					}

					$cuentas="";
					$cuentas.='<table cellspacing="0" cellpadding="0" style="width:100%;background-color:#FFFFFF;">';

						###CAISAC###

						$cuentas.='<tr>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">COMERCIAL ANDINA INDUSTRIAL S.A.C.</td>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">RUC: 20108772884</td>';
						$cuentas.='</tr>';

						#BCP

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;">&nbsp;BANCO DE CREDITO DEL PERU</td>';
						$cuentas.='</tr>';

						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;194-0091402-0-51</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;194-0078937-1-51</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;002-194-000091402051-96</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;002-194-000078937151-95</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';

						#BBVA

						#*********309(PANDURO)*********#

						if($cod_zona==309){

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;border-top: 2px solid #FFFFFF;">&nbsp;BANCO CONTINENTAL</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;0011-0181-59-0100018085</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;011-181000100018085-59</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';

						}

						#BANCO DE LA NACION

						#*********318(AYACUCHO)*********#

						if($cod_zona==318){

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;border-top: 2px solid #FFFFFF;">&nbsp;BANCO DE LA NACI&Oacute;N</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00-000-307343</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;018-000-000000307343-04</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';

						}

						###ANDEX###

						$cuentas.='<tr>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">GRUPO ANDEX S.A.C.</td>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">RUC: 20509808717</td>';
						$cuentas.='</tr>';

						#BCP

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;">&nbsp;BANCO DE CREDITO DEL PERU</td>';
						$cuentas.='</tr>';

						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;193-1486853-0-15</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;193-1534935-1-02</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00219300148685301516</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00219300153493510211</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';

						#BBVA

						#*********309(PANDURO)*********#

						if($cod_zona==309){
							$cuentas.='<tr>';
							$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;border-top: 2px solid #FFFFFF;">&nbsp;BANCO CONTINENTAL</td>';
							$cuentas.='</tr>';

							$cuentas.='<tr>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;0011-0181-0100020918-57</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
							$cuentas.='</tr>';
							$cuentas.='<tr>';
							$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
							$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;0011-0181-0100020675-53</td>';
							$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
							$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
							$cuentas.='</tr>';
							$cuentas.='<tr>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;011-181-000100020918-57</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
							$cuentas.='</tr>';
							$cuentas.='<tr>';
							$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
							$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;011-181-000100020675-53</td>';
							$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
							$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
							$cuentas.='</tr>';
						}

						#BANCO DE LA NACION

						#*********318(AYACUCHO)*********#

						if($cod_zona==318){
							$cuentas.='<tr>';
							$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;border-top: 2px solid #FFFFFF;">&nbsp;BANCO DE LA NACI&Oacute;N</td>';
							$cuentas.='</tr>';

							$cuentas.='<tr>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00-091-005239</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
							$cuentas.='</tr>';
							$cuentas.='<tr>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;018-091-000091005239-98</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
							$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
							$cuentas.='</tr>';
						}

						###SEMILLAS###

						$cuentas.='<tr>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">FERTILIZANTES Y SEMILLAS ANDINAS S.A.C.</td>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">RUC: 20512706577</td>';
						$cuentas.='</tr>';

						#BCP

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;">&nbsp;BANCO DE CREDITO DEL PERU</td>';
						$cuentas.='</tr>';

						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;193-1709352-0-81</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;193-1711289-1-56</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00219300170935208119</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00219300171128915613</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';

						#BBVA

						#*********309(PANDURO)*********#

						if($cod_zona==309){
						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;border-top: 2px solid #FFFFFF;">&nbsp;BANCO CONTINENTAL</td>';
						$cuentas.='</tr>';

						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;0011-0181-53-0100018069</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;0011-0181-0100023054-58</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;011-181000100018069-53</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;011-181-000100023054-58</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';
						}

						#BANCO DE LA NACION

						#*********318(AYACUCHO)*********#

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;border-top: 2px solid #FFFFFF;">&nbsp;BANCO DE LA NACI&Oacute;N</td>';
						$cuentas.='</tr>';

						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE(DETRACI&Oacute;N) N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00-058-009008</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';

						###SUNNY###

						$cuentas.='<tr>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">SUNNY VALLEY S.A.C.</td>';
						$cuentas.='<td colspan=2 style="background-color:black;color:white;border-bottom: 2px solid white;font-family: Arial, Times, serif;text-align:center;font-size: 10px;font-weight: bold;">RUC: 20524869714</td>';
						$cuentas.='</tr>';

						#BCP

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;">&nbsp;BANCO DE CREDITO DEL PERU</td>';
						$cuentas.='</tr>';

						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;194-2360303043</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;194-2344261113</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;002-194002360303043-90</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';
						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;C&Oacute;DIGO DE CUENTA INTERBANCARIO</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;002-194002344261113-95</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#C4C4C4;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">D&oacute;lares Americanos</td>';
						$cuentas.='</tr>';

						#BANCO DE LA NACION

						$cuentas.='<tr>';
						$cuentas.='<td colspan=4 style="background-color:#747474;color:white;font-family: Arial, Times, serif;text-align:left;font-size: 10px;font-weight: bold;border-bottom: 2px solid #FFFFFF;">&nbsp;BANCO DE LA NACI&Oacute;N</td>';
						$cuentas.='</tr>';

						$cuentas.='<tr>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;CTA. CORRIENTE N&deg;</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;00-058-040703</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:black;font-weight: bold;font-size: 10px;text-align: left;font-family: Arial, Times, serif;height:13px;border-right:2px solid #FFFFFF;">&nbsp;MONEDA</td>';
						$cuentas.='<td style="background-color:#E1E1E1;color:white;color:black;font-weight: bold;font-size: 10px;text-align: center;font-family: Arial, Times, serif;height:13px;">Nuevos Soles</td>';
						$cuentas.='</tr>';

					$cuentas.='</table>';



					$buscarfe = array("January","February","March","April","May","June","July","August","September","October","November","December",",");
					$cambiafe = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","");

					$layout = file_get_contents('E:/Proyectos/REPORTES/tarea/layout/layout_correo.php');
					$buscar = array("cuerpomensaje");
					$cambiar = array($cuerpo);
					$speechini = str_replace($buscar, $cambiar, $layout);

					$buscars = array("datofecha","datogestor","datocliente", "tablaresumen","xcuentas");

					// $fecha_al=date('d/m/Y');

					$sqldatenowdeu = "	SELECT CONVERT(VARCHAR(19), GETDATE(), 103) AS FECHA_ENVIODEU ";
					$prdatenowdeu = $connection->prepare($sqldatenowdeu);
					$prdatenowdeu->execute();
					$ar_datenowdeu = $prdatenowdeu->fetchAll(PDO::FETCH_ASSOC);

					$fecha_al = $ar_datenowdeu[0]['FECHA_ENVIODEU'];

					$date = str_replace('/', '-', $fecha_al);
					$fecha_hasta =date('Y/m/d', strtotime($date));
					$fecha_al_deu = date("d", strtotime($fecha_hasta))." de ".$cambiafe[intval(date("m", strtotime($fecha_hasta)))-1]." del ".date("Y", strtotime($fecha_hasta));

					// echo $fecha_al_deu;

					$cambias = array($fecha_al_deu,$datogestor,$cliente,$resumensaldo,$cuentas);
					$speechnuevo = str_replace($buscars, $cambias, $speechini);

					$objMailer = new PHPMailer();
					$objMailer->SMTPAuth = true;
					$objMailer->WordWrap = 50;
					$objMailer->SMTPDebug  = 1;
					$objMailer->Mailer = 'smtp';
					$objMailer->Host = 'smtp.gmail.com';
					$objMailer->Timeout = 120;
					$objMailer->SMTPSecure = "tls";
					$objMailer->IsHTML(true);
					$objMailer->IsSMTP();
					$objMailer->CharSet = "utf-8";
					$objMailer->Port = '587';
					$objMailer->Username = 'informes@grupoandina.com.pe';
					$objMailer->From = 'informes@grupoandina.com.pe';
					$objMailer->Password = 'grupoandina';
					$objMailer->FromName = 'Grupo Andina S.A.C.';
					$objMailer->Subject = "Grupo Andina - Estado de Cuenta al ".$fecha_al_deu;
					$objMailer->Body = $speechnuevo;
					$objMailer->AddAttachment('E:/Proyectos/REPORTES/documento/correo_masivo/'.$namefile,$namefile);

					$objMailer->ClearAddresses();
					// comentar para prueba ini
					$objMailer->AddBCC($body_correo);
					if($body_correo=='jsaldana@grupoandina.com.pe'){
						$objMailer->AddBCC('cfeijoo@grupoandina.com.pe');
					}
					//  comentar para prueba fin


					$objMailer->AddAddress($correo);

					$status = 0;
					if(!$objMailer->send()) {
						echo "<br>"."Problemas al enviado ".$correo."<br>"."\n";
						$status = 2; // problems to send message
					} else {
						echo "<br>"."enviado ".$correo."<br>"."\n";
						$status = 1; // send message good
					}



					$send_mail = " INSERT INTO CORREO_ENVIO_HISTORICO(CODIGO_CLIENTE,CORREO,FECHA_ENVIO,ESTADO) VALUES('$cliExistDeu','$correo',GETDATE(),$status) ";
					$prsend_mail = $connection->prepare($send_mail);
					$prsend_mail -> execute();

					$updateSendMail = " UPDATE CORREO_ENVIO SET FECHA_ENVIO= GETDATE() WHERE CODIGO_CLIENTE= '$cliExistDeu' AND CORREO = '$correo'  ";
					$prupdateSendMail = $connection->prepare($updateSendMail);
					$prupdateSendMail -> execute();

				}

			} else {
				$disableSendMassiveMailCliente = " UPDATE CORREO_ENVIO SET FECHA_ENVIO=GETDATE(),ESTADO = 3 WHERE IDCORREO_ASUNTO=1";
				$prdisableSendMassiveMailCliente = $connection->prepare($disableSendMassiveMailCliente);
				$prdisableSendMassiveMailCliente->execute();
				echo "Tarea : 'Estado de Cuenta' Se deshabilito Correos del Cliente: $cliExistDeu ya que se rebajo antes del envio masivo  \n";
			}
		}
	} else {
		$disableSendMassiveMail = " UPDATE CORREO_ASUNTO SET ESTADO = 0 WHERE IDCORREO_ASUNTO=1";
		$prdisableSendMassiveMail = $connection->prepare($disableSendMassiveMail);
		$prdisableSendMassiveMail->execute();
		echo "Tarea : 'Estado de Cuenta' Se deshabilito por que se envio todas y ya no hay deudas \n";
	}
} else {
//	echo "Tarea : 'Estado de Cuenta' esta Desactivado � Tiene fecha programada para otro dia";
}
?>
