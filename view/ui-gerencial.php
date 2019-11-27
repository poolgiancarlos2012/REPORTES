<div data-role="accordion" data-one-frame="true" data-show-active="true" class="accordion">
    <!-- <div class="frame active"> -->
    <div class="frame">
        <div class="heading"  onclick="chequear('0002');">CAISAC<div style="float:right;"><input type="checkbox" value="0002" name="empresa"/></div></div>
        <div class="content" style="border:0;">
            <div class="p-2">
				<div class="row cells2">
				    <div class="cell">
				        <label>EMISION INICIO</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerpayini" data-on-select="">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO INICIAL" id="ger_emini0002" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				    <div class="cell">
				        <label>EMISION FINAL</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerpayfin" data-on-select="">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO FINAL" id="ger_emfin0002" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				</div>				
				<div class="row cells">
				    <!-- <div class="cell">
				        <label>COD CLIENTE</label>
				        <div class="input-control text full-size">
				            <input type="text" id="ger_codcli0002">
				        </div>
				    </div> -->
				    <div class="cell">
				        <label>CLIENTE</label>
				        <div class="input-control text full-size">
				            <!-- <input type="text" id="ger_client0002"> -->
				            <input id="ger_client0002">
				            <!-- <div id="searchcliente0002" class="grid bg-white fg-black " style="z-index: 3;max-width:428.55px;height:150px;overflow: auto;display:none;-moz-box-shadow: 1px 1px 5px 2px #000000;-webkit-box-shadow: 1px 1px 5px 2px #000000;box-shadow: 1px 1px 5px 2px #000000;"></div> -->
				        </div>
				    </div>
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>AGENCIA</label>
				    	<br>
				    	<br>
				        <input id='ger_agen0002' type='text' class='tags' value="300,304,30401,305,30501,30502,30503,30521,30522,306,30601,3061,30611,307,30701,30702,30703,308,309,310,311,312,313,3131,314,31401,315,31501,316,317,318,319,31901,320,321,322,323,324,3132">
				    </div>				    
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>LOCAL</label>
				    	<br>
				    	<br>
				        <input id='ger_local0002' type='text' class='tags' value="0001">
				    </div>				    
				</div>
            </div>
        </div>
    </div>

    <div class="frame">
        <div class="heading" onclick="chequear('0003');">ANDEX<div style="float:right;"><input type="checkbox" value="0003" name="empresa"/></div></div>
        <div class="content" style="border:0;">
            <div class="p-2">
				<div class="row cells2">
				    <div class="cell">
				        <label>EMISION INICIO</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerpayini" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO INICIAL" id="ger_emini0003" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				    <div class="cell">
				        <label>EMISION FINAL</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerpayfin" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO FINAL" id="ger_emfin0003" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				</div>				
				<div class="row cells">
				    <!-- <div class="cell">
				        <label>COD CLIENTE</label>
				        <div class="input-control text full-size">
				            <input type="text" id="ger_codcli0003">
				        </div>
				    </div> -->
				    <div class="cell">
				        <label>CLIENTE</label>
				        <div class="input-control text full-size">
				            <input type="text" id="ger_client0003">
				            <div id="searchcliente0003" class="grid bg-white fg-black " style="z-index: 3;max-width:428.55px;height:150px;overflow: auto;display:none;-moz-box-shadow: 1px 1px 5px 2px #000000;-webkit-box-shadow: 1px 1px 5px 2px #000000;box-shadow: 1px 1px 5px 2px #000000;"></div>
				        </div>
				    </div>
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>AGENCIA</label>
				    	<br>
				    	<br>
				        <input id='ger_agen0003' type='text' class='tags' value="300,304,30401,305,30501,30502,30503,30521,30522,306,30601,3061,30611,307,30701,30702,30703,308,309,310,311,312,313,3131,314,31401,315,31501,316,317,318,319,31901,320,321,322,323,324,3132">
				    </div>				    
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>LOCAL</label>
				    	<br>
				    	<br>
				        <input id='ger_local0003' type='text' class='tags' value="0001">
				    </div>				    
				</div>
            </div>
        </div>
    </div>

    <div class="frame">
        <div class="heading" onclick="chequear('0004');">SEMILLAS<div style="float:right;"><input type="checkbox" value="0004" name="empresa"/></div></div>
        <div class="content" style="border:0;">
            <div class="p-2">
				<div class="row cells2">
				    <div class="cell">
				        <label>EMISION INICIO</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerpayini" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO INICIAL" id="ger_emini0004" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				    <div class="cell">
				        <label>EMISION FINAL</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerpayfin" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO FINAL" id="ger_emfin0004" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				</div>				
				<div class="row cells">
				    <!-- <div class="cell">
				        <label>COD CLIENTE</label>
				        <div class="input-control text full-size">
				            <input type="text" id="ger_codcli0004">
				        </div>
				    </div> -->
				    <div class="cell">
				        <label>CLIENTE</label>
				        <div class="input-control text full-size">
				            <input type="text" id="ger_client0004">
				            <div id="searchcliente0004" class="grid bg-white fg-black " style="z-index: 3;max-width:428.55px;height:150px;overflow: auto;display:none;-moz-box-shadow: 1px 1px 5px 2px #000000;-webkit-box-shadow: 1px 1px 5px 2px #000000;box-shadow: 1px 1px 5px 2px #000000;"></div>
				        </div>
				    </div>
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>AGENCIA</label>
				    	<br>
				    	<br>
				        <input id='ger_agen0004' type='text' class='tags' value="300,304,30401,305,30501,30502,30503,30521,30522,306,30601,3061,30611,307,30701,30702,30703,308,309,310,311,312,313,3131,314,31401,315,31501,316,317,318,319,31901,320,321,322,323,324,3132">
				    </div>				    
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>LOCAL</label>
				    	<br>
				    	<br>
				        <input id='ger_local0004' type='text' class='tags' value="0001">
				    </div>				    
				</div>
            </div>
        </div>
    </div>

    <div class="frame">
        <div class="heading" onclick="chequear('0016');">SUNNY<div style="float:right;"><input type="checkbox" value="0016" name="empresa"/></div></div>
        <div class="content" style="border:0;">
            <div class="p-2">
				<div class="row cells2">
				    <div class="cell">
				        <label>EMISION INICIO</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerpayini" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO INICIAL" id="ger_emini0016" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				    <div class="cell">
				        <label>EMISION FINAL</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerpayfin" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO FINAL" id="ger_emfin0016" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				</div>				
				<div class="row cells">
				    <!-- <div class="cell">
				        <label>COD CLIENTE</label>
				        <div class="input-control text full-size">
				            <input type="text" id="ger_codcli0016">
				        </div>
				    </div> -->
				    <div class="cell">
				        <label>CLIENTE</label>
				        <div class="input-control text full-size">
				            <input type="text" id="ger_client0016">
				            <div id="searchcliente0016" class="grid bg-white fg-black " style="z-index: 3;max-width:428.55px;height:150px;overflow: auto;display:none;-moz-box-shadow: 1px 1px 5px 2px #000000;-webkit-box-shadow: 1px 1px 5px 2px #000000;box-shadow: 1px 1px 5px 2px #000000;"></div>
				        </div>
				    </div>
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>AGENCIA</label>
				    	<br>
				    	<br>
				        <input id='ger_agen0016' type='text' class='tags' value="300,301,3011,3012,3013,3014,3015,3016,3017,3018,302,3021,3022,3023,3024,303,3031,3032,304,30401,3041,305,30501,30502,30503,3051,3052,3053,306,30601,3061,307,30702,30703,308,309,310,312,3131,314,315,316,317,318,319,31901,320,321,324">
				    </div>				    
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>LOCAL</label>
				    	<br>
				    	<br>
				        <input id='ger_local0016' type='text' class='tags' value="0000">
				    </div>				    
				</div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="row cells align-center">
    <button id="descargagerencial" class="button" >DESCARGAR</button>
</div>

