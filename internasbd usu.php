<?php
require "parte superiorusu.php";
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "rol");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL para obtener los proyectos
$sql = "SELECT * FROM redesinternas";
$resultado = mysqli_query($conexion, $sql);


// Obtener el término de búsqueda enviado desde el formulario
$terminoBusqueda = isset($_GET['termino_busqueda']) ? $_GET['termino_busqueda'] : '';

// Consulta SQL para buscar proyectos que coincidan con el término de búsqueda
$sql = "SELECT * FROM redesinternas WHERE id LIKE '%$terminoBusqueda%' OR  Consecutivo LIKE '%$terminoBusqueda%' OR
Anio LIKE '%$terminoBusqueda%' OR
FechaIngreso1 LIKE '%$terminoBusqueda%' OR
PosibilidadServicio LIKE '%$terminoBusqueda%' OR
Sector LIKE '%$terminoBusqueda%' OR
DireccionObra LIKE '%$terminoBusqueda%' OR
ComunaSector LIKE '%$terminoBusqueda%' OR
CiudadMunicipio LIKE '%$terminoBusqueda%' OR
NombreProyecto LIKE '%$terminoBusqueda%' OR
PropietarioObra LIKE '%$terminoBusqueda%' OR
FirmaConsultoraProyectista LIKE '%$terminoBusqueda%' OR
IngenieroAsignado LIKE '%$terminoBusqueda%' OR
No LIKE '%$terminoBusqueda%' OR
Tipo LIKE '%$terminoBusqueda%' OR
No2 LIKE '%$terminoBusqueda%' OR
Tipo2 LIKE '%$terminoBusqueda%' OR
EstadoAvance LIKE '%$terminoBusqueda%' OR
EstadoAtencion LIKE '%$terminoBusqueda%' OR
FechaEstado LIKE '%$terminoBusqueda%' OR
AreaConstruccionFacturada LIKE '%$terminoBusqueda%' OR
CostoFacturadoIVA LIKE '%$terminoBusqueda%' OR
FechaLiquidacion LIKE '%$terminoBusqueda%' OR
FechaPago LIKE '%$terminoBusqueda%' OR
RadicacionNo LIKE '%$terminoBusqueda%' OR
FechaAprobacion LIKE '%$terminoBusqueda%' OR
OficioAprobacion LIKE '%$terminoBusqueda%' OR
CCNITPropietario LIKE '%$terminoBusqueda%' OR
DireccionPropietario LIKE '%$terminoBusqueda%' OR
TelefonoPropietario LIKE '%$terminoBusqueda%' OR
CorreoElectronicoPropietario LIKE '%$terminoBusqueda%' OR
Devol1 LIKE '%$terminoBusqueda%' OR
DiasRev1 LIKE '%$terminoBusqueda%' OR
FechaIngreso2 LIKE '%$terminoBusqueda%' OR
Devol2 LIKE '%$terminoBusqueda%' OR
DiasRev2 LIKE '%$terminoBusqueda%' OR
FechaIngreso3 LIKE '%$terminoBusqueda%' OR
Devol3 LIKE '%$terminoBusqueda%' OR
DiasRev3 LIKE '%$terminoBusqueda%' OR
FechaIngreso4 LIKE '%$terminoBusqueda%' OR
Devol4 LIKE '%$terminoBusqueda%' OR
DiasRev4 LIKE '%$terminoBusqueda%' OR
FechaIngreso5 LIKE '%$terminoBusqueda%' OR
Devol5 LIKE '%$terminoBusqueda%' OR
DiasRev5 LIKE '%$terminoBusqueda%' OR
FechaIngreso6 LIKE '%$terminoBusqueda%' OR
Devol6 LIKE '%$terminoBusqueda%' OR
DiasRev6 LIKE '%$terminoBusqueda%' OR
diasEnRevision LIKE '%$terminoBusqueda%' OR
TotalRev LIKE '%$terminoBusqueda%' OR
FechaAprobacion LIKE '%$terminoBusqueda%'";

$resultado = mysqli_query($conexion, $sql);

// Verificar si se encontraron registros
if (mysqli_num_rows($resultado) > 0) {

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>REDES INTERNAS</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }.button-container {
                text-align: right;
            }
        </style>
    </head>
    <body>
    <div class="button-container">
            <form action="descargarint.php" method="post">
                <input type="submit" name="descargar" value="Descargar Datos">
            </form>
        </div>
        <h2>REDES INTERNAS</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
        <table>
            <tr>
                <th>Consecutivo No.</th>
                <th>AÑO</th>
                <th>Fecha Ingreso 1</th>
                <th>Posibilidad de Servicio</th>
                <th>Sector</th>
                <th>Direccion de la Obra</th>
                <th>Comuna / Sector</th>
                <th>Ciudad o Municipio</th>
                <th>Nombre del Proyecto</th>
                <th>Propietario de la Obra</th>
                <th>Firma Consultora ó Proyectista</th>
                <th>Ingeniero Asignado</th>
                <th>No.</th>
                <th>Tipo</th>
                <th>No.2</th>
                <th>Tipo2</th>
                <th>Estado Avance</th>
                <th>Estado Atención</th>
                <th>Fecha Estado</th>
                <th>Area en m2 de Construcción Facturada</th>
                <th>Costo Facturado(m2) + IVA</th>
                <th>Fecha Liquidación</th>
                <th>Fecha Pago</th>
                <th>Radicacion No.</th>
                <th>Fecha de Aprobación</th>
                <th>Oficio Aprobación</th>
                <th>CC ó NIT Propietario</th>
                <th>Direccion Propietario</th>
                <th>Telefono Propietario</th>
                <th>Correo Electronico Propietario</th>
                <th>Fecha Dev. 1</th>
                <th>Días Rev. 1</th>
                <th>Fecha Rev. 2</th>
                <th>Fecha Dev. 2</th>
                <th>Días Rev. 2</th>
                <th>Fecha Rev. 3</th>
                <th>Fecha Dev. 3</th>
                <th>Días Rev. 3</th>
                <th>Fecha Rev. 4</th>
                <th>Fecha Dev. 4</th>
                <th>Días Rev. 4</th>
                <th>Fecha Rev. 5</th>
                <th>Fecha Dev. 5</th>
                <th>Días Rev. 5</th>
                <th>Fecha Rev. 6</th>
                <th>Fecha Dev. 6</th>
                <th>Días Rev. 6</th>
                <th>Total Días Rev.</th>
                <th>Total Revisiones</th>
                <th>Fecha Aprobación</th>
                
            </tr>
            <?php

            // Iterar sobre los resultados y mostrar los datos en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td><?php echo $fila['Consecutivo']; ?></td>
                    <td><?php echo $fila['Anio']; ?></td>
                    <td><?php echo $fila['FechaIngreso1']; ?></td>
                    <td><?php echo $fila['PosibilidadServicio']; ?></td>
                    <td><?php echo $fila['Sector']; ?></td>
                    <td><?php echo $fila['DireccionObra']; ?></td>
                    <td><?php echo $fila['ComunaSector']; ?></td>
                    <td><?php echo $fila['CiudadMunicipio']; ?></td>
                    <td><?php echo $fila['NombreProyecto']; ?></td>
                    <td><?php echo $fila['PropietarioObra']; ?></td>
                    <td><?php echo $fila['FirmaConsultoraProyectista']; ?></td>
                    <td><?php echo $fila['IngenieroAsignado']; ?></td>
                    <td><?php echo $fila['No']; ?></td>
                    <td><?php echo $fila['Tipo']; ?></td>
                    <td><?php echo $fila['No2']; ?></td>
                    <td><?php echo $fila['Tipo2']; ?></td>
                    <td><?php echo $fila['EstadoAvance']; ?></td>
                    <td><?php echo $fila['EstadoAtencion']; ?></td>
                    <td><?php echo $fila['FechaEstado']; ?></td>
                    <td><?php echo $fila['AreaConstruccionFacturada']; ?></td>
                    <td><?php echo $fila['CostoFacturadoIVA']; ?></td>
                    <td><?php echo $fila['FechaLiquidacion']; ?></td>
                    <td><?php echo $fila['FechaPago']; ?></td>
                    <td><?php echo $fila['RadicacionNo']; ?></td>
                    <td><?php echo $fila['FechaAprobacion']; ?></td>
                    <td><?php echo $fila['OficioAprobacion']; ?></td>
                    <td><?php echo $fila['CCNITPropietario']; ?></td>
                    <td><?php echo $fila['DireccionPropietario']; ?></td>
                    <td><?php echo $fila['TelefonoPropietario']; ?></td>
                    <td><?php echo $fila['CorreoElectronicoPropietario']; ?></td>
                    <td><?php echo $fila['Devol1']; ?></td>
                    <td><?php echo $fila['DiasRev1']; ?></td>
                    <td><?php echo $fila['FechaIngreso2']; ?></td>
                    <td><?php echo $fila['Devol2']; ?></td>
                    <td><?php echo $fila['DiasRev2']; ?></td>
                    <td><?php echo $fila['FechaIngreso3']; ?></td>
                    <td><?php echo $fila['Devol3']; ?></td>
                    <td><?php echo $fila['DiasRev3']; ?></td>
                    <td><?php echo $fila['FechaIngreso4']; ?></td>
                    <td><?php echo $fila['Devol4']; ?></td>
                    <td><?php echo $fila['DiasRev4']; ?></td>
                    <td><?php echo $fila['FechaIngreso5']; ?></td>
                    <td><?php echo $fila['Devol5']; ?></td>
                    <td><?php echo $fila['DiasRev5']; ?></td>
                    <td><?php echo $fila['FechaIngreso6']; ?></td>
                    <td><?php echo $fila['Devol6']; ?></td>
                    <td><?php echo $fila['DiasRev6']; ?></td>
                    <td><?php echo $fila['diasEnRevision']; ?></td>
                    <td><?php echo $fila['TotalRev']; ?></td>
                    <td><?php echo $fila['FechaAprobacion']; ?></td>
                    
                </tr>
                <?php
            }
            ?>
        </table>
      </body>
    </html>
<?php
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>REDES INTERNAS</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }.button-container {
                text-align: right;
            }
        </style>
    </head>
    <body>
    <div class="button-container">
            <form action="descargarint.php" method="post">
                <input type="submit" name="descargar" value="Descargar Datos">
            </form>
        </div>
        <h2>REDES INTERNAS</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#dataTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
          <table>
            <tr>
                <th>Consecutivo No.</th>
                <th>AÑO</th>
                <th>Fecha Ingreso 1</th>
                <th>Posibilidad de Servicio</th>
                <th>Sector</th>
                <th>Direccion de la Obra</th>
                <th>Comuna / Sector</th>
                <th>Ciudad o Municipio</th>
                <th>Nombre del Proyecto</th>
                <th>Propietario de la Obra</th>
                <th>Firma Consultora ó Proyectista</th>
                <th>Ingeniero Asignado</th>
                <th>No.</th>
                <th>Tipo</th>
                <th>No.2</th>
                <th>Tipo2</th>
                <th>Estado Avance</th>
                <th>Estado Atención</th>
                <th>Fecha Estado</th>
                <th>Area en m2 de Construcción Facturada</th>
                <th>Costo Facturado(m2) + IVA</th>
                <th>Fecha Liquidación</th>
                <th>Fecha Pago</th>
                <th>Radicacion No.</th>
                <th>Fecha de Aprobación</th>
                <th>Oficio Aprobación</th>
                <th>CC ó NIT Propietario</th>
                <th>Direccion Propietario</th>
                <th>Telefono Propietario</th>
                <th>Correo Electronico Propietario</th>
                <th>Fecha Dev. 1</th>
                <th>Días Rev. 1</th>
                <th>Fecha Rev. 2</th>
                <th>Fecha Dev. 2</th>
                <th>Días Rev. 2</th>
                <th>Fecha Rev. 3</th>
                <th>Fecha Dev. 3</th>
                <th>Días Rev. 3</th>
                <th>Fecha Rev. 4</th>
                <th>Fecha Dev. 4</th>
                <th>Días Rev. 4</th>
                <th>Fecha Rev. 5</th>
                <th>Fecha Dev. 5</th>
                <th>Días Rev. 5</th>
                <th>Fecha Rev. 6</th>
                <th>Fecha Dev. 6</th>
                <th>Días Rev. 6</th>
                <th>Total Días Rev.</th>
                <th>Total Revisiones</th>
                <th>Fecha Aprobación</th>
                
            </tr>
            <?php

    echo "No se encontraron registros.";
}

// Cerrar la conexión
mysqli_close($conexion);
require "parte inferior.php";
?>
