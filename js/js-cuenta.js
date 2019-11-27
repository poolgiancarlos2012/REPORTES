$(document).ready(function(){


		// SI DIGITAN CODIGO CLIENTE
		$("#idtxtruc").on('keyup click',function(event){
			if (event.type == 'keyup') {
				var obj=$("#idtxtruc").val().replace(/\s+/g, '');
				if(obj.length==0){
					html="";
					$("#searchcliente").html(html);
					$("#searchcliente").css({'display':'none'});
					$("#idtxtrazon_social").val("");
					$("#iddesargar").attr("disabled",true);
					$("#iddesargar").removeClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
				}else if(obj.length==11){
						cuentaDAO.searchcodigo_cliente();
				}
			} else if (event.type == 'click') {
				var obj=$("#idtxtruc").val().replace(/\s+/g, '');
				if(obj.length==0){
					html="";
					$("#searchcliente").html(html);
					$("#searchcliente").css({'display':'none'});
					$("#idtxtrazon_social").val("");
					$("#iddesargar").attr("disabled",true);
					$("#iddesargar").removeClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
				}else if(obj.length==11){
						cuentaDAO.searchcodigo_cliente();
				}
			}
		});

		//SI DIGITAN RAZON SOCIAL
		$("#idtxtrazon_social").on('keyup click',function(event){
			if (event.type == 'keyup') {
				var obj=$("#idtxtrazon_social").val().replace(/\s+/g, '');
				if(obj.length==0){
					html="";
					$("#searchcliente").html(html);
					$("#searchcliente").css({'display':'none'});
					$("#idtxtruc").val("");
					$("#iddesargar").attr("disabled",true);
					$("#iddesargar").removeClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
				}else{
						$("#idtxtruc").val("");
						cuentaDAO.searchrazon_social();
				}
			} else if (event.type == 'click') {
				var obj=$("#idtxtrazon_social").val();
				if(obj.length==0){
					html="";
					$("#searchcliente").html(html);
					$("#searchcliente").css({'display':'none'});
					$("#idtxtruc").val("");
					$("#iddesargar").attr("disabled",true);
					$("#iddesargar").removeClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
				}else{
						cuentaDAO.searchrazon_social();
				}
			}
		});

		$("body").click(function(event){
			var idinput=event.target.id;
			if(idinput!='idtxtruc'){
				$('#searchcliente').hide();
			}
			if(idinput!='idtxtrazon_social'){
				$('#searchfundo').hide();
			}
			// if(idinput!='cultivo'){
			// 	$('#searchcultivo').hide();
			// }
			// if(idinput!='objetivo'){
			// 	$('#searchobjetivo').hide();
			// }
			// if(idinput!='problema'){
			// 	$('#searchproblema').hide();
			// }
		});

		$("#iddesargar").click(function(){
			// VALIDA SI TIENE DEUDA O NO
			var cod_cliente=$("#idtxtruc").val().replace(/\s+/g, '');
			cuentaDAO.ifexist_deuda_cliente(cod_cliente);

		});

		$("#iddescargarliq").click(function(){
			// VALIDA SI TIENE DEUDA O NO
			var payi=$("#idfchpagoini").val();
			var payf=$("#idfchpagofin").val();

			var crei=$("#idfchcreacionini").val();
			var cref=$("#idfchcreacionfin").val();

			var ruc=$("#idtxtruc").val();
			var empresa=$("#idtxtrazon_social").val();

			cuentaDAO.ifexist_liquidacion(payi,payf,crei,cref,ruc);

		});

		$("#idmesconcepto,#idanioconcepto").keyup(function(){

			var mes =$("#idmesconcepto").val().trim();
			var anio=$("#idanioconcepto").val().trim();

			if(mes.length==2 && anio.length==4){
				$("#iddescargarconcepto").removeAttr("disabled");
    			$("#iddescargarconcepto").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
			}else{
				$("#iddescargarconcepto").attr("disabled",true);
				$("#iddescargarconcepto").removeClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
			}

		});

		$("#iddescargarconcepto").click(function(){
			var mes =parseInt($("#idmesconcepto").val().trim());
			var anio=parseInt($("#idanioconcepto").val().trim());
			// window.location.href='../rpt/excel/contabilidad_conceptos.php?&mes='+mes+'&anio='+anio;

			cuentaDAO.ifexist_concepto(mes,anio);

		});

		$("#iddescargarhist").click(function(){
			var xini =$("#idfchdesde").val().trim();
			var xfin =$("#idfchhasta").val().trim();
			// window.location.href='../rpt/excel/contabilidad_conceptos.php?&mes='+mes+'&anio='+anio;

			var xempresa =$("#idlslcempresa").val();
			var xtipdoc =$("#idlslctipo_doc").val();

			cuentaDAO.ifexist_historico_documento(xini,xfin,xempresa,xtipdoc);

		});

		$("#iddescargarhist_detdoc").click(function(){
			var xini =$("#idfchdesde_det_doc").val().trim();
			var xfin =$("#idfchhasta_det_doc").val().trim();

			var xempresa =$("#idlslcdempresa").val();
			var xtipdoc =$("#idlslcdtipo_doc").val();

			var ar_cli0002=$('#ger_clientdet0002').val().split(" - ");
			xclie0002= ar_cli0002[0];
			
			cuentaDAO.ifexist_historico_documento_detalle(xini,xfin,xempresa,xtipdoc,xclie0002);



		});

		$("#iddescargartc").click(function(){
			var xini =$("#idfchini").val().trim();
			var xfin =$("#idfchfin").val().trim();
			cuentaDAO.ifexist_tipo_cambio(xini,xfin);
		});

	    $('#ger_agen0002').tagsInput({
			width: 'auto'
		});

		$('#ger_local0002').tagsInput({
			width: 'auto'
		});

	    $('#ger_agen0003').tagsInput({
			width: 'auto'
		});

		$('#ger_local0003').tagsInput({
			width: 'auto'
		});

	    $('#ger_agen0004').tagsInput({
			width: 'auto'
		});

		$('#ger_local0004').tagsInput({
			width: 'auto'
		});

	    $('#ger_agen0016').tagsInput({
			width: 'auto'
		});

		$('#ger_local0016').tagsInput({
			width: 'auto'
		});

		$('#ger_agenSU0016').tagsInput({
			width: 'auto'
		});

		$('#ger_localSU0016').tagsInput({
			width: 'auto'
		});

		// var options = {
		// 	url: function(phrase) {
		// 		return "../controller/ControllerAlfa.php";
		// 	},
		// 	getValue: function(element) {
		// 		return element.name;
		// 	},
		// 	ajaxSettings: {
		// 		dataType: "json",
		// 		method: "POST",
		// 		data: {
		// 			dataType: "json",
		// 			command:'cuenta',
		// 			action:'consultar_cliente',
		// 		}
		// 	},
		// 	preparePostData: function(data) {
		// 		data.phrase = $("#ger_client0002").val();
		// 		return data;
		// 	},
		// 	requestDelay: 0,
		// 	theme: "yellow"
		// };

		$("#ger_client0002").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#ger_client0002").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow"
			}
		);
		$("#ger_client0003").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#ger_client0003").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow"
			}
		);
		$("#ger_client0004").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#ger_client0004").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow"
			}
		);
		$("#ger_client0016").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#ger_client0016").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow"
			}
		);
		$("#ger_clientSU0016").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#ger_clientSU0016").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow"
			}
		);
		$("#base_cliente").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_codigo_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#base_cliente").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow",
				list: {
					onClickEvent: function() {
						var value = $("#base_cliente").getSelectedItemData();
						var cod_cliente = value["name"].toString().split(" - ");
						cuentaDAO.consultar_base_cliente(cod_cliente[0]);
					}
				}
			}
		);
		$("#lc_cliente").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_codigo_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#lc_cliente").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow",
				list: {
					onClickEvent: function() {
						var value = $("#lc_cliente").getSelectedItemData();
						var cod_cliente = value["name"].toString().split(" - ");
						cuentaDAO.consultar_linea_credito(cod_cliente[0]);
					}
				}
			}
		);

		$("#consulrtc").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consulta_vendedor_general',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#consulrtc").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow",
				list: {
					onClickEvent: function() {
						// var xrtc = $("#consulrtc").val().trim();
						// var xzona = $("#consulzona").val().trim();

						// if (xrtc.length!='' && xzona.length!='') {
						// 	$("#iddesargarCartas").removeAttr("disabled");
						//  $("#iddesargarCartas").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
						// } else {
						// 	$("#iddesargarCartas").attr("disabled",true);
						// 	$("#iddesargarCartas").removeClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
						// }
					}
				}
			}
		);

		$("#consulzona").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consulta_zona_general',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#consulzona").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow",
				list: {
					onClickEvent: function() {
						var xrtc = $("#consulrtc").val().trim();
						var xzona = $("#consulzona").val().trim();

						// if (xrtc.length!=0 || xzona.length!=0) {
						// 	// alert(1);
						// 	$("#iddesargarCartas").removeAttr("disabled");
			   //  			$("#iddesargarCartas").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
						// } else {
						// 	$("#iddesargarCartas").attr("disabled",true);
						// 	$("#iddesargarCartas").removeClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
						// }
					}
				}
			}
		);

		$("#ger_clientdet0002").easyAutocomplete(
			{
				url: function(phrase) {
					return "../controller/ControllerAlfa.php";
				},
				getValue: function(element) {
					return element.name;
				},
				ajaxSettings: {
					dataType: "json",
					method: "POST",
					data: {
						dataType: "json",
						command:'cuenta',
						action:'consultar_cliente',
					}
				},
				preparePostData: function(data) {
					data.phrase = $("#ger_clientdet0002").val();
					return data;
				},
				requestDelay: 0,
				theme: "yellow"
			}
		);

		$("#descargagerencial").click(function(){

			var xempr0002="";
			var xagen0002="";
			var xclie0002="";
			var xiemi0002="";
			var xfemi0002="";
			var xloca0002="";

			var xempr0003="";
			var xagen0003="";
			var xclie0003="";
			var xiemi0003="";
			var xfemi0003="";
			var xloca0003="";

			var xempr0004="";
			var xagen0004="";
			var xclie0004="";
			var xiemi0004="";
			var xfemi0004="";
			var xloca0004="";

			var xempr0016="";
			var xagen0016="";
			var xclie0016="";
			var xiemi0016="";
			var xfemi0016="";
			var xloca0016="";

			if ($('input[name="empresa"][value="0002"]').prop('checked')) {
				var ar_cli0002=$('#ger_client0002').val().split(" - ");
				xempr0002= "0002";
				xagen0002= $('#ger_agen0002').tagsInput()[0].value;
				xclie0002= ar_cli0002[0];
				xiemi0002= $('#ger_emini0002').val();
				xfemi0002= $('#ger_emfin0002').val();
				xloca0002= $( '#ger_local0002' ).tagsInput()[0].value;
			}
			if($('input[name="empresa"][value="0003"]').prop('checked')){
				var ar_cli0003=$('#ger_client0003').val().split(" - ");
				xempr0003= "0003";
				xagen0003= $('#ger_agen0003').tagsInput()[0].value;
				xclie0003= ar_cli0003[0];
				xiemi0003= $('#ger_emini0003').val();
				xfemi0003= $('#ger_emfin0003').val();
				xloca0003= $( '#ger_local0003' ).tagsInput()[0].value;
			}
			if($('input[name="empresa"][value="0004"]').prop('checked')){
				var ar_cli0004=$('#ger_client0004').val().split(" - ");
				xempr0004= "0004";
				xagen0004= $('#ger_agen0004').tagsInput()[0].value;
				xclie0004= ar_cli0004[0];
				xiemi0004= $('#ger_emini0004').val();
				xfemi0004= $('#ger_emfin0004').val();
				xloca0004= $( '#ger_local0004' ).tagsInput()[0].value;
			}
			if($('input[name="empresa"][value="0016"]').prop('checked')){
				var ar_cli0016=$('#ger_client0016').val().split(" - ");
				xempr0016= "0016";
				xagen0016= $('#ger_agen0016').tagsInput()[0].value;
				xclie0016= ar_cli0016[0];
				xiemi0016= $('#ger_emini0016').val();
				xfemi0016= $('#ger_emfin0016').val();
				xloca0016= $( '#ger_local0016' ).tagsInput()[0].value;
			}

			var xparams = {
				empr0002:xempr0002,
				agen0002:xagen0002,
				clie0002:xclie0002,
				iemi0002:xiemi0002,
				femi0002:xfemi0002,
				loca0002:xloca0002,
				empr0003:xempr0003,
				agen0003:xagen0003,
				clie0003:xclie0003,
				iemi0003:xiemi0003,
				femi0003:xfemi0003,
				loca0003:xloca0003,
				empr0004:xempr0004,
				agen0004:xagen0004,
				clie0004:xclie0004,
				iemi0004:xiemi0004,
				femi0004:xfemi0004,
				loca0004:xloca0004,
				empr0016:xempr0016,
				agen0016:xagen0016,
				clie0016:xclie0016,
				iemi0016:xiemi0016,
				femi0016:xfemi0016,
				loca0016:xloca0016
			};

			var str = jQuery.param(xparams);

			window.location.href='../rpt/excel/gerencia_diario.php?'+str;

		});

		$("#iddesargarCartas").click(function(){





			var ar_rtc=$('#consulrtc').val().split(" - ");
			var xrtc  = ar_rtc[0];

			var ar_zona=$('#consulzona').val().split(" - ");
			var xzona = ar_zona[0];

			// alert(xrtc);

			// if (xrtc.length!=0 || xzona.length!=0) {
			// 	return false
			// }

			cuentaDAO.ifexist_cartas(xrtc,xzona);
		});

		$('#idsuper,#idtip_ries,#idlin_ba,#idsobreg,#idlin_cre,#idtelf,#idemail,#idrepren,#idlocali,#iddirecc,#iddistri,#idprovin,#iddeparta,#idtienda,#idest_ext').keyup(function(e){
		    if(e.keyCode == 13){

		    	var xcodigo_cliente= $("#idrazon_social").val().toString().split(" - ");

		    	var idsuper=$("#idsuper").val();
		    	var idtip_ries=$("#idtip_ries").val();
		    	var idlin_ba=$("#idlin_ba").val();
		    	var idsobreg=$("#idsobreg").val();
		    	var idlin_cre=$("#idlin_cre").val();
		    	var idtelf=$("#idtelf").val();
		    	var idemail=$("#idemail").val();
		    	var idrepren=$("#idrepren").val();
		    	var idlocali=$("#idlocali").val();
		    	var iddirecc=$("#iddirecc").val();
		    	var iddistri=$("#iddistri").val();
		    	var idprovin=$("#idprovin").val();
		    	var iddeparta=$("#iddeparta").val();
		    	var idtienda=$("#idtienda").val();
		    	var idest_ext=$("#idest_ext").val();

				cuentaDAO.update_base_cliente(xcodigo_cliente[0],idsuper,idtip_ries,idlin_ba,idsobreg,idlin_cre,idtelf,idemail,idrepren,idlocali,iddirecc,iddistri,idprovin,iddeparta,idtienda,idest_ext);

		    }
		});


		$("#descargaSUgerencial").click(function(){

			var xempr0016="";
			var xagen0016="";
			var xclie0016="";
			var xiemi0016="";
			var xfemi0016="";
			var xloca0016="";

			if($('input[name="empresa"][value="0016"]').prop('checked')){
				var ar_cli0016=$('#ger_clientSU0016').val().split(" - ");
				xempr0016= "0016";
				xagen0016= $('#ger_agenSU0016').tagsInput()[0].value;
				xclie0016= ar_cli0016[0];
				xiemi0016= $('#ger_eminiSU0016').val();
				xfemi0016= $('#ger_emfinSU0016').val();
				xloca0016= $( '#ger_localSU0016' ).tagsInput()[0].value;
			}

			var xparams = {
				empr0016:xempr0016,
				agen0016:xagen0016,
				clie0016:xclie0016,
				iemi0016:xiemi0016,
				femi0016:xfemi0016,
				loca0016:xloca0016
			};

			var str = jQuery.param(xparams);

			window.location.href='../rpt/excel/gerencia_diario_sunny.php?'+str;

		});

		$("#btndireccioncliente").click(function(){
			window.location.href='../rpt/excel/direccion_cliente.php';
		});

		$("#idloademail").click(function(){
			cuentaDAO.CargarEmail();
		});

		$("#idrefresh").click(function(){
			cuentaDAO.RefreshCantEmail();
		});

		$("#idguradraprog").click(function(){
			var idfecha_program = $("#idfecha_program").val();
			var idestadoprog = $("#idestadoprog").val();

			cuentaDAO.Save_Programacion(idfecha_program,idestadoprog);

		});


});




function GetIndex(index,elem,table,symb){
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text()); // OBTIENE RAZON SOCIAL
    if($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)"+" input").length==1){ // SI EXISTE EL INPT HIDE DEL CODIGO CLIENTE LO SETEA
    	$("#idtxtruc").val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)"+" input").val()); // OBTIENE CODIGO CLIENTE
    	$("#ger_codcli0002").val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)"+" input").val()); // OBTIENE CODIGO CLIENTE
    	$("#ger_codcli0003").val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)"+" input").val()); // OBTIENE CODIGO CLIENTE
    	$("#ger_codcli0004").val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)"+" input").val()); // OBTIENE CODIGO CLIENTE
    	$("#ger_codcli0016").val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)"+" input").val()); // OBTIENE CODIGO CLIENTE
    }

    $("#iddesargar").removeAttr("disabled");
    $("#iddesargar").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function Validacionxfecha(){
	var payi=$("#idfchpagoini").val();
	var payf=$("#idfchpagofin").val();
	if(payi!="" && payf!=""){
		$("#iddescargarliq").removeAttr("disabled");
    	$("#iddescargarliq").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
	}

	$("#idfchcreacionini").val("");
	$("#idfchcreacionfin").val("");

}

function Validacionxfecha_crea(){
	var creai=$("#idfchcreacionini").val();
	var creaf=$("#idfchcreacionfin").val();
	if(creai!="" && creaf!=""){
		$("#iddescargarliq").removeAttr("disabled");
    	$("#iddescargarliq").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
	}

	$("#idfchpagoini").val("");
	$("#idfchpagofin").val("");

}

function Validacionxfecha_hist_doc(){
	var fchi=$("#idfchdesde").val();
	var fchf=$("#idfchhasta").val();
	if(fchi!="" && fchf!=""){
		$("#iddescargarhist").removeAttr("disabled");
    	$("#iddescargarhist").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
	}

}

function Validacionxfecha_hist_detdoc(){
	var fchi=$("#idfchdesde_det_doc").val();
	var fchf=$("#idfchhasta_det_doc").val();
	if(fchi!="" && fchf!=""){
		$("#iddescargarhist_detdoc").removeAttr("disabled");
    	$("#iddescargarhist_detdoc").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
	}
}

function Validacionxtc(){
	var payi=$("#idfchini").val();
	var payf=$("#idfchfin").val();
	if(payi!="" && payf!=""){
		$("#iddescargartc").removeAttr("disabled");
    	$("#iddescargartc").addClass('bg-lightGreen fg-white text-shadow bg-active-darkEmerald');
	}
}


$("input[type='checkbox'][value='0002']").prop('checked', true);


function chequear(xcod){
	$(".easy-autocomplete").removeAttr( 'style' );
	if ($("input[type='checkbox'][value='"+xcod+"']").is(':checked')) {
		$("input[type='checkbox'][value='"+xcod+"']").prop('checked', false);
	}else{
		$("input[type='checkbox'][value='"+xcod+"']").prop('checked', true);
	}
}
