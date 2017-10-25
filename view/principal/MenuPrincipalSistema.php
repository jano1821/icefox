<?php
class MenuPrincipalSistema {

    public function mostrarMenuPrincipalSistema($menu) {
        ?>
        <!DOCTYPE html>
        <html lang="en" class="no-js">
            <head>
                <meta charset="UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Menu Principal</title>
                <link rel=icon href='../../images/images.png' sizes="32x32" type="image/png">
                <link rel="stylesheet" type="text/css" href="../../css/default.css" />
                <link rel="stylesheet" type="text/css" href="../../css/component.css" />
                <script src="../../js/modernizr.custom.js"></script>
                <script src="../../js/envioFormulario.js" type="text/javascript"></script>
            </head>
            <body>
                <div class="container">
                    <header class="clearfix">
                        <span>ICEFOX</span>
                        <h1>Sistema de Gestion de Especies Valoradas</h1>
                    </header>
                    <form name="formMenuPrincipal" id="formMenuPrincipal" method="POST" action="../../view/principal/GetMenuPrincipal.php">
                        <input type="hidden" name="codigoMenu" id="codigoMenu" value="NN">
                        <div class="main">
                            <nav id="cbp-hrmenu" class="cbp-hrmenu">
                                <ul>
                                    <?php
                                    echo $menu;
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </form>
                </div>

                <script src="../../js/jquery.min.menu.js"></script>
                <script src="../../js/cbpHorizontalMenu.min.js"></script>
                <script src="../../js/cbpHorizontalMenu.min.js"></script>
                <script>
                    $(function () {
                        cbpHorizontalMenu.init();
                    });
                </script>
            </body>
            <?php
            include('../generales/FooterFechaHora.php');
            ?>
        </html>
        <?php
    }
}
;
?>