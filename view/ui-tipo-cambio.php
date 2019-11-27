<div class="row cells2">
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickertc" data-on-select="Validacionxtc()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA INICIAL" id="idfchini" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickertc" data-on-select="Validacionxtc()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA FINAL" id="idfchfin" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
</div>
<div class="row cells align-center">
    <button id="iddescargartc" class="button" disabled>DESCARGAR</button>
</div>
