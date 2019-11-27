<?php
if($_SESSION['tipo_usuario']=='SUPERV_CRED'){
?>
    <?php
        if($_SESSION['usuario']=='09671386' || $_SESSION['usuario']=='07942186' || $_SESSION['usuario']=='21563888' || $_SESSION['usuario']=='44762828'  || $_SESSION['usuario']=='42119301' || $_SESSION['usuario']=='46884841' || $_SESSION['usuario']=='09931322'){
    ?>
        <ul class="v-menu context block-shadow-impact" style="background: #272936;">
            <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
            <li class="divider bg-black"></li>
            <li><a href="?abrir_pagina=linea_credito" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Consulta Linea Creditos</a></li>
            <li class="divider bg-black"></li>
            <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        </ul>
    <?php
        } else{
    ?>
        <ul class="v-menu context block-shadow-impact" style="background: #272936;">
            <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
            <li class="divider bg-black"></li>
            <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        </ul>
    <?php
        }
    ?>

<?php
} elseif($_SESSION['tipo_usuario']=='GERENCIA'){
?>



    <?php
        if($_SESSION['usuario']=='10062760'){
    ?>

            <ul class="v-menu context block-shadow-impact" style="background: #272936;">
                <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
                <li class="divider bg-black"></li>
                <li><a href="#" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Fecha</a></li>
                <li class="divider bg-black" ></li>
                <li><a href="?abrir_pagina=tipo_cambio" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Tipo de Cambio</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=gerencial" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Gerencial</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=gerencial_sunny" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Gerencial Sunny</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=base_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Base de Clientes</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=linea_credito" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Consulta Linea Creditos</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=liquidacion" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico de Pagos</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=historico_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=direccion_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Dirección Cliente</a></li>
                <li class="divider bg-black"></li>
                <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
            </ul>

    <?php
        } elseif($_SESSION['usuario']=='21561093' || $_SESSION['usuario']=='07789289'){
    ?>
            <ul class="v-menu context block-shadow-impact" style="background: #272936;">
                <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
                <li class="divider bg-black"></li>
                <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
            </ul>
    <?php
        } else{
    ?>
            <ul class="v-menu context block-shadow-impact" style="background: #272936;">
                <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
                <li class="divider bg-black"></li>
                <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
            </ul>
    <?php
        }
    ?>

<?php
} elseif($_SESSION['tipo_usuario']=='OPERACIONES'){
?>


    <?php
        if($_SESSION['usuario']=='46312286'){ // ESTACIO
    ?>
            <ul class="v-menu context block-shadow-impact" style="background: #272936;">
                <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=liquidacion" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico de Pagos</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
                <li class="divider bg-black"></li>
                <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
                <!-- <li class="divider"></li>
                <li>
                    <a href="#" class="dropdown-toggle">More functions</a>
                    <ul class="d-menu context" data-role="dropdown">
                        <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                        <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                        <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                        <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
                    </ul>
                </li> -->
            </ul>


    <?php
        } elseif($_SESSION['usuario']=='47004469'){ // JUAN BAUTISTA
    ?>
            <ul class="v-menu context block-shadow-impact" style="background: #272936;">
                <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=liquidacion" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico de Pagos</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
                <li class="divider bg-black"></li>
                <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
                <!-- <li class="divider"></li>
                <li>
                    <a href="#" class="dropdown-toggle">More functions</a>
                    <ul class="d-menu context" data-role="dropdown">
                        <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                        <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                        <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                        <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
                    </ul>
                </li> -->
            </ul>


    <?php
        } elseif($_SESSION['usuario']=='43258460'){ // GINO VARQUEZ
    ?>
            <ul class="v-menu context block-shadow-impact" style="background: #272936;">
                <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
                <li class="divider bg-black"></li>
                <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
                <li class="divider bg-black"></li>
                <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
                <!-- <li class="divider"></li>
                <li>
                    <a href="#" class="dropdown-toggle">More functions</a>
                    <ul class="d-menu context" data-role="dropdown">
                        <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                        <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                        <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                        <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
                    </ul>
                </li> -->
            </ul>


    

    <?php
        } else {
    ?>
            <ul class="v-menu context block-shadow-impact" style="background: #272936;">
                <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
                <li class="divider bg-black"></li>
                        
                
                <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
                <!-- <li class="divider"></li>
                <li>
                    <a href="#" class="dropdown-toggle">More functions</a>
                    <ul class="d-menu context" data-role="dropdown">
                        <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                        <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                        <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                        <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
                    </ul>
                </li> -->
            </ul>
    <?php
        }
    ?>

<?php
} elseif($_SESSION['tipo_usuario']=='CLIENTE'){
?>

<?php
}elseif($_SESSION['tipo_usuario']=='JEFE_OPE'){
?>
    <ul class="v-menu context block-shadow-impact" style="background: #272936;">
        <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
        <li class="divider bg-black"></li>
        <li><a href="#" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Fecha</a></li>
	<li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=envio_estado_cuenta" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Envio Estado de Cuenta</a></li>
        <li class="divider bg-black" ></li>
        <li><a href="?abrir_pagina=tipo_cambio" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Tipo de Cambio</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=gerencial" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Gerencial</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=gerencial_sunny" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Gerencial Sunny</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=base_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Base de Clientes</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=linea_credito" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Consulta Linea Creditos</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=liquidacion" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico de Pagos</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=historico_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=direccion_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Dirección Cliente</a></li>
        <li class="divider bg-black"></li>
        <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        <!-- <li class="divider"></li>
        <li>
            <a href="#" class="dropdown-toggle">More functions</a>
            <ul class="d-menu context" data-role="dropdown">
                <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
            </ul>
        </li> -->
    </ul>
<?php
}elseif($_SESSION['tipo_usuario']=='ADMINISTRADOR'){
?>
    <ul class="v-menu context block-shadow-impact" style="background: #272936;">
        <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
        <li class="divider bg-black"></li>
        <li><a href="#" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Fecha</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=envio_estado_cuenta" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Envio Estado de Cuenta</a></li>
        <li class="divider bg-black" ></li>
        <li><a href="?abrir_pagina=tipo_cambio" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Tipo de Cambio</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=gerencial" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Gerencial</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=gerencial_sunny" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Gerencial Sunny</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=cartas" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Cartas</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=liquidacion" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico de Pagos</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=historico_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=conceptos" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Conceptos</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=base_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Base de Clientes</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=linea_credito" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Consulta Linea Creditos</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=direccion_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Dirección Cliente</a></li>
        <li class="divider bg-black"></li>
        <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        <!-- <li class="divider"></li>
        <li>
            <a href="#" class="dropdown-toggle">More functions</a>
            <ul class="d-menu context" data-role="dropdown">
                <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
            </ul>
        </li> -->
    </ul>
<?php
}elseif($_SESSION['tipo_usuario']=='TIENDA' || $_SESSION['tipo_usuario']=='CAISAC'){
?>
    <ul class="v-menu context block-shadow-impact" style="background: #272936;">
        <li><a href="?abrir_pagina=cuenta_cliente" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Estado de Cuenta - Cliente</a></li>
        <li class="divider bg-black"></li>
        <li><a href="?abrir_pagina=linea_credito" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Consulta Linea Creditos</a></li>
        
        <li class="divider bg-black"></li>
        <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        <!-- <li class="divider"></li>
        <li>
            <a href="#" class="dropdown-toggle">More functions</a>
            <ul class="d-menu context" data-role="dropdown">
                <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
            </ul>
        </li> -->
    </ul>
<?php
}elseif($_SESSION['tipo_usuario']=='CONTABILIDAD'){
?>
    <ul class="v-menu context block-shadow-impact" style="background: #272936;">
        <li><a href="?abrir_pagina=conceptos" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Conceptos</a></li>
        <li class="divider bg-black"></li>
        <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        <!-- <li class="divider"></li>
        <li>
            <a href="#" class="dropdown-toggle">More functions</a>
            <ul class="d-menu context" data-role="dropdown">
                <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
            </ul>
        </li> -->
    </ul>

<?php
}elseif($_SESSION['tipo_usuario']=='MARKETING'){
?>
    <ul class="v-menu context block-shadow-impact" style="background: #272936;">
        <li><a href="?abrir_pagina=his_detalle_documento" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Historico Documento detalle</a></li>
        <li class="divider bg-black"></li>
        <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        <!-- <li class="divider"></li>
        <li>
            <a href="#" class="dropdown-toggle">More functions</a>
            <ul class="d-menu context" data-role="dropdown">
                <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
            </ul>
        </li> -->
    </ul>
<?php
}else{
?>
    <ul class="v-menu context block-shadow-impact" style="background: #272936;">
        <li><a href="../close.php" class="bg-hover-white fg-hover-black" style="color: #FFFFFF;">Exit</a></li>
        <!-- <li class="divider"></li>
        <li>
            <a href="#" class="dropdown-toggle">More functions</a>
            <ul class="d-menu context" data-role="dropdown">
                <li><a href="#"><span class="icon mif-cogs"></span> Ра�?ширенные круги</a></li>
                <li><a href="#"><span class="icon mif-users"></span> Дл�? в�?ех</a></li>
                <li><a href="#"><span class="icon mif-spinner5"></span> Мои круги</a></li>
                <li><a href="#"><span class="icon mif-lock"></span> Только �?</a></li>
            </ul>
        </li> -->
    </ul>
<?php
}
?>
