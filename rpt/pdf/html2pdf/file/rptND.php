<?php
require('../../../conexion/config.php');
require_once '../../../conexion/MYSQLConnectionPDO.php';
require_once '../../../factory/FactoryConnection.php';
require '../numletras.php';

$factoryConnection = FactoryConnection::create('mysql');
$connection = $factoryConnection->getConnection();

$iddocumento=$_GET['iddocumento'];
$unique=$_GET['unique'];

//DOCUMENTO
$sqldoc="   SELECT 
            iddocumento,
            codage,ctd,numser,numdoc,documento,razon_social,codigo_cliente,ruc,direccion,remision,
            fecha_emi,fecha_venc,nropedido,cond_pago,repre_ventas,tot_ope_inaf,tot_ope_exo,tot_ope_grat,
            sum_igv,impo_tot,firm_dig,docum_modif,denominacion,emitido,motivo,moneda,idcliente 
            FROM 
            sfw.documento WHERE 
            iddocumento='$iddocumento'
            ";

$prdoc = $connection->prepare($sqldoc);
$prdoc->execute();
$datadoc=$prdoc->fetchAll(PDO::FETCH_ASSOC);




$codage=$datadoc[0]['codage'];
$ctd=$datadoc[0]['ctd'];
$numser=$datadoc[0]['numser'];
$numdoc=$datadoc[0]['numdoc'];
$documento=$datadoc[0]['documento'];
$fecha_emision_n=$datadoc[0]['fecha_emi'];
$fecha_emision=explode("/", $datadoc[0]['fecha_emi']);
$fecha_emision_dia=$fecha_emision[0];
$fecha_emision_mes=$fecha_emision[1];
$fecha_emision_anio=$fecha_emision[2];

$nropedido=$datadoc[0]['nropedido'];

$cond_pago=$datadoc[0]['cond_pago'];
$fecha_venc=$datadoc[0]['fecha_venc'];
$repre_ventas=$datadoc[0]['repre_ventas'];

$razon_social=$datadoc[0]['razon_social'];
$ruc=$datadoc[0]['ruc'];
$direccion=$datadoc[0]['direccion'];
$codigo_cliente=$datadoc[0]['codigo_cliente'];
$remision=$datadoc[0]['remision'];

$sum_igv=$datadoc[0]['sum_igv'];
$impo_tot=$datadoc[0]['impo_tot'];
$firm_dig=$datadoc[0]['firm_dig'];

$docum_modif=$datadoc[0]['docum_modif'];
$denominacion=$datadoc[0]['denominacion'];
$emitido=$datadoc[0]['emitido'];
$motivo=$datadoc[0]['motivo'];
$moneda=$datadoc[0]['moneda'];

$numletras= new EnLetras();
$n=$impo_tot; 

$numerosito=utf8_decode($numletras->ValorEnLetras(abs($n),""));

//DETALLE DOCUMENTO

$sqldetdoc="  SELECT TRUNCATE(cant, 2) AS cant,codpro,um,prod,precio AS precio,dscto AS dscto,subtot AS subtot FROM sfw.detalle_documento WHERE iddocumento=$iddocumento ORDER BY numdoc,item,prod;";

$prdetdoc = $connection->prepare($sqldetdoc);
$prdetdoc->execute();
$datadetdoc=$prdetdoc->fetchAll(PDO::FETCH_ASSOC);

ob_start();
include(dirname(__FILE__).'/res/HTMLReporteNotaDebito.php');
$content = ob_get_clean();

// convert to PDF
require_once(dirname(__FILE__).'/../html2pdf.class.php');
try
{

    $conf = parse_ini_file('../../../conf/cobrast.ini', true);


    $carpeta = $conf['ruta_cobrast']['document_root_cobrast'].'/reporte/pdf/Documentos/';
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }


    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $filepdf='Documento_'.$codage.$ctd.$numser.$numdoc.'-'.$unique;
    $html2pdf->Output($conf['ruta_cobrast']['document_root_cobrast'].'/reporte/pdf/Documentos/'.$filepdf.'.pdf','F');
    
   


}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>