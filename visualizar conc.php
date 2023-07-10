
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
$sql = "SELECT * FROM documentos_conc WHERE id LIKE '%$terminoBusqueda%' OR nombre LIKE '%$terminoBusqueda%' OR NumeroDeOficio LIKE '%$terminoBusqueda%'";

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
   
    <button onclick="window.location.href = 'subir_conc.php';">Subir Documento</button>
     
    <h1>Oficios de Aprobacion</h1>
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
        <thead>
            <tr>
               
                <th>Nombre</th>
                <th>Numero De Oficio</th>
                <th>visualizar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "rol");

            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }

            // Consulta para obtener los documentos
            $query = "SELECT * FROM documentos_conc";
            $resultado = mysqli_query($conexion, $query);

            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                   
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["NumeroDeOficio"] . "</td>";
                    echo "<td><a href=\"visualizar_documento_conc.php?id=" . $fila["id"] . "\" target=\"_blank\">Ver</a></td>";
                    ?>
                      <td>
                       <a href="editar_documentos_conc.php?id=<?php echo $fila['id']; ?>">Editar</a>
                       <a href="eliminar documentosconc.php?id=<?php echo $fila['id']; ?>">Eliminar</a>
                      </td>
                    <?php
                    echo "</tr>";
                }
            }
            } else {
                ?> 
            
    <!DOCTYPE html>
    <html>
    <head>
        <title>Conceptos Tecnicos</title>
        
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
   

    <h1>Oficios de Aprobacion Conceptos Tecnicos</h1>
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
        <thead>
            <tr>
               
                <th>Nombre</th>
                <th>Numero De Oficio</th>
                <th>visulaizacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                echo "<tr><td colspan='4'>No existen documentos</td></tr>";
            
            }

            // Cierre de la conexión
            mysqli_close($conexion);
           
            ?>
        </tbody>
    </table>
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
