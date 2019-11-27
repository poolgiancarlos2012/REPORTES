<div data-role="accordion" data-one-frame="true" data-show-active="true" class="accordion">
    <!-- <div class="frame active"> -->    
    <div class="frame">
        <div class="heading" onclick="chequear('0016');">SUNNY<div style="float:right;"><input type="checkbox" value="0016" name="empresa"/></div></div>
        <div class="content" style="border:0;">
            <div class="p-2">
				<div class="row cells2">
				    <div class="cell">
				        <label>EMISION INICIO</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-effect="slide" data-format="dd/mm/yyyy" id="datepickerpayini" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO INICIAL" id="ger_eminiSU0016" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
				            <button class="button"><span class="mif-calendar"></span></button>
				            <span class="input-state-error mif-warning"></span>
				            <span class="input-state-success mif-checkmark"></span>
				        </div>
				    </div>
				    <div class="cell">
				        <label>EMISION FINAL</label>
				        <div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="datepickerpayfin" data-on-select="Validacionxfecha()">
				            <input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA PAGO FINAL" id="ger_emfinSU0016" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
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
				            <input type="text" id="ger_clientSU0016">
				            <div id="searchcliente0016" class="grid bg-white fg-black " style="z-index: 3;max-width:428.55px;height:150px;overflow: auto;display:none;-moz-box-shadow: 1px 1px 5px 2px #000000;-webkit-box-shadow: 1px 1px 5px 2px #000000;box-shadow: 1px 1px 5px 2px #000000;"></div>
				        </div>
				    </div>
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>AGENCIA</label>
				    	<br>
				    	<br>
				        <input id='ger_agenSU0016' type='text' class='tags' value="300,301,3011,3012,3013,3014,3015,3016,3017,3018,302,3021,3022,3023,3024,303,3031,3032,304,30401,3041,305,30501,30502,30503,3051,3052,3053,306,30601,3061,307,30702,30703,308,309,310,312,3131,314,315,316,317,318,319,31901,320,321,324">
				    </div>				    
				</div>
				<div class="row cells">
				    <div class="cell">
				    	<label>LOCAL</label>
				    	<br>
				    	<br>
				        <input id='ger_localSU0016' type='text' class='tags' value="0001,0002,0003,0004,0005,0006,0008,0009,0011,0012,0013,0014">
				    </div>				    
				</div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="row cells align-center">
    <button id="descargaSUgerencial" class="button" >DESCARGAR</button>
</div>

