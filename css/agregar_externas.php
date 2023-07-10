<?php
require "parte_superior.php";
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "rol");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL para obtener los proyectos
$sql = "SELECT * FROM proyectos";
$resultado = mysqli_query($conexion, $sql);

// Obtener el término de búsqueda enviado desde el formulario
$terminoBusqueda = isset($_GET['termino_busqueda']) ? $_GET['termino_busqueda'] : '';

// Verificar si se encontraron registros
if (mysqli_num_rows($resultado) > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>REDES EXTERNAS</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
        </style>
    </head>
    <body>
        <h2>REDES EXTERNAS</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <table>
            <tr>
                <th>Tipo de Proyecto</th>
                <th>Actividad</th>
                <th>Servicio</th>
                <th>Consecutivo</th>
                <th>Año</th>
                <th>F/Ingreso 1</th>
                <th>Descripción proyecto</th>
                <th>Dirección</th>
                <th>Propietario Proyecto</th>
                <th>Estado</th>
                <th>ESTADO ATENCIÓN</th>
                <th>Fecha Estado</th>
                <th>Dirección Propietario</th>
                <th>Cédula o Nit</th>
                <th>Teléfono Propietario</th>
                <th>Correo Propietario</th>
                <th>Consultor</th>
                <th>Teléfono Proyectista</th>
                <th>Correo Electrónico Proyectista</th>
                <th>Recursos</th>
                <th>Comuna</th>
                <th>Ingeniero</th>
                <th>Unidad</th>
                <th>Cant.</th>
                <th>ML Facturados</th>
                <th>Vr. Facturado</th>
                <th>Fecha Liquidación</th>
                <th>Fecha Pago</th>
                <th>Nº Oficio</th>
                <th>Dato Básico</th>
                <th>F/Dato Básico</th>
                <th>FECHA DEVOLUCIÓN 1</th>
                <th>DIAS REV. 1</th>
                <th>FECHA REVISIÓN 2</th>
                <th>FECHA DEVOLUCIÓN 2</th>
                <th>DIAS REV. 2</th>
                <th># DIAS EN REVISIÓN</th>
                <th>FECHA REVISIÓN 3</th>
                <th>FECHA DEVOLUCIÓN 3</th>
                <th>FECHA REVISIÓN 4</th>
                <th>FECHA DEVOLUCIÓN 4</th>
                <th>FECHA REVISIÓN 5</th>
                <th>FECHA DEVOLUCIÓN 5</th>
                <th>FECHA APROBACIÓN</th>
                <th>OFICIO APROBACIÓN No.</th>
            </tr>
            <?php
            // Iterar sobre los resultados y mostrar los datos en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td>
                        <?php
                        // Obtener el tipo de proyecto a través de la relación con la tabla TipoProyecto
                        $tipoProyectoID = $fila['tipo_proyecto_id'];
                        $sqlTipoProyecto = "SELECT tipo_proyecto FROM TipoProyecto WHERE id = $tipoProyectoID";
                        $resultadoTipoProyecto = mysqli_query($conexion, $sqlTipoProyecto);
                        $filaTipoProyecto = mysqli_fetch_assoc($resultadoTipoProyecto);
                        echo $filaTipoProyecto['tipo_proyecto'];
                        ?>
                    </td>
                    <td><?php echo $fila['Actividad']; ?></td>
                    <td><?php echo $fila['Servicio']; ?></td>
                    <td><?php echo $fila['Consecutivo']; ?></td>
                    <td><?php echo $fila['Año']; ?></td>
                    <td><?php echo $fila['F_Ingreso_1']; ?></td>
                    <td><?php echo $fila['Descripción_proyecto']; ?></td>
                    <td><?php echo $fila['Dirección']; ?></td>
                    <td><?php echo $fila['Propietario_Proyecto']; ?></td>
                    <td><?php echo $fila['Estado']; ?></td>
                    <td><?php echo $fila['ESTADO_ATENCION']; ?></td>
                    <td><?php echo $fila['Fecha_Estado']; ?></td>
                    <td><?php echo $fila['Dirección_Propietario']; ?></td>
                    <td><?php echo $fila['Cédula_o_Nit']; ?></td>
                    <td><?php echo $fila['Teléfono_Propietario']; ?></td>
                    <td><?php echo $fila['Correo_Propietario']; ?></td>
                    <td><?php echo $fila['Consultor']; ?></td>
                    <td><?php echo $fila['Teléfono_Proyectista']; ?></td>
                    <td><?php echo $fila['Correo_Electrónico_Proyectista']; ?></td>
                    <td><?php echo $fila['Recursos']; ?></td>
                    <td><?php echo $fila['Comuna']; ?></td>
                    <td><?php echo $fila['Ingeniero']; ?></td>
                    <td><?php echo $fila['Unidad']; ?></td>
                    <td><?php echo $fila['Cant']; ?></td>
                    <td><?php echo $fila['ML_Facturados']; ?></td>
                    <td><?php echo $fila['Vr_Facturado']; ?></td>
                    <td><?php echo $fila['Fecha_Liquidación']; ?></td>
                    <td><?php echo $fila['Fecha_Pago']; ?></td>
                    <td><?php echo $fila['N_Oficio']; ?></td>
                    <td><?php echo $fila['Dato_Básico']; ?></td>
                    <td><?php echo $fila['F_Dato_Básico']; ?></td>
                    <td><?php echo $fila['FECHA_DEVOLUCIÓN_1']; ?></td>
                    <td><?php echo $fila['DIAS_REV_1']; ?></td>
                    <td><?php echo $fila['FECHA_REVISIÓN_2']; ?></td>
                    <td><?php echo $fila['FECHA_DEVOLUCIÓN_2']; ?></td>
                    <td><?php echo $fila['DIAS_REV_2']; ?></td>
                    <td><?php echo $fila['DIAS_EN_REVISIÓN']; ?></td>
                    <td><?php echo $fila['FECHA_REVISIÓN_3']; ?></td>
                    <td><?php echo $fila['FECHA_DEVOLUCIÓN_3']; ?></td>
                    <td><?php echo $fila['FECHA_REVISIÓN_4']; ?></td>
                    <td><?php echo $fila['FECHA_DEVOLUCIÓN_4']; ?></td>
                    <td><?php echo $fila['FECHA_REVISIÓN_5']; ?></td>
                    <td><?php echo $fila['FECHA_DEVOLUCIÓN_5']; ?></td>
                    <td><?php echo $fila['FECHA_APROBACIÓN']; ?></td>
                    <td>
                        <?php
                        // Obtener el número de oficio a través de la relación con la tabla documentos
                        $oficioAprobacionID = $fila['OficioAprovacionNo'];
                        $sqlOficioAprobacion = "SELECT numero_oficio FROM documentos WHERE id = $oficioAprobacionID";
                        $resultadoOficioAprobacion = mysqli_query($conexion, $sqlOficioAprobacion);
                        $filaOficioAprobacion = mysqli_fetch_assoc($resultadoOficioAprobacion);
                        echo $filaOficioAprobacion['numero_oficio'];
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
    </html>
    <?php
} else {
    echo "No se encontraron registros.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
require "parte_inferior.php";
?>
