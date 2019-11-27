<div class="row cells align-center">
    <h2 class="fg-white">BASE DE CLIENTES</h2>
</div>
<div class="cell">
    <label class="text-accent" style="color: white;">CLIENTE</label>
    <div class="input-control text full-size">
        <input id="base_cliente">
    </div>
</div>

<hr style="color: #0056b2;" />


<div style="background:white;padding: 2%;">
	
	<h5 style="font-weight: bold;">CLIENTES</h5>
	<hr style="color: #445159;" />

	<br>

	<div class="row cells2">
	    <div class="cell">
			<label class="text-accent">RAZON SOCIAL</label>
			<div class="input-control text full-size rounded">
		        <input id="idrazon_social" class="text-small" disabled>
		    </div>
	    </div>
	    <div class="cell">
			<label class="text-accent">TIPO_CLIENTE</label>
			<div class="input-control text full-size rounded">
		        <input id="idtip_client" disabled class="text-small">
		    </div>	        
	    </div>
	</div>

	<br>
	<br>

	<div class="row cells2">
	    <div class="cell">

	    	<h5 style="font-weight: bold;">CREDITOS</h5>
	        <hr style="color: #0056b2;" />
			<br>
	        <label class="text-accent">SUPERVISOR</label>
			<div class="input-control text full-size rounded">
		        <input id="idsuper" class="text-small">
		    </div>

			<label class="text-accent">TIPO_RIESGO</label>
			<div class="input-control text full-size rounded">
		        <input id="idtip_ries" class="text-small">
		    </div>

			<label class="text-accent">LINEA_BASE</label>
			<div class="input-control text full-size rounded">
		        <input id="idlin_ba" class="text-small">
		    </div>

			<label class="text-accent">SOBREGIRO_CAMPANIA</label>
			<div class="input-control text full-size rounded">
		        <input id="idsobreg" class="text-small">
		    </div>

			<label class="text-accent">LINEA_CREDITO_TOTAL</label>
			<div class="input-control text full-size rounded">
		        <input id="idlin_cre" class="text-small">
		    </div>

			<label class="text-accent">ESTUDIO_EXTERNO</label>
			<div class="input-control text full-size rounded">
		        <input id="idest_ext" class="text-small">
		    </div>
	    </div>

	    <div class="cell">
			<h5 style="font-weight: bold;">ZONA</h5>
	        <hr style="color: #0056b2;" />
			<br>
	        <label class="text-accent">COD_ZONA</label>
			<div class="input-control text full-size rounded">
		        <input id="idcod_zona" disabled="disabled" class="text-small">
		    </div>

			<label class="text-accent">ZONA</label>
			<div class="input-control text full-size rounded">
		        <input id="idzona" disabled="disabled" class="text-small">
		    </div>

			<label class="text-accent">COD_VEN</label>
			<div class="input-control text full-size rounded">
		        <input id="idcod_vend" disabled="disabled" class="text-small">
		    </div>

			<label class="text-accent">RESPONSABLE_ZONA</label>
			<div class="input-control text full-size rounded">
		        <input id="idresponsa" disabled="disabled" class="text-small">
		    </div>

			<label class="text-accent">COD_VEN_RTC_JUNIOR</label>
			<div class="input-control text full-size rounded">
		        <input id="idcodvenrtc" disabled="disabled" class="text-small">
		    </div>

			<label class="text-accent">RTC</label>
			<div class="input-control text full-size rounded">
		        <input id="idrtc" disabled="disabled" class="text-small">
		    </div>
	    </div>
	</div>

	<h5 style="font-weight: bold;">DATO CONTACTO</h5>
	<hr style="color: #0056b2;" />

	<br>

	<div class="row cells2">
	    <div class="cell">
			<label class="text-accent">TELEFONO</label>
        	<div class="input-control textarea full-size rounded">
			    <textarea placeholder="LOS TELEFONOS ESTAN SEPARADOS POR COMAS (NO PRESIONAR ENTER)" oncopy="return true" onpaste="return true" style="max-height:100px;" id="idtelf" class="text-small"></textarea>
			</div>	    	
	    </div>

	    <div class="cell">
			<label class="text-accent">CORREO</label>
        	<div class="input-control textarea full-size rounded">
			    <textarea placeholder="LOS CORREOS ESTAN SEPARADOS POR COMAS (NO PRESIONAR ENTER)" readonly = "true" oncopy="return true" onpaste="return true" style="max-height:100px;" id="idemail"  class="text-small"></textarea>
			</div>
	    </div>
	</div>

	<div class="row cells">
	    <div class="cell">
	    	<label class="text-accent">REPRESENTANTE</label>
	    	<div class="input-control text full-size rounded">
		        <input id="idrepren" class="text-small">
		    </div>
	    </div>
	</div>
	<br>
	<br>
	<h5 style="font-weight: bold;">UBICACIÓN</h5>
	<hr style="color: #0056b2;" />
	<br>
	<div class="row cells2">
	    <div class="cell">
			<label class="text-accent">LOCALIDAD</label>
			<div class="input-control text full-size rounded" data-role="input">
		        <input id="idlocali" type="text" class="text-small">
		        <button class="button helper-button clear"><span class="mif-cross"></span></button>
		    </div>  
			<label class="text-accent">DIRECCION</label>
			<div class="input-control text full-size rounded" data-role="input">
		        <input id="iddirecc" type="text" class="text-small">
		        <button class="button helper-button clear"><span class="mif-cross"></span></button>
		    </div>  
			<label class="text-accent">TIENDA_SUNNY</label>
			<div class="input-control text full-size rounded" data-role="input">
		        <input id="idtienda" type="text" class="text-small">
		        <button class="button helper-button clear"><span class="mif-cross"></span></button>
		    </div>   	
	    </div>

	    <div class="cell">
			<label class="text-accent">DISTRITO</label>
			<div class="input-control text full-size rounded" data-role="input">
		        <input id="iddistri" type="text" class="text-small">
		        <button class="button helper-button clear"><span class="mif-cross"></span></button>
		    </div>
			<label class="text-accent">PROVINCIA</label>
			<div class="input-control text full-size rounded" data-role="input">
		        <input id="idprovin" type="text" class="text-small">
		        <button class="button helper-button clear"><span class="mif-cross"></span></button>
		    </div>
			<label class="text-accent">DEPARTAMENTO</label>
			<div class="input-control text full-size rounded" data-role="input">
		        <input id="iddeparta" type="text" class="text-small">
		        <button class="button helper-button clear"><span class="mif-cross"></span></button>
		    </div>
	    </div>
	</div>

</div>

