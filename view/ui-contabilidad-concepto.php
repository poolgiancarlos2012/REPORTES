<div class="row cells2 align-center">
    <div class="cell ">
        <div class="input-control text text full-size rounded" style="width: 80% !important;">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="MES (01-12) 2 DIGITOS" id="idmesconcepto" onkeypress="return isNumberKey(event)" maxlength="2" data-validate-func="digits,maxlength,minlength" data-validate-arg=",11,11" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO, 11 DIGITOS NUMERICOS">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
    <div class="cell">
        <div class="input-control text text full-size rounded" style="width: 80% !important;">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="AÑO (2017) 4 DIGITOS" id="idanioconcepto" onkeypress="return isNumberKey(event)" maxlength="4" data-validate-func="digits,maxlength,minlength" data-validate-arg=",11,11" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO, 11 DIGITOS NUMERICOS">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
</div>
<div class="row cells align-center">
    <button id="iddescargarconcepto" class="button" disabled>DESCARGAR</button>
</div>
<div class="row cells align-center align-justify">
    <p class="text-secondary"><h5 class="fg-grayLight">NOTA:</h5></p>
    <p class="text-secondary fg-grayLight">Dentro de conceptos esta obsequio, bonificación y muestras de las empresas CAISAC, ANDEX y SEMILLAS</p>
</div>