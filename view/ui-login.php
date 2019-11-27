<?php
	session_start();
	if( isset($_SESSION['logeo']) AND $_SESSION['activo']==1){
		header('Location: ../view/ui-index.php');
	}
?>
<!DOCTYPE html>
	<head>
  	<title>GRUPO ANDINA</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">


    <link rel='stylesheet' href='../css/normalize.css'>

    <link href="../includes/Metro-UI-CSS-master/docs/css/metro.css" rel="stylesheet">
    <link href="../includes/Metro-UI-CSS-master/docs/css/metro-icons.css" rel="stylesheet">
    <link href="../includes/Metro-UI-CSS-master/docs/css/metro-responsive.css" rel="stylesheet">

    <link rel='stylesheet' href='../css/estilos.css'>

    <script src="../includes/jquery-2.1.3.min.js"></script>
    <script src="../includes/Metro-UI-CSS-master/docs/js/metro.js"></script>

    <script type="text/javascript" src="../js/loginDAO.js" ></script>
    <script type="text/javascript" src="../js/js-login.js" ></script>

    <script>
        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>

  </head>
  <body class="bkg_plomo_gradient">
	  <!-- <body style="background-image: url('../img/667386.jpg');height: 100%; background-position: center;background-repeat: no-repeat;background-size: cover;"> -->

    <!-- <div class="centrado-porcentual" id="logologin">
      <img src="../img/GRUPO_ANDINA_1.png" style="width:300px;"/>
    </div> -->

    <div class="login-form padding20 block-shadow" style="background: #272936;">
        <form>
            <h1 class="align-left"><h4><span style="color:#49B296" class="text-bold"><span style="font-size: 25px;color:#49B296;font-family: Conv_Robotica">LOGIN</span> - Acceso</span></h4></h1>

            <div class="input-control modern text iconic full-size" >
                <input type="text" autocomplete="off" style="color:white !important;" id="user_login">
                <span class="label text-bold" style="color:white !important;font-size: 14px;font-family: Conv_orbitron-bold">USUARIO</span>
                <span class="informer" style="color:white !important;font-size: 14px;font-family: Conv_orbitron-bold">Por favor ingrese su username</span>
                <span class="placeholder" id="idplhusu" style="color:white !important;font-size: 14px;font-family: Conv_orbitron-bold">Ingrese login</span>
                <span class="icon mif-user" style="color:white !important;"></span>
            </div>

            <div class="input-control modern password iconic full-size" data-role="input">
                <input type="password" autocomplete="off" style="color:white !important;" id="user_password">
                <span class="label" style="color:white !important;font-size: 14px;font-family: Conv_orbitron-bold">PASSWORD</span>
                <span class="informer" style="color:white !important;font-size: 14px;font-family: Conv_orbitron-bold">Por favor ingrese su password</span>
                <span class="placeholder" id="idplhpass" style="color:white !important;font-size: 14px;font-family: Conv_orbitron-bold">Ingrese password</span>
                <span class="icon mif-lock" style="color:white !important;"></span>
                <button class="button  helper-button reveal" style="background-color: #272936 !important;color:white !important;"><span class="mif-looks"></span></button>
            </div>
            <br>
            <br>
            <div class="form-actions align-center">
                <div style="font-size: 14px;font-family: Conv_orbitron-bold" class="button primary" onclick="logeo();">INGRESAR <span class="icon mif-enter"></span></div>
            </div>

        </form>
    </div>
</body>
</html>
