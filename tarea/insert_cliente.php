<?php
session_start();

require_once 'E:/Proyectos/REPORTES/conexion/config.php';
require_once 'E:/Proyectos/REPORTES/conexion/MSSQLConnectionPDO.php';
require_once 'E:/Proyectos/REPORTES/factory/FactoryConnection.php';

$factoryConnection = FactoryConnection::create('mssql');
$connection = $factoryConnection->getConnection();

$exiscli0002 = "	SELECT
					LTRIM(RTRIM(CL_CCODCLI)) AS RUC,
					LTRIM(RTRIM(CL_CNOMCLI)) AS CLIENTE,
					LTRIM(RTRIM(CL_CZONVTA)) AS COD_ZONA,
					(SELECT LTRIM(RTRIM(ZV_CNOMZON))  FROM RSFACCAR..FT0002ZONV LEFT OUTER JOIN RSFACCAR..AL0002TRAN ON ZV_CCODTRA = TR_CCODIGO WHERE ZV_CCODZON= FT0002CLIE.CL_CZONVTA) AS ZONA,
					LTRIM(RTRIM(CL_CVENDE)) AS COD_VEN_RTC_JUNIOR,
					(SELECT LTRIM(RTRIM(VE_CNOMBRE)) FROM FT0002VEND WHERE VE_CCODIGO= FT0002CLIE.CL_CVENDE) AS RTC,
					LTRIM(RTRIM(CL_CDIRCLI)) AS DIRECCION,
					LTRIM(RTRIM(CL_CDEPT)) AS DEPARTAMENTO,
					LTRIM(RTRIM(CL_CPROV)) AS PROVINCIA,
					(SELECT LTRIM(RTRIM(TG_CDESCRI)) From RSFACCAR..AL0002TABL Where TG_CCOD='A2' And TG_CCLAVE=CL_CUBIGEO) AS DISTRITO
					FROM FT0002CLIE 
					WHERE 
					-- CAST(CL_DFECCRE AS DATE) = CAST(GETDATE() AS DATE)
					CAST(CL_DFECCRE AS DATE) >= CAST('2018-05-20' AS DATE)
					";

$prexiscli0002 = $connection->prepare($exiscli0002);
$prexiscli0002->execute();
$ar_count0002 = $prexiscli0002->fetchAll(PDO::FETCH_ASSOC);
if(count($ar_count0002)>0){
	for ($i=0; $i <= count($ar_count0002)-1 ; $i++){
		$ruc0002      			= $ar_count0002[$i]['RUC'];
		$cliente0002  			= $ar_count0002[$i]['CLIENTE'];
		$cod_zona0002 			= $ar_count0002[$i]['COD_ZONA'];
		$zona0002     			= $ar_count0002[$i]['ZONA'];
		$cod_ven_rtc_junior0002 = $ar_count0002[$i]['COD_VEN_RTC_JUNIOR'];
		$rtc0002      			= $ar_count0002[$i]['RTC'];

		$dire0002      			= $ar_count0002[$i]['DIRECCION'];
		$dept0002      			= $ar_count0002[$i]['DEPARTAMENTO'];
		$prov0002      			= $ar_count0002[$i]['PROVINCIA'];
		$dist0002      			= $ar_count0002[$i]['DISTRITO'];



		$consulcli = "SELECT COUNT(*) AS 'COUNT' FROM BASE_CLIENTE WHERE RUC = '$ruc0002'";
		$prconsul = $connection->prepare($consulcli);
		$prconsul->execute();
		$ar_consult = $prconsul->fetchAll(PDO::FETCH_ASSOC);
		if($ar_consult[0]['COUNT'] == 0){
			$insertcli = "INSERT BASE_CLIENTE(RUC,CLIENTE,COD_ZONA,ZONA,COD_VEN_RTC_JUNIOR,RTC,DIRECCION,DEPARTAMENTO,PROVINCIA,DISTRITO) VALUES ('$ruc0002','$cliente0002','$cod_zona0002','$zona0002','$cod_ven_rtc_junior0002','$rtc0002','$dire0002','$dept0002','$prov0002','$dist0002') ";
			$prinsertcli = $connection->prepare($insertcli);
			$prinsertcli->execute();
			echo "INSERTO 0002 = ".$ruc0002."<br> \t";
		}
	}
}

$exiscli0003 = "	SELECT
					LTRIM(RTRIM(CL_CCODCLI)) AS RUC,
					LTRIM(RTRIM(CL_CNOMCLI)) AS CLIENTE,
					LTRIM(RTRIM(CL_CZONVTA)) AS COD_ZONA,
					(SELECT LTRIM(RTRIM(ZV_CNOMZON))  FROM RSFACCAR..FT0003ZONV LEFT OUTER JOIN RSFACCAR..AL0003TRAN ON ZV_CCODTRA = TR_CCODIGO WHERE ZV_CCODZON= FT0003CLIE.CL_CZONVTA) AS ZONA,
					LTRIM(RTRIM(CL_CVENDE)) AS COD_VEN_RTC_JUNIOR,
					(SELECT LTRIM(RTRIM(VE_CNOMBRE)) FROM FT0003VEND WHERE VE_CCODIGO= FT0003CLIE.CL_CVENDE) AS RTC,
					LTRIM(RTRIM(CL_CDIRCLI)) AS DIRECCION,
					LTRIM(RTRIM(CL_CDEPT)) AS DEPARTAMENTO,
					LTRIM(RTRIM(CL_CPROV)) AS PROVINCIA,
					(SELECT LTRIM(RTRIM(TG_CDESCRI)) From RSFACCAR..AL0003TABL Where TG_CCOD='A2' And TG_CCLAVE=CL_CUBIGEO) AS DISTRITO
					FROM FT0003CLIE 
					WHERE 
					-- CAST(CL_DFECCRE AS DATE) =  CAST(GETDATE() AS DATE)
					CAST(CL_DFECCRE AS DATE) >= CAST('2018-05-20' AS DATE)
					";
$prexiscli0003 = $connection->prepare($exiscli0003);
$prexiscli0003->execute();
$ar_count0003 = $prexiscli0003->fetchAll(PDO::FETCH_ASSOC);
if(count($ar_count0003)>0){
	for ($i=0 ; $i <=count($ar_count0003)-1 ; $i++) { 
		$ruc0003      			= $ar_count0003[$i]['RUC'];
		$cliente0003  			= $ar_count0003[$i]['CLIENTE'];
		$cod_zona0003 			= $ar_count0003[$i]['COD_ZONA'];
		$zona0003     			= $ar_count0003[$i]['ZONA'];
		$cod_ven_rtc_junior0003 = $ar_count0003[$i]['COD_VEN_RTC_JUNIOR'];
		$rtc0003      			= $ar_count0003[$i]['RTC'];

		$dire0003      			= $ar_count0003[$i]['DIRECCION'];
		$dept0003      			= $ar_count0003[$i]['DEPARTAMENTO'];
		$prov0003      			= $ar_count0003[$i]['PROVINCIA'];
		$dist0003      			= $ar_count0003[$i]['DISTRITO'];

		$consulcli = "SELECT COUNT(*) AS 'COUNT' FROM BASE_CLIENTE WHERE RUC = '$ruc0003'";
		$prconsul = $connection->prepare($consulcli);
		$prconsul->execute();
		$ar_consult = $prconsul->fetchAll(PDO::FETCH_ASSOC);
		if($ar_consult[0]['COUNT'] == 0){
			$insertcli = "INSERT BASE_CLIENTE(RUC,CLIENTE,COD_ZONA,ZONA,COD_VEN_RTC_JUNIOR,RTC,DIRECCION,DEPARTAMENTO,PROVINCIA,DISTRITO) VALUES ('$ruc0003','$cliente0003','$cod_zona0003','$zona0003','$cod_ven_rtc_junior0003','$rtc0003','$dire0003','$dept0003','$prov0003','$dist0003') ";
			$prinsertcli = $connection->prepare($insertcli);
			$prinsertcli->execute();
			echo "INSERTO 0003 = ".$ruc0003."<br> \t";
		}
	}
}

$exiscli0004 = "	SELECT
					LTRIM(RTRIM(CL_CCODCLI)) AS RUC,
					LTRIM(RTRIM(CL_CNOMCLI)) AS CLIENTE,
					LTRIM(RTRIM(CL_CZONVTA)) AS COD_ZONA,
					(SELECT LTRIM(RTRIM(ZV_CNOMZON))  FROM RSFACCAR..FT0004ZONV LEFT OUTER JOIN RSFACCAR..AL0004TRAN ON ZV_CCODTRA = TR_CCODIGO WHERE ZV_CCODZON= FT0004CLIE.CL_CZONVTA) AS ZONA,
					LTRIM(RTRIM(CL_CVENDE)) AS COD_VEN_RTC_JUNIOR,
					(SELECT LTRIM(RTRIM(VE_CNOMBRE)) FROM FT0004VEND WHERE VE_CCODIGO= FT0004CLIE.CL_CVENDE) AS RTC,
					LTRIM(RTRIM(CL_CDIRCLI)) AS DIRECCION,
					LTRIM(RTRIM(CL_CDEPT)) AS DEPARTAMENTO,
					LTRIM(RTRIM(CL_CPROV)) AS PROVINCIA,
					(SELECT LTRIM(RTRIM(TG_CDESCRI)) From RSFACCAR..AL0004TABL Where TG_CCOD='A2' And TG_CCLAVE=CL_CUBIGEO) AS DISTRITO
					FROM 
					FT0004CLIE 
					WHERE 
					-- CAST(CL_DFECCRE AS DATE) =  CAST(GETDATE() AS DATE)
					CAST(CL_DFECCRE AS DATE) >= CAST('2018-05-20' AS DATE)
					";
$prexiscli0004 = $connection->prepare($exiscli0004);
$prexiscli0004->execute();
$ar_count0004 = $prexiscli0004->fetchAll(PDO::FETCH_ASSOC);
if(count($ar_count0004)>0){
	for ($i=0; $i <=count($ar_count0004)-1 ; $i++) { 
		$ruc0004      			= $ar_count0004[$i]['RUC'];
		$cliente0004  			= $ar_count0004[$i]['CLIENTE'];
		$cod_zona0004 			= $ar_count0004[$i]['COD_ZONA'];
		$zona0004     			= $ar_count0004[$i]['ZONA'];
		$cod_ven_rtc_junior0004 = $ar_count0004[$i]['COD_VEN_RTC_JUNIOR'];
		$rtc0004      			= $ar_count0004[$i]['RTC'];

		$dire0004      			= $ar_count0004[$i]['DIRECCION'];
		$dept0004      			= $ar_count0004[$i]['DEPARTAMENTO'];
		$prov0004      			= $ar_count0004[$i]['PROVINCIA'];
		$dist0004      			= $ar_count0004[$i]['DISTRITO'];

		$consulcli = "SELECT COUNT(*) AS 'COUNT' FROM BASE_CLIENTE WHERE RUC = '$ruc0004'";
		$prconsul = $connection->prepare($consulcli);
		$prconsul->execute();
		$ar_consult = $prconsul->fetchAll(PDO::FETCH_ASSOC);
		if($ar_consult[0]['COUNT'] == 0){
			$insertcli = "INSERT BASE_CLIENTE(RUC,CLIENTE,COD_ZONA,ZONA,COD_VEN_RTC_JUNIOR,RTC,DIRECCION,DEPARTAMENTO,PROVINCIA,DISTRITO) VALUES ('$ruc0004','$cliente0004','$cod_zona0004','$zona0004','$cod_ven_rtc_junior0004','$rtc0004','$dire0004','$dept0004','$prov0004','$dist0004') ";
			$prinsertcli = $connection->prepare($insertcli);
			$prinsertcli->execute();
			echo "INSERTO 0004 = ".$ruc0004."<br> \t";
		}
	}
}

$exiscli0016 = "	SELECT
					LTRIM(RTRIM(CL_CCODCLI)) AS RUC,
					LTRIM(RTRIM(CL_CNOMCLI)) AS CLIENTE,
					LTRIM(RTRIM(CL_CZONVTA)) AS COD_ZONA,
					(SELECT LTRIM(RTRIM(ZV_CNOMZON))  FROM RSFACCAR..FT0016ZONV LEFT OUTER JOIN RSFACCAR..AL0016TRAN ON ZV_CCODTRA = TR_CCODIGO WHERE ZV_CCODZON= FT0016CLIE.CL_CZONVTA) AS ZONA,
					LTRIM(RTRIM(CL_CVENDE)) AS COD_VEN_RTC_JUNIOR,
					(SELECT LTRIM(RTRIM(VE_CNOMBRE)) FROM FT0016VEND WHERE VE_CCODIGO= FT0016CLIE.CL_CVENDE) AS RTC,
					LTRIM(RTRIM(CL_CDIRCLI)) AS DIRECCION,
					LTRIM(RTRIM(CL_CDEPT)) AS DEPARTAMENTO,
					LTRIM(RTRIM(CL_CPROV)) AS PROVINCIA,
					(SELECT LTRIM(RTRIM(TG_CDESCRI)) From RSFACCAR..AL0016TABL Where TG_CCOD='A2' And TG_CCLAVE=CL_CUBIGEO) AS DISTRITO
					FROM 
					FT0016CLIE 
					WHERE 
					-- CAST(CL_DFECCRE AS DATE) =  CAST(GETDATE() AS DATE)
					CAST(CL_DFECCRE AS DATE) >= CAST('2018-05-20' AS DATE)
					";
$prexiscli0016 = $connection->prepare($exiscli0016);
$prexiscli0016->execute();
$ar_count0016 = $prexiscli0016->fetchAll(PDO::FETCH_ASSOC);
if(count($ar_count0016)>0){

	for ($i=0; $i <=count($ar_count0016)-1 ; $i++) { 
		$ruc0016      			= $ar_count0016[$i]['RUC'];
		$cliente0016  			= $ar_count0016[$i]['CLIENTE'];
		$cod_zona0016 			= $ar_count0016[$i]['COD_ZONA'];
		$zona0016     			= $ar_count0016[$i]['ZONA'];
		$cod_ven_rtc_junior0016 = $ar_count0016[$i]['COD_VEN_RTC_JUNIOR'];
		$rtc0016      			= $ar_count0016[$i]['RTC'];

		$dire0016      			= $ar_count0016[$i]['DIRECCION'];
		$dept0016      			= $ar_count0016[$i]['DEPARTAMENTO'];
		$prov0016      			= $ar_count0016[$i]['PROVINCIA'];
		$dist0016      			= $ar_count0016[$i]['DISTRITO'];

		$consulcli = "SELECT COUNT(*) AS 'COUNT' FROM BASE_CLIENTE WHERE RUC = '$ruc0016'";
		$prconsul = $connection->prepare($consulcli);
		$prconsul->execute();
		$ar_consult = $prconsul->fetchAll(PDO::FETCH_ASSOC);
		if($ar_consult[0]['COUNT'] == 0){
			$insertcli = "INSERT BASE_CLIENTE(RUC,CLIENTE,COD_ZONA,ZONA,COD_VEN_RTC_JUNIOR,RTC,DIRECCION,DEPARTAMENTO,PROVINCIA,DISTRITO) VALUES ('$ruc0016','$cliente0016','$cod_zona0016','$zona0016','$cod_ven_rtc_junior0016','$rtc0016','$dire0016','$dept0016','$prov0016','$dist0016') ";
			$prinsertcli = $connection->prepare($insertcli);
			$prinsertcli->execute();
			echo "INSERTO 0016 = ".$ruc0016."<br> \t";
		}
	}
}



?>