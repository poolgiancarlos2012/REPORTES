<?php
class servletCuenta extends CommandController{
	public function doPost(){
		#####DAO#####
		$DAOCuenta=DAOFactory::getDAOCuenta('mssql');
		#####DAO#####
		switch ($_POST['action']) {
			case 'searchbycodigo_cliente':
				$DAOCuenta->searchbycodigo_cliente($_POST['codigo_cliente']);
			break;
			case 'searchbyrazon_social':
				$DAOCuenta->searchbyrazon_social($_POST['rz']);
				break;
			case 'ifexist_deuda_cliente':
				$DAOCuenta->ifexist_deuda_cliente($_POST['codigo_cliente']);
				break;
			case 'ifexist_liquidacion':
				$DAOCuenta->ifexist_liquidacion($_POST['payi'],$_POST['payf'],$_POST['crei'],$_POST['cref'],$_POST['ruc']);
				break;
			case 'ifexist_concepto':
				$DAOCuenta->ifexist_concepto($_POST['mes'],$_POST['anio']);
				break;
			case 'ifexist_historico_documento':
				$DAOCuenta->ifexist_historico_documento($_POST['ini'],$_POST['fin'],$_POST['empresa'],$_POST['tipdoc']);
				break;
			case 'ifexist_historico_documento_detalle':
				$DAOCuenta->ifexist_historico_documento_detalle($_POST['ini'], $_POST['fin'], $_POST['empresa'], $_POST['tipdoc'], $_POST['codclie']);
				break;
			case 'ifexist_tipo_cambio':
				$DAOCuenta->ifexist_tipo_cambio($_POST['ini'],$_POST['fin']);
				break;
			case 'consultar_cliente':
				$DAOCuenta->consultar_cliente($_POST['phrase']);
				break;
			case 'consultar_codigo_cliente':
				$DAOCuenta->consultar_codigo_cliente($_POST['phrase']);
				break;
			case 'consultar_base_cliente':
				$DAOCuenta->consultar_base_cliente($_POST['codigo_cliente']);
				break;
			case 'update_base_cliente':
				$DAOCuenta->update_base_cliente($_POST['codigo_cliente'],$_POST['idsuper'],$_POST['idtip_ries'],$_POST['idlin_ba'],$_POST['idsobreg'],$_POST['idlin_cre'],$_POST['idtelf'],$_POST['idemail'],$_POST['idrepren'],$_POST['idlocali'],$_POST['iddirecc'],$_POST['iddistri'],$_POST['idprovin'],$_POST['iddeparta'],$_POST['idtienda'],$_POST['idest_ext']);
				break;
			case 'consultar_linea_credito':
				$DAOCuenta->consultar_linea_credito($_POST['codigo_cliente']);
				break;
			case 'consulta_vendedor_general':
				$DAOCuenta->consulta_vendedor_general($_POST['phrase']);
				break;
			case 'consulta_zona_general':
				$DAOCuenta->consulta_zona_general($_POST['phrase']);
				break;
			case 'ifexist_cartas':
				$DAOCuenta->ifexist_cartas($_POST['rtc'],$_POST['zona']);
				break;
			case 'CargarEmail' :
				$DAOCuenta->CargarEmail();
				break;
			case 'RefreshCantEmail' :
				$DAOCuenta->RefreshCantEmail();
				break;
			case 'Save_Programacion' :

				$idfecha_program = $_POST['idfecha_program'];
				$idestadoprog = $_POST['idestadoprog'];

				$DAOCuenta->Save_Programacion($idfecha_program,$idestadoprog);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada'));
			break;
		}
	}
	public function doGet(){
		#####DAO#####

		#####DAO#####
	}
}
?>
