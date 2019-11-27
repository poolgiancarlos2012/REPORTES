<div class="row cells2">
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerpayini" data-on-select="Validacionxfecha()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO INICIAL" id="idfchpagoini" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerpayfin" data-on-select="Validacionxfecha()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO FINAL" id="idfchpagofin" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
</div>
<div class="row cells2">
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerpayini" data-on-select="Validacionxfecha_crea()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA CREACION INICIAL" id="idfchcreacionini" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerpayfin" data-on-select="Validacionxfecha_crea()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA CREACION FINAL" id="idfchcreacionfin" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
</div>
<div class="row cells2">
    <div class="cell">
        <div class="input-control text full-size rounded">
            <input type="text" placeholder="CODIGO CLIENTE (11 DIGITOS NUMERICOS)" id="idtxtruc"  maxlength="11" data-validate-func="digits,maxlength,minlength" data-validate-arg=",11,11" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO, 11 DIGITOS NUMERICOS">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
    <div class="cell">
        <div class="input-control text full-size rounded">
            <input type="text" placeholder="RAZON SOCIAL"  id="idtxtrazon_social" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
            <div id="searchcliente" class="grid bg-white fg-black " style="z-index: 2;max-width:428.55px;height:150px;overflow: auto;display:none;-moz-box-shadow: 1px 1px 5px 2px #000000;-webkit-box-shadow: 1px 1px 5px 2px #000000;box-shadow: 1px 1px 5px 2px #000000;">
            </div>
        </div>
    </div>
</div>

<div class="row cells align-center">
    <button id="iddescargarliq" class="button" disabled>DESCARGAR</button>
</div>
<div class="row cells align-center align-justify">
    <p class="text-secondary"><h5 class="fg-grayLight">NOTA:</h5></p>
    <p class="text-secondary fg-grayLight">Es necesario ingresar ambas fechas para que el botón descargar se active.</p>
    <br>
    <p class="text-secondary fg-grayLight">CAISAC, ANDEX, SEMILLAS muestran todas las tiendas y vendedores de sus respectivas empresas que tengan liquidación en ese rango de fecha.</p>
    <br>
    <p class="text-secondary fg-grayLight">SUNNY muestra solo la tienda de lima y todos los vendedores de esa agencia que tengan liquidaciones en ese rango de fecha.</p>
</div>