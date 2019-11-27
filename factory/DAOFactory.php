<?php
class  DAOFactory{
    public static function getDAOLogeo($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLLogeoDAO;
            break;
            case 'maria':
                    $rs = new MARIALogeoDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOLogeoDAO;
            break;
            case 'pg':
                    $rs = new PG_Logeo_DAO;
            break;
            case 'mssql':
                    $rs = new MSSQLLoginDAO;
                break;
        endswitch;
        return $rs ;
    }
    public static function getDAOIndex($tipo){
    	$rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLIndexDAO;
            break;
            case 'maria':
                    $rs = new MARIAIndexDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOIndexDAO;
            break;
            case 'pg':
                    $rs = new PG_Index_DAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOCuenta($tipo){
    	$rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLCuentaDAO;
            break;
            case 'maria':
                    $rs = new MARIACuentaDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOCuentaDAO;
            break;
            case 'pg':
                    $rs = new PG_Cuenta_DAO;
            break;
            case 'mssql':
                    $rs = new MSSQLCuentaDAO;
                break;
        endswitch;
        return $rs ;
    }
}
?>
