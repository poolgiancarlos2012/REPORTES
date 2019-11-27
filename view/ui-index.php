<?php
session_start();
if (!isset($_SESSION['logeo'])) {header('Location:../index.php');}
else if(!$_SESSION['activo']) {header('Location:../index.php');}
include('ui-call-file.php');
?>
<!DOCTYPE html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Index</title>
    <link rel="shortcut icon" href="../img/andina.ico" type="image/x-icon">
    <link rel='stylesheet' href='../css/normalize.css'/>
    <link type="text/css" rel="stylesheet" href="../css/estilos.css" />
    <link type="text/css" rel="stylesheet" href="../css/ma-base.css" />
    <link type="text/css" rel="stylesheet" href="../css/ma-global.css" />
    <link type="text/css" rel="stylesheet" href="../css/ma-global-2c.css" />
    <link type="text/css" rel="stylesheet" href="../css/ma-responsive.css" />
    <link type="text/css" rel="stylesheet" href="../css/ma-responsive-2c.css" />

    <link href="../includes/Metro-UI-CSS-master/docs/css/metro.css" rel="stylesheet">
    <link href="../includes/Metro-UI-CSS-master/docs/css/metro-icons.css" rel="stylesheet">
    <link href="../includes/Metro-UI-CSS-master/docs/css/metro-responsive.css" rel="stylesheet">
    <link href="../includes/Metro-UI-CSS-master/docs/css/metro-schemes.css" rel="stylesheet">
    <link href="../includes/Metro-UI-CSS-master/docs/css/metro-colors.css" rel="stylesheet">
    <link href="../includes/Metro-UI-CSS-master/docs/css/docs.css" rel="stylesheet">
    <!-- <script src="../includes/jquery-2.1.3.min.js"></script> -->
    <script src="../includes/jquery-ui-1.10.1/tests/jquery-1.9.1.js"></script>
    <!-- <script src="../includes/jquery-1.11.2.js"></script> -->
    <!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> -->
    <!-- <script type="text/javascript" src="../js/includes/jquery-1.4.2.js" ></script> -->
    <!-- <script src="../includes/jquery-ui-1.8.24/ui/jquery-ui.js"></script> -->


    <!-- <link type="text/css" rel="stylesheet" href="../includes/jquery-ui-themes-1.8.24/themes/start/jquery-ui.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" /> -->


    <script src="../includes/Metro-UI-CSS-master/docs/js/metro.js"></script>
    <!--<script src="../includes/Metro-UI-CSS-master/docs/js/docs.js"></script>-->
    <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="../includes/Metro-UI-CSS-master/docs/js/ga.js"></script>
    <!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->

    <!--[if lt IE 9]>
    <script type="text/javascript">
    var is_ie_lt9 = true;
    document.createElement('header');
    document.createElement('footer');
    document.createElement('nav');
    document.createElement('section');
    document.createElement('article');
    document.createElement('aside');
    document.createElement('figure');
    document.createElement('figcaption');
    </script>
    <![endif]-->

     <link rel="stylesheet" type="text/css" href="../includes/jQuery-Tags-Input-master/jquery.tagsinput.css">
     <script type="text/javascript" src="../includes/jQuery-Tags-Input-master/jquery.tagsinput.js"></script>

<!--     <link rel="stylesheet" type="text/css" href="../includes/jquery-textext-master_1.3.1/src/css/textext.core.css">
    <link rel="stylesheet" type="text/css" href="../includes/jquery-textext-master_1.3.1/src/css/textext.plugin.arrow.css">
    <link rel="stylesheet" type="text/css" href="../includes/jquery-textext-master_1.3.1/src/css/textext.plugin.autocomplete.css">
    <link rel="stylesheet" type="text/css" href="../includes/jquery-textext-master_1.3.1/src/css/textext.plugin.clear.css">
    <link rel="stylesheet" type="text/css" href="../includes/jquery-textext-master_1.3.1/src/css/textext.plugin.focus.css">
    <link rel="stylesheet" type="text/css" href="../includes/jquery-textext-master_1.3.1/src/css/textext.plugin.prompt.css">
    <link rel="stylesheet" type="text/css" href="../includes/jquery-textext-master_1.3.1/src/css/textext.plugin.tags.css">


    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.core.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.ajax.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.arrow.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.autocomplete.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.clear.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.filter.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.focus.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.prompt.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.suggestions.js"></script>
    <script type="text/javascript" src="../includes/jquery-textext-master_1.3.1/src/js/textext.plugin.tags.js"></script> -->


    <script src="../includes/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js"></script>
    <link rel="stylesheet" href="../includes/EasyAutocomplete-1.3.5/easy-autocomplete.css">
    <link rel="stylesheet" href="../includes/EasyAutocomplete-1.3.5/easy-autocomplete.themes.css">

    <?php echo (isset($call_file)==TRUE) ? $call_file : "";?>
</head>
<body class="bkg_plomo_gradient">
<!-- <body style="background-image: url('../img/338341.jpg');height: 100%; background-position: center;background-repeat: no-repeat;background-size: cover;"> -->
    <input type="hidden" id="dni_usuario" value="<?php echo $_SESSION['usuario'];?>">
    <!-- HEADER -->
    <div class="container padding10" >
        <div class="grid" style="border:none;">
            <div class="row cells12">
                <!-- <div class="cell colspan12 " > -->
                    <?php include('ui-header.php');?>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <!-- NAV AND SECTION -->
    <div class="container padding10" style="background-color: none;">
        <div class="grid" >
            <div class="row cells12">
                <div class="cell colspan4 " >
                    <?php include('ui-nav.php');?>
                </div>
                <div class="cell colspan8 " style="background-color: none;">
                    <?php include('ui-section.php');?>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <div class="container padding10" >
        <div class="flex-grid" >
            <div class="row cells12">
                    <?php include('ui-footer.php');?>
            </div>
        </div>
    </div>

    <div data-role="dialog" id="dialog9" class="padding20 dialog" data-close-button="false" data-overlay="true" data-overlay-color="op-dark" data-background="bg-black" data-color="fg-white" data-overlay-click-close="false" style="width: auto; height: auto; visibility: hidden;">
        <h1>Espere Por Favor</h1>
        <p>
            Descargando Archivo...!!!
        </p>
    </div>

    <div data-role="dialog" id="dialog10" class="padding20 dialog" data-close-button="false" data-overlay="true" data-overlay-color="op-dark" data-background="bg-black" data-color="fg-white" data-overlay-click-close="false" style="width: auto; height: auto; visibility: hidden;">
        <h1>Espere Por Favor</h1>
        <p>
            Procesando...!!!
        </p>
    </div>

</body>
</html>
