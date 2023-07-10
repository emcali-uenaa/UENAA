    
<?php
require "parte superior.php";
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "rol");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el término de búsqueda enviado desde el formulario
$terminoBusqueda = isset($_GET['termino_busqueda']) ? $_GET['termino_busqueda'] : '';



// Consulta SQL para buscar proyectos que coincidan con el término de búsqueda
$sql = "SELECT * FROM redesinternas WHERE 
    Consecutivo LIKE '%$terminoBusqueda%' OR 
    FechaIngreso1 LIKE '%$terminoBusqueda%' OR 
    NombreProyecto LIKE '%$terminoBusqueda%' OR
    PropietarioObra LIKE '%$terminoBusqueda%' OR
    EstadoAvance LIKE '%$terminoBusqueda%' OR
    EstadoAtencion LIKE '%$terminoBusqueda%' OR
    Sector LIKE '%$terminoBusqueda%' OR
    IngenieroAsignado LIKE '%$terminoBusqueda%' OR
    FechaLiquidacion LIKE '%$terminoBusqueda%' OR
    Aprob1 LIKE '%$terminoBusqueda%' OR
    Devol1 LIKE '%$terminoBusqueda%' OR
    diasEnRevision LIKE '%$terminoBusqueda%' OR
    FechaIngreso2 LIKE '%$terminoBusqueda%' OR
    Devol2 LIKE '%$terminoBusqueda%' OR
    FechaIngreso3 LIKE '%$terminoBusqueda%' OR
    Devol3 LIKE '%$terminoBusqueda%' OR
    FechaIngreso4 LIKE '%$terminoBusqueda%' OR
    Devol4 LIKE '%$terminoBusqueda%' OR
    FechaIngreso5 LIKE '%$terminoBusqueda%' OR
    Devol5 LIKE '%$terminoBusqueda%' OR
    FechaIngreso6 LIKE '%$terminoBusqueda%' OR
    Devol6 LIKE '%$terminoBusqueda%' OR
    FechaAprobacion LIKE '%$terminoBusqueda%' OR
    
    Aprob2 LIKE '%$terminoBusqueda%' OR
    Aprob3 LIKE '%$terminoBusqueda%' OR
    Aprob4 LIKE '%$terminoBusqueda%' OR
    Aprob5 LIKE '%$terminoBusqueda%' OR
    TotalRev LIKE '%$terminoBusqueda%'";

$resultado = mysqli_query($conexion, $sql);


// Verificar si se encontraron registros
if (mysqli_num_rows($resultado) > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Reporte Redes Internas</title>
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
        <h2>Reporte Redes Internas</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <br>
        <table>
            <tr>
                <th>Consecutivo</th>
                <th>Ultimo Ingreso</th>
                <th>Nombre proyecto</th>
                <th>Propietario Obra</th>
                <th>Estado Avance</th>
                <th>ESTADO ATENCIÓN</th>
                <th>Sector</th>
                <th>fecha aprobacion</th>
                <th>Ingeniero asignado</th>
                <th>Fecha Liquidación</th>
                <th>ULTIMA DEVOLUCIÓN</th>
                <th># DIAS EN REVISIÓN</th>
                <th>Total de Revisiones</th>
            </tr>
            <?php
            // Iterar sobre los resultados y mostrar los datos en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td><?php echo $fila['Consecutivo']; ?></td>
                    
                    <td><?php
                    $ultimaFecha = max(
                        $fila['FechaIngreso1'],
                        $fila['FechaIngreso2'],
                        $fila['FechaIngreso3'],
                        $fila['FechaIngreso4'],
                        $fila['FechaIngreso5'],
                        $fila['FechaIngreso6']
                    );
                    
                    echo $ultimaFecha;
                     ?></td>
                    <td><?php echo $fila['NombreProyecto']; ?></td>
                    <td><?php echo $fila['PropietarioObra']; ?></td>
                    <td><?php echo $fila['EstadoAvance']; ?></td>
                    <td><?php echo $fila['EstadoAtencion']; ?></td>
                    <td><?php echo $fila['Sector']; ?></td>
                    <td><?php 
                          $ultimaFecha = max(
                            $fila['Aprob1'],
                            $fila['Aprob2'],
                            $fila['Aprob3'],
                            $fila['Aprob4'],
                            $fila['Aprob5'],
                            $fila['Aprob6']
                        );
                        
                        echo $ultimaFecha;
                    ?></td>
                    
                    <td><?php echo $fila['IngenieroAsignado']; ?></td>
                    <td><?php echo $fila['FechaLiquidacion']; ?></td>
                    <td><?php 
                     $ultimaFecha = max(
                        $fila['Devol1'],
                        $fila['Devol2'],
                        $fila['Devol3'],
                        $fila['Devol4'],
                        $fila['Devol5']
                    );
                    
                    echo $ultimaFecha;
                    ?></td>
                    <td><?php echo $fila['diasEnRevision']; ?></td>
                    <td><?php echo $fila['TotalRev']; ?></td>
                    
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
        <title>Reporte Redes Internas</title>
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
        <h2>reporte Redes Internas</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <br>
        <table>
            <tr>
                <th>Consecutivo</th>
                <th>Ultimo Ingreso</th>
                <th>Nombre proyecto</th>
                <th>Propietario Obra</th>
                <th>Estado Avance</th>
                <th>ESTADO ATENCIÓN</th>
                <th>Sector</th>
                <th>fecha aprobacion</th>
                <th>Ingeniero asignado</th>
                <th>Fecha Liquidación</th>
                <th>ULTIMA DEVOLUCIÓN</th>
                <th># DIAS EN REVISIÓN</th>
                <th>Total de Revisiones</th>
            </tr>
            <?php    
    echo "No se encontraron registros.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
           </div>
                </main>
               
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="js/datatables-simple-demo.js"></script>
<script src="js/scripts.js"></script>
<script>
    $(document).ready(function() {
        $('#sidebarToggle').on('click', function() {
            $('body').toggleClass('sb-sidenav-toggled');
        });
    });
</script>
    </body>
</html>
