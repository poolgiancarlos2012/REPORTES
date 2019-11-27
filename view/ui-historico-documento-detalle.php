<div class="row cells align-center">
    <h2 class="fg-white">Reporte Detalle Documento</h2>
</div>

<div class="row cells2">
    
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerfchini_detdoc" data-on-select="Validacionxfecha_hist_detdoc()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA DESDE" id="idfchdesde_det_doc" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
    <div class="cell">
        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerfchfin_detdoc" data-on-select="Validacionxfecha_hist_detdoc()">
            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA HASTA" id="idfchhasta_det_doc" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
            <button class="button"><span class="mif-calendar"></span></button>
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
        </div>
    </div>
</div>
<div class="row cells">
    <div class="cell">
        <label>CLIENTE</label>
        <div class="input-control text full-size">
            <input id="ger_clientdet0002">
        </div>
    </div>
</div>
<div class="row cells2">
    <div class="cell">
        <div class="input-control select full-size rounded ">
            <select id="idlslcdempresa" data-validate-func="required" data-show-error-hint="false" data-validate-hint="DEBE SER SELECCIONADO">
                <option value="">EMPRESA</option>
                <option value="0002">CAISA</option>
                <option value="0003">ANDEX</option>
                <option value="0004">SEMILLAS</option>
                <option value="0016">SUNNY</option>
            </select>
        </div>
    </div>
    <div class="cell">
        <div class="input-control select full-size rounded ">
            <select id="idlslcdtipo_doc" data-validate-func="required" data-show-error-hint="false" data-validate-hint="DEBE SER SELECCIONADO">
                <option value="">TD</option>
                <option value="FT">FACTURA</option>
                <option value="BV">BOLETA</option>
                <option value="NC">NOTA DE CREDITO</option>
            </select>
        </div>
    </div>
</div>
<div class="row cells align-center">
    <button id="iddescargarhist_detdoc" class="button" disabled>DESCARGAR</button>
</div>