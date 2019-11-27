<div class="row cells align-center">
    <h2 class="fg-white">Envio Estado de Cuenta</h2>
</div>
<div class="row cells3">
	<div class="cell align-left">
		<button id="idloademail" class="button warning block-shadow-warning text-shadow"  >LOAD MAIL</button>
	</div>	
	<div class="cell align-center">
		<h4 id="idcantsendmail">0</h4>
	</div>
	<div class="cell align-right">
		<!--<button id="iddesargar" class="button" disabled>REFRESH</button>-->
		<button class="button loading-pulse lighten primary" id="idrefresh" >REFRESH</button>
	</div>
</div>
</br>
<div class="row cells3">
	<div class="cell">
		<label>Fech.Prog.</label>
		<div class="input-control text full-size datepicker rounded" data-role="datepicker" data-format="dd/mm/yyyy" id="" >
			<input type="text" oncopy="return false" onpaste="return false" placeholder="FECHA HASTA" id="idfecha_program" data-validate-func="required" data-show-error-hint="false" data-validate-hint="NO DEBE ESTAR VACIO">
			<button class="button"><span class="mif-calendar"></span></button>
			<span class="input-state-error mif-warning"></span>
			<span class="input-state-success mif-checkmark"></span>
		</div>
	</div>
	<div class="cell align-center">
		<label>Estado</label>
		<div class="input-control select full-size rounded ">
			<select id="idestadoprog" data-validate-func="required" data-show-error-hint="false" data-validate-hint="DEBE SER SELECCIONADO">
				<option value="">SELECCIONE</option>
				<option value="1">ACTIVO</option>
				<option value="0">DESACTIVO</option>

			</select>
		</div>
		
		
	</div>
	<div class="cell align-right">
		</br>
		<button id="idguradraprog" class="button success block-shadow-success text-shadow" >Guardar Programacion</button>
	</div>
</div>