<?php

session_start();
date_default_timezone_set('America/Lima');

require_once '../controller/CommandController.php';


/*CONNECTION BD*/
require_once '../conexion/config.php';
require_once '../conexion/MSSQLConnectionPDO.php';

/*CONNECTION BD*/

/*PDO DE CONECCION*/
require_once '../factory/DAOFactory.php';
require_once '../factory/FactoryConnection.php';
/*PDO DE CONECCION*/

/***SERVLET***/
require_once '../controller/servletLogin.php';
require_once '../controller/servletCuenta.php';

/***SERVLET***/

/***DAO***/

require_once '../dao/MSSQLLoginDAO.php';
require_once '../dao/MSSQLCuentaDAO.php';

/***DAO***/

/***DTO***/
require_once '../dto/dto_usuario.php';
/***DTO***/ 


$cn = CommandController::getCommand();
$cn->process();
?>
