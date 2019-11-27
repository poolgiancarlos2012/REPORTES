<?php
	class servletIndex extends CommandController{
		public function doPost(){
			#####DAO#####
			$PG_Index_DAO=DAOFactory::getDAOIndex('pg');
			#####DAO#####
			switch ($_POST['action']) {
				case 'QUERY_load_menu':			
					$response = $PG_Index_DAO->QUERY_load_menu();
					echo json_encode($response);
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