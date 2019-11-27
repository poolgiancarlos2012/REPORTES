<?php

class servletLogin extends CommandController {

    public function doPost() {
        #####DAO#####
        $MSSQL_Logeo_DAO = DAOFactory::getDAOLogeo('mssql');
        #####DAO#####
        switch ($_POST['action']) {
            case 'acceso':
                $user = $_POST['usuario'];
                $pass = $_POST['clave'];
                $dto_usuario = new dto_usuario;
                $dto_usuario->setUsuario($user);
                $dto_usuario->setClave($pass);
                $response = $MSSQL_Logeo_DAO->QUERY_login($dto_usuario);
                echo json_encode($response);

                break;
            default:
                echo json_encode(array('rst' => false, 'msg' => 'Accion no encontrada'));
                break;
        }
    }

    public function doGet() {
        #####DAO#####
        #####DAO#####
    }

}

?>