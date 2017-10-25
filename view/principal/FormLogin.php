<?php
class FormLogin {

    public function mostrarFormLogin() {
        ?>
        <!DOCTYPE HTML>
        <html>
            <head>
                <title>ICEFOX</title>
                <link href="css/styleLogin.css" rel="stylesheet" type="text/css" media="all"/>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link href='css/font-nunito.css' rel='stylesheet' type='text/css'>
                <link href='css/font-raleway.css' rel='stylesheet' type='text/css'>
                <link rel=icon href='../../images/images.png' sizes="32x32" type="image/png">
                <script src="js/jquery.min.js"></script>
                <script>$(document).ready(function (c) {
                        $('.close').on('click', function (c) {
                            $('.mail-section').fadeOut('slow', function (c) {
                                $('.mail-section').remove();
                            });
                        });
                    });
                </script>
            </head>
            <body>
                <div class="header">
                    <h1>Login IceFox</h1>
                </div>
                <div class="main">
                    <div class="mail-section">
                        <div class="close"> </div>
                        <div class="mail-image">
                            <img src="images/message.png" alt="" />
                            <h3>Bienvenido a</h3>
                            <h2>IceFox</h2>
                        </div>
                        <div class="mail-form">
                            <form name="formularioLogin" action="view/principal/getFormLogin.php" method="POST">
                                <input type="text" placeholder="Usuario...." required="" name="username" id="username"/>
                                <input type="password"  class="pass" placeholder="Password...." required="" name="password" id="password"/>
                                <input type="submit" value="Ingresar" name="ingresar" id="ingresar">
                            </form>
                        </div>
                        <div class="clear"> </div>
                    </div>
                </div>
            </body>
        </html>
        <?php
    }
}
;
?>