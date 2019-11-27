<?php

class MSSQLLoginDAO {

    public function QUERY_login(dto_usuario $dto_usuario) {

        $user = $dto_usuario->getUsuario();
        $pass = $dto_usuario->getClave();

        $factoryConnection = FactoryConnection::create('mssql');
        $connection = $factoryConnection->getConnection();
        #### VERIFICAR USUARIO ####

        $sql_Exist_user = " SELECT 
                            COUNT(*) AS CONT
                            FROM 
                            VIEW_DISTRIBUCION_PERSONAL 
                            WHERE 
                            EMPRESA IN ('CAISAC','SUPERV_CRED','OPERACIONES','ADMINISTRADOR','GERENCIA','JEFE_OPE','CONTABILIDAD','MARKETING') AND
                            DNI='$user'";
        $pr = $connection->prepare($sql_Exist_user);
        $pr->execute();
        $data_Exist_user = $pr->fetchAll(PDO::FETCH_ASSOC);
        if ($data_Exist_user[0]['CONT'] > 0) {
            
            $sql_Exist_clave = "    SELECT 
                                    COUNT(*) AS CONT
                                    FROM 
                                    VIEW_DISTRIBUCION_PERSONAL 
                                    WHERE 
                                    EMPRESA IN ('CAISAC','SUPERV_CRED','OPERACIONES','ADMINISTRADOR','GERENCIA','JEFE_OPE','CONTABILIDAD','MARKETING') AND
                                    SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', DNI)),3,32)=SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', '$pass')),3,32)";

            $pr_pass = $connection->prepare($sql_Exist_clave);
            $pr_pass->execute();
            $data_Exist_clave = $pr_pass->fetchAll(PDO::FETCH_ASSOC);

            if ($data_Exist_clave[0]['CONT'] > 0) {
                $sql_Exist_user_clave = "   SELECT 
                                            COUNT(*) AS CONT
                                            FROM 
                                            VIEW_DISTRIBUCION_PERSONAL 
                                            WHERE 
                                            EMPRESA IN ('CAISAC','SUPERV_CRED','OPERACIONES','ADMINISTRADOR','GERENCIA','JEFE_OPE','CONTABILIDAD','MARKETING') AND
                                            DNI='$user' AND
                                            SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', DNI)),3,32)=SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', '$pass')),3,32)";
                $pr_user_pass = $connection->prepare($sql_Exist_user_clave);
                $pr_user_pass->execute();
                $data_Exist_user_clave = $pr_user_pass->fetchAll(PDO::FETCH_ASSOC);
                if ($data_Exist_user_clave[0]['CONT'] > 0){
                    
                    $sql_User_datos = " SELECT 
                                        VEND AS 'DATOS',
                                        DNI AS 'USUARIO',
                                        EMPRESA AS 'TIPO_USUARIO',
                                        1 AS ESTADO
                                        FROM 
                                        VIEW_DISTRIBUCION_PERSONAL 
                                        WHERE 
                                        EMPRESA IN ('CAISAC','SUPERV_CRED','OPERACIONES','ADMINISTRADOR','GERENCIA','JEFE_OPE','CONTABILIDAD','MARKETING') AND
                                        DNI='$user' AND
                                        SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', DNI)),3,32)=SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', '$pass')),3,32)";

                    $pr_User_datos = $connection->prepare($sql_User_datos);
                    $pr_User_datos->execute();
                    $data_User_datos = $pr_User_datos->fetchAll(PDO::FETCH_ASSOC);
                    if (count($data_User_datos) > 0) {
                        $_SESSION['logeo'] = $data_User_datos[0]['ESTADO'];
                        $_SESSION['activo'] = $data_User_datos[0]['ESTADO'];
                        $_SESSION['datos'] = $data_User_datos[0]['DATOS'];
                        $_SESSION['usuario'] = $data_User_datos[0]['USUARIO'];
                        $_SESSION['tipo_usuario'] = $data_User_datos[0]['TIPO_USUARIO'];

                        //echo "hola".$data_User_datos[0]['USUARIO'];

                        return array('rst' => true, 'msg' => 'Ingreso Correctamente...!!!', 'data' => $data_User_datos[0]['DATOS'] . " " . $data_User_datos[0]['USUARIO']);
                    } else {
                        return array('rst' => false, 'msg' => 'Error de ejecucion al obtener datos');
                    }
                } else {
                    return array('rst' => false, 'msg' => '¡Ingresó incorrectamente Usuario o Password!', 'data' => $data_Exist_user_clave[0]['CONT']);
                }
            } else {
                return array('rst' => false, 'msg' => '¡Clave incorrecta!', 'data' => $data_Exist_clave[0]['CONT']);
            }
        } else {
            return array('rst' => false, 'msg' => '¡Usuario no registrado!', 'data' => $data_Exist_user[0]['CONT']);
        }


    }

}

?>