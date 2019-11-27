<?php
require_once '../../../conexion/config.php';
require_once '../../../conexion/MSSQLConnectionPDO.php';
require_once '../../../factory/FactoryConnection.php';
require_once '../html2pdf/numletras.php';

$factoryConnection = FactoryConnection::create('mssql');
$connection = $factoryConnection->getConnection();

$mes="";

switch(date("n")){
    case 1:
        $mes = "Enero";
    break;
    case 2:
        $mes = "Febrero";
    break;
    case 3:
        $mes = "Marzo";
    break;
    case 4:
        $mes = "Abril";
    break;
    case 5:
        $mes = "Mayo";
    break;
    case 6:
        $mes = "Junio";
    break;
    case 7:
        $mes = "Julio";
    break;
    case 8:
        $mes = "Agosto";
    break;
    case 9:
        $mes = "Septiembre";
    break;
    case 10:
        $mes = "Octubre";
    break;
    case 11:
        $mes = "Noviembre";
    break;
    case 12:
        $mes = "Diciembre";
    break;
    default:
        echo "No se Causa";
    break;
}

$fecha_actual="Lima, ".date("d")." de ".$mes." de ".date("Y");


ob_start();

$rtc = $_GET['rtc'];
$zona = $_GET['zona'];

$sp = " EXECUTE SP_GERENCIAL
        '0002','$zona',NULL,NULL,NULL,'0001','$rtc',
        '0003','$zona',NULL,NULL,NULL,'0001','$rtc',
        '0004','$zona',NULL,NULL,NULL,'0001','$rtc',
        '0016','$zona',NULL,NULL,NULL,'0000','$rtc';";

//echo $sp;
//exit();

// $sp = " EXECUTE SP_GERENCIAL
//         '0002', '','20104860762',NULL,NULL,'0001','319',
//         '0003', '','20104860762',NULL,NULL,'0001','319',
//         '0004', '','20104860762',NULL,NULL,'0001','319',
//         '0016', '','20104860762',NULL,NULL,'0000','319';";

// $sp = " EXECUTE SP_GERENCIAL
//         '0002',NULL,'00010236742',NULL,NULL,'0001','319',
//         '0003',NULL,'00010236742',NULL,NULL,'0001','319',
//         '0004',NULL,'00010236742',NULL,NULL,'0001','319',
//         '0016',NULL,'00010236742',NULL,NULL,'0000','319';";

// $sp = " EXECUTE SP_GERENCIAL
//         '0002',NULL,'20104860762',NULL,NULL,'0001','319',
//         '0003',NULL,'20104860762',NULL,NULL,'0001','319',
//         '0004',NULL,'20104860762',NULL,NULL,'0001','319',
//         '0016',NULL,'20104860762',NULL,NULL,'0000','319';";

$pr = $connection->prepare($sp);
$pr->execute();
$arrgerencial=$pr->fetchAll(PDO::FETCH_ASSOC);

$ar_unicos = array();
for($a=0;$a<=count($arrgerencial)-1;$a++){
    array_push($ar_unicos, $arrgerencial[$a]['COD_CLIENTE']);
}

$ar_unicos = array_values(array_unique($ar_unicos));

// print_r($ar_unicos);

for($b=0;$b<=count($ar_unicos)-1;$b++){
    $cod_cliente = $ar_unicos[$b];

    $sqlcli = "SELECT LTRIM(RTRIM(RUC)) AS RUC,LTRIM(RTRIM(CLIENTE)) AS CLIENTE,LTRIM(RTRIM(DIRECCION)) AS DIRECCION,LTRIM(RTRIM(REPRESENTANTE)) AS REPRESENTANTE FROM BASE_CLIENTE WHERE RUC = '$cod_cliente'";
    $prcli = $connection->prepare($sqlcli);
    $prcli->execute();
    $arrcli=$prcli->fetchAll(PDO::FETCH_ASSOC);

    $cliente        = $arrcli[0]['CLIENTE'];
    $ruc            = $arrcli[0]['RUC'];
    $direccion      = $arrcli[0]['DIRECCION'];
    $representante  = $arrcli[0]['REPRESENTANTE'];

    include('../html/HTMLConfirmCartas.php');


    include('../html/HTMLCuentasBancarias.php');

    // for($c=0;$c<=count($arrgerencial)-1;$c++){
    //     if($cod_cliente==$arrgerencial[$c]['COD_CLIENTE']){

    //     }
    // }
}





$content = ob_get_clean();

require_once('../html2pdf/html2pdf.class.php');
try{
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
    $html2pdf->setTestTdInOnePage(false);
    $html2pdf->pdf->SetTitle('Confirmación de Cartas');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

    $fecha_envio=date('Y-m-d H:i:s');
    $date = new DateTime($fecha_envio);
    $html2pdf->Output('Cartas_'.$date->format('Y-m-d H.i.s').'.pdf');
} catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}

?>