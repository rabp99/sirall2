<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       
        <link rel="stylesheet" type="text/css" href="resources/css/start/jquery-ui-1.10.3.custom.min.css"/>
        <link rel="stylesheet" type="text/css" href="resources/css/template.css"/>
        <link rel="stylesheet" type="text/css" href="resources/css/jquery.dataTables_themeroller.css"/>
       
        <script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="resources/js/template.js"></script>
        <script type="text/javascript" src="resources/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var botones = function() {
                    $('.select')
                        .button({
                            icons: {
                                secondary: "ui-icon-triangle-1-s"
                            }
                        })                  
                        .click(function() {
                            var menu = $( this ).next().show().position({
                                my: "left top",
                                at: "left bottom",
                                of: this
                            });
                            $('*').not($(this)).click(function() {
                                menu.hide();
                            });
                            return false;
                        })
                        .next()
                            .hide()
                            .menu();
                };
                botones();
                $('.tblLista')
                .bind('page',   function () { botones(); })
                .dataTable( {
                    "sPaginationType": "full_numbers",
                    "sScrollY": "600px",
                    "bJQueryUI": true,
                    "bScrollCollapse": true,        
                    "oLanguage": {
                        "sLengthMenu": "Mostrar _MENU_ registros por página",
                        "sZeroRecords": "No se ecnontró ningún registro",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ ",
                        "sInfoEmpty": "No se muestra ningún registro",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "oPaginate": {
                            "sFirst": "|<",
                            "sLast": ">|",
                            "sNext": ">>",
                            "sPrevious": "<<",
                        },
                        "sSearch": "Buscar"
                    }
                });
                $( "#mensaje" ).dialog({
                    closeOnEscape: true,
                    show: 'fade',
                    hide: 'fade',
                    open: function(event, ui){
                        setTimeout("$('#mensaje').dialog('close')",3000);
                    },
                    position: { 
                        at: "right top", 
                        of: window
                    },
                    buttons: [
                        {
                            text: "OK",
                            click: function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    ]
                });
            });
        </script>
        
        <title>SIRALL2 - Lista Marca</title>
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
                        <h2>Lista Marca</h2>
                        <h4>Lista de Marcas registradas</h4>
                    </hgroup>
                </header>       
                <?php if(isset($mensaje)) { ?>
                <div id="mensaje" title="Mensaje"><p><?php echo $mensaje; ?></p></div>
                <?php } ?>
                <table class="tblLista">
                    <thead>
                        <tr>
                            <th><abbr title="Código identificador">ID.</abbr> Marca</th>
                            <th>Descripción</th>
                            <th>Indicación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(is_array($marcas)) {
                                foreach ($marcas as $marca) {
                        ?>
                        <tr>
                            <td><?php echo $marca->getIdMarca(); ?></td>
                            <td><?php echo $marca->getDescripcion(); ?></td>
                            <td><?php echo $marca->getIndicacion(); ?></td>
                            <td>
                                <button class="select">Acciones</button>
                                <ul>
                                    <li><a href="?controller=TipoEquipo&action=Detalle&idTipoEquipo=<?php echo $tipoEquipo->getIdTipoEquipo(); ?>"><img src="resources/images/detalle.png"> Detalle</a></li>
                                    <li><a href="?controller=TipoEquipo&action=Editar&idTipoEquipo=<?php echo $tipoEquipo->getIdTipoEquipo(); ?>"><img src="resources/images/editar.png"> Editar</a></li>
                                    <li><a href="?controller=TipoEquipo&action=Eliminar&idTipoEquipo=<?php echo $tipoEquipo->getIdTipoEquipo(); ?>"><img src="resources/images/eliminar.png"> Eliminar</a></li>
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
                            <td colspan="2"><a class="crearLink" href="?controller=TipoEquipo&action=Crear">Crear Tipo de Equipo</a></td>
                        </tr>
                    </tfoot>
                </table>
            </article>
        </section>
    </body>
</html>