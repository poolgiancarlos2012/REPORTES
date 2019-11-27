<?php
if(isset($_GET['abrir_pagina'])){
	switch ($_GET['abrir_pagina']) {
		case 'cuenta_cliente':
			include('ui-cuenta-cliente.php');
		break;
		case 'liquidacion':
			include('ui-liquidacion.php');
			break;
		case 'conceptos':
			include('ui-contabilidad-concepto.php');
			break;
		case 'historico_documento':
			include('ui-historico-documento.php');
			break;
		case 'his_detalle_documento':
			include('ui-historico-documento-detalle.php');
			break;
		case 'tipo_cambio':
			include('ui-tipo-cambio.php');
			break;
		case 'gerencial':
			include('ui-gerencial.php');
			break;
		case 'base_cliente':
			include('ui-base_cliente.php');
			break;
		case 'linea_credito':
			include('ui-linea_credito.php');
			break;
		case 'gerencial_sunny':
			include('ui-gerencial_sunny.php');
			break;
		case 'cartas':
			include('ui-cartas.php');
			break;
		case 'direccion_cliente':
			include('ui-direccion_cliente.php');
			break;
		case 'envio_estado_cuenta':
			include('ui-envio_estado_cuenta.php');
			break;
		default:
			echo "Pagina Web No Existe";
		break;
	}
}else{
	include('ui-default.php');
}
?>
