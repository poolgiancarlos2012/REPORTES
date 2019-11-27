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
    <button id="iddesargar" class="button" disabled>DESCARGAR</button>
</div>
<div class="row cells align-center align-justify">
    <p class="text-secondary"><h5 class="fg-grayLight">NOTA:</h5></p>
    <p class="text-secondary fg-grayLight">La búsqueda se realiza cada vez que se digita en el código cliente y razón social, las dos opciones de ingreso están relacionadas, es decir si se ingresa incorrectamente en una el otro se limpia.</p>
</div>


