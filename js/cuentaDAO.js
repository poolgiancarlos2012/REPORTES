var cuentaDAO={
	url:'../controller/ControllerAlfa.php',
  	idLayerMessage : 'layerMessage',
  	searchcodigo_cliente : function(){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'searchbycodigo_cliente',
				codigo_cliente:$("#idtxtruc").val()
			},
			beforeSend:function(){

			},
			success:function(obj){
				if(obj.rst){
					if(obj.ardata.length==1){
						$("#idtxtrazon_social").val("");
						$("#idtxtrazon_social").val(obj.ardata[0]['CL_CNOMCLI']);

						$("#iddesargar").removeAttr("disabled");
    					$("#iddesargar").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');

					}else if(obj.ardata.length>=2){
						$("#idtxtrazon_social").val("");
						var table="";
						table+='<div class="row">';
						table+='<div class="span9">';
						table+='<table class="table" id="tabledtr" >';
						table+='<tbody>';
						for(var i=0;i<=obj.ardata.length-1;i++){

							table+='<tr id= "dtr'+i+'" style="cursor: pointer;" class="changecolor" onclick="GetIndex(this,\'idtxtrazon_social\',\'tabledtr\',\'dtr\')">';
							table+='<td class="changed" align="left"><p class="text-default">'+$.trim(obj.ardata[i]['CL_CNOMCLI'])+'</p></td>';
			                table+='</tr>';
						}
						table+='</tbody>';
						table+='</table>';
						table+='</div>';
						table+='</div>';

						$("#searchcliente").css({'display':'block'});
                    	$("#searchcliente").html(table);
					}
				}else{

				}
			},
			error:function(){

			}
		});
  	},
  	searchrazon_social : function(){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'searchbyrazon_social',
				rz:$("#idtxtrazon_social").val()
			},
			beforeSend:function(){

			},
			success:function(obj){
				if(obj.rst){
						var table="";
						table+='<div class="row">';
						table+='<div class="span9">';
						table+='<table class="table" id="tabledtr" >';
						table+='<tbody>';
						for(var i=0;i<=obj.ardata.length-1;i++){

							table+='<tr id= "dtr'+i+'" style="cursor: pointer;" class="changecolor" onclick="GetIndex(this,\'idtxtrazon_social\',\'tabledtr\',\'dtr\')">';
							// table+='<tr id= "dtr'+i+'" style="cursor: pointer;" class="changecolor" onclick="GetIndex(this,\'idtxtrazon_social\');">';
			                table+='<td class="changed" align="left"><p class="text-default"><input id="rzc'+i+'" value="'+$.trim(obj.ardata[i]['CL_CCODCLI'])+'" type="hidden">'+$.trim(obj.ardata[i]['CL_CNOMCLI'])+'</p></td>';
			                table+='</tr>';
						}
						table+='</tbody>';
						table+='</table>';
						table+='</div>';
						table+='</div>';

						$("#searchcliente").css({'display':'block'});
                    	$("#searchcliente").html(table);
				}else{
				}
			},
			error:function(){

			}
		});
  	},
  	ifexist_deuda_cliente: function(cod_cliente){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'ifexist_deuda_cliente',
				codigo_cliente: cod_cliente
			},
			beforeSend:function(){

			},
			success:function(obj){
				if(obj.rst){
					 window.location.href='../rpt/excel/estado_cuenta_cliente.php?&codigo_cliente='+cod_cliente;
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
				}
			},
			error:function(){

			}
		});
  	},
  	ifexist_liquidacion: function(xpayi,xpayf,xcrei,xcref,xruc){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'ifexist_liquidacion',
				payi: xpayi,
				payf: xpayf,
				crei:xcrei,
				cref:xcref,
				ruc:xruc
			},
			beforeSend:function(){
				metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					window.location.href='../rpt/excel/empresas_liquidacion.php?&payi='+xpayi+'&payf='+xpayf+'&crei='+xcrei+'&cref='+xcref+'&ruc='+xruc;
					metroDialog.close('#dialog9')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
				}
			},
			error:function(){

			}
		});
  	},
  	ifexist_concepto: function(xmes,xanio){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'ifexist_concepto',
				mes: xmes,
				anio: xanio
			},
			beforeSend:function(){
				metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					 // window.location.href='../rpt/excel/empresas_liquidacion.php?&payi='+xpayi+'&payf='+xpayf;
					 window.location.href='../rpt/excel/contabilidad_conceptos.php?&mes='+xmes+'&anio='+xanio;
					 metroDialog.close('#dialog9')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
  	ifexist_historico_documento: function(xini,xfin,xempresa,xtipdoc){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'ifexist_historico_documento',
				ini: xini,
				fin: xfin,
				empresa:xempresa,
				tipdoc:xtipdoc
			},
			beforeSend:function(){
				metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					 // window.location.href='../rpt/excel/empresas_liquidacion.php?&payi='+xpayi+'&payf='+xpayf;
					 window.location.href='../rpt/excel/historico_documento.php?&ini='+xini+'&fin='+xfin+"&empresa="+xempresa+"&tipdoc="+xtipdoc;
					 metroDialog.close('#dialog9')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
  	ifexist_historico_documento_detalle: function(xini,xfin,xempresa,xtipdoc,xcodclie){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'ifexist_historico_documento_detalle',
				ini: xini,
				fin: xfin,
				empresa:xempresa,
				tipdoc:xtipdoc,
				codclie:xcodclie
			},
			beforeSend:function(){
				metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					 window.location.href='../rpt/excel/historico_documento_detalle.php?&ini='+xini+'&fin='+xfin+"&empresa="+xempresa+"&tipdoc="+xtipdoc+'&codclie='+xcodclie;
					 metroDialog.close('#dialog9')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
  	ifexist_tipo_cambio: function(xini,xfin){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'ifexist_tipo_cambio',
				ini: xini,
				fin: xfin
			},
			beforeSend:function(){
				metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					 window.location.href='../rpt/excel/tipo_de_cambio.php?&ini='+xini+'&fin='+xfin;
					 metroDialog.close('#dialog9')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
  	loadManufacturer : function(url) {
	    var tmp = null;
	    $.ajax({
	    	url: url,
	        async: false,
	        type: "POST",
	        global: false,
	        dataType: 'json',
	        data: {
				//dataType: "json",
				command:'cuenta',
				action:'consultar_cliente',
				phrase: $("#ger_client0002").val()
			},

	        success: function (data) {
	            tmp = data;
	        }
	    });
	    return tmp;
	},
	consultar_base_cliente : function(xcodigo_cliente){
		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'consultar_base_cliente',
				codigo_cliente:xcodigo_cliente
			},
			beforeSend:function(){
				// metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					$("#idrazon_social").val(obj.datos[0]['RUC']+" - "+obj.datos[0]['CLIENTE']);
					$("#idtip_client").val(obj.datos[0]['TIPO_CLIENTE']);
					$('#idsuper').val(obj.datos[0]['SUPERVISOR']);
					$('#idtip_ries').val(obj.datos[0]['TIPO_RIESGO']);
					$('#idlin_ba').val(obj.datos[0]['LINEA_BASE']);
					$('#idsobreg').val(obj.datos[0]['SOBREGIRO_CAMPANIA']);
					$('#idlin_cre').val(obj.datos[0]['LINEA_CREDITO_TOTAL']);
					$('#idest_ext').val(obj.datos[0]['ESTUDIO_EXTERNO']);
					$('#idcod_zona').val(obj.datos[0]['COD_ZONA']);
					$('#idzona').val(obj.datos[0]['ZONA']);
					$('#idcod_vend').val(obj.datos[0]['COD_VEN']);
					$('#idresponsa').val(obj.datos[0]['RESPONSABLE_ZONA']);
					$('#idcodvenrtc').val(obj.datos[0]['COD_VEN_RTC_JUNIOR']);
					$('#idrtc').val(obj.datos[0]['RTC']);
					$('#idtelf').val(obj.datos[0]['TELEFONO']);
					$('#idemail').val(obj.datos[0]['CORREO']);
					$('#idrepren').val(obj.datos[0]['REPRESENTANTE']);
					$('#idlocali').val(obj.datos[0]['LOCALIDAD']);
					$('#iddirecc').val(obj.datos[0]['DIRECCION']);
					$('#idtienda').val(obj.datos[0]['TIENDA_SUNNY']);
					$('#iddistri').val(obj.datos[0]['DISTRITO']);
					$('#idprovin').val(obj.datos[0]['PROVINCIA']);
					$('#iddeparta').val(obj.datos[0]['DEPARTAMENTO']);



				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
				}
			},
			error:function(){

			}
		});
	},
	update_base_cliente : function (xcodigo_cliente,xidsuper,xidtip_ries,xidlin_ba,xidsobreg,xidlin_cre,xidtelf,xidemail,xidrepren,xidlocali,xiddirecc,xiddistri,xidprovin,xiddeparta,xidtienda,xidest_ext){
		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'update_base_cliente',
				codigo_cliente:xcodigo_cliente,
				idsuper:xidsuper,
		    	idtip_ries:xidtip_ries,
		    	idlin_ba:xidlin_ba,
		    	idsobreg:xidsobreg,
		    	idlin_cre:xidlin_cre,
		    	idtelf:xidtelf,
		    	idemail:xidemail,
		    	idrepren:xidrepren,
		    	idlocali:xidlocali,
		    	iddirecc:xiddirecc,
		    	iddistri:xiddistri,
		    	idprovin:xidprovin,
		    	iddeparta:xiddeparta,
		    	idtienda:xidtienda,
		    	idest_ext:xidest_ext
			},
			beforeSend:function(){
				// metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						type: 'success'
					});
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
				}
			},
			error:function(){

			}
		});
	},
	consultar_linea_credito : function(xcodigo_cliente){
		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'consultar_linea_credito',
				codigo_cliente:xcodigo_cliente
			},
			beforeSend:function(){
				// metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){

// alert(obj.datos['tipo_riesgo']);

					$("#idxlin_base").val(obj.datos['linea_base']);
					$("#idx_por_campania").val(obj.datos['por_campania']);
					$("#idxtotal").val(obj.datos['total']);
					$("#idx_sald_consu").val(obj.datos['saldo_consumido']);
					$("#idx_difer").val(obj.datos['diferencia']);
					$("#idx_descrip").val(obj.datos['descripcion']);

					$("#idx_cod_zona").val(obj.datos['cod_zona']);
					$("#idx_zona").val(obj.datos['nom_zona']);
					$("#idx_tip_riesg").val(obj.datos['tipo_riesgo']);
					$("#idx_cod_vend").val(obj.datos['cod_vend']);
					$("#idx_vend").val(obj.datos['nom_vend']);
					$("#idx_supervi").val(obj.datos['supervisor']);
					$("#idx_obs").val(obj.datos['obs']);

// linea_base
// por_campania
// total
// saldo_consumido
// diferencia
// descripcion
// cod_zona
// nom_zona
// tipo_riesgo
// cod_vend
// nom_vend
// supervisor


				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
				}
			},
			error:function(){

			}
		});
	},
	ifexist_cartas: function(xrtc,xzona){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'ifexist_cartas',
				rtc: xrtc,
				zona: xzona
			},
			beforeSend:function(){
				// metroDialog.toggle('#dialog9')
			},
			success:function(obj){
				if(obj.rst){
					 // window.location.href='../rpt/pdf/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona;
					 window.open('http://191.98.186.82:8080/REPORTES/rpt/pdf/call/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona, '_blank');
					 // metroDialog.close('#dialog9')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					// metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
	CargarEmail: function(){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'CargarEmail'
			},
			beforeSend:function(){
				 metroDialog.toggle('#dialog10')
			},
			success:function(obj){
				if(obj.rst){
					 // window.location.href='../rpt/pdf/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona;
					// window.open('http://191.98.186.82:8080/REPORTES/rpt/pdf/call/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona, '_blank');

					$("#idcantsendmail").text(obj.cant);

					  metroDialog.close('#dialog10')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					// metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
	RefreshCantEmail: function(){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'RefreshCantEmail'
			},
			beforeSend:function(){
				 metroDialog.toggle('#dialog10')
			},
			success:function(obj){
				if(obj.rst){
					 // window.location.href='../rpt/pdf/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona;
					// window.open('http://191.98.186.82:8080/REPORTES/rpt/pdf/call/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona, '_blank');

					$("#idcantsendmail").text(obj.cant);
					$("#idfecha_program").val(obj.fecha_prog);
					$("#idestadoprog").val(obj.estado);

					  metroDialog.close('#dialog10')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					// metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
	Save_Programacion: function(xidfecha_program,xidestadoprog){
  		$.ajax({
				url:this.url,
				type:'POST',
				dataType:'json',
				data:{
				command:'cuenta',
				action:'Save_Programacion',
				idfecha_program : xidfecha_program,
				idestadoprog : xidestadoprog
			},
			beforeSend:function(){
				 metroDialog.toggle('#dialog10')
			},
			success:function(obj){
				if(obj.rst){
					 // window.location.href='../rpt/pdf/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona;
					// window.open('http://191.98.186.82:8080/REPORTES/rpt/pdf/call/CALLConfirmCartas.php?&rtc='+xrtc+'&zona='+xzona, '_blank');

					  metroDialog.close('#dialog10')
				}else{
					$.Notify({
						caption: 'Información',
						content: obj.msg,
						icon: "<span class='mif-warning'></span>",
						type: 'info'
					});
					// metroDialog.close('#dialog9')
				}
			},
			error:function(){

			}
		});
  	},
}
