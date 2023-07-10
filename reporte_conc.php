    
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
$sql = "SELECT * FROM conceptostecnicos WHERE 
    Numero LIKE '%$terminoBusqueda%' OR 
    Sector LIKE '%$terminoBusqueda%' OR 
    `Comuna / Localidad` LIKE '%$terminoBusqueda%' OR
    `Nombre del Concepto` LIKE '%$terminoBusqueda%' OR
    Estado LIKE '%$terminoBusqueda%' OR
    `Fecha Ultima Modificacion` LIKE '%$terminoBusqueda%' OR
    `Ingeniero Asignado` LIKE '%$terminoBusqueda%' OR
    `Propietario de la Obra` LIKE '%$terminoBusqueda%' OR
    `Radicacion No.` LIKE '%$terminoBusqueda%' OR
    DiasEnRevision LIKE '%$terminoBusqueda%' OR
    TotalRev LIKE '%$terminoBusqueda%' OR
    diasEnRevision LIKE '%$terminoBusqueda%' OR
    `Fecha Ingreso 1` LIKE '%$terminoBusqueda%' OR
    `Fecha Ingreso 2` LIKE '%$terminoBusqueda%' OR
    `Fecha Ingreso 3` LIKE '%$terminoBusqueda%' OR
    `Fecha Ingreso 4` LIKE '%$terminoBusqueda%' OR
    `Fecha Aprobación 1` LIKE '%$terminoBusqueda%' OR
    `Fecha Aprobación 2` LIKE '%$terminoBusqueda%' OR
    `Fecha Aprobación 3` LIKE '%$terminoBusqueda%' OR
    `Fecha Aprobación 4` LIKE '%$terminoBusqueda%' OR
    `FechaDevolución 1` LIKE '%$terminoBusqueda%' OR
    `Fecha Devolución 2` LIKE '%$terminoBusqueda%' OR
    `Fecha Devolución 3` LIKE '%$terminoBusqueda%' OR
    `Fecha Devolución 4` LIKE '%$terminoBusqueda%'";


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
        <h2>Reporte conceptos tecnicos</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <br>
        <table>
            <tr>
                <th>Numero</th>
                
                <th>Sector</th>
                <th>Comuna o localidad</th>
                <th>nombre del concepto</th>
                <th>Estado</th>
                <th>fecha ultima modificacion</th>
                <th>Ingeniero asignado</th>
                <th>fecha Ultimo ingreso</th>
                <th>propietario de Obra</th>
                <th>Radicacion No</th>
                <th>ULTIMA DEVOLUCIÓN</th>
                <th>Fecha de A   probacion</th>
                <th># DIAS EN REVISIÓN</th>
                <th>Total de Revisiones</th>
            </tr>
            <?php
            // Iterar sobre los resultados y mostrar los datos en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td><?php echo $fila['Numero']; ?></td>
                    <td><?php echo $fila['Sector']; ?></td>
                    <td><?php echo $fila['Comuna / Localidad']; ?></td>
                    <td><?php echo $fila['Nombre del Concepto']; ?></td>
                    <td><?php echo $fila['ESTADO']; ?></td>
                    <td><?php echo $fila['Fecha Ultima Modificacion']; ?></td>
                    <td><?php echo $fila['INGENIERO ASIGNADO']; ?></td>
                    <td><?php
                    $ultimaFecha = max(
                        $fila['Fecha Ingreso 1'],
                        $fila['Fecha Ingreso 2'],
                        $fila['Fecha Ingreso 3'],
                        $fila['Fecha Ingreso 4']
                    );
                    
                    echo $ultimaFecha;
                     ?></td>
                    <td><?php echo $fila['Propietario de la Obra']; ?></td>
                    <td><?php echo $fila['Radicacion No.']; ?></td>
                    <td><?php 
                     $ultimaFecha = max(
                        $fila['FechaDevolución 1'],
                        $fila['Fecha Devolución 2'],
                        $fila['Fecha Devolución 3'],
                        $fila['Fecha Devolución 4'],
                    );
                    
                    echo $ultimaFecha;
                    ?></td>
                    <td><?php 
                          $ultimaFecha = max(
                            $fila['Fecha Aprobación 1'],
                            $fila['Fecha Aprobación 2'],
                            $fila['Fecha Aprobación 3'],
                            $fila['Fecha Aprobación 4']
                        );
                        
                        echo $ultimaFecha;
                    ?></td>
                    
                    <td><?php echo $fila['DiasEnRevision']; ?></td>
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
        <title>Reporte conceptos tecnicos</title>
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
        <h2>reporte Conceptos tecnicos</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <br>
        <table>
            <tr>
                <th>Numero</th>
                
                <th>Sector</th>
                <th>Comuna o localidad</th>
                <th>nombre del concepto</th>
                <th>Estado</th>
                <th>fecha ultima modificacion</th>
                <th>Ingeniero asignado</th>
                <th>fecha Ultimo ingreso</th>
                <th>propietario de Obra</th>
                <th>Radicacion No</th>
                <th>ULTIMA DEVOLUCIÓN</th>
                <th>Fecha de A   probacion</th>
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
