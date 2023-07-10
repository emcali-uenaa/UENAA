

<?php
require "parte superior.php";
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


   // Consulta SQL para buscar proyectos que coincidan con el término de búsqueda
$sql = "SELECT * FROM proyectos WHERE id LIKE '%$terminoBusqueda%' OR  Actividad LIKE '%$terminoBusqueda%' OR
Servicio LIKE '%$terminoBusqueda%' OR
Consecutivo LIKE '%$terminoBusqueda%' OR
Anio LIKE '%$terminoBusqueda%' OR
FIngreso1 LIKE '%$terminoBusqueda%' OR
DescripcionProyecto LIKE '%$terminoBusqueda%' OR
Direccion LIKE '%$terminoBusqueda%' OR
PropietarioProyecto LIKE '%$terminoBusqueda%' OR
Estado LIKE '%$terminoBusqueda%' OR
EstadoAtencion LIKE '%$terminoBusqueda%' OR
FechaEstado LIKE '%$terminoBusqueda%' OR
DireccionPropietario LIKE '%$terminoBusqueda%' OR
CedulaNit LIKE '%$terminoBusqueda%' OR
TelefonoPropietario LIKE '%$terminoBusqueda%' OR
CorreoPropietario LIKE '%$terminoBusqueda%' OR
Consultor LIKE '%$terminoBusqueda%' OR
TelefonoProyectista LIKE '%$terminoBusqueda%' OR
CorreoElectronicoProyectista LIKE '%$terminoBusqueda%' OR
Recursos LIKE '%$terminoBusqueda%' OR
Comuna LIKE '%$terminoBusqueda%' OR
Ingeniero LIKE '%$terminoBusqueda%' OR
Unidad LIKE '%$terminoBusqueda%' OR
Cantidad LIKE '%$terminoBusqueda%' OR
MLFacturados LIKE '%$terminoBusqueda%' OR
VrFacturado LIKE '%$terminoBusqueda%' OR
FechaLiquidacion LIKE '%$terminoBusqueda%' OR
FechaPago LIKE '%$terminoBusqueda%' OR
NoOficio LIKE '%$terminoBusqueda%' OR
DatoBasico LIKE '%$terminoBusqueda%' OR
FDatoBasico LIKE '%$terminoBusqueda%' OR
FechaDevolucion1 LIKE '%$terminoBusqueda%' OR
DiasRev1 LIKE '%$terminoBusqueda%' OR
FechaRevision2 LIKE '%$terminoBusqueda%' OR
FechaDevolucion2 LIKE '%$terminoBusqueda%' OR
DiasRev2 LIKE '%$terminoBusqueda%' OR
FechaRevision3 LIKE '%$terminoBusqueda%' OR
FechaDevolucion3 LIKE '%$terminoBusqueda%' OR
DiasRev3 LIKE '%$terminoBusqueda%' OR
FechaRevision4 LIKE '%$terminoBusqueda%' OR
FechaDevolucion4 LIKE '%$terminoBusqueda%' OR
DiasRev4 LIKE '%$terminoBusqueda%' OR
FechaRevision5 LIKE '%$terminoBusqueda%' OR
FechaDevolucion5 LIKE '%$terminoBusqueda%' OR
DiasRev5 LIKE '%$terminoBusqueda%' OR
DiasEnRevision LIKE '%$terminoBusqueda%' OR
FechaAprobacion LIKE '%$terminoBusqueda%' OR
OficioAprobacionNo LIKE '%$terminoBusqueda%'";

$resultado = mysqli_query($conexion, $sql); 

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
            }th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        
        .btn-editar {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-eliminar {
            background-color: #f44336;
            color: white;
        }
        
        .btn-agregar {
            background-color: #f44336;
            color: white;
            margin-bottom: 10px;
        }.button-container {
                text-align: right;
            }
        
        </style>
    </head>
    <body>
    <div class="button-container">
            <form action="descargarext.php" method="post">
                <input type="submit" name="descargar" value="Descargar Datos">
            </form>
        </div>
        <h2>REDES EXTERNAS</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <button onclick="window.location.href = 'crear_externas.php';" class="btn btn-agregar">crear nuevo proyecto</button>
       
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
                <th>tipo proyecto</th>
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
                <th>FECHA REVISIÓN 3</th>
                <th>FECHA DEVOLUCIÓN 3</th>
                <th>DIAS REV. 3</th>
                <th>FECHA REVISIÓN 4</th>
                <th>FECHA DEVOLUCIÓN 4</th>
                <th>DIAS REV. 4</th>
                <th>FECHA REVISIÓN 5</th>
                <th>FECHA DEVOLUCIÓN 5</th>
                <th>DIAS REV. 5</th>
                <th># DIAS EN REVISIÓN</th>
                <th>FECHA APROBACIÓN</th>
                <th>OFICIO APROBACIÓN No.</th>
                <th>Acciones</th>
            </tr>
            <?php
            
            // Iterar sobre los resultados y mostrar los datos en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td><?php echo $fila['TipoProyecto']; ?></td>
                    <td><?php echo $fila['Actividad']; ?></td>
                    <td><?php echo $fila['Servicio']; ?></td>
                    <td><?php echo $fila['Consecutivo']; ?></td>
                    <td><?php echo $fila['Anio']; ?></td>
                    <td><?php echo $fila['FIngreso1']; ?></td>
                    <td><?php echo $fila['DescripcionProyecto']; ?></td>
                    <td><?php echo $fila['Direccion']; ?></td>
                    <td><?php echo $fila['PropietarioProyecto']; ?></td>
                    <td><?php echo $fila['Estado']; ?></td>
                    <td><?php echo $fila['EstadoAtencion']; ?></td>
                    <td><?php echo $fila['FechaEstado']; ?></td>
                    <td><?php echo $fila['DireccionPropietario']; ?></td>
                    <td><?php echo $fila['CedulaNit']; ?></td>
                    <td><?php echo $fila['TelefonoPropietario']; ?></td>
                    <td><?php echo $fila['CorreoPropietario']; ?></td>
                    <td><?php echo $fila['Consultor']; ?></td>
                    <td><?php echo $fila['TelefonoProyectista']; ?></td>
                    <td><?php echo $fila['CorreoElectronicoProyectista']; ?></td>
                    <td><?php echo $fila['Recursos']; ?></td>
                    <td><?php echo $fila['Comuna']; ?></td>
                    <td><?php echo $fila['Ingeniero']; ?></td>
                    <td><?php echo $fila['Unidad']; ?></td>
                    <td><?php echo $fila['Cantidad']; ?></td>
                    <td><?php echo $fila['MLFacturados']; ?></td>
                    <td><?php echo $fila['VrFacturado']; ?></td>
                    <td><?php echo $fila['FechaLiquidacion']; ?></td>
                    <td><?php echo $fila['FechaPago']; ?></td>
                    <td><?php echo $fila['NoOficio']; ?></td>
                    <td><?php echo $fila['DatoBasico']; ?></td>
                    <td><?php echo $fila['FDatoBasico']; ?></td>
                    <td><?php echo $fila['FechaDevolucion1']; ?></td>
                    <td><?php echo $fila['DiasRev1']; ?></td>
                    <td><?php echo $fila['FechaRevision2']; ?></td>
                    <td><?php echo $fila['FechaDevolucion2']; ?></td>
                    <td><?php echo $fila['DiasRev2']; ?></td>
                    <td><?php echo $fila['FechaRevision3']; ?></td>
                    <td><?php echo $fila['FechaDevolucion3']; ?></td>
                    <td><?php echo $fila['DiasRev3']; ?></td>
                    <td><?php echo $fila['FechaRevision4']; ?></td>
                    <td><?php echo $fila['FechaDevolucion4']; ?></td>
                    <td><?php echo $fila['DiasRev4']; ?></td>
                    <td><?php echo $fila['FechaRevision5']; ?></td>
                    <td><?php echo $fila['FechaDevolucion5']; ?></td>
                    <td><?php echo $fila['DiasRev5']; ?></td>
                    <td><?php echo $fila['DiasEnRevision']; ?></td>
                    <td><?php echo $fila['FechaAprobacion']; ?></td>
                    <td><?php echo $fila['OficioAprobacionNo']; ?></td>
          
                    <td>
                        <a href="editar_ext.php?id=<?php echo $fila['id']; ?>"class='btn btn-editar'>Editar</a>
                        <a href="eliminar_externas.php?id=<?php echo $fila['id']; ?>"class='btn btn-eliminar'>Eliminar</a>
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
            }.button-container {
                text-align: right;
            }
        </style>
    </head>
    <body>
    <div class="button-container">
            <form action="descargarext.php" method="post">
                <input type="submit" name="descargar" value="Descargar Datos">
            </form>
        </div>
        <h2>REDES EXTERNAS</h2>
        <form method="GET" action="">
            <input type="text" name="termino_busqueda" placeholder="Buscar...">
            <input type="submit" value="Buscar">
        </form>
        <button onclick="window.location.href = 'crear_externas.php';">crear nuevo proyecto</button>
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
                <th>tipo proyecto</th>
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
                <th>FECHA REVISIÓN 3</th>
                <th>FECHA DEVOLUCIÓN 3</th>
                <th>DIAS REV. 3</th>
                <th>FECHA REVISIÓN 4</th>
                <th>FECHA DEVOLUCIÓN 4</th>
                <th>DIAS REV. 4</th>
                <th>FECHA REVISIÓN 5</th>
                <th>FECHA DEVOLUCIÓN 5</th>
                <th>DIAS REV. 5</th>
                <th># DIAS EN REVISIÓN</th>
                <th>FECHA APROBACIÓN</th>
                <th>OFICIO APROBACIÓN No.</th>
                <th>Acciones</th>
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

