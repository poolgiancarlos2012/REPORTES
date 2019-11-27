var loginDAO={
  url:'../controller/ControllerAlfa.php',
  idLayerMessage : 'layerMessage',
  checkUser:function( ){
    $.ajax({
      url:this.url,
      type:'POST',
      dataType:'json',
      data:{
        command:'logeo',
        action:'acceso',
        usuario:$.trim($('#user_login').val()),
        clave:$.trim($('#user_password').val())
      },
      beforeSend:function(){

      },
      success:function(obj){
        if(obj.rst){          
          // if(obj.tipo_usuario=='SUPERVISOR'){
          //     window.location.href='../view/ui-index.php?abrir_pagina=cliente';
          // }else if(obj.tipo_usuario=='SISTEMAS'){
          //     window.location.href='../view/ui-index.php';
          // }
          window.location.href='../view/ui-index.php';
        }else{
          $.Notify({
            caption: 'ALERTA',
            content: obj.msg,
            icon: "<span class='mif-warning'></span>",
            type: 'alert'
          });
        }
      },
      error:function(){

      }
    });
  },
  hide_message:function(){
		
  },
  setTimeOut_hide_message:function(){

  }
}