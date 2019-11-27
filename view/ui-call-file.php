<?php
if(isset($_GET['abrir_pagina'])){
    switch ($_GET['abrir_pagina']) {
        
        case 'cuenta_cliente':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'liquidacion':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'conceptos':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'historico_documento':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'his_detalle_documento':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'tipo_cambio':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'gerencial':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'base_cliente':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'linea_credito':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'gerencial_sunny':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'cartas':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'direccion_cliente':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;
        case 'envio_estado_cuenta':
                $call_file='<script type="text/javascript" src="../js/cuentaDAO.js" ></script>
                            <script type="text/javascript" src="../js/js-cuenta.js" ></script>';
            break;

        default:
            $call_file='';
        break;
    }
}
?>