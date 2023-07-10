    
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
$sql = "SELECT * FROM proyectos WHERE Consecutivo LIKE '%$terminoBusqueda%'
OR FIngreso1 LIKE '%$terminoBusqueda%' OR DescripcionProyecto LIKE '%$terminoBusqueda%'
 OR PropietarioProyecto LIKE '%$terminoBusqueda%' OR Estado LIKE '%$terminoBusqueda%'
 OR EstadoAtencion LIKE '%$terminoBusqueda%' OR Consultor LIKE '%$terminoBusqueda%' 
 OR Recursos LIKE '%$terminoBusqueda%' OR Ingeniero LIKE '%$terminoBusqueda%' 
 OR FechaLiquidacion LIKE '%$terminoBusqueda%' OR NoOficio LIKE '%$terminoBusqueda%'
 OR FechaDevolucion1 LIKE '%$terminoBusqueda%' OR DiasEnRevision LIKE '%$terminoBusqueda%'
 OR FechaRevision2 LIKE '%$terminoBusqueda%' OR FechaDevolucion2 LIKE '%$terminoBusqueda%'
 OR FechaRevision3 LIKE '%$terminoBusqueda%' OR FechaDevolucion3 LIKE '%$terminoBusqueda%'
 OR FechaRevision4 LIKE '%$terminoBusqueda%' OR FechaDevolucion4 LIKE '%$terminoBusqueda%' 
 OR FechaRevision5 LIKE '%$terminoBusqueda%' OR FechaDevolucion5 LIKE '%$terminoBusqueda%' 
 OR FechaAprobacion LIKE '%$terminoBusqueda%' OR OficioAprobacionNo LIKE '%$terminoBusqueda%'";

$resultado = mysqli_query($conexion, $sql);

// Verificar si se encontraron registros
if (mysqli_num_rows($resultado) > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Tabla de Proyectos</title>
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
        <h2>Reporte de Proyectos</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <br>
        <table>
            <tr>
                <th>Consecutivo</th>
                <th>Ultimo Ingreso</th>
                <th>Descripción proyecto</th>
                <th>Propietario Proyecto</th>
                <th>Estado</th>
                <th>ESTADO ATENCIÓN</th>
                <th>Fecha Estado</th>
                <th>Consultor</th>
                <th>Recursos</th>
                <th>Ingeniero</th>
                <th>Fecha Liquidación</th>
                <th>ULTIMA DEVOLUCIÓN</th>
                <th># DIAS EN REVISIÓN</th>
                <th>Total de Revisiones</th>
                <th>FECHA APROBACIÓN</th>
                <th>OFICIO APROBACIÓN No.</th>
            </tr>
            <?php
            // Iterar sobre los resultados y mostrar los datos en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td><?php echo $fila['Consecutivo']; ?></td>
                    
                    <td><?php
                    $ultimaFecha = max(
                        $fila['FIngreso1'],
                        $fila['FechaRevision2'],
                        $fila['FechaRevision3'],
                        $fila['FechaRevision4'],
                        $fila['FechaRevision5']
                    );
                    
                    echo $ultimaFecha;
                     ?></td>
                    <td><?php echo $fila['DescripcionProyecto']; ?></td>
                    <td><?php echo $fila['PropietarioProyecto']; ?></td>
                    <td><?php echo $fila['Estado']; ?></td>
                    <td><?php echo $fila['EstadoAtencion']; ?></td>
                    <td><?php echo $fila['FechaEstado']; ?></td>
                    <td><?php echo $fila['Consultor']; ?></td>
                    <td><?php echo $fila['Recursos']; ?></td>
                    <td><?php echo $fila['Ingeniero']; ?></td>
                    <td><?php echo $fila['FechaLiquidacion']; ?></td>
                    <td><?php 
                     $ultimaFecha = max(
                        $fila['FechaDevolucion1'],
                        $fila['FechaDevolucion2'],
                        $fila['FechaDevolucion3'],
                        $fila['FechaDevolucion4'],
                        $fila['FechaDevolucion5']
                    );
                    
                    echo $ultimaFecha;
                    ?></td>
                    <td><?php echo $fila['DiasEnRevision']; ?></td>
                    <td><?php echo $fila['TotalRev']; ?></td>
                    <td><?php echo $fila['FechaAprobacion']; ?></td>
                    <td><?php echo $fila['OficioAprobacionNo']; ?></td>
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
        <title>Reporte Redes Externas</title>
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
        <h2>reporte de Proyectos</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <br>
        <table>
            <tr>
                <th>Consecutivo</th>
                <th>Ultimo Ingreso</th>
                <th>Descripción proyecto</th>
                <th>Propietario Proyecto</th>
                <th>Estado</th>
                <th>ESTADO ATENCIÓN</th>
                <th>Fecha Estado</th>
                <th>Consultor</th>
                <th>Recursos</th>
                <th>Ingeniero</th>
                <th>Fecha Liquidación</th>
                <th>ULTIMA DEVOLUCIÓN</th>
                <th># DIAS EN REVISIÓN</th>
                <th>Total de Revisiones</th>
                <th>FECHA APROBACIÓN</th>
                <th>OFICIO APROBACIÓN No.</th>
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
