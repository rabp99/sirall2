<!-- File: /views/Mantenimiento/Personal/Crear.php -->

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      
        <link rel="stylesheet" type="text/css" href="resources/css/start/jquery-ui-1.10.3.custom.min.css"/>
        <link rel="stylesheet" type="text/css" href="resources/css/template.css"/>
        <link rel="stylesheet" type="text/css" href="resources/css/jquery.treeview.css"/>
      
        <script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="resources/js/template.default.js"></script>
        <script type="text/javascript" src="resources/js/template.funciones.js"></script>
        <script type="text/javascript" src="resources/js/template.areaSelect.js"></script>
        <script type="text/javascript" src="resources/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="resources/js/jquery.treeview.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                isRequired($('#txtNombres'));
                isRequired($('#txtApellidoPaterno'));
                isRequired($('#txtApellidoMaterno'));
                isRequired($('#cboRol'));
                $('#btnEnviar').button();
                $('#btnBorrar').button();
                $('#txtIdPersonal').focus();
                $('#asistente').tabs();
                
                $('div#asistente div:not(:first)').append("<button class='prev' type='button'>Anterior</button>");
                $('.prev').click(function() {
                    var selected = $("#asistente").tabs("option", "active");
                    $("#asistente").tabs("option", "active", selected - 1);
                });
                
                $('div#asistente div:not(:last)').append("<button class='next' type='button'>Siguiente</button>");
                $('.next').click(function() {
                    var selected = $("#asistente").tabs("option", "active");
                    $("#asistente").tabs("option", "active", selected + 1);
                });
                $('button.next').button();
                $('button.prev').button();
                   
                $('form').submit(function() {
                    if(!$('#txtAreaSeleccionada').text().length) {
                        alert('Debes elegir una area');
                        return false;
                    }
                });
            });
        </script>
        
        <title>SIRALL2 - Crear Personal</title>
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
                        <h2>Crear Personal</h2>
                        <h4>Crea un Personal</h4>
                    </hgroup>
                </header>
                <form id="frmCrearPersonal" method="POST" action="?controller=Personal&action=CrearPOST">
                    <fieldset>
                        <legend>Crear Personal</legend>
                        <div id="asistente">
                            <ul>
                                <li><a href="#personal">Información personal</a></li>
                                <li><a href="#institucional">Información Institucional</a></li>
                            </ul>
                            <div id="personal">
                                <table>
                                    <tr>
                                        <td><label for="txtIdPersonal"><abbr title="Código identificador">ID.</abbr> Personal</label></td>
                                        <td><input id="txtIdPersonal" type="text" name="idPersonal" maxlength="7" pattern="[0-9]{7,7}" placeholder="Código de Personal"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="txtNombres">Nombres</label></td>
                                        <td><input id="txtNombres" type="text" name="nombres" placeholder="Escribe el nombre del usuario"/></td>  
                                    </tr>
                                    <tr>
                                        <td><label for="txtApellidoPaterno">Apellido Paterno</label></td>
                                        <td><input id="txtApellidoPaterno" type="text" name="apellidoPaterno" placeholder="Escribe el apellido paterno"/></td>  
                                    </tr>
                                    <tr>
                                        <td><label for="txtApellidoMaterno">Apellido Materno</label></td>
                                        <td><input id="txtApellidoMaterno" type="text" name="apellidoMaterno" placeholder="Escribe el apellido materno"/></td>  
                                    </tr>
                                </table>
                            </div>
                            <div id="institucional">
                                <table>
                                    <tr>
                                        <td><label for="btnAreaSuperior">Área Superior</label></td>
                                        <td>
                                            <button id="btnAreaSuperior" type="button">Seleccionar</button>
                                            <span id="txtAreaSeleccionada"></span>
                                            <input id="hdnEstablecimiento" type="hidden" name="idEstablecimiento" value=""/>
                                            <input id="hdnArea" type="hidden" name="idArea" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="txtCorreo">Correo Institucional</label></td>
                                        <td><input id="txtCorreo" type="text" name="correo" placeholder="Escribe el correo"/></td>  
                                    </tr>
                                    <tr>
                                        <td><label for="txtRpm">RPM</label></td>
                                        <td><input id="txtRpm" type="tel" name="rpm" placeholder="Escribe el número de RPM"/></td>  
                                    </tr>
                                    <tr>
                                        <td><label for="txtAnexo">Anexo</label></td>
                                        <td><input id="txtAnexo" type="tel" name="anexo" placeholder="Escribe el número de anexo"/></td>  
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <table>
                            <tr>
                                <td></td>
                                <td>
                                    <button id="btnEnviar" type="submit">Enviar</button>
                                    <button id="btnBorrar" type="reset">Borrar</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><a href="?controller=Personal">Regresar</a></td>
                            </tr>
                        </table>     
                        <div id="areaSelect" title="Seleccionar Area">         
                            <p>Selecciona una Area</p>
                            <?php
                                function tieneHijos($padre, $areas) {
                                    foreach ($areas as $area) {
                                        if($padre->getIdArea() == $area->getSuperIdArea()) 
                                            return true;
                                    }
                                    return false;
                                }
                                
                                function mostrarHijosEstablecimiento($padre, $areas) {
                                    if(is_array($areas)) {
                                        foreach ($areas as $area) {
                                            if($padre->getIdEstablecimiento() == $area->getIdEstablecimiento() && $area->getSuperIdArea() == null) {
                                                echo "<li><button type='button' title='Area'><input type='hidden' value='" . $area->getIdArea() ."'/>" . $area->getDescripcion() . "</button>";
                                                if(tieneHijos($area, $areas)) {
                                                    echo "<ul>";
                                                    mostrarHijos($area, $areas);
                                                    echo "</ul>";
                                                }
                                                echo "</li>";
                                            }
                                        }
                                    }
                                }
                                
                                function mostrarHijos($padre, $areas) {
                                    foreach ($areas as $area) {
                                        if($padre->getIdArea() == $area->getSuperIdArea()) {
                                            echo "<li><button type='button' title='Area'><input type='hidden' value='" . $area->getIdArea() ."'/>" . $area->getDescripcion() . "</button>";
                                            if(tieneHijos($area, $areas)) {
                                                echo "<ul>";
                                                mostrarHijos($area, $areas);
                                                echo "</ul>";
                                            }
                                            echo "</li>";
                                        }
                                    }
                                }
                                
                                if(is_array($establecimientos)) {
                                    echo "<ul id='ulArea' class='treeview-blue'>";
                                    foreach($establecimientos as $establecimiento) {
                                        echo "<li><button type='button' title='Establecimiento'><input type='hidden' value='" . $establecimiento->getIdEstablecimiento() ."'/>" . $establecimiento->getDescripcion() . "</button>";
                                        echo "<ul>";
                                        mostrarHijosEstablecimiento($establecimiento, $areas);
                                        echo "</ul>";
                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                }
                            ?>
                            <button id="btnSeleccionar" type="button">Seleccionar</button>
                        </div>
                    </fieldset>               
                </form>
            </article>
        </section>
    </body>
</html>