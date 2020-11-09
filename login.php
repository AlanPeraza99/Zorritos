<?php
  if(isset($_POST['user_name'])){
    include_once("app/controlador/usuario_controller.php");
    
    $hay_sesion = login($_POST['user_name'],$_POST['user_pass']);

    if($hay_sesion==true){
        header('location: index');
    }else{
        $error = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>El correo o la contraseña son incorrectos.</div>';
    }
    
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión</title>
    <?php include("modulos/head.php") ?>   
</head>
<body>
    <header>
    <div class="container">
                <a class="logo" href="index.php"><img src="images/logobanner.png" alt="Logo"></a>

                <div class="right-area">
                        <h6><a class="plr-20 color-white btn-fill-primary" href="index.php">Ver Vista Cliente</a></h6>
                </div><!-- right-area -->

                <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>
                

                <div class="clearfix"></div>
        </div><!-- container -->
    </header>

    <section class="bg-7 h-600x main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                    
                        <div class="dplay-tbl-cell center-text color-white pt-90">
                        <img class="heading-img-2" src="images/heading_logo.png" alt="">
                        <h2 class="abs-tlr-30">Inicio de Sesión</h2>
                        <form action="" name="login" method="POST" class="placeholder-1 form-style-1 pos-relative">
                        <div class="col-md-6"><input class="mtb-20" type="text" placeholder="Usuario" name="user_name"></div>
                        <div class="col-md-6"><input class="mtb-20" type="password" placeholder="Contraseña" name="user_pass"></div>
                        <?php if(isset($error)){
                            echo $error; } ?>

                                                        <button class="w-100 btn-primaryc-2" type="submit"><strong>Iniciar Sesión</strong> </button>
                                                </form>
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div><!-- container -->
</section>

</body>
</html>