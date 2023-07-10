
                       
<?php
require "parte superior.php";
// Configuración de conexión a MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rol";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a MySQL: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$NoOficio = $_POST['NoOficio'];
$tipo="application/pdf";
$archivo = $_FILES['archivo'];

// Verificar si se seleccionó un archivo
if ($archivo['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $archivo['tmp_name'];

    // Leer el contenido del archivo
    $contenido = file_get_contents($tmp_name);
    

    // Guardar los metadatos y el contenido en MySQL
    $sql = "INSERT INTO documentos_int (nombre, NumeroDeOficio, tipo, contenido) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre,$NoOficio, $tipo, $contenido);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "El archivo se ha subido correctamente a MySQL en int.";
} else {
    echo "Error al subir el archivo.";
}

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