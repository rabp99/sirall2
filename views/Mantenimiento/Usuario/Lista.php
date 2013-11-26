<!-- File: /views/Mantenimiento/Usuario/lista.php -->

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       
        <link rel="stylesheet" type="text/css" href="resources/css/start/jquery-ui-1.10.3.custom.min.css"/>
        <link rel="stylesheet" type="text/css" href="resources/css/template.css"/>
        <link rel="stylesheet" type="text/css" href="resources/css/jquery.dataTables_themeroller.css"/>
       
        <script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="resources/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="resources/js/template.default.js"></script>
        <script type="text/javascript" src="resources/js/template.lista.js"></script>
        
        <title>SIRALL2 - Lista Usuario</title>
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
                        <h2>Lista Usuario</h2>
                        <h4>Lista de Usuarios registrados</h4>
                    </hgroup>
                </header>       
                <?php if(isset($mensaje)) { ?>
                <div id="mensaje" title="Mensaje"><p><?php echo $mensaje; ?></p></div>
                <?php } ?>
                <table class="tblLista">
                    <thead>
                        <tr>
                            <th><abbr title="Código identificador">ID.</abbr> Usuario</th>
                            <th>Dependencia</th>
                            <th>Red</th>
                            <th>Nombre Completo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(is_array($vwUsuarios)) {
                                foreach ($vwUsuarios as $vwUsuario) {
                        ?>
                        <tr>
                            <td><?php echo $vwUsuario->getIdUsuario(); ?></td>
                            <td><?php echo $vwUsuario->getDependencia(); ?></td>
                            <td><?php echo $vwUsuario->getRed(); ?></td>
                            <td><?php echo $vwUsuario->getNombreCompleto(); ?></td>
                            <td>
                                <button class="select">Acciones</button>
                                <ul>
                                    <li><a href="?controller=Usuario&action=Detalle&idUsuario=<?php echo $vwUsuario->getIdUsuario(); ?>">Detalle</a></li>
                                    <li><a href="?controller=Usuario&action=Editar&idUsuario=<?php echo $vwUsuario->getIdUsuario(); ?>">Editar</a></li>
                                    <li><a href="?controller=Usuario&action=Eliminar&idUsuario=<?php echo $vwUsuario->getIdUsuario(); ?>">Eliminar</a></li>
                                </ul>
                            </td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>          
                        <tr>
                            <td colspan="2"><a class="crearLink" href="?controller=Usuario&action=Crear">Crear Usuario</a></td>
                        </tr>
                    </tfoot>
                </table>
            </article>
        </section>
    </body>
</html>