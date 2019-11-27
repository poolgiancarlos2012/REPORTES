<?php

    require('../../../conexion/config.php');
    require_once '../../../conexion/MYSQLConnectionPDO.php';
    require_once '../../../factory/FactoryConnection.php';
    require '../numletras.php';
    
    $factoryConnection = FactoryConnection::create('mysql');
    $connection = $factoryConnection->getConnection();
    
    
    

    $ope=$_GET['ope'];

    if($ope=='ckbx'){
        //necesito los ids va a ver un for que recorra cada id y crear carpeta unica y guarde ahi luego comprima luego descargue


        $codigo=$_GET['codigo'];
        $td=$_GET['td'];

        //DOCUMENTO
        $sqldoc="   SELECT 
                    iddocumento,
                    codage,ctd,numser,numdoc,documento,razon_social,codigo_cliente,ruc,direccion,remision,
                    fecha_emi,fecha_venc,nropedido,cond_pago,repre_ventas,tot_ope_inaf,tot_ope_exo,tot_ope_grat,
                    sum_igv,impo_tot,firm_dig,docum_modif,denominacion,emitido,motivo,moneda,idcliente 
                    FROM 
                    sfw.documento WHERE 
                    iddocumento='$codigo' AND 
                    ctd='$td'
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

        $numerosito=utf8_decode($numletras->ValorEnLetras($n,""));

        //DETALLE DOCUMENTO

        $sqldetdoc="  SELECT TRUNCATE(cant, 2) AS cant,codpro,um,prod,precio AS precio,precio_i AS precio_i,dscto AS dscto,subtot AS subtot FROM sfw.detalle_documento WHERE iddocumento=$codigo AND ctd='$td' ORDER BY numdoc,item,prod;";

        $prdetdoc = $connection->prepare($sqldetdoc);
        $prdetdoc->execute();
        $datadetdoc=$prdetdoc->fetchAll(PDO::FETCH_ASSOC);
        
        ob_start();
        include(dirname(__FILE__).'/res/HTMLReporteNotaCredito.php');
        $content = ob_get_clean();

        // convert to PDF
        require_once(dirname(__FILE__).'/../html2pdf.class.php');
        try
        {

            $conf = parse_ini_file('../../../conf/cobrast.ini', true);
            //echo $conf['ruta_cobrast']['document_root_cobrast']; // /opt/lampp/htdocs/SFW
            //echo __FILE__; // /opt/lampp/htdocs/SFW/reporte/pdf/file/ReporteFactura.php

            $directorio=$_GET['diretory'];

            $carpeta = $conf['ruta_cobrast']['document_root_cobrast'].'/reporte/pdf/Documentos/'.$directorio;
            if (!file_exists($carpeta)) {
                mkdir($carpeta);
            }


            $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

            $filepdf='Documento_'.$codage.$ctd.$numser.$numdoc;
            //$html2pdf->Output($conf['ruta_cobrast']['document_root_cobrast'].'/reporte/pdf/Documentos/'.$directorio.'/Documento_'.$codage.$ctd.$numser.$numdoc.'.pdf','F');
            $html2pdf->Output($conf['ruta_cobrast']['document_root_cobrast'].'/reporte/pdf/Documentos/'.$directorio.'/'.$filepdf.'.pdf','F');
            
            //BUSCAR EL NOMBRE DE CADA PDF EN LA RUTA DE LOS XML Y LOS AGREGA/COPIA LA CARPETA QUE SERA COMPIRMIDA
            $ruta_xml = "/home/poolpg/Documentos/DOCUMS/";
            $destino=$conf['ruta_cobrast']['document_root_cobrast'].'/reporte/pdf/Documentos/'.$directorio.'/xml/';
            foreach(glob($ruta_xml.$filepdf.'.zip') as $file) {
                if (!file_exists($destino)) {
                    mkdir($destino);
                }
                $filxmlzip= str_replace($ruta_xml, "", $file); // OBTIENE NOMBRE DEL ARCHIVO ZIP BUSCADO
                copy($ruta_xml.$filxmlzip, $destino.$filxmlzip); // COPIAS EN LA RUTA DE LA CARPETA A COMPIRMIR
            }



        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }

    }else if($ope=='id'){
        //necesito los 4 datos solo para vista individual
        $xcodage = $_GET['xcodage'];
        $xctd =$_GET['xctd'];
        $xnumser=$_GET['xnumser'];
        $xnumdoc=$_GET['xnumdoc'];
        $xruc=$_GET['xruc'];

        //DOCUMENTO
        $sqldoc="   SELECT 
                    iddocumento,
                    codage,ctd,numser,numdoc,documento,razon_social,codigo_cliente,ruc,direccion,remision,
                    fecha_emi,fecha_venc,nropedido,cond_pago,repre_ventas,tot_ope_inaf,tot_ope_exo,tot_ope_grat,
                    sum_igv,impo_tot,firm_dig,docum_modif,denominacion,emitido,motivo,moneda,idcliente 
                    FROM 
                    sfw.documento WHERE 
                    codage='$xcodage' AND 
                    ctd='$xctd' AND 
                    numser='$xnumser' AND 
                    numdoc='$xnumdoc' AND 
                    ruc='$xruc';";

        $prdoc = $connection->prepare($sqldoc);
        $prdoc->execute();
        $datadoc=$prdoc->fetchAll(PDO::FETCH_ASSOC);

        $documento=$datadoc[0]['documento'];
        //$fecha_emision=$datadoc[0]['fecha_emi'];
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

        $numerosito=utf8_decode($numletras->ValorEnLetras($n,""));

        //DETALLE DOCUMENTO

        $sqldetdoc="  SELECT TRUNCATE(cant, 2) AS cant,codpro,um,prod,precio AS precio,precio_i AS precio_i,dscto AS dscto,subtot AS subtot FROM sfw.detalle_documento WHERE codage='$xcodage' AND ctd='$xctd' AND numser='$xnumser' AND numdoc='$xnumdoc' ORDER BY numdoc,item,prod;";

        $prdetdoc = $connection->prepare($sqldetdoc);
        $prdetdoc->execute();
        $datadetdoc=$prdetdoc->fetchAll(PDO::FETCH_ASSOC);
        
        ob_start();
        include(dirname(__FILE__).'/res/HTMLReporteNotaCredito.php');
        $content = ob_get_clean();

        // convert to PDF
        require_once(dirname(__FILE__).'/../html2pdf.class.php');
        try
        {


            $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Documento_'.$xcodage.$xctd.$xnumser.$xnumdoc.'.pdf');
            //$html2pdf->Output(dirname(__FILE__).'/Documento_'.$xcodage.$xctd.$xnumser.$xnumdoc.'.pdf','F');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }

    }

    
    
    
    
