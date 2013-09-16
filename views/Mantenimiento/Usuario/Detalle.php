<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      
        <link rel="stylesheet" type="text/css" href="resources/css/start/jquery-ui-1.10.3.custom.min.css"/>
        <link rel="stylesheet" type="text/css" href="resources/css/template.css"/>
      
        <script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="resources/js/template.default.js"></script>
        <script type="text/javascript" src="resources/js/jquery.codaPopupBubbles.js"></script>

        <title>SIRALL2 - Detalle Usuario</title>
    </head>
    <body>
        <aside>
            <header>
                <?php include_once 'views/Home/header.php';?>
            </header>
            <nav>
                <?php include_once 'views/Home/nav.php';?>
            </nav>
        </aside>
        <section>
            <article>
                <header>
                    <hgroup>
                        <h2>Detalle Usuario</h2>
                        <h4>Detalla la información del Usuario</h4>
                    </hgroup>
                </header>
                <fieldset>
                    <legend>Detalle Usuario</legend>
                    <table>
                        <tr>
                            <td><strong><abbr title="Código identificador">ID.</abbr> Usuario:</strong></td>
                            <td><?php echo $usuario->getIdUsuario(); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Descripción:</strong></td>
                            <td><?php echo $usuario->getDescripcion(); ?></td>  
                        </tr>
                        <tr>
                            <td><strong>Dirección:</strong></td>
                            <td><?php echo $usuario->getDireccion(); ?></td>  
                        </tr>
                        <tr>
                            <td>
                                <a href="?controller=Usuario&action=Editar&idUsuario=<?php echo $usuario->getIdUsuario(); ?>">Editar</a> |
                                <a href="?controller=Usuario&action=Eliminar&idUsuario=<?php echo $usuario->getIdUsuario(); ?>">Eliminar</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="?controller=Usuario">Regresar</a></td>
                        </tr>
                    </table>
                </fieldset>
            </article>
        </section>
    </body>
</html>